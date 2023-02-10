<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CategoryController extends Controller
{
    public function getAllCategories($page = 1, $perPage = 10)
    {
       // Get the book data from the cache or from the API
        $category_all = cache()->remember('category_all', 60, function() {
            $client = new Client();
            $response = $client->get('https://api.rachnaye.com/api/book/portal/categoryBooks');
            return json_decode($response->getBody(), true);
        });
        $categories = [];
        $count = 0;
        foreach ($category_all['data'] as $category=>$books) {
            $categories[$category] = $books;
        }
        return $categories;

    }

    public function categoryAll()
    {
        $categories = $this->getAllCategories();
        // dd($categories);
        
        return view('/template', compact('categories'));
    }

    public function CategorySearch(Request $request,$category_slug)
    {
        $categories = $this->getAllCategories();
    // Get the book data from the cache or from the API
        $category_search = cache()->remember("category_search_$category_slug", 60, function() use ($category_slug) {
            // $url = "https://api.rachnaye.com/api/book/portal/category/".$category_slug;
            $client = new Client();
            $response = $client->get('https://api.rachnaye.com/api/book/portal/category/'.$category_slug);
            return json_decode($response->getBody(), true);
        });
        // $book = json_decode($category_search, true);
        $book = $category_search['data'];
        // dd($book);
        return view('/template', compact('book', 'categories'));
    }

}
