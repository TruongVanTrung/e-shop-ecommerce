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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', '255');
            $table->integer('price')->unsigned()->length(255);
            $table->foreignId('id_category')->constrained('category')->cascadeOnUpdate();
            $table->foreignId('id_brand')->constrained('brand')->cascadeOnUpdate();
            $table->integer('status')->unsigned()->comment = '1:sale 0:new';
            $table->integer('sale')->unsigned()->comment = '0:sale';
            $table->string('company', '255')->nullable();
            $table->string('detail', '255');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
