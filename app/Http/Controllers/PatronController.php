<?php

namespace App\Http\Controllers;

use App\Models\Patron;
use App\Models\Book;
use Illuminate\Http\Request;

class PatronController extends Controller
{
    public function index()
    {
        return Patron::with('borrowRecords')->get();
    }

    public function store(Request $request)
    {
        return Patron::create($request->all());
    }

    public function update(Request $request, Patron $patron)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|unique:patrons,email,' . $patron->id,
        ]);

        $patron->update($data);
        return response()->json($patron);
    }

    public function destroy(Patron $patron)
    {
        $patron->delete();
        return response()->json(null, 204);
    }

    public function borrowBook(Request $request, Patron $patron)
    {
        $book = Book::findOrFail($request->input('book_id'));

        $isBorrowed = $patron->borrowedRecords()->where('book_id', $book->id)->whereNull('returned_on')->exists();
        if ($isBorrowed) {
            return response()->json(['error' => 'The book is already borrowed'], 400);
        }

        $patron->borrowedRecords()->create([
            'book_id' => $book->id,
            'borrowed_on' => now(),
            'due_back_on' => now()->addWeeks(2)
        ]);

        return response()->json(['message' => 'Book borrowed successfully']);
    }

    public function returnBook(Patron $patron, $bookId)
    {
        $book = Book::findOrFail($bookId);
        $borrowRecord = $patron->borrowedBooks()->where('book_id', $book->id)->whereNull('returned_on')->first();

        if (!$borrowRecord) {
            return response()->json(['error' => 'The book was not borrowed by this patron'], 400);
        }

        $borrowRecord->update(['returned_on' => now()]);
        return response()->json(['message' => 'Book returned successfully']);
    }
    public function show($id)
    {
        // Find the patron by ID
        $patron = Patron::find($id);

        // Check if the patron was found
        if (!$patron) {
            return response()->json(['error' => 'Patron not found'], 404);
        }

        return response()->json($patron, 200);
    }
}
