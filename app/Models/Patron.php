<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patron extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public function borrowedRecords()
    {
        return $this->belongsToMany(Book::class, 'borrowed_books')
                    ->withPivot('borrowed_at', 'due_back', 'returned_at')
                    ->withTimestamps();
    }
}
