<?php


namespace App\Http\Services;

use App\Text;
use PHPHtmlParser\Dom;

class BBCMundoScraper
{
    public function scrapeWebPage($url = null): Text
    {
        $dom = new Dom;
        $dom->loadFromUrl($url);

        $title = $dom->find('title')[0]->innerHTML;

        $header = $this->findHeader($dom);
        $container = $header->getParent();
        $articleContainer = $this->findArticleContainer($container);
        $articleText = $articleContainer->text(true);

        $date = new \DateTime('now');

        $text = new Text([
            'text_title' => $title,
            'publication_date' => $date->format('Y-m-d h:i:s'),
            'site_name' => 'BBC Mundo',
            'direct_link' => $url,
            'lang' => 'Spanish',
            'blurb' => substr($articleText, 0, 255)
        ]);
        return $text;
    }

    private function findHeader($dom)
    {
        $title = $dom->find('title')[0]->innerHTML;
        $titleStart = substr($title, 0, 20);

        $articleHeader = false;
        $headerTags = ['h1', 'h2', 'h3'];
        foreach($headerTags as $headerTag) {
            $headers = $dom->find($headerTag);
            foreach ($headers as $header) {
                if (strpos($header->text(true), $titleStart) !== false) {
                    $articleHeader = $header;
                    break;
                }
            }
            if($articleHeader)
                break;
        }
        return $articleHeader;
    }

    private function findArticleContainer($container)
    {
        $max = 0;
        $maxLength = 0;
        foreach($container->getChildren() as $i => $child) {
            $length = strlen($child->innerHtml());
            if ($length > $maxLength) {
                $max = $i;
                $maxLength = $length;
            }
        }
        return $container->getChildren()[$max];
    }
}
