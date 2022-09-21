<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookReservationTest extends TestCase
{
    // 5. start off with a fresh slate DB before each and every test case
    use RefreshDatabase;

    /**
     * @test
     *
     */
    public function a_book_can_be_added_to_the_library()
    {
        // 3. disable exception bubbling
        $this->withoutExceptionHandling();

        // 1. response object after a POST request
        $response = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'HXANT'
        ]);

        // 2. assert that the response was successful
        $response->assertOk();

        // 4. assert that there's only 1 book posted
        $this->assertCount(1, Book::all());
    }

    /**
     * @test
     * */
    public function a_title_is_required()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => '',
            'author' => 'HXANT'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function an_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /**
     * @test
     */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'HXANT'
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id, [
            'title' => 'New Book Title',
            'author' => 'New Book Author'
        ]);

        $this->assertEquals('New Book Title', Book::first()->title);
        $this->assertEquals('New Book Author', Book::first()->author);
    }
}

