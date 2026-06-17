@php
    // 1. CONFIGURACIÓN ESTRATÉGICA DE COLORES Y ATMÓSFERA SEGÚN LA CATEGORÍA (¡Colores favoritos de Karina!)
    $categorySectionStyles = [
        'faciales' => [
            'heroBg' => 'bg-linear-to-b from-spa-accent to-spa-bg',
            'badge' => 'bg-spa-aqua/30 text-spa-deep border border-spa-aqua/50',
            'blobColor' => 'bg-spa-aqua/20',
            'accentText' => 'text-spa-deep'
        ],
        'masajes' => [
            'heroBg' => 'bg-linear-to-b from-spa-primary to-spa-bg',
            'badge' => 'bg-spa-mint/40 text-spa-dark border border-spa-primary/60',
            'blobColor' => 'bg-spa-mint/20',
            'accentText' => 'text-spa-deep'
        ],
        'tratamientos' => [
            'heroBg' => 'bg-linear-to-b from-spa-primary/20 to-spa-bg',
            'badge' => 'bg-spa-primary/30 text-spa-dark border border-spa-primary/40',
            'blobColor' => 'bg-spa-primary/20',
            'accentText' => 'text-spa-deep'
        ]
    ];

    $style = $categorySectionStyles[$service->category->slug] ?? $categorySectionStyles['tratamientos'];

    // 2. SEO LOCAL AVANZADO
    $pageTitle = $service->name . " en León | " . ($business->name ?? 'Soul Center Spa');
    $pageDescription = $service->seo_description ?? "Disfruta de " . $service->name . " en Soul Center Spa. El mejor santuario de bienestar en Jardines del Moral, León, Gto. Agenda tu tratamiento hoy.";
@endphp

<x-layouts.app>
    <x-slot:title>{{ $pageTitle }}</x-slot:title>
    <x-slot:metaDescription>{{ $pageDescription }}</x-slot:metaDescription>

    {{-- SECCIÓN 1: HERO / DETALLE DEL SERVICIO --}}
    <section class="relative overflow-hidden pt-12 pb-20 {{ $style['heroBg'] }}">
        {{-- Blobs de fondo orgánicos --}}
        <div class="absolute -top-32 -right-32 w-96 h-96 {{ $style['blobColor'] }} rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -left-32 w-80 h-80 bg-white/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Enlace de retorno --}}
            <div class="mb-8">
                <a href="/#servicios-menu" class="text-xs uppercase tracking-widest font-bold text-spa-dark/60 hover:text-spa-deep transition-colors inline-flex items-center gap-2 font-sans select-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Volver a Servicios
                </a>
            </div>

            {{-- Rejilla Principal del Hero --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">

                {{-- Columna Izquierda: Galería/Imagen Emblema --}}
                <div class="relative group">
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-spa-deep/5 rounded-full blur-xl"></div>
                    <div class="overflow-hidden rounded-3xl border border-spa-muted/40 shadow-xs group-hover:shadow-md transition-all duration-500">
                        <img src="{{ $service->image ? asset('storage/' . $service->image) : 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=1200&q=80' }}"
                             alt="{{ $service->name }} en Soul Center Jardines del Moral"
                             class="w-full h-80 sm:h-112 object-cover transform scale-100 group-hover:scale-102 transition-transform duration-700 ease-out select-none">
                    </div>
                </div>

                {{-- Columna Derecha: Contenido Editorial --}}
                <div class="space-y-8">
                    <div class="space-y-4">
                        <span class="inline-block px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest font-sans {{ $style['badge'] }}">
                            {{ $service->category->name }}
                        </span>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-bold text-spa-dark tracking-tight leading-tight">
                            {{ $service->name }}
                        </h1>
                        <div class="w-12 h-0.5 bg-spa-primary rounded-full opacity-60"></div>
                    </div>

                    {{-- Tarjeta Metadatos del Tratamiento (Precio y Duración) --}}
                    <div class="flex flex-wrap items-center gap-6 p-5 bg-white/70 backdrop-blur-md rounded-2xl border border-spa-muted/30 shadow-2xs max-w-md">
                        <div class="space-y-1">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-spa-dark/50 block font-sans">Inversión</span>
                            <span class="text-2xl font-serif font-bold text-spa-peach">${{ number_format($service->price, 0) }} MXN</span>
                        </div>
                        <div class="w-px h-10 bg-spa-muted/40 hidden sm:block"></div>
                        <div class="space-y-1">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-spa-dark/50 block font-sans">Duración Total</span>
                            <span class="text-sm font-sans font-bold text-spa-dark flex items-center gap-1.5 uppercase tracking-wide">
                                <svg class="w-4 h-4 text-spa-peach shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $service->duration_minutes }} Minutos
                            </span>
                        </div>
                    </div>

                    {{-- Descripción Principal --}}
                    <p class="text-sm sm:text-base text-spa-dark/90 font-medium leading-relaxed font-sans">
                        {!! $service->description !!}
                    </p>

                    {{-- Botonera de Conversión Inmediata (Estilo Navbar/Welcome) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-lg pt-2">
                        <a href="https://wa.me/{{ $business->whatsapp ?? '5214776888128' }}?text={{ urlencode('Hola Soul Center! Deseo agendar una cita para el tratamiento de: ' . $service->name) }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-2.5 bg-spa-deep text-white font-sans font-bold text-xs uppercase tracking-widest px-8 py-4 rounded-full hover:bg-spa-mint hover:text-spa-dark transition-all shadow-xs hover:shadow-md select-none w-full">
                            <svg class="w-4 h-4 fill-current opacity-90" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.717-1.456L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.795 1.451 5.432 0 9.851-4.42 9.854-9.855.001-2.63-1.023-5.101-2.883-6.963C16.49 1.925 14.025 1.001 11.95 1.001c-5.434 0-9.857 4.422-9.86 9.856-.002 1.702.459 3.363 1.336 4.887l-1.01 3.693 3.784-.992z"/>
                            </svg>
                            Agendar Tratamiento
                        </a>

                        <a href="https://wa.me/{{ $business->whatsapp ?? '5214776888128' }}?text={{ urlencode('Hola Soul Center, tengo algunas dudas técnicas sobre el servicio de: ' . $service->name) }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-2 bg-transparent text-spa-dark border border-spa-deep font-sans font-bold text-xs uppercase tracking-widest px-8 py-4 rounded-full hover:bg-spa-deep/10 transition-all w-full select-none">
                            Consultar Dudas
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </section>

    {{-- SECCIÓN 2: BENEFICIOS DETALLADOS (RENDERIZADO FILAMENT) --}}
    @if($service->benefits)
        <section class="py-16 bg-white border-t border-spa-muted/30">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Encabezado de la sección --}}
                <div class="mb-10 space-y-2">
                    <span class="text-xs font-bold uppercase tracking-widest text-spa-deep block font-sans">Propiedades Holísticas</span>
                    <h2 class="text-2xl sm:text-3xl font-serif font-bold text-spa-dark">Beneficios del Tratamiento</h2>
                    <div class="w-12 h-0.5 bg-spa-primary rounded-full opacity-60"></div>
                </div>

                {{-- Contenedor del contenido HTML enriquecido --}}
                <div class="raw-benefits text-sm sm:text-base text-spa-dark/90 font-medium leading-relaxed font-sans space-y-4">
                    {!! $service->benefits !!}
                </div>

            </div>
        </section>
    @endif

    {{-- SECCIÓN 3: PREGUNTAS FRECUENTES (FAQs) Alpinejs --}}
    @if($service->faqs && $service->faqs->count() > 0)
        <section class="py-16 bg-spa-primary border-t border-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Encabezado de la sección --}}
                <div class="text-center max-w-2xl mx-auto mb-12 space-y-2">
                    <span class="text-xs font-bold uppercase tracking-widest text-spa-deep block font-sans">Preguntas Frecuentes</span>
                    <h2 class="text-2xl sm:text-3xl font-serif font-bold text-spa-dark">Preguntas sobre el Tratamiento</h2>
                    <div class="w-12 h-0.5 bg-spa-primary mx-auto rounded-full opacity-60 my-2"></div>
                </div>

                {{-- Contenedor del Acordeón con Alpine.js --}}
                <div x-data="{ active: null }" class="space-y-4">
                    @foreach($service->faqs as $faq)
                        <div class="border border-spa-muted/40 rounded-2xl bg-spa-bg/10 overflow-hidden transition-all duration-300"
                             :class="active === {{ $faq->id }} ? 'bg-spa-bg/30 shadow-xs border-spa-primary/40' : ''">

                            {{-- Botón / Pregunta --}}
                            <button type="button"
                                    class="w-full flex items-center justify-between p-5 text-left font-sans font-bold text-xs sm:text-sm text-spa-dark uppercase tracking-wider select-none focus:outline-hidden"
                                    @click="active = (active === {{ $faq->id }} ? null : {{ $faq->id }})">
                                <span>{{ $faq->question }}</span>
                                <span class="ml-4 shrink-0 p-1 rounded-xl bg-white border border-spa-muted/30 text-spa-peach transition-transform duration-300"
                                      :class="active === {{ $faq->id }} ? 'rotate-180 bg-spa-primary/20' : ''">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>

                            {{-- Respuesta --}}
                            <div x-show="active === {{ $faq->id }}"
                                 x-collapse
                                 x-cloak>
                                <div class="px-5 pb-5 pt-1 text-sm text-spa-dark/80 font-medium leading-relaxed border-t border-spa-muted/20 bg-white/50">
                                    {{ $faq->answer }}
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

    {{-- SECCIÓN 4: LOGROS DE MARCA --}}
    <x-trust-features />

    {{-- SECCIÓN 5: BANNER DE CIERRE Y CONVERSIÓN --}}
    <section class="bg-spa-mint/20 py-12 text-center border-t border-spa-muted/20">
        <div class="max-w-2xl mx-auto px-4 space-y-4">
            <h2 class="text-2xl font-serif text-spa-dark font-bold">Reservar tu momento de paz</h2>
            <p class="text-stone-600 text-xs sm:text-sm">Las citas son limitadas. Separa tu espacio hoy mismo.</p>
            <a href="https://wa.me/{{ $business->whatsapp ?? '5214776888128' }}?text={{ urlencode('Hola! Deseo separar mi espacio para el tratamiento de: ' . $service->name) }}"
               target="_blank"
               class="inline-block bg-spa-deep text-white px-8 py-3.5 rounded-full font-bold text-xs uppercase tracking-widest hover:bg-spa-mint hover:text-spa-dark transition shadow-xs">
                Consultar Disponibilidad
            </a>
        </div>
    </section>

    {{-- CORRECCIÓN DE ESTILOS PARA LOS BENEFICIOS DEL FILAMENT TINYMCE --}}
    <style>
        .raw-benefits ul { list-style-type: disc !important; padding-left: 1.25rem !important; margin: 0.5rem 0 !important; }
        .raw-benefits li { margin-bottom: 0.5rem !important; }
        .raw-benefits strong { color: #2B5054 !important; font-weight: 700 !important; }
    </style>
</x-layouts.app>
