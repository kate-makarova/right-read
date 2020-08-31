<?php

namespace App\Jobs;

use App\Scrapers\Scraper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $scraper;
    private $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Scraper $scraper, string $url)
    {
        $this->scraper = $scraper;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->scraper->processArticle($this->url);
    }
}
