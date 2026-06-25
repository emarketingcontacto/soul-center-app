<header class="relative overflow-hidden py-16 lg:py-24 bg-linear-to-b from-spa-mint/15 to-spa-bg">
    <div class="absolute -top-20 -right-20 w-72 h-72 bg-spa-aqua/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6 text-center lg:text-left">
            <span class="text-xs font-bold uppercase tracking-widest text-spa-deep block font-sans">Tu oasis de paz en León, Gto</span>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif text-spa-dark leading-tight font-bold">
                El mejor <span class="italic font-normal text-spa-peach">Spa en León</span> para renovar tu bienestar
            </h1>

            <p class="text-base sm:text-lg text-spa-dark/90 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                Desconéctate del estrés cotidiano. Disfruta de masajes terapéuticos de clase mundial y tratamientos faciales botánicos diseñados a la medida de tu piel.
            </p>

            <div class="pt-2 flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                <a href="https://wa.me/5214776888128" target="_blank"
                   class="bg-spa-deep text-white text-center px-8 py-4 rounded-full font-bold text-xs uppercase tracking-widest hover:bg-spa-mint hover:text-spa-dark transition-all shadow-md hover:shadow-lg">
                    Reserva Directa
                </a>

                <a href="#servicios-menu"
                   class="bg-transparent border border-spa-deep text-spa-deep text-center px-8 py-4 rounded-full font-bold text-xs uppercase tracking-widest hover:bg-spa-deep/10 transition-all shadow-xs">
                    Ver Menú de Servicios
                </a>
            </div>
        </div>

       {{-- Contenedor de la Imagen con Slider Ligero en Alpine.js --}}
        <div class="relative mx-auto lg:mx-0 w-full max-w-md lg:max-w-none"
             x-data="{
                 active: 0,
                 images: [
                     '{{ asset('images/header/header.webp') }}',
                     '{{ asset('images/header/header2.webp') }}',
                     '{{ asset('images/header/header3.webp') }}',
                     '{{ asset('images/header/header5.webp') }}',
                     '{{ asset('images/header/header6.webp') }}'
                 ],
                 init() {
                     setInterval(() => {
                         this.active = (this.active + 1) % this.images.length;
                     }, 3000); {{-- Cambia de imagen cada 5 segundos --}}
                 }
             }">

            {{-- Fondo decorativo estilizado con gradiente --}}
            <div class="absolute inset-0 bg-linear-to-tr from-spa-primary/20 to-spa-aqua/20 rounded-3xl transform rotate-2 scale-105"></div>

            {{-- Contenedor de imágenes para aplicar el efecto Fade --}}
            <div class="relative w-full h-112.5 rounded-3xl shadow-2xl overflow-hidden border-4 border-white z-10">
                <template x-for="(img, index) in images" :key="index">
                    <img :src="img"
                         alt="Masajes relajantes en León Gto - Soul Center"
                         class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out"
                         :class="active === index ? 'opacity-100 z-10' : 'opacity-0 z-0'"
                         x-cloak>
                </template>
            </div>
        </div>


    </div>
</header>
