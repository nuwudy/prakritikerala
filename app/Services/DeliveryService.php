<?php

namespace App\Services;

use App\Models\ShopSetting;
use App\Models\ShippingRule;

class DeliveryService
{
    /**
     * Calculate aerial distance between two coordinates in kilometers using the Haversine formula.
     */
    public static function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371; // Radius of Earth in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    /**
     * Calculate delivery fee and distance breakdown.
     */
    public static function calculateFee(?float $customerLat = null, ?float $customerLng = null, ?float $cartWeight = null): array
    {
        $settings = ShopSetting::getSettings();
        $distance = null;
        $isFree = false;
        $fee = $settings->standard_shipping_fee ?? 50.00;
        $label = 'Standard Delivery';

        if ($customerLat !== null && $customerLng !== null && $settings->latitude && $settings->longitude) {
            $distance = self::calculateDistance(
                $settings->latitude,
                $settings->longitude,
                $customerLat,
                $customerLng
            );

            if ($settings->enable_free_delivery && $distance <= $settings->free_delivery_radius_km) {
                return [
                    'fee' => 0.00,
                    'is_free' => true,
                    'distance' => round($distance, 2),
                    'radius' => $settings->free_delivery_radius_km,
                    'label' => 'Free Local Delivery (' . round($distance, 1) . ' km away)',
                ];
            }
        }

        // If not within free radius or no coords, check weight-based shipping rules if configured
        if ($cartWeight !== null && $cartWeight > 0) {
            $rule = ShippingRule::where('min_weight', '<=', $cartWeight)
                ->where(function ($query) use ($cartWeight) {
                    $query->where('max_weight', '>=', $cartWeight)
                          ->orWhereNull('max_weight');
                })
                ->orderBy('min_weight', 'desc')
                ->first();

            if ($rule) {
                $fee = (float) $rule->fee;
                $label = 'Weight-based Shipping (' . $cartWeight . ' kg)';
            }
        }

        return [
            'fee' => (float) $fee,
            'is_free' => ($fee == 0.0),
            'distance' => $distance !== null ? round($distance, 2) : null,
            'radius' => $settings->free_delivery_radius_km,
            'label' => $distance !== null 
                ? 'Standard Delivery (' . round($distance, 1) . ' km)' 
                : $label,
        ];
    }
}
