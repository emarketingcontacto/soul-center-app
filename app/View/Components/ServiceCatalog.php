<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class ServiceCatalog extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        // Traemos las categorías y servicios activos para el catálogo
        $categories = Category::where('is_active', true)
            ->whereHas('services', function ($query) {
                $query->where('is_active', true);
            })
            ->with(['services' => function ($query) {
                $query->where('is_active', true);
            }])
            ->get();

        return view('components.service-catalog')->with('categories', $categories);
    }
}
