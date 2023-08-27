<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRecord extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'patron_id', 'borrowed_on', 'due_back_on', 'returned_on'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function patron()
    {
        return $this->belongsTo(Patron::class);
    }
}
