<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransaksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'barang_id' => ['required', 'integer', 'exists:barangs,id'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'tgl_pinjam' => ['required', 'date'],
            'tgl_kembali' => ['nullable', 'date', 'after_or_equal:tgl_pinjam'],
            'status' => ['required', Rule::in(['dipinjam', 'dikembalikan'])],
        ];
    }
}
