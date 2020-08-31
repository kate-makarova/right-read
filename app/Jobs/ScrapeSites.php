<?php

namespace App\Jobs;

use App\Http\Scrapers\Scraper;
use App\Http\Services\TextTagService;
use App\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapeSites implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @param TextTagService $tagService
     * @return void
     */
    public function handle(TextTagService $tagService)
    {
        $sites = Site::all();

        foreach($sites as $site) {
            $job = new CollectArticles($site);
            $job::dispatch();
        }
    }
}
