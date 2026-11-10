<?php

namespace Modules\Authors\Controllers;

use App\Http\Controllers\Controller;
use Modules\Authors\Models\Author;
use Modules\Authors\Requests\StoreAuthorRequest;
use Modules\Authors\Exceptions\AuthorHasBooksException;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->get();
        return response()->json($authors);
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());
        return response()->json([
            'message' => 'Penulis berhasil ditambahkan.',
            'data' => $author
        ], 201);
    }

    public function destroy($id)
    {
        $author = Author::with('books')->findOrFail($id);

        // Menerapkan Custom Exception jika penulis masih memiliki buku
        if ($author->books()->count() > 0) {
            throw new AuthorHasBooksException($author->name);
        }

        $author->delete();

        return response()->json([
            'message' => 'Penulis berhasil dihapus.'
        ]);
    }
}