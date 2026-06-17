<section id="sobre-nosotros" class="scroll-mt-24 bg-spa-bg py-20 lg:py-28 border-b border-spa-muted/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

        {{-- COLUMNA IZQUIERDA: REJILLA ASIMÉTRICA CON TEXTO INTEGRADO AL SISTEMA --}}
        <div class="relative grid grid-cols-2 gap-4">
            {{-- Fondos difuminados alineados a la paleta oficial (Primary) --}}
            <div class="absolute -top-10 -left-10 w-72 h-72 bg-spa-primary/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-spa-primary/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="space-y-4 relative z-10">
                <img src="{{ asset('images/spa1.webp') }}"
                     alt="Atmósfera pacífica en Soul Center"
                     class="rounded-3xl shadow-xl object-cover w-full h-64 border-4 border-white">

                <div class="py-6 px-4 text-center bg-white rounded-3xl border border-spa-muted/40 shadow-xs flex flex-col items-center justify-center space-y-2">
                    <div class="flex items-center justify-center gap-2">
                        <span class="text-5xl font-serif font-bold text-spa-deep leading-none">5</span>
                        {{-- Círculo unificado con la paleta de Karina --}}
                        <div class="w-7 h-7 rounded-full bg-spa-primary/40 flex items-center justify-center shrink-0">
                            <span class="text-spa-peach font-bold font-sans text-sm">+</span>
                        </div>
                    </div>
                    <span class="block text-xs uppercase tracking-widest font-bold text-spa-dark font-sans">Años de Trayectoria</span>
                </div>
            </div>

            <div class="pt-12 space-y-4 relative z-10">
                <div class="bg-white p-6 rounded-3xl border border-spa-muted/40 shadow-xs space-y-2">
                    {{-- Círculo unificado con la paleta de Karina --}}
                    <div class="w-7 h-7 rounded-full bg-spa-primary/40 flex items-center justify-center text-spa-peach text-xs font-bold mb-1">✦</div>
                    <h4 class="text-xs font-bold font-sans text-spa-deep uppercase tracking-widest">Ubicación Exclusiva</h4>
                    <p class="text-xs text-spa-dark leading-relaxed font-medium">Ubicados en Jardines del Moral, un rincón pensado para tu aislamiento total del ruido urbano.</p>
                </div>

                <img src="{{ asset('images/spa2.webp') }}"
                     alt="Instalaciones de primer nivel - Soul Center Spa"
                     class="rounded-3xl shadow-xl object-cover w-full h-64 border-4 border-white">
            </div>
        </div>

        {{-- COLUMNA DERECHA: COPIA DE LA FÓRMULA DEL HERO Y FILOSOFÍA --}}
        <div class="space-y-6 relative z-10">
            <span class="text-xs font-bold uppercase tracking-widest text-spa-deep block font-sans">Nuestra Esencia</span>

            <h3 class="text-3xl sm:text-4xl lg:text-5xl font-serif text-spa-dark font-bold leading-tight">
                Un santuario privado concebido para tu <span class="italic font-normal text-spa-peach">renovación absoluta</span>
            </h3>

            <div class="text-base text-spa-dark/90 space-y-4 leading-relaxed font-medium">
                <p>
                    En <strong class="text-spa-deep font-bold font-sans uppercase text-xs tracking-wider">Soul Center</strong>, entendemos que el verdadero bienestar no es un lujo, sino una necesidad vital en León, Gto. Nacimos con el propósito fiel de ofrecer un refugio del ritmo acelerado del día a día.
                </p>
                <p>
                    Traspasar nuestra puerta es sumergirse en una experiencia donde se respira <span class="italic text-spa-peach font-semibold font-serif">paz, silencio y absoluta confianza</span>. Hemos cuidado minuciosamente cada aroma e iluminación para garantizar un ambiente profundamente acogedor.
                </p>
            </div>

            <div class="pt-2 flex lg:justify-start justify-center">
                <div class="w-16 h-0.5 bg-spa-primary rounded-full opacity-70"></div>
            </div>

            {{-- ✨ SECCIÓN DE CARACTERÍSTICAS FINALES: TU VERSIÓN PERFECCIONADA EN MARCA Y COLOR DE ICONO --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                <div class="bg-spa-primary text-spa-dark text-center px-6 py-4 rounded-full font-bold text-xs uppercase tracking-widest flex items-center justify-center gap-2 shadow-xs select-none">
                    <span class="text-spa-peach text-sm opacity-90">✦</span>
                    Atmósfera Zen
                </div>
                <div class="bg-spa-primary text-spa-dark text-center px-6 py-4 rounded-full font-bold text-xs uppercase tracking-widest flex items-center justify-center gap-2 shadow-xs select-none">
                    <span class="text-spa-peach text-sm opacity-90">✦</span>
                    Privacidad Absoluta
                </div>
            </div>
        </div>

    </div>
</section>
