<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'seo_title',
        'seo_description',
        'is_active',
        'picked_for_you_order',
        'image',
        'images',
        'video_url',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'images' => 'array',
    ];

    /** Relationships */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function mainImage()
    {
        return $this->belongsTo(\Awcodes\Curator\Models\Media::class, 'image');
    }

    public function productVideo()
    {
        return $this->belongsTo(\Awcodes\Curator\Models\Media::class, 'video_url');
    }

    public function getGalleryImagesAttribute()
    {
        if (empty($this->images)) return collect();
        return \Awcodes\Curator\Models\Media::whereIn('id', $this->images)->get();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    /** Scopes */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Mutators */
    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
        static::updating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
