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
        Schema::table('rate', function (Blueprint $table) {
            $table->foreignId('id_user')->constrained('users')->nullable()
                ->cascadeOnUpdate();
            $table->foreignId('id_blog')->constrained('blogs')->nullable()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rate', function (Blueprint $table) {
            //
        });
    }
};
