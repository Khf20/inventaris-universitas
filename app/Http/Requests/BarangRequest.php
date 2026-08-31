<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BarangRequest extends FormRequest
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
            'kategori_id' => ['required', 'integer', 'exists:kategoris,id'],
            'nama' => ['required', 'string', 'max:150'],
            'jumlah' => ['required', 'integer', 'min:0'],
            'kondisi' => ['required', Rule::in(['baik', 'rusak', 'hilang'])],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'string', 'max:255'],
        ];
    }
}
