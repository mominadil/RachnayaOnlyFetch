<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CategoryController;

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
            $url = "https://api.rachnaye.com/api/author/".$author_id."/booksForPortal";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        });
        $author_book = json_decode($authorBooks, true);
        $author_book = $author_book['data'];
        // dd($categories);
        return view('/template', compact('author_book', 'categories'));
    }
}
