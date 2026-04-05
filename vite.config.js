import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/header.css',
                'resources/css/footer.css',
                'resources/css/formProd.css',
                'resources/css/forms.css',
                'resources/css/formulario.css',
                'resources/css/gestion.css',
                'resources/css/inicio.css',
                'resources/css/login.css',
                'resources/css/mapa.css',
                'resources/css/menu-lateral.css',
                'resources/css/perfil.css',
                'resources/css/producto.css',
                'resources/css/productos.css',
                'resources/css/register.css',
                'resources/css/subasta.css',
                'resources/css/subastas.css',
                'resources/css/tabla.css',
                'resources/css/terms.css',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/menu.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
        emptyOutDir: true,
        manifest: true,
    },
});
