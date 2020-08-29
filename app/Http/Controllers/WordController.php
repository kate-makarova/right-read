<?php


namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;

class WordController extends Controller
{
    public function add($word)
    {
        $present = DB::table('word_user')
            ->where('word', $word)
            ->where('user_id', $user = Auth::user()->id)
            ->count();

        $status = 'error';

        if($present) {
            DB::table('word_user')
                ->where('word', $word)
                ->where('user_id', $user = Auth::user()->id)
                ->delete();
            $status = 'removed';
        } else {
            $date = new \DateTime('now');
            DB::table('word_user')->insert([
                'word' => $word,
                'user_id' => $user = Auth::user()->id,
                'created_at' => $date->format('Y-m-d h:i:s')
            ]);
            $status = 'added';
        }

        return response()->json(['status' => $status]);
    }
}
