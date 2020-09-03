<?php


namespace App\Http\Controllers;



use App\Http\Services\TextTagService;
use App\Jobs\CollectArticles;
use App\Jobs\ReIndexWordsText;
use App\Jobs\ScrapeSites;
use App\Site;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function test(TextTagService $textTagService)
    {
        $t = 1;
        return response()->json(['This thing does' => 'nothing']);
    }
}
