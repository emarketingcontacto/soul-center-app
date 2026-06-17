<nav class="bg-spa-bg/90 backdrop-blur-md border-b border-spa-muted/30 sticky top-0 z-50 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

        <div class="flex items-center">
            <a href="/" class="text-xl sm:text-2xl font-serif tracking-widest text-spa-deep font-bold uppercase transition-colors hover:text-spa-mint">
                {{ $business->name }}
            </a>
        </div>

        <div class="hidden md:flex space-x-6 items-center">
            @foreach($categories as $category)
                <div class="relative group py-2">
                    <button class="flex items-center gap-1 font-sans font-bold text-xs text-spa-dark hover:text-spa-deep transition-colors uppercase tracking-widest focus:outline-hidden">
                        {{ $category->name }}
                        <svg class="w-4 h-4 text-spa-muted group-hover:text-spa-deep transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7\"></path>
                        </svg>
                    </button>

                    <div class="absolute left-0 mt-2 w-64 bg-white border border-spa-muted/40 rounded-2xl shadow-xl hidden group-hover:block z-50 py-2 overflow-hidden">
                        @foreach($category->services as $service)
                            <a href="{{ route('services.show', ['category' => $category->slug, 'slug' => $service->slug]) }}"
                               class="block px-4 py-3 text-xs text-spa-dark hover:bg-spa-bg/50 transition-all border-b border-spa-muted/10 last:border-0">
                                <div class="font-bold text-sm tracking-wide text-spa-deep hover:text-spa-mint transition-colors">{{ $service->name }}</div>
                                <span class="text-[11px] font-bold text-spa-peach block mt-0.5">{{ $service->duration_minutes }} min • ${{ number_format($service->price, 0) }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach

            @if(isset($externalServices) && $externalServices->count() > 0)
                <div class="relative group py-2">
                    <button class="flex items-center gap-1 font-sans font-bold text-xs text-spa-dark hover:text-spa-deep transition-colors uppercase tracking-widest focus:outline-hidden">
                        Especialistas
                        <svg class="w-4 h-4 text-spa-muted group-hover:text-spa-deep transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div class="absolute left-0 mt-2 w-64 bg-white border border-spa-muted/40 rounded-2xl shadow-xl hidden group-hover:block z-50 py-2 overflow-hidden">
                        @foreach($externalServices as $extService)
                            <a href="{{ route('external.services.show', $extService->slug) }}"
                               class="block px-4 py-3 text-xs text-spa-dark hover:bg-spa-bg/50 transition border-b border-spa-muted/10 last:border-0">
                                <div class="font-bold text-sm tracking-wide text-spa-deep transition-colors hover:text-spa-mint">{{ $extService->title }}</div>
                                <span class="text-[11px] font-medium text-spa-peach block mt-0.5">Por: {{ $extService->contacto }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <a href="#contacto" class="font-sans font-bold text-xs text-spa-dark hover:text-spa-deep transition-colors uppercase tracking-widest">Ubicación</a>
        </div>

        <div>
            <a href="https://wa.me/{{ $business->whatsapp }}?text=Hola%20Soul%20Center,%20me%20gustaría%20agendar%20una%20cita."
               target="_blank"
               class="bg-spa-deep text-white px-6 py-3 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-spa-mint hover:text-spa-dark transition-all shadow-xs hover:shadow-md">
                Agendar Cita
            </a>
        </div>
    </div>
</nav>
