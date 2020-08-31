<?php


namespace App\Http\Controllers;

use App\Http\Services\BBCMundoScraper;
use App\Http\Services\TextTagService;
use App\Text;
use App\Word;
use Illuminate\Support\Facades\DB;


class ScrapeController extends Controller
{
    public function scrape(TextTagService $tagService)
    {
       // $url = 'https://www.bbc.com/mundo/vert-tra-53407240';
        $scraper = new BBCMundoScraper();
        $textData = $scraper->scrapeWebPage($url);

        $uniqueWords = $tagService::getUniqueWords($textData['text']);

        $date = new \DateTime('now');

        $text = new Text([
            'text_title' => $textData['title'],
            'publication_date' => $date->format('Y-m-d h:i:s'),
            'site_name' => 'BBC Mundo',
            'direct_link' => $url,
            'lang' => 'Spanish',
            'total_words' => count($uniqueWords)
        ]);

        $text->save();
        $id = $text->getKey();

        foreach($uniqueWords as $uniqueWord)
        {
            Word::firstOrCreate([
                'word' => $uniqueWord,
                'lang' => 'Spanish'
            ]);

            DB::table('word_text')->insert(
                ['word' => $uniqueWord, 'text_id' => $id]
            );
        }
    }
}
