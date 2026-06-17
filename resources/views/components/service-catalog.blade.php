@php
    // Tu lógica de Section Blocking: respetando el orden cromático que decidiste para el scroll
    $categorySectionStyles = [
        'faciales' => [
            'sectionBg' => 'bg-spa-primary', // Rompe perfecto el bg-spa-bg de Sobre Nosotros
            'badge' => 'bg-white/60 text-spa-dark border border-white/20',
            'priceColor' => 'text-spa-deep',
            'iconDot' => 'bg-spa-deep'
        ],
        'masajes' => [
            'sectionBg' => 'bg-spa-bg', // Alterna de vuelta al arena suave para descansar la vista
            'badge' => 'bg-spa-primary/30 text-spa-dark border border-spa-primary/40',
            'priceColor' => 'text-spa-deep',
            'iconDot' => 'bg-spa-primary'
        ],
        'tratamientos' => [
            'sectionBg' => 'bg-spa-primary', // Cierra el bloque con el rosa viejo corporativo
            'badge' => 'bg-white/60 text-spa-dark border border-white/20',
            'priceColor' => 'text-spa-deep',
            'iconDot' => 'bg-spa-deep'
        ]
    ];
@endphp

<div id="servicios-menu" class="bg-spa-bg">
    @foreach($categories as $category)
        @php
            $style = $categorySectionStyles[$category->slug] ?? $categorySectionStyles['tratamientos'];
        @endphp

        <section id="{{ $category->slug }}" class="scroll-mt-20 py-20 lg:py-24 {{ $style['sectionBg'] }} transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

                {{-- ENCABEZADO DE CATEGORÍA --}}
                <div class="border-b border-spa-dark/10 pb-5">
                    <h2 class="text-3xl sm:text-4xl font-serif text-spa-dark capitalize font-bold flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full {{ $style['iconDot'] }} shrink-0"></span>
                        {{ $category->name }}
                    </h2>
                    @if($category->description)
                        <p class="text-spa-dark/70 text-sm mt-2 font-medium max-w-2xl leading-relaxed">{{ $category->description }}</p>
                    @endif
                </div>

                {{-- REJILLA DE TARJETAS UNIFICADAS EN BLANCO PURO (Consistencia de Sistema) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($category->services as $service)
                        <div class="bg-white rounded-3xl p-6 border border-spa-muted/30 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex flex-col justify-between group relative z-10 overflow-hidden">

                            <div class="space-y-4">
                                {{-- CONTENEDOR DE IMAGEN CON LINK INTERNO (`services.show`) --}}
                                <a href="{{ route('services.show', ['category' => $category->slug, 'slug' => $service->slug]) }}"
                                   class="block w-full h-48 bg-spa-bg rounded-2xl overflow-hidden relative group/img">
                                    <img src="{{ $service->image ? asset('storage/' . $service->image) : 'https://images.unsplash.com/photo-1600334089648-b0d9d3028eb2?auto=format&fit=crop&w=500&q=80' }}"
                                         alt="{{ $service->name }} - Soul Center León"
                                         class="w-full h-full object-cover group-hover/img:scale-105 transition-all duration-500 opacity-95 group-hover/img:opacity-100">

                                    <span class="absolute bottom-3 left-3 backdrop-blur-md px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $style['badge'] }} shadow-xs select-none">
                                        ⏱️ {{ $service->duration_minutes }} min
                                    </span>
                                </a>

                                {{-- INFORMACIÓN CON LINK EN EL TÍTULO --}}
                                <div class="space-y-2">
                                    <h3 class="text-xl font-serif font-bold text-spa-dark group-hover:text-spa-deep transition-colors">
                                        <a href="{{ route('services.show', ['category' => $category->slug, 'slug' => $service->slug]) }}" class="hover:underline decoration-spa-primary decoration-2 underline-offset-4">
                                            {{ $service->name }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-spa-dark/85 line-clamp-3 leading-relaxed font-medium">
                                        {{ strip_tags($service->description) }}
                                    </p>
                                </div>
                            </div>

                            {{-- CONTENEDOR DE PRECIO Y ACCIONES UNIFICADAS --}}
                            <div class="pt-4 mt-6 border-t border-spa-muted/20 space-y-4">
                                <div class="flex flex-col">
                                    <span class="text-[10px] uppercase tracking-widest text-spa-dark/40 font-bold font-sans">Inversión</span>
                                    <span class="text-2xl font-serif font-bold {{ $style['priceColor'] }}">${{ number_format($service->price, 0) }}</span>
                                </div>

                                {{-- REJILLA DE ACCIÓN COMPLETAMENTE CONSISTENTE --}}
                                <div class="grid grid-cols-2 gap-3 pt-1">
                                    <a href="{{ route('services.show', ['category' => $category->slug, 'slug' => $service->slug]) }}"
                                       class="text-center text-[10px] font-bold uppercase tracking-widest py-3.5 rounded-xl border border-spa-muted/60 text-spa-dark hover:bg-spa-bg/50 transition-all shadow-xs select-none">
                                        Ver detalles
                                    </a>

                                    <a href="https://wa.me/{{ $business->whatsapp ?? '5214776888128' }}?text={{ urlencode('Hola! Me interesa agendar el servicio de: ' . $service->name) }}"
                                       target="_blank"
                                       class="text-center text-[10px] font-bold uppercase tracking-widest py-3.5 rounded-xl bg-spa-deep text-white hover:bg-spa-dark transition-all shadow-xs select-none">
                                        Agendar
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endforeach
</div>
