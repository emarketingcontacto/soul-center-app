<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Muestra un servicio interno del Spa basado en su categoría y slug.
     */
    public function show(string $category, string $slug)
    {
        // Buscamos el servicio activo cargando sus FAQs ordenadas eficientemente
        $service = Service::where('slug', $slug)
                          ->where('is_active', true)
                          ->with(['faqs' => function($query) {
                              $query->orderBy('sort_order', 'asc');
                          }])
                          ->firstOrFail();

        // Validación de que la categoría de la URL coincida con la del servicio
        if ($service->category->slug !== $category) {
            abort(404);
        }

        // Enviamos únicamente la variable $service para mantener la vista limpia y segura
        return view('services.show', compact('service'));
    }
}
