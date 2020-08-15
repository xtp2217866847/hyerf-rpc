<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('xtp_user', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name')->comment('用户姓名');
            $table->string('password')->comment('用户密码');
            $table->string('phone')->comment('手机号');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xtp_user');
    }
}
