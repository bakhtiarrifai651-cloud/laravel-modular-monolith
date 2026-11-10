<?php

namespace Modules\Books\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class BookNotAvailableException extends Exception
{
    protected $bookTitle;

    public function __construct(string $bookTitle)
    {
        $this->bookTitle = $bookTitle;
        
        // Fitur Tambahan: Log error ke file storage/logs/laravel.log[cite: 15]
        Log::warning("Percobaan peminjaman gagal: Buku '{$bookTitle}' stok habis.");

        parent::__construct("Buku '{$bookTitle}' tidak tersedia karena stok habis.");
    }

    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $this->getMessage(),
                'error' => 'book_not_available',
            ], 422);
        }

        return back()->withErrors(['stock' => $this->getMessage()]);
    }
}