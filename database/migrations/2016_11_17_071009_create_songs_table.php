<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('songs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('url');
            $table->timestamps();
            $table->integer('album_id')->unsigned();
            $table->foreign('album_id')
                ->references('id')->on('albums')
                ->onDelete('cascade');
            // $table->integer('artist_id')->unsigned();
            // $table->foreign('artist_id')
            //     ->references('id')->on('artists')
            //     ->onDelete('cascade');
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
        Schema::drop('songs');
    }
}
