<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\ExternalService;
use Illuminate\Support\Facades\Log;

class ExternalServiceController extends Controller
{
    public function show(string $slug)
    {
        // Buscamos el servicio por el slug o lanzamos un 404 si no existe
        $externalService = ExternalService::with(['faqs' => function ($query) {
            $query->orderBy('sort_order', 'asc'); // Forzamos el orden nativo de Filament
        }])->where('slug', $slug)->firstOrFail();

        return view('external-services.show', compact('externalService'));
    }

    /**
     * 📈 Registra el click de conversión y redirecciona a WhatsApp.
     */
    public function trackClick(string $slug)
    {
        $externalService = ExternalService::where('slug', $slug)->firstOrFail();
        // 📊 Registro del evento de conversión en los logs de Laragon
        Log::info("Conversión de Lead - Servicio Externo: {$externalService->title} | Especialista: {$externalService->contacto}");
        // Estructuramos el mensaje personalizado
        $message = rawurlencode("¡Hola! Vi tu servicio de *{$externalService->title}* en la plataforma de Soul Center y me gustaría agendar una cita o pedir más información. ✨");
        // 🚀 Al grano: Usamos el campo directamente porque ya viene blindado con 10 dígitos puros
        $whatsappUrl = "https://wa.me/52{$externalService->whatsapp}?text={$message}";
        // Redireccionamos directamente a la app de WhatsApp
        return redirect()->away($whatsappUrl);
    }

}
