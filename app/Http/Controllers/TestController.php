<?php


namespace App\Http\Controllers;


use App\Jobs\ScrapeSites;

class TestController extends Controller
{
    public function testScraperJob()
    {
        ScrapeSites::dispatch();
    }
}
