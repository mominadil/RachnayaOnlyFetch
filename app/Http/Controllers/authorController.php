<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CategoryController;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class authorController extends Controller
{
    public function categoryAll()
    {
        $categories = $this->getAllCategories();
        // dd($categories);
        
        // return view('/template', compact('categories'));
    }

    public function show($author_id)
    {
        $category_all = new CategoryController; 
        $categories = $category_all->getAllCategories();
        
        // Get the book data from the cache or from the API
        // dd($author_id);
        $authorBooks = cache()->remember("authorBooks_{$author_id}", 60, function() use ($author_id) {
            // $url = "https://api.rachnaye.com/api/author/".$author_id."/booksForPortal";
            $client = new Client();
            $response = $client->get('https://api.rachnaye.com/api/author/'.$author_id.'/booksForPortal');
            return json_decode($response->getBody(), true); 
        });
        $author_book = $authorBooks['data'];
        // dd($categories);
        return view('/template', compact('author_book', 'categories'));
    }
}
