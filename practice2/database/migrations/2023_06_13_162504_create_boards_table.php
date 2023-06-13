<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // php artisan migrate 시 실행되는 함수
    public function up(): void
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->string('title', 64);
            $table->string('content',256);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    // php artisan migrate:rollback 시 실행되는 함수, 해당 테이블명을 삭제함
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};
