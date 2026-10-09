<div {{ $attributes->merge(['class' => 'card rounded-2xl border border-slate-200 bg-white shadow-sm']) }}>
    @if (isset($header))
        <div class="flex items-center justify-between gap-4 border-b border-slate-200 px-6 py-5">
            <div class="flex items-center gap-3">
                @if (isset($icon))
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl" style="background:{{ $iconBg ?? '#eef2ff' }}; color:{{ $iconColor ?? '#4f46e5' }}" aria-hidden="true">
                        <i class="fas {{ $icon }}"></i>
                    </div>
                @endif
                <h3 class="text-base font-bold text-slate-900">{{ $header }}</h3>
            </div>
            @if (isset($action))
                <div class="shrink-0">{{ $action }}</div>
            @endif
        </div>
    @endif

    <div class="card-body {{ $bodyClass ?? 'p-6' }}">
        {{ $slot }}
    </div>
</div>