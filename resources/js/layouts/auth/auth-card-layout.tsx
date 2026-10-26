import { Link } from '@inertiajs/react';
import type { PropsWithChildren } from 'react';
import { ShieldCheck } from 'lucide-react';
import AppLogoIcon from '@/components/app-logo-icon';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { home } from '@/routes';

export default function AuthCardLayout({
    children,
    title,
    description,
}: PropsWithChildren<{
    name?: string;
    title?: string;
    description?: string;
}>) {
    return (
        <div className="relative flex min-h-svh flex-col items-center justify-center overflow-hidden bg-gradient-to-br from-sky-50 via-white to-indigo-50 p-4 text-slate-900 [color-scheme:light] sm:p-6">
            <div className="pointer-events-none absolute -top-32 -left-32 size-80 rounded-full bg-cyan-300/30 blur-3xl" />
            <div className="pointer-events-none absolute -right-32 -bottom-32 size-80 rounded-full bg-fuchsia-300/25 blur-3xl" />

            <div className="relative flex w-full max-w-md flex-col gap-5">
                <Link
                    href={home()}
                    className="group flex flex-col items-center gap-3 self-center"
                >
                    <div className="flex size-12 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/25 transition-transform group-hover:scale-105">
                        <AppLogoIcon className="size-7 fill-current" />
                    </div>
                    <span className="text-sm font-semibold tracking-wide text-slate-700">
                        Inventaris Universitas
                    </span>
                </Link>

                <Card className="rounded-2xl border-slate-200 bg-white shadow-xl shadow-indigo-900/10">
                    <CardHeader className="gap-2 px-6 pt-7 text-center sm:px-10">
                        <CardTitle className="text-2xl tracking-tight text-slate-900">{title}</CardTitle>
                        <CardDescription className="text-sm text-slate-500">{description}</CardDescription>
                    </CardHeader>
                    <CardContent className="px-6 pb-7 text-slate-700 sm:px-10">
                        {children}
                    </CardContent>
                </Card>

                <div className="flex items-center justify-center gap-2 text-center text-xs text-slate-500">
                    <ShieldCheck className="size-3.5 text-emerald-600" />
                    <span>Data Anda terlindungi dan aman</span>
                </div>
            </div>
        </div>
    );
}
