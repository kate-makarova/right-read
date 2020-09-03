<?php


namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;


class ReIndexWordsText implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        DB::statement('UPDATE text_user
                   JOIN
        (
           select word_text.text_id, word_user.user_id, count(word_text.word) as known
            from word_text
            join word_user on word_text.word = word_user.word
           where word_text.indexed = 0
           group by word_text.text_id, word_user.user_id
                ) r
         SET known_words = known_words
         WHERE text_user.text_id = r.text_id
         and text_user.user_id = r.user_id');

        DB::table('word_text')
            ->where('indexed', 0)
            ->update(['indexed' => 1]);
    }

}
