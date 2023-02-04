<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
class BookController extends Controller
{
    public function search($slug, $page = 1, $perPage = 10)
    {
        $books = cache()->remember('books', 60, function() use ($slug) {
            $url = "https://api.rachnaye.com/api/book/slug/".$slug;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response, true);
        });

    // Add the publisher details
        $book = $books['data'];
        $publisherId = $book['publisher']['id'];
        $publisher = cache()->remember("publisher_{$publisherId}", 60, function() use ($publisherId) {
            $url = "https://api.rachnaye.com/api/publisher/".$publisherId."/publishedBooks?pageNumber=0&pageSize=20";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response, true);
        });

        $book['publisher_details'] = $publisher['data'];

        return $book;
    }
    public function show($slug)
    {
        $book = $this->search($slug);
        return view('/book', compact('book'));
    }

}
