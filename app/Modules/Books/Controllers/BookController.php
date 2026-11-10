<?php

namespace Modules\Books\Controllers;

use App\Http\Controllers\Controller;
use Modules\Books\Models\Book;
use Modules\Books\Requests\StoreBookRequest;
use Modules\Books\Exceptions\BookNotAvailableException;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->get();
        return response()->json($books);
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());
        return response()->json([
            'message' => 'Buku berhasil ditambahkan.',
            'data' => $book
        ], 201);
    }

    // Contoh penerapan Custom Exception ketika stok buku diperiksa/dipinjam habis
    public function borrow($id)
    {
        $book = Book::findOrFail($id);

        if ($book->stock <= 0) {
            throw new BookNotAvailableException($book->title);
        }

        $book->decrement('stock');

        return response()->json([
            'message' => "Buku '{$booktitle}' berhasil dipinjam.",
            'remaining_stock' => $book->stock
        ]);
    }
}