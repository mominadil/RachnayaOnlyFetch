<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
class BookController extends Controller
{
    public function search($slug, $page = 1, $perPage = 10)
    {
    // Get the book data from the cache or from the API
        $books = cache()->remember('books', 60, function() {
            $url = "https://api.rachnaye.com/api/book/portal/allBooks";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        });
        $books = json_decode($books, true);

        // Convert the slug to text
        $slug = str_replace('-', ' ', $slug);
        $slug = ucwords(mb_strtolower($slug));

        // Filter the books by title
        $filtered_books = array_filter($books['data'], function ($book) use ($slug) {
            $title = str_replace('-', ' ', $book['title']);
            $title = ucwords(mb_strtolower($title));
            return $title == $slug;
        });

        // Paginate the books
        $paginated_books = array_slice($filtered_books, $perPage * ($page - 1), $perPage);

        // Return the paginated books
        return $paginated_books;
    }

}
