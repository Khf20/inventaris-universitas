<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-slate-700">
            {{ $label }}
            @if ($required ?? false)
                <span class="text-rose-600" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        @if (isset($icon))
            <span class="pointer-events-none absolute inset-y-0 left-0 flex w-10 items-center justify-center text-slate-400" aria-hidden="true"><i class="fas {{ $icon }}"></i></span>
        @endif

        @if ($type === 'textarea')
            <textarea
                name="{{ $name }}"
                id="{{ $name }}"
                {{ $attributes->except(['class', 'value']) }}
                placeholder="{{ $placeholder ?? ' ' }}"
                class="min-h-28 w-full resize-y rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 {{ isset($icon) ? 'pl-10' : '' }}"
                @required($required)
                aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}"
                rows="{{ $rows ?? 4 }}"
            >{{ $value ?? old($name) }}</textarea>
        @elseif ($type === 'select')
            <select
                name="{{ $name }}"
                id="{{ $name }}"
                {{ $attributes->except(['class', 'value']) }}
                class="w-full appearance-none rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 {{ isset($icon) ? 'pl-10' : '' }}"
                @required($required)
                aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}"
            >
                {{ $slot }}
            </select>
        @else
            <input
                type="{{ $type ?? 'text' }}"
                name="{{ $name }}"
                id="{{ $name }}"
                value="{{ $value ?? old($name) }}"
                placeholder="{{ $placeholder ?? ' ' }}"
                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 {{ isset($icon) ? 'pl-10' : '' }}"
                @required($required)
                aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}"
                {{ $attributes->except(['class', 'value']) }}
            >
        @endif
    </div>

    @error($name)
        <p class="flex items-start gap-1.5 text-xs font-medium text-rose-600" role="alert">
            <i class="fas fa-exclamation-circle mt-0.5" aria-hidden="true"></i> <span>{{ $message }}</span>
        </p>
    @enderror
</div>