<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CategoryController;

use Illuminate\Http\Request;

class searchController extends Controller
{
    public function search(Request $request)
    {
        $category_all = new CategoryController; 
        $categories = $category_all->getAllCategories();

        $key = $request->input('key');
        $results = cache()->remember("publisherBooks_{$key}", 60, function() use ($key) {
            $url = "https://api.rachnaye.com/api/book/portal/search?searchBy=".$key;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        });
        $results = json_decode($results, true);
        // dd($results);
        if (!isset($results['data'])) {
            abort(404);
        }
        $results = $results['data'];
        // $results = $results->data;
        return view('/template', compact('results', 'categories')); 
        // return view('search-results', ['results' => $results]);
    }
}
