<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::firstOrCreate([
            'slug' => 'pantry'
        ], [
            'name' => 'Pantry Essentials',
            'description' => 'Everyday essentials for your kitchen.'
        ]);

        Product::firstOrCreate([
            'slug' => 'pure-coconut-oil'
        ], [
            'category_id' => $category->id,
            'name' => 'Pure Coconut Oil',
            'description' => 'Cold‑pressed, 100% natural pure coconut oil from Kerala.',
            'image' => 'product_coconut_oil_1787066952268.jpg',
            'is_active' => true,
        ]);

        Product::firstOrCreate([
            'slug' => 'organic-turmeric-powder'
        ], [
            'category_id' => $category->id,
            'name' => 'Organic Turmeric Powder',
            'description' => 'Vibrant colour, rich flavour. Sourced organically.',
            'image' => 'product_turmeric_1787066990188.jpg',
            'is_active' => true,
        ]);

        Product::firstOrCreate([
            'slug' => 'kerala-black-pepper'
        ], [
            'category_id' => $category->id,
            'name' => 'Kerala Black Pepper',
            'description' => 'Pungent, aromatic, premium quality black peppercorns.',
            'image' => 'product_black_pepper_1787067100180.jpg',
            'is_active' => true,
        ]);
    }
}
