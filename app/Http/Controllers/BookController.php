<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function store() {
        Book::create([
            'title' => request('title'),
            'author' => request('author')
        ]);
    }
}
