<footer class="bg-spa-muted text-spa-bg/80 py-16 text-sm border-t border-spa-muted/20 relative overflow-hidden">
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-spa-primary/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-spa-mint/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 pb-12 border-b border-white/10">

            {{-- COLUMNA 1: IDENTIDAD DE LA MARCA --}}
            <div class="space-y-4">
                <span class="text-xl sm:text-2xl font-serif tracking-widest text-spa-peach font-bold block uppercase">
                    {{ $business->name ?? 'SOUL CENTER' }}
                </span>
                {{-- REDES SOCIALES UNIFICADAS AL SISTEMA DE DISEÑO --}}
                @if(isset($business->social_media) && count($business->social_media) > 0)
                    <div class="flex gap-3 pt-2">
                        @foreach($business->social_media as $platform => $url)
                            <a href="{{ $url }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="w-9 h-9 rounded-xl bg-spa-accent/60 flex items-center justify-center text-spa-dark/80 hover:bg-spa-peach/40 hover:text-spa-dark hover:-translate-y-0.5 transition-all duration-300 shadow-2xs group"
                               title="Síguenos en {{ ucfirst($platform) }}">
                                @if($platform === 'facebook')
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                                @elseif($platform === 'instagram')
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.01 3.71.054 1.139.052 1.9.232 2.508.468.641.249 1.183.575 1.722 1.113.536.537.859 1.077 1.107 1.714.242.612.421 1.397.473 2.531.045.926.054 1.268.054 3.71s-.01 2.784-.054 3.71c-.052 1.139-.232 1.9-.468 2.508a4.59 4.59 0 01-1.113 1.722 4.666 4.666 0 01-1.714 1.107c-.612.242-1.397.421-2.531.473-.926.045-1.268.054-3.71.054s-2.784-.01-3.71-.054c-1.139-.052-1.9-.232-2.508-.468a4.59 4.59 0 01-1.722-1.113 4.59 4.59 0 01-1.107-1.714c-.242-.612-.421-1.397-.473-2.531-.045-.926-.054-1.268-.054-3.71s.01-2.784.054-3.71c.052-1.139.232-1.9.468-2.508a4.59 4.59 0 011.113-1.722A4.59 4.59 0 016.72 2.704c.612-.242 1.397-.421 2.531-.473.926-.045 1.268-.054 3.71-.054zm0 2.232c-2.41 0-2.693.01-3.646.054-.92.042-1.42.196-1.753.325a2.357 2.357 0 00-.846.551 2.357 2.357 0 00-.551.846c-.129.333-.283.833-.325 1.753-.044.953-.054 1.236-.054 3.646s.01 2.693.054 3.646c.042.92.196 1.42.325 1.753.129.333.283.833.325 1.753.044.953.129.333.283.833.325 1.753a2.357 2.357 0 00.551.846c.333.129.833.283 1.753.325.953.044 1.236.054 3.646.054s2.693-.01 3.646-.054c.92-.042 1.42-.196 1.753-.325.333-.129.833-.283 1.753-.325.953-.044 1.236-.054 3.646-.054s2.693.01 3.646.054c.042-.92.196-1.42.325-1.753a2.357 2.357 0 00-.551-.846c-.333-.129-.833-.283-1.753-.325-.953-.044-1.236-.054-3.646-.054zm0 2.62a5.148 5.148 0 100 10.295 5.148 5.148 0 000-10.295zm0 8.064a2.917 2.917 0 110-5.834 2.917 2.917 0 010 5.834zm5.885-7.421a.674.674 0 11-1.348 0 .674.674 0 011.348 0z" clip-rule="evenodd"/></svg>
                                @elseif($platform === 'tiktok')
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.53.02C13.84 0 15.14.01 16.44 0c.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.06-2.89-.58-4.06-1.47-.07-.05-.12-.13-.25-.27v6.62c.03 1.87-.5 3.79-1.72 5.18-1.57 1.88-4.14 2.87-6.59 2.5-2.73-.32-5.18-2.31-5.83-5.01-.76-2.88.43-6.13 2.96-7.51.69-.4 1.46-.65 2.26-.77V13.3c-.34.05-.68.14-1 .28-1.35.58-2.22 1.99-2.14 3.46.05 1.55 1.18 2.94 2.71 3.14 1.58.26 3.22-.55 3.75-2.06.15-.44.2-.91.19-1.37V.02z"/></svg>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- COLUMNA 2: ENLACES RÁPIDOS DE NAVEGACIÓN --}}
            <div class="space-y-4 md:pl-8">
                <h4 class="text-spa-dark font-sans font-bold text-xs uppercase tracking-widest border-b border-white/10 pb-2">
                    Navegación
                </h4>
                <ul class="grid grid-cols-2 gap-x-4 gap-y-2.5 text-xs font-medium font-sans uppercase tracking-wider">
                    <li><a href="#" class="text-spa-dark/80 hover:text-spa-peach transition-colors">Inicio</a></li>
                    <li><a href="#sobre-nosotros" class="text-spa-dark/80 hover:text-spa-peach transition-colors">Nosotros</a></li>
                    <li><a href="#faciales" class="text-spa-dark/80 hover:text-spa-peach transition-colors">Faciales</a></li>
                    <li><a href="#masajes" class=" text-spa-dark/80 hover:text-spa-peach transition-colors">Masajes</a></li>
                    <li><a href="#tratamientos" class="text-spa-dark/80 hover:text-spa-peach transition-colors">Corporales</a></li>
                    <li><a href="#contacto" class="text-spa-dark/80 hover:text-spa-peach transition-colors">Ubicación</a></li>
                </ul>
            </div>

            {{-- COLUMNA 3: CONTACTO DIRECTO --}}
            <div class="space-y-4">
                <h4 class="text-spa-dark font-sans font-bold text-xs uppercase tracking-widest border-b border-white/10 pb-2">
                    Contacto & Citas
                </h4>
                <div class="space-y-2.5 text-xs font-medium">
                    <p class="flex items-center gap-2.5 text-spa-dark/70">
                        <svg class="w-4 h-4 text-spa-peach shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        <span>{{$business->address}}</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-spa-peach shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="https://wa.me/{{ $business->whatsapp ?? '5214776888128' }}" class="text-spa-dark/70 hover:text-spa-peach transition-colors font-sans tracking-wider">
                            {{ $business->whatsapp ?? '52 1 477 688 8128' }}
                        </a>
                    </p>
                </div>
            </div>

        </div>

        {{-- SECCIÓN DE CRÉDITOS Y COPYRIGHT --}}
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-[11px] text-spa-dark/50 font-sans uppercase tracking-wider font-medium gap-4">
            <div>
                &copy; {{ date('Y') }} {{ $business->name ?? 'Soul Center Spa' }}.
            </div>
        </div>
    </div>
</footer>
