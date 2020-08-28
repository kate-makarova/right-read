<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class TextTagService
{
    public static function tagText(string $text)
    {
        $words = self::textSplit($text);
        $uniqueWords = array_unique($words);
        $known = self::getKnownWords($uniqueWords);
        $pattern = [];
        $replacement = [];
        foreach($uniqueWords as $uniqueWord) {
            if (in_array($uniqueWord, $known))
                $tag = '~!!~';
            else
                $tag = '~!!!~';
            $pattern[] = '/(?<=[\s,.:;"\']|^)'.$uniqueWord.'(?=[\s,.:;"\']|$)/u';
            $replacement[] = '<' . $tag . '>' . $uniqueWord . '<~!~>';
        }
        $text = preg_replace($pattern, $replacement, $text) ;
        $text = str_replace('~!~', '/span', $text);
        $text = str_replace('~!!~', 'span class="text-tag" data-tag="known"', $text);
        $text = str_replace('~!!!~', 'span class="text-tag" data-tag="unknown"', $text);
        return $text;
    }

    public static function getKnownWords(array $words)
    {
        $result = DB::table('words')->whereIn('word', $words)->value('word');
        if(!is_array($result))
            return (array)$result;
        return sort($result);
    }

    protected static function textSplit($str)
    {
        return preg_split('~[^\p{L}\p{N}\']+~u',$str);
    }

}
