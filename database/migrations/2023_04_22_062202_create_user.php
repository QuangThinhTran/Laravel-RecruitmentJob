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
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('img_avatar')->nullable()->default('avatar.jpg');
            $table->string('position')->nullable();
            $table->string('major')->nullable();
            $table->text('description')->nullable();
            $table->string('password')->nullable();
            $table->string('provider')->nullable();
            $table->string('remember_token')->nullable();

            $table->unsignedBigInteger('role_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
