<?php


namespace App\Http\Controllers;


class StaticController extends Controller
{
    public function about()
    {
        return response()->json([
            'title' => 'About this site',
            'content' => 'Some content'
        ]);
    }
}
