<?php


namespace App\Http\Controllers;


use App\StaticContent;

class StaticController extends Controller
{
    public function static($name)
    {
        $content = StaticContent::where('name', $name)->first();

        return response()->json([
            'title' => $content->text_title,
            'content' => $content->text_content
        ]);
    }
}
