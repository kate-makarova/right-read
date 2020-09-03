<?php


namespace App\Http\Controllers;

use Auth;
use App\Text;
use Illuminate\Support\Facades\DB;

class TextController extends Controller
{
    public function index()
    {
        $data = Db::table('texts')
            ->join('text_user', 'text_user.text_id', '=', 'texts.id')
            ->where('text_user.user_id', Auth::user()->id)
            ->select(
                'texts.text_title',
                'texts.site_name',
                'texts.direct_link',
            'texts.publication_date',
            'texts.total_words',
            'text_user.percentage',
            'text_user.known_words')
            ->orderBy('text_user.percentage', 'desc')
            ->get();



        return response()->json($data);
    }
}
