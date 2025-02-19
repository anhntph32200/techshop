<?php

use App\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('status')->default(Order::CHO_XAC_NHA); // Thay đổi tùy theo kiểu dữ liệu thực tế
            $table->string('payment_type')->nullable(); // Thay đổi tùy theo kiểu dữ liệu thực tế
            $table->string('payment_status')->default(Order::CHUA_THANH_TOAN); // Thay đổi tùy theo kiểu dữ liệu thực tế
            $table->decimal('total_price', 10, 2)->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('promotion_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('shipping_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->decimal('money_total', 10, 2)->nullable();
            $table->string('phone')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
