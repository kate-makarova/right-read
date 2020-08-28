<?php


namespace App\Http\Controllers;

use App\Http\Services\TextTagService;
use App\Text;

class TextController extends Controller
{
    public function index()
    {
        $books = Text::all()->toArray();
        return response()->json(array_reverse($books));
    }

    public function view($id, TextTagService $tagService)
    {
        $text = Text::find($id);
        $text->text_content = $tagService::tagText($text->text_content);
        return response()->json($text);
    }
}
