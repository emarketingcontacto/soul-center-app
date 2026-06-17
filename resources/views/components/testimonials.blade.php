{{-- BLOQUE 1: BANNER DE AUTORIDAD Y PRUEBA SOCIAL (MENTA COMPLETO) --}}
<section class="bg-spa-mint py-16 my-5 text-center relative overflow-hidden shadow-xs border-y border-spa-muted/20">
    <div class="absolute -top-24 -left-24 w-48 h-48 bg-spa-deep/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-spa-deep/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 relative z-10 space-y-4">
        {{-- Estrellas consistentes --}}
        <div class="flex justify-center gap-1 text-spa-peach text-2xl select-none animate-pulse">★★★★★</div>

        <h2 class="text-3xl sm:text-4xl font-serif font-bold text-spa-dark">
            La confianza de nuestra comunidad
        </h2>
        <p class="text-spa-deep max-w-xl mx-auto text-base leading-relaxed font-bold">
            Orgullosos de contar con más de <span class="bg-white/60 px-2 py-0.5 rounded-md text-spa-deep font-extrabold shadow-2xs">174 opiniones de 5 estrellas</span> en Google. Nuestro compromiso es tu tranquilidad absoluta.
        </p>
    </div>
</section>

{{-- BLOQUE 2: REJILLA DE EXPERIENCIAS REALES (FONDOS Y BORDES UNIFICADOS) --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-16">

    {{-- Encabezado consistente con la fórmula de Sobre Nosotros y Catálogo --}}
    <div class="text-center space-y-3">
        <span class="text-xs font-bold uppercase tracking-widest text-spa-deep block font-sans">Experiencias Reales</span>
        <h3 class="text-3xl sm:text-4xl font-serif text-spa-dark font-bold">
            Lo que dicen nuestros clientes en León, Gto
        </h3>
        <div class="w-12 h-0.5 bg-spa-primary mx-auto rounded-full opacity-60"></div>
    </div>

    {{-- REJILLA DE TARJETAS: Mismo radio de curvatura (rounded-3xl) y bordes del catálogo --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <div class="bg-white p-8 rounded-3xl border border-spa-muted/40 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between relative group">
            <div class="space-y-4">
                <div class="flex text-spa-peach text-base">★★★★★</div>
                <p class="text-spa-dark/90 text-sm italic leading-relaxed font-medium">
                    "El mejor masaje relajante que me he hecho en León. Las instalaciones son hermosas y la atención es de primera de principio a fin."
                </p>
            </div>
            <div class="font-sans font-bold text-xs text-spa-deep/70 uppercase tracking-wider pt-6 mt-6 border-t border-spa-muted/20">
                — Mariana L.
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-spa-muted/40 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between relative group">
            <div class="space-y-4">
                <div class="flex text-spa-peach text-base">★★★★★</div>
                <p class="text-spa-dark/90 text-sm italic leading-relaxed font-medium">
                    "Hice el tratamiento de velo de novia y superó mis expectativas. Mi piel quedó radiante para el gran día. Súper recomendado."
                </p>
            </div>
            <div class="font-sans font-bold text-xs text-spa-deep/70 uppercase tracking-wider pt-6 mt-6 border-t border-spa-muted/20">
                — Sofía R.
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-spa-muted/40 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between relative group">
            <div class="space-y-4">
                <div class="flex text-spa-peach text-base">★★★★★</div>
                <p class="text-spa-dark/90 text-sm italic leading-relaxed font-medium">
                    "Los faciales para acné realmente funcionan. Tienen tecnología muy avanzada y te explican todo el proceso con mucha paciencia."
                </p>
            </div>
            <div class="font-sans font-bold text-xs text-spa-deep/70 uppercase tracking-wider pt-6 mt-6 border-t border-spa-muted/20">
                — Alejandro M.
            </div>
        </div>

    </div>
</section>

<!-- Seccion CTA Final en index.blade.php -->
<section class="bg-spa-bg py-6 text-center">
    <div class="max-w-2xl mx-auto px-4 space-y-3">
        <!-- Título usando el elegante color Gravy original -->
        <h2 class="text-3xl font-serif text-spa-dark font-bold">¿Lista para regalarte el descanso que mereces?</h2>
        <p class="text-spa-dark/90 font-medium">No dejes tu bienestar para después. Agenda tu cita hoy mismo vía WhatsApp y asegura tu espacio.</p>

        <!-- Botón llamativo usando tu verde océano profundo de fondo y texto claro arena -->
        <a href="https://wa.me/5214776888128" target="_blank" class="inline-block bg-spa-deep text-spa-bg px-8 py-4 rounded-full font-semibold hover:bg-spa-mint hover:text-spa-dark transition shadow-md">
            Agendar Mi Cita
        </a>
    </div>
</section>
