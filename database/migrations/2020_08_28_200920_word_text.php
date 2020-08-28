<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WordText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_text', function (Blueprint $table) {
            $table->string('word', 128);
            $table->integer('text_id');
            $table->index('word');
        });

        Schema::create('word_user', function (Blueprint $table) {
            $table->string('word', 128);
            $table->integer('user_id');
            $table->index('word');
            $table->index('user_id');
        });

        Schema::table('texts', function (Blueprint $table) {
            $table->integer('total_words');
            $table->dropColumn('read');
        });

        Schema::create('text_user', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('text_id');
            $table->integer('total_words');
            $table->boolean('read')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
