<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class ShopPage extends Component
{
    use WithPagination;

    public $search = '';
    public $category = null;
    public $minPrice = null;
    public $maxPrice = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'minPrice' => ['except' => ''],
        'maxPrice' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function filterByCategory($slug)
    {
        if ($this->category === $slug) {
            $this->category = null;
        } else {
            $this->category = $slug;
        }
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::active()->with(['category', 'variants']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->category) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', $this->category);
            });
        }

        if ($this->minPrice) {
            $query->whereHas('variants', function ($q) {
                $q->where('price', '>=', $this->minPrice);
            });
        }

        if ($this->maxPrice) {
            $query->whereHas('variants', function ($q) {
                $q->where('price', '<=', $this->maxPrice);
            });
        }

        $products = $query->paginate(12);
        $categories = Category::has('products')->get();

        return view('livewire.shop-page', [
            'products' => $products,
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
