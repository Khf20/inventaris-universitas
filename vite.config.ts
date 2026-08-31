import inertia from '@inertiajs/vite';
import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/app.tsx',
                'resources/js/pages/auth/confirm-password.tsx',
                'resources/js/pages/auth/forgot-password.tsx',
                'resources/js/pages/auth/login.tsx',
                'resources/js/pages/auth/register.tsx',
                'resources/js/pages/auth/reset-password.tsx',
                'resources/js/pages/auth/two-factor-challenge.tsx',
                'resources/js/pages/auth/verify-email.tsx',
                'resources/js/pages/dashboard.tsx',
                'resources/js/pages/settings/appearance.tsx',
                'resources/js/pages/settings/profile.tsx',
                'resources/js/pages/settings/security.tsx',
                'resources/js/pages/welcome.tsx',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        inertia(),
        react({
            babel: {
                plugins: ['babel-plugin-react-compiler'],
            },
        }),
        tailwindcss(),
        wayfinder({
            formVariants: true,
        }),
    ],
    server: {
        watch: {
            ignored: [
                '**/.agents/**',
                '**/.claude/**',
                '**/.cursor/**',
                '**/.junie/**',
                '**/vendor/**',
            ],
        },
    },
});
