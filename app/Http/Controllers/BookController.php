<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class BookController extends Controller
{
    public function index(Request $request)
    {
        return Book::with('authors')->get();
    }

    // to Retrieve all record
    public function show($id)
    {
        return Book::find($id);
    }

    // To add a new record

    public function store(Request $request)
    {
        $book = Book::create($request->only(['title','description','ISBN','publication_date']));
        $book->authors()->sync(explode(',',$request->author_ids));
        return response()->json(['success'=>true,"book"=>$book],200);
    }
    //update record
    public function update(Request $request, Book $book) {
        $book->update($request->all());
        if ($request->input('author_ids')) {
            $book->authors()->sync($request->input('author_ids'));
        }
        return response()->json($book);
    }

    //delete a record
    public function destroy(Book $book) {
        try {
            $book->delete();
            return response()->json(['message' => 'Book deleted successfully'], 204);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Failed to delete the book.'], 400);
        }
    }
    // search book
    public function booksByAuthor(Author $author)
    {
        return response()->json($author->books);
    }

    // To search an record by title and author name

    public function search(Request $request)
    {
        $query = Book::query();
        if ($request->input('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        if ($request->input('author_name')) {
            $query->whereHas('authors', function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->input('author_name') . '%')
                    ->orWhere('last_name', 'like', '%' . $request->input('author_name') . '%');
            });
        }

        return $query->get();
    }
}
