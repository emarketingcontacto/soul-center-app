<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;
use App\Models\ExternalService;


class Navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
   public function render(): View|Closure|string
    {
        // Categorías activas con servicios activos (Tu código original impecable)
        $categories = Category::where('is_active', true)
            ->whereHas('services', function ($query) {
                $query->where('is_active', true);
            })
            ->with(['services' => function ($query) {
                $query->where('is_active', true);
            }])
            ->get();

        //Servicios externos (solo los campos necesarios para el menú)
        $externalServices = ExternalService::select('id', 'title', 'slug', 'contacto')
        ->where('is_active', true)
        ->get();

        // variables de la vista de la Navbar
        return view('components.navbar')
            ->with('categories', $categories)
            ->with('externalServices', $externalServices); // 👈 Inyectamos la variable aquí
    }
}
