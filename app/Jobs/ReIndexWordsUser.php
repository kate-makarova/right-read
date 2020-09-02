<?php


namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;


class ReIndexWordsUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function handle()
    {
        DB::statement('UPDATE text_user
            JOIN
            (
                select wt.text_id, count(word_user.word) as known
                from word_user
                         join words w on word_user.word = w.word
                         join word_text wt on w.word = wt.word
                where user_id = '.$this->userId.'
                  and word_user.indexed = 0
                group by wt.text_id
            ) r
            SET known_words = known_words + r.known
            WHERE text_user.text_id = r.text_id and text_user.user_id = '.$this->userId);

        DB::table('word_user')
            ->where('id', $this->userId)
            ->where('indexed', 0)
            ->update(['indexed' => 1]);
    }

}
