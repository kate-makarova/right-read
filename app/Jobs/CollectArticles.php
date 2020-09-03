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

    /**
     * @var Site
     */
    private $site;

    /**
     * Create a new job instance.
     *
     * @param Site $site
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
        array_unique($urls);
        $existing = DB::table('texts')
            ->whereIn('direct_link', $urls)
            ->pluck('direct_link')->toArray();
        $urls = array_diff($urls, $existing);

        foreach($urls as $url) {
            ProcessArticle::dispatch($scraper, $url);
        }
    }
}
