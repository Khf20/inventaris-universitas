<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold text-slate-900">Tambah Barang</h2></x-slot>
    <div class="min-h-screen bg-slate-50 py-8"><div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8"><div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">@include('barang.form', ['action' => route('barang.store'), 'method' => 'POST', 'barang' => null])</div></div></div>
</x-app-layout>
