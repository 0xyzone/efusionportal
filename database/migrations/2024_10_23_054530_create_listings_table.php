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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->longText('description');
            $table->json('tags')->nullable();
            $table->integer('stock')->unsigned()->nullable();
            $table->decimal('purchased_price',15,2)->default(0);
            $table->decimal('offer_price',15,2)->default(0);
            $table->date('purchased_date')->nullable();
            $table->string('invoice_receipt')->nullable();
            $table->string('main_photo')->nullable();
            $table->string('condition')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
