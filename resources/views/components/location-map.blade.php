

<section id="contacto" class="py-20 bg-white border-t border-spa-muted/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ENCABEZADO EDITORIAL CONSISTENTE --}}
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-spa-deep block font-sans">Ubicación Estratégica</span>
            <h2 class="text-3xl sm:text-4xl font-serif font-bold text-spa-dark">Visita Nuestro Santuario</h2>
            <div class="w-12 h-0.5 bg-spa-primary mx-auto rounded-full opacity-60 my-2"></div>
            <p class="text-sm text-spa-dark/70 font-medium leading-relaxed">
                Nos encontramos en una de las zonas más exclusivas, tranquilas y de fácil acceso en León, Guanajuato.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">

            {{-- TARJETA DE INFORMACIÓN DE CONTACTO --}}
            <div class="lg:col-span-4 flex flex-col justify-between bg-spa-bg/40 p-8 rounded-3xl border border-spa-muted/40 shadow-xs space-y-8">

                <div class="space-y-6">
                    {{-- Bloque: Dirección --}}
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-spa-deep font-sans font-bold text-xs uppercase tracking-widest">
                            <span class="w-8 h-8 rounded-full bg-spa-aqua/40 flex items-center justify-center text-spa-peach shadow-2xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>
                            <h4>Dirección</h4>
                        </div>
                        <p class="text-sm text-spa-dark leading-relaxed font-medium pl-11">
                            Calle Dique 243,<br>
                            Col. Jardines del Moral, C.P. 37125<br>
                            León, Gto., México.
                        </p>
                    </div>

                    {{-- Bloque: Horarios --}}
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-spa-deep font-sans font-bold text-xs uppercase tracking-widest">
                            <span class="w-8 h-8 rounded-full bg-spa-aqua/40 flex items-center justify-center text-spa-peach shadow-2xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            <h4>Horario de Citas</h4>
                        </div>
                        <ul class="text-xs text-spa-dark/90 space-y-2 pl-11 font-medium">
                            <li class="flex justify-between border-b border-spa-muted/20 pb-1">
                                <span>Lunes a Viernes:</span>
                                <span class="font-bold text-spa-deep">9:30 AM – 8:00 PM</span>
                            </li>
                            <li class="flex justify-between border-b border-spa-muted/20 pb-1">
                                <span>Sábado:</span>
                                <span class="font-bold text-spa-deep">9:00 AM – 2:00 PM</span>
                            </li>
                            <li class="flex justify-between text-spa-dark/40 italic">
                                <span>Domingo:</span>
                                <span>Cerrado</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- BOTÓN DE ACCIÓN UNIFICADO CON EL SISTEMA --}}
                <div class="pt-4">
                    <a href="https://maps.google.com/?q=Calle+Dique+243+Jardines+del+Moral+Leon+Gto"
                       target="_blank"
                       class="inline-flex items-center justify-center gap-2 bg-spa-deep text-white font-sans font-bold text-xs uppercase tracking-widest px-6 py-4 rounded-full hover:bg-spa-dark transition-all shadow-xs hover:shadow-md w-full text-center">
                        <svg class="w-4 h-4 opacity-90" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        Abrir en Google Maps
                    </a>
                </div>

            </div>

            {{-- CONTENEDOR DEL IFRAME DEL MAPA (Mantiene el efecto grayscale interactivo elegante) --}}
            <div class="lg:col-span-8 h-96 lg:h-auto min-h-87.5 relative rounded-3xl overflow-hidden border border-spa-muted/40 shadow-xs">
                <iframe
                    class="absolute inset-0 w-full h-full border-0 grayscale opacity-90 hover:grayscale-0 transition-all duration-500"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7442.286406121628!2d-101.6916319!3d21.1466986!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842bbf010ae2b4df%3A0x5bc3e1e367288a48!2sSoul%20Center%20%26%20Wellness%20Spa!5e0!3m2!1sen!2smx!4v1779458857343!5m2!1sen!2smx"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>

            </div>

        </div>

    </div>
</section>
