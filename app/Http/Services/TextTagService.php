<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class TextTagService
{
    /**
     * Add known/unknown tags to every word in the text.
     *
     * @param string $text A text to tag.
     * @return string The same text, tagged.
     */
    public static function tagText(string $text): string
    {
        $words = self::textSplit($text);
        $words= array_map('strtolower', $words);
        $uniqueWords = array_unique($words);
        $empty = array_search('', $uniqueWords);
        unset($uniqueWords[$empty]);
        $known = self::getKnownWords($uniqueWords);

        $pattern = [];
        $replacement = [];
        foreach($uniqueWords as $uniqueWord) {
            if (in_array($uniqueWord, $known))
                $tag = '~!!~';
            else
                $tag = '~!!!~';
            $pattern[] = '/(?<=[\s,.:;"\']|^)'.$uniqueWord.'(?=[\s,.:;"\']|$)/ui';
            $replacement[$uniqueWord] = $tag;
        }
        $text = preg_replace_callback($pattern, function($matches)use($replacement) {
            return '<'.$replacement[strtolower($matches[0])].' word="' . $matches[0] . '"><~!~>';
        }, $text) ;

        $pattern = ['~!~', '~!!~', '~!!!~'];
        $replacement = [
            '/WordTag',
            'WordTag tag="known"',
            'WordTag tag="unknown"'];

        $text = str_replace($pattern, $replacement, $text);
        return '<div>'.$text.'</div>';
    }

    /**
     * Filter the list of given words and return those which are already known.
     *
     * @param array $words List of all the words in a text.
     * @return array List of known words (can be empty).
     */
    public static function getKnownWords(array $words): array
    {
        $result = DB::table('words')->whereIn('word', $words)->pluck('word')->all();
        if(!is_array($result))
            return (array)$result;
        return $result;
    }

    /**
     * Split a string into words, Unicode.
     *
     * @param $str
     * @return array|false|string[]
     */
    protected static function textSplit(string $str)
    {
        return preg_split('~[^\p{L}\p{N}\']+~u',$str);
    }
}
