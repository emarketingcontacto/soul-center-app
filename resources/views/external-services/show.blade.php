<x-layouts.app>
    {{-- Inyección de SEO Dinámico al Layout Base --}}
    @slot('title', $externalService->seo_title ?? $externalService->title . ' | Soul Center')
    @slot('metaDescription', $externalService->seo_description ?? Str::limit(strip_tags($externalService->description), 150))

    {{-- Contenedor principal con el fondo suave de Karina (Wishbone) --}}
    <div class="bg-spa-bg min-h-screen">

        <article class="max-w-4xl mx-auto px-4 py-12 md:py-16">

            {{-- 1. HERO SECTION: Cabecera equilibrada usando colores institucionales --}}
            <header class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 items-center mb-12">

                {{-- Datos del Servicio --}}
                <div class="md:col-span-6 flex flex-col justify-center">
                    <span class="text-xs font-bold tracking-widest text-spa-dark/70 uppercase block mb-2">
                        Servicio Externo Autorizado
                    </span>

                    <h1 class="font-serif text-3xl md:text-4xl text-spa-dark font-bold leading-tight mb-3">
                        {{ $externalService->title }}
                    </h1>

                    <p class="text-md text-spa-dark/80 font-medium mb-6">
                        Impartido por: <span class="text-spa-dark font-bold">{{ $externalService->contacto }}</span>
                    </p>

                    {{-- BOTÓN DE CONVERSIÓN: Estilizado con la identidad de la marca --}}
                    <div>
                        <a href="{{ route('external.services.click', $externalService->slug) }}"
                           class="inline-flex items-center justify-center bg-spa-dark hover:bg-spa-dark/90 text-spa-bg font-semibold px-8 py-3.5 rounded-full shadow-md transition-all duration-300 transform hover:-translate-y-0.5 w-full sm:w-auto">
                            <svg class="w-5 h-5 mr-3 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.4.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.713-1.457L0 24zm6.59-4.846c1.666.988 3.309 1.48 5.355 1.481 5.518 0 10.009-4.486 10.012-10.001.002-2.673-1.04-5.184-2.936-7.082C17.135 1.653 14.634.61 11.998.61c-5.524 0-10.014 4.487-10.017 10.002-.001 2.012.524 3.988 1.52 5.727L2.533 21.43l5.114-1.341z"/>
                            </svg>
                            Agendar con la Especialista
                        </a>
                    </div>
                </div>

                {{-- Imagen del Servicio con marco estético en Pie Crust --}}
                <div class="md:col-span-6 rounded-2xl overflow-hidden shadow-sm aspect-4/3 bg-spa-accent p-1">
                    <div class="w-full h-full rounded-xl overflow-hidden bg-spa-muted/30 flex items-center justify-center">
                        @if($externalService->image)
                            <img src="{{ asset('storage/' . $externalService->image) }}"
                                 alt="{{ $externalService->title }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="text-center p-8 text-spa-dark/40">
                                <svg class="w-12 h-12 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 002-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs font-sans">Imagen en optimización</span>
                            </div>
                        @endif
                    </div>
                </div>

            </header>

            <hr class="border-t border-spa-muted my-10">

            {{-- 2. SECCIÓN DE CONTENIDO EN FASES --}}
            <div class="space-y-12">

                {{-- FASE A: ACERCA DEL SERVICIO (Fondo blanco sutil para dar luz y súper contraste) --}}
                <section class="bg-white rounded-2xl p-6 md:p-8 border border-spa-muted/40 shadow-sm">
                    <h2 class="font-serif text-2xl text-spa-dark font-bold mb-4">
                        Acerca del Servicio
                    </h2>
                    {{-- Inyectamos tus clases de color de forma estricta para el RichEditor --}}
                    <div class="prose max-w-none text-base leading-relaxed font-sans text-spa-dark prose-p:text-spa-dark/90 prose-strong:text-spa-dark prose-strong:font-bold">
                        {!! $externalService->description !!}
                    </div>
                </section>

                {{-- FASE B: BENEFICIOS CLAVE (Usando Pie Crust de fondo para contrastar las fases) --}}
                @if($externalService->benefits)
                    <section class="bg-spa-accent/40 rounded-2xl p-6 md:p-8 border border-spa-accent">
                        <h2 class="font-serif text-2xl text-spa-dark font-bold mb-4">
                            Beneficios Clave
                        </h2>
                        <div class="prose max-w-none text-base font-sans text-spa-dark prose-p:text-spa-dark/90 prose-li:text-spa-dark/90 prose-strong:text-spa-dark">
                            {!! $externalService->benefits !!}
                        </div>
                    </section>
                @endif

                {{-- FASE C: PREGUNTAS FRECUENTES (Acordeones limpios con detalles Fine China) --}}
                @if($externalService->faqs->count() > 0)
                    <section>
                        <h2 class="font-serif text-2xl text-spa-dark font-bold mb-6 px-2">
                            Preguntas Frecuentes
                        </h2>

                        <div class="space-y-3" x-data="{ activeFaq: null }">
                            @foreach($externalService->faqs as $index => $faq)
                                <div class="border border-spa-muted rounded-xl bg-white overflow-hidden shadow-xs transition-all duration-200">
                                    {{-- Botón del Acordeón --}}
                                    <button type="button"
                                            class="w-full text-left px-6 py-4 flex justify-between items-center font-semibold text-spa-dark hover:bg-spa-bg/40 transition-colors font-sans"
                                            @click="activeFaq === {{ $index }} ? activeFaq = null : activeFaq = {{ $index }}">
                                        <span>{{ $faq->question }}</span>
                                        <svg class="w-5 h-5 text-spa-dark/60 transform transition-transform duration-200 shrink-0 ml-4"
                                             :class="activeFaq === {{ $index }} ? 'rotate-180' : ''"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>

                                    {{-- Contenido Desplegable (Fondo Wishbone muy sutil con texto nítido) --}}
                                    <div class="px-6 border-t border-spa-muted/40 bg-spa-bg/20 text-spa-dark/90 transition-all duration-300"
                                         x-show="activeFaq === {{ $index }}"
                                         x-collapse
                                         style="display: none;">
                                        <p class="py-4 leading-relaxed text-sm font-normal font-sans">
                                            {{ $faq->answer }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

            </div>

        </article>
    </div>
</x-layouts.app>
