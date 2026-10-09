@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex w-full items-center gap-3 rounded-xl bg-[#e94762] px-3 py-3 text-sm font-semibold text-white shadow-lg shadow-rose-950/20 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/70'
            : 'flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/70';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
