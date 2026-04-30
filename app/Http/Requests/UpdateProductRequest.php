<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'qty' => 'sometimes|integer|min:1',
            'price' => 'sometimes|numeric|min:0',
            'user_id' => 'sometimes|exists:users,id',
            'kategori_id' => 'nullable|exists:kategoris,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.string' => 'Nama produk harus berupa teks.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

            'qty.integer' => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'qty.min' => 'Jumlah produk minimal 1.',

            'price.numeric' => 'Harga produk harus berupa angka yang valid.',
            'price.min' => 'Harga produk tidak boleh negatif.',

            'user_id.exists' => 'User yang dipilih tidak ditemukan.',

            'kategori_id.exists' => 'Kategori yang dipilih tidak ditemukan.',
        ];
    }
}
