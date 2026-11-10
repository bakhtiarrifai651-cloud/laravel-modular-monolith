<?php

namespace Modules\Books\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Authors\Models\Author;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'author_id',
        'title',
        'isbn',
        'published_year',
        'price',
        'stock',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}