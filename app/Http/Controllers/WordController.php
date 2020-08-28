<?php


namespace App\Http\Controllers;


class WordController extends Controller
{
    public function add($word)
    {
        return response()->json(['word' => $word]);
    }
}
