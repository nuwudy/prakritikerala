<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name',
        'warehouse_address',
        'latitude',
        'longitude',
        'free_delivery_radius_km',
        'enable_free_delivery',
        'enable_cod',
        'cod_extra_charge',
        'standard_shipping_fee',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'free_delivery_radius_km' => 'float',
        'enable_free_delivery' => 'boolean',
        'enable_cod' => 'boolean',
        'cod_extra_charge' => 'float',
        'standard_shipping_fee' => 'float',
    ];

    /**
     * Get or create the singleton settings record.
     */
    public static function getSettings(): self
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'shop_name' => 'Prakriti Kerala',
                'warehouse_address' => 'Kochi, Kerala, India',
                'latitude' => 9.9312328,
                'longitude' => 76.2673041,
                'free_delivery_radius_km' => 3.0,
                'enable_free_delivery' => true,
                'enable_cod' => true,
                'cod_extra_charge' => 0.0,
                'standard_shipping_fee' => 50.0,
            ]
        );
    }
}
