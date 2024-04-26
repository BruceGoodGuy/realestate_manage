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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('phone', 15);
            $table->string('email', 100)->nullable();
            $table->string('password', 200);
            $table->enum('status', [
                config('constants.user.status.created'),
                config('constants.user.status.active'),
                config('constants.user.status.blocked'),
            ])->default(0);
            $table->string('birthday', 10)->nullable();
            $table->text('note')->nullable();
            $table->string('address', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('ward', 100)->nullable();
            $table->string('referral_code', 100);
            $table->string('created_from');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
