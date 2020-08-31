<?php


namespace App\Http\Controllers;

use Auth;
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
            ->where('word_user.user_id', Auth::user()->id)
            ->count('*');

            $text['known_words'] = $known;
            $text['percentage'] = floor($known/$text['total_words']*100);
        }

        usort($texts, function($a, $b) {
            return $a['percentage'] > $b['percentage'] ? 1 : -1;
        });

        return response()->json(array_reverse($texts));
    }
}
