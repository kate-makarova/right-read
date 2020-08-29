<?php


namespace App\Http\Controllers;

use App\Http\Services\TextTagService;
use App\Text;
use Illuminate\Support\Facades\DB;

class TextController extends Controller
{
    public function index()
    {
        $texts = Text::all()->toArray();

        foreach($texts as &$text)
        {
            //todo: optimize the request
            $known = DB::table('word_text')
            ->join('word_user', 'word_text.word', '=', 'word_user.word')
            ->where('word_text.text_id', $text['id'])
            ->count('*');
            $text['known_words'] = $known;
            $text['blurb'] .= '...';
        }

        return response()->json(array_reverse($texts));
    }
}
