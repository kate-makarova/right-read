<?php


namespace App\Http\Controllers;



use App\Jobs\ReIndexWordsText;
use App\Jobs\ScrapeSites;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function test()
    {
        ReIndexWordsText::dispatchNow();
       // return response()->json(['This thing does' => 'nothing']);
    }
}
