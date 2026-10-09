<div {{ $attributes->merge(['class' => 'card']) }}>
    <div class="overflow-x-auto">
        <table class="{{ $tableClass ?? '' }}">
            @if (isset($headers))
                <thead>
                    <tr>
                        @foreach ($headers as $header)
                            <th class="{{ $header['class'] ?? '' }}"
                                @if (isset($header['width'])) style="width:{{ $header['width'] }}" @endif>
                                {{ $header['label'] ?? $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
            @endif

            <tbody class="divide-y">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if (isset($paginator) && $paginator->hasPages())
        <div class="pagination-wrapper">
            {{ $paginator->links() }}
        </div>
    @endif
</div>