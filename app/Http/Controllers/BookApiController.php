<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookApiController extends Controller
{

    public function index()
    {
        return response()->json(Book::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|max:255",
            "writer" => "required|max:255",
            "description" => "required",
            "price" => "numeric",
            "file" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ]);

        $book = Book::create([
            "designation" => $request["title"],
            "auteur" => $request["writer"],
            "description"=> $request["description"],
            "prix"=> $request["price"]
        ]);

        return response()->json([
            'message' => "book created successfully !",
            "book" => $book
        ]);
    }


    public function show(Book $book)
    {
        if($book->id){
            return response()->json($book, 200);
        }
        return response()->json([
            "error" => "this book does not exists !"
        ]);
    }


    public function update(Request $request, Book $book)
    {
        $book->update([
            "designation" => $request->title,
            "auteur" => $request->writer,
            "description" => $request->description,
            "prix" => $request->price,
        ]);

        return response()->json([
            'message' => "book updated successfully !",
            "book" => $book
        ]);
    }


    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            "message" => "book deleted successfully !",
        ]);
    }
}