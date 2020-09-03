<?php


namespace App\Http\Controllers;



use App\Jobs\ScrapeSites;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function test()
    {
        $job = new ScrapeSites();
        $job::dispatch();
       // return response()->json(['This thing does' => 'nothing']);
    }
}
