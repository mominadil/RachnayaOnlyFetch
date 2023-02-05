<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories($page = 1, $perPage = 10)
    {
        $categories = cache()->remember('category_all', 60, function() {
            $url = "https://api.rachnaye.com/api/book/portal/categoryBooks";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            $category_all = json_decode($response, true);
            $categories = [];
            foreach ($category_all['data'] as $category => $books) {
                foreach ($books as $key => $book) {
                    $slugify = new Slugify();
                    $slug = $slugify->slugify($book['title']);
                    $cachedImageUrl = Cache::remember('cached_image_url_'.$slug, 1440, function () use ($book, $slug) {
                        $imagePath = 'public/cached_images/image_'.$slug.'.jpg';
                        if (!Storage::exists($imagePath)) {
                            $image = file_get_contents($book['thumbnailFront']);
                            Storage::put($imagePath, $image);
                        }
                        return Storage::url($imagePath);
                    });
                    $book['thumbnailFront'] = $cachedImageUrl;
                    $categories[$category][$key] = $book;
                }
            }
            return $categories;
        });
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
