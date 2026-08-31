import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

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
        }),
    ],
});
