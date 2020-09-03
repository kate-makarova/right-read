<?php


namespace App\Scrapers;


use App\Http\Services\TextTagService;
use App\Site;
use App\Text;
use App\Word;
use Illuminate\Support\Facades\DB;
use PHPHtmlParser\Dom;

abstract class Scraper
{
    private $site;
    private $tagService;

    public function __construct(Site $site, TextTagService $textTagService)
    {
        $this->site = $site;
        $this->tagService = $textTagService;
    }

    abstract function scrapeWebPage(string $url): array;

    public function collectLinks(): array
    {
        $categories = json_decode($this->site->config);
        $urls = [];
        foreach($categories as $category) {
            $dom = new Dom;
            $dom->loadFromUrl($category->link);

            $titles = $dom->find($category->selector);

            foreach ($titles as $title) {
                $urls[] = $this->site->index_link . '/' . $title->href;
            }
        }
        return $urls;
    }

    public function processArticle($url)
    {
        $textData = $this->scrapeWebPage($url);

        $uniqueWords = $this->tagService::getUniqueWords($textData['text']);

        $date = new \DateTime('now');

        $text = new Text([
            'text_title' => $textData['title'],
            'publication_date' => $date->format('Y-m-d h:i:s'),
            'site_name' => $this->site->site_name,
            'direct_link' => $url,
            'lang' => $this->site->lang,
            'total_words' => count($uniqueWords)
        ]);

        $text->save();
        $id = $text->getKey();

        DB::statement('INSERT INTO text_user
        (text_id, user_id, known_words)
        SELECT '.$id.', id, 0 from users');

        foreach($uniqueWords as $uniqueWord)
        {
            Word::firstOrCreate([
                'word' => $uniqueWord,
                'lang' => 'Spanish'
            ]);

            DB::table('word_text')->insert(
                ['word' => $uniqueWord, 'text_id' => $id, 'indexed' => 0]
            );
        }
    }
}
