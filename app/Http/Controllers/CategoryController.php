<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories($page = 1, $perPage = 10)
    {
       // Get the book data from the cache or from the API
        $category_all = cache()->remember('category_all', 60, function() {
            $url = "https://api.rachnaye.com/api/book/portal/categoryBooks";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        });
        $category_all = json_decode($category_all, true);
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
        return view('/template', compact('categories'));
    }

    public function CategorySearch($category_slug)
    {
        $categories = $this->getAllCategories();
    // Get the book data from the cache or from the API
        $category_search = cache()->remember("category_search_$category_slug", 60, function() use ($category_slug) {
            $url = "https://api.rachnaye.com/api/book/portal/category/".$category_slug;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        });
        $book = json_decode($category_search, true);
        $book = $book['data'];
        // dd($book);
        return view('/template', compact('book', 'categories'));
    }

}
