<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return Author::with('books')->get();
    }

    public function store(Request $request)
    {
        $author = Author::create($request->only(['first_name', 'last_name']));
        return response()->json(['success' => true, 'author' => $author], 200);
    }

    public function update(Request $request, Author $author)
    {
        $author->update($request->all());
        return $author;
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json(null, 204);
    }
    public function show(Author $author)
    {
        return Author::with('books')->find($author->id);
    }
    public function search(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $name = $validatedData['name'];

        // Search for authors by name
        $authors = Author::where('first_name', 'like', '%' . $name . '%')
                    ->orWhere('last_name', 'like', '%' . $name . '%')
                    ->get();

        if ($authors->isEmpty()) {
            return response()->json(['message' => 'No authors found'], 404);
        }

        return response()->json($authors, 200);
    }
    public function booksByAuthor(Author $author)
    {
        $books = $author->books;
        return response()->json($books);
    }
}
