<?php


namespace App\Http\Controllers;



use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function test()
    {
        return response()->json(['This thing does' => 'nothing']);
    }
}
