<?php

namespace App\View\Components;

use App\Models\Author;
use App\Models\Language;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class ProductGrid extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public LengthAwarePaginator $products
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-grid', [
            'authors' => Author::orderBy("name")->get(),
            'languages' => Language::orderBy("name")->get(),
        ]);
    }
}
