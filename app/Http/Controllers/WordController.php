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
                'indexed' => 0,
                'user_id' => $user = Auth::user()->id,
                'created_at' => $date->format('Y-m-d h:i:s')
            ]);
            $status = 'added';
        }

        return response()->json(['status' => $status]);
    }

    public function known($words)
    {
        $known = DB::table('word_user')
            ->whereIn('word', $words)
            ->where('user_id', $user = Auth::user()->id)
            ->pluck('word')->toArray();
        $result  = [];
        foreach($words as $word) {
            if (in_array($word, $known))
                $result[$word] = 1;
            else
                $result[$word] = 0;
        }
        return $result;
    }
}
