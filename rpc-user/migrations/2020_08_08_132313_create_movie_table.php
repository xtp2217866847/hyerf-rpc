<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateMovieTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('xtp_movie', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('cover')->comment('封面');
            $table->string('rate')->comment('评分');
            $table->string('title')->comment('标题');
            $table->string('url')->comment('链接');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xtp_movie');
    }
}
