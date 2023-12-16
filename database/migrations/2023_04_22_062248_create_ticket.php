<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('username')->nullable();
            $table->text('email')->nullable();
            $table->text('content')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->integer('ticket_id')->nullable();

            $table->unsignedBigInteger('from_user_id')->nullable();
            $table->unsignedBigInteger('to_user_id')->nullable();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('from_user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('to_user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('ticket_type')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('post')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
