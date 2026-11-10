<?php

namespace Modules\Books\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $currentYear = date('Y');

        return [
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'unique:books,isbn'],
            'published_year' => ['required', 'integer', 'min:1900', "max:{$currentYear}"],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'author_id' => ['required', 'exists:authors,id'],
        ];
    }

    public function messages(): array
    {
        $currentYear = date('Y');

        return [
            'title.required' => 'Judul buku wajib diisi.',
            'title.max' => 'Judul buku maksimal 255 karakter.',
            'isbn.required' => 'ISBN wajib diisi.',
            'isbn.unique' => 'ISBN sudah terdaftar.',
            'published_year.required' => 'Tahun terbit wajib diisi.',
            'published_year.integer' => 'Tahun terbit harus berupa angka.',
            'published_year.min' => 'Tahun terbit minimal tahun 1900.',
            'published_year.max' => "Tahun terbit tidak boleh melebihi tahun {$currentYear}.",
            'price.required' => 'Harga buku wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',
            'stock.required' => 'Stok buku wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'stock.min' => 'Stok tidak boleh negatif.',
            'author_id.required' => 'Penulis wajib dipilih.',
            'author_id.exists' => 'Penulis yang dipilih tidak valid.',
        ];
    }
}