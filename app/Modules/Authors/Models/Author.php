<?php

namespace Modules\Authors\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Books\Models\Book;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = [
        'name',
        'email',
        'bio',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'author_id');
    }
}