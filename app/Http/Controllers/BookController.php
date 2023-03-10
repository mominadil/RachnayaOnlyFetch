<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;

class BookController extends Controller
{
    public function search($slug, $page = 1, $perPage = 10)
    {
        $books = cache()->remember('books_'.$slug, 60, function() use ($slug) {
            $client = new Client();
            $response = $client->get('https://api.rachnaye.com/api/book/slug/'.$slug);
            return json_decode($response->getBody(), true);
        });
        // dd($books);
        if (!isset($books['data'])) {
            abort(404);
        }
        // Add the publisher details
        
        $book = $books['data'];
        $publisherId = $book['publisher']['id'];
        $publisher = cache()->remember("publisher_{$publisherId}", 60, function() use ($publisherId) {
            $client = new Client();
            $response = $client->get('https://api.rachnaye.com/api/publisher/'.$publisherId.'/publishedBooks?pageNumber=0&pageSize=20');
            return json_decode($response->getBody(), true);
        });

        $book['publisher_details'] = $publisher['data'];

        return $book;
    }
    
    public function show($slug)
    {
        $book = $this->search($slug);
        if (!$book) {
            abort(404);
        }
        return view('/book', compact('book'));
    }

}
