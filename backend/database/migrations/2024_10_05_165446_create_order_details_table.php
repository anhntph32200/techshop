<?php

use App\Models\Productvariant;
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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(Productvariant::class)->constrained('product_variants'); 
            $table->integer('quantity');
            $table->decimal('listed_price', 10, 2);
            $table->decimal('sale_price', 10, 2);
            $table->decimal('import_price', 10, 2);
            $table->string('name');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
