<?php

namespace App\Jobs;

use App\Http\Services\TextTagService;
use App\Scrapers\Scraper;
use App\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CollectArticles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $site;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    /**
     * Execute the job.
     *
     * @param TextTagService $textTagService
     * @return void
     */
    public function handle(TextTagService $textTagService)
    {
        $scraperName = 'App\Scrapers\\'.$this->site->scraper;
        /** @var Scraper $scraper */
        $scraper = new $scraperName($this->site, $textTagService);
        $urls = $scraper->collectLinks();
        foreach($urls as $url) {

            $exists = DB::table('texts')
                ->where('direct_link', $url)
                ->count('*');

            if(!$exists) {
                $job = new ProcessArticle($scraper, $url);
                $job::dispatch();
            }
        }
    }
}
