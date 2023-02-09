<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CategoryController;

use Illuminate\Http\Request;

class publisherController extends Controller
{
    public function show($publisher_id)
    {
       $category_all = new CategoryController; 
        $categories = $category_all->getAllCategories();
        
        // Get the book data from the cache or from the API
        // dd($author_id);
        $publisherBooks = cache()->remember("publisherBooks_{$publisher_id}", 60, function() use ($publisher_id) {
            $url = "https://api.rachnaye.com/api/publisher/".$publisher_id."/publishedBooks";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        });
        $publisher_book = json_decode($publisherBooks, true);
        $publisher_book = $publisher_book['data'];
        // dd($categories);
        return view('/template', compact('publisher_book', 'categories')); 
    }
}
