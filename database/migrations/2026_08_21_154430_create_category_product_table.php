<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        // Migrate data
        $products = DB::table('products')->whereNotNull('category_id')->get();
        foreach ($products as $product) {
            DB::table('category_product')->insert([
                'category_id' => $product->category_id,
                'product_id' => $product->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
        });

        // Attempt to restore data (will only restore one category per product)
        $pivotRecords = DB::table('category_product')->get();
        foreach ($pivotRecords as $record) {
            DB::table('products')->where('id', $record->product_id)->update([
                'category_id' => $record->category_id,
            ]);
        }

        Schema::dropIfExists('category_product');
    }
};
