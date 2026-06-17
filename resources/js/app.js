import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'; // Opcional: para la animación suave de x-collapse

// Si quieres usar la animación x-collapse del acordeón, registras el plugin:
Alpine.plugin(collapse);

window.Alpine = Alpine;
Alpine.start();
