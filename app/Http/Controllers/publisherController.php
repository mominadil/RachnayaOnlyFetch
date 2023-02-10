<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CategoryController;
use GuzzleHttp\Client;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class publisherController extends Controller
{
    public function show($publisher_id)
    {
       $category_all = new CategoryController; 
        $categories = $category_all->getAllCategories();
        
        // Get the book data from the cache or from the API
        // dd($author_id);
        $publisherBooks = cache()->remember("publisherBooks_{$publisher_id}", 60, function() use ($publisher_id) {
            $client = new Client();
            $response = $client->get('https://api.rachnaye.com/api/publisher/'.$publisher_id.'/publishedBooks?pageSize=10');
            return json_decode($response->getBody(), true);
        });
        $publisher_book = $publisherBooks['data'];
        // $publisher_book = collect($publisher_book)->paginate(10);
        // dd($categories);
        return view('/template', compact('publisher_book', 'categories')); 
    }
}
