<?php


namespace App\Http\Controllers;



use App\Jobs\ReIndexWordsText;
use App\Jobs\ScrapeSites;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function test()
    {
        ReIndexWordsText::dispatch();
       // return response()->json(['This thing does' => 'nothing']);
    }
}
