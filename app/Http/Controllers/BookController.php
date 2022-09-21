<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function store() {        
        $book = Book::create($this->validateRequest());

        return redirect('/books/' . $book->id);
    }

    public function update(Book $book) {
        $book->update($this->validateRequest());

        return redirect('/books/' . $book->id);
    }

    public function destroy(Book $book) {
        $book->delete();

        return redirect('/books');
    }

    protected function validateRequest() {
        return request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
    }
}
