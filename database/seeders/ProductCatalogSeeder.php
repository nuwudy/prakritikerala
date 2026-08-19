<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class ProductCatalogSeeder extends Seeder
{
    public function run()
    {
        $catalog = [
            'Spice Powders & Blends' => [
                'Kashmiri Chilly Powder' => ['250g', '500g', '1kg'],
                'Kashmiri Chilly 70% + Ordinary Chilly 30% Mix' => ['250g', '500g', '1kg'],
                'Kashmiri Chilly 50% + Ordinary Chilly 50% Mix' => ['250g', '500g', '1kg'],
                'Ordinary Chilly Powder' => ['250g', '1kg'],
                'Coriander Powder' => ['250g', '1kg'],
                'Turmeric Powder' => ['250g', '1kg'],
                'Garam Masala Powder' => ['250g', '1kg'],
            ],
            'Traditional Flours & Staples' => [
                'Sprouted Ragi Powder' => ['1kg'],
                'Rice Powder' => ['1kg', '5kg'],
                'Red Raw Rice Powder / Unakkalari Powder' => ['1kg', '5kg'],
            ],
            'Authentic Pickles & Preserves' => [
                'Beef Pickle' => ['500g', '1kg'],
                'Kera (Tuna) Pickle' => ['500g', '1kg'],
                'Prawns Pickle' => ['500g', '1kg'],
                'Dates and Lemon Pickle' => ['500g', '1kg'],
                'Mango Pickle' => ['500g', '1kg'],
                'Pulinji (പുളിഞ്ചി)' => ['250g', '500g', '1kg'],
                'Chicken Pickle' => ['250g', '500g', '1kg'],
            ],
            'Specialty Meat & Pure Oils' => [
                'Cooked Dried Beef / ഉണക്ക ഇറച്ചി പാചകം ചെയ്തത്' => ['250g', '500g', '1kg'],
                'Roasted Coconut Oil / വെന്ത വെളിച്ചെണ്ണ' => ['1kg'],
            ],
        ];

        foreach ($catalog as $categoryName => $products) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'description' => "Category for $categoryName",
                'image' => 'images/placeholder_spice.jpg',
            ]);

            foreach ($products as $productName => $weights) {
                $product = Product::create([
                    'category_id' => $category->id,
                    'name' => $productName,
                    'slug' => Str::slug($productName),
                    'description' => "Premium $productName sourced from Kerala.",
                    'seo_title' => "$productName – Prakriti Kerala",
                    'seo_description' => "Buy $productName – 100% natural, preservative‑free.",
                    'is_active' => true,
                    'image' => 'images/placeholder_spice.jpg',
                ]);

                foreach ($weights as $weight) {
                    $basePrice = 50; // base price per 250g in INR
                    $multiplier = (int) filter_var($weight, FILTER_SANITIZE_NUMBER_INT) / 250;
                    $price = $basePrice * $multiplier;

                    ProductVariant::create([
                        'product_id' => $product->id,
                        'weight' => $weight,
                        'price' => $price,
                        'sku' => Str::slug($productName) . '-' . $weight . '-' . uniqid(),
                        'stock' => 100,
                        'is_default' => $weight === '250g',
                    ]);
                }
            }
        }
    }
}
