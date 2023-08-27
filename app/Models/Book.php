<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'ISBN', 'publication_date'];
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_book', 'book_id', 'author_id');
    }
    public function patrons()
    {
        return $this->belongsToMany(Patron::class, 'borrowed_books')
                    ->withPivot('borrowed_at', 'due_back', 'returned_at')
                    ->withTimestamps();
    }
}
