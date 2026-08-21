<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\CartService;

class ProductDetailsPage extends Component
{
    public $product;
    public $selectedVariantId;
    public $quantity = 1;

    public $reviewerName;
    public $rating = 5;
    public $reviewComment;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)
            ->with(['variants', 'categories', 'approvedReviews'])
            ->firstOrFail();

        $defaultVariant = $this->product->variants->where('is_default', true)->first() 
                          ?? $this->product->variants->first();

        if ($defaultVariant) {
            $this->selectedVariantId = $defaultVariant->id;
        }
    }

    public function selectVariant($variantId)
    {
        $this->selectedVariantId = $variantId;
        $this->quantity = 1;
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        if (!$this->selectedVariantId) return;

        $variant = ProductVariant::with('product')->find($this->selectedVariantId);
        if ($variant) {
            CartService::add($variant, $this->quantity);
            $this->dispatch('cart-updated');
            session()->flash('message', 'Added to cart successfully!');
            return $this->redirect('/cart', navigate: true);
        }
    }

    public function submitReview()
    {
        $this->validate([
            'reviewerName' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'reviewComment' => 'required|string|max:1000',
        ]);

        $isApproved = $this->rating >= 4;

        $this->product->reviews()->create([
            'reviewer_name' => $this->reviewerName,
            'rating' => $this->rating,
            'comment' => $this->reviewComment,
            'is_approved' => $isApproved,
        ]);

        $this->reset(['reviewerName', 'rating', 'reviewComment']);
        
        if ($isApproved) {
            $this->product->load('approvedReviews'); // reload approved reviews
            session()->flash('review_message', 'Thank you! Your review has been posted.');
        } else {
            session()->flash('review_message', 'Thank you! Your review has been submitted and is pending moderation.');
        }
    }

    public function render()
    {
        $selectedVariant = collect($this->product->variants)->firstWhere('id', $this->selectedVariantId);

        return view('livewire.product-details-page', [
            'selectedVariant' => $selectedVariant,
        ])->layout('layouts.app');
    }
}
