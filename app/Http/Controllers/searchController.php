<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CategoryController;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function search(Request $request)
    {
        $category_all = new CategoryController; 
        $categories = $category_all->getAllCategories();

        $key = $request->input('key');
        $results = cache()->remember("publisherBooks_{$key}", 60, function() use ($key) {
            $client = new Client();
            $response = $client->get('https://api.rachnaye.com/api/book/portal/search?searchBy='.$key);
            return json_decode($response->getBody(), true);
        });
        // dd($results);
        if (!isset($results['data'])) {
            abort(404);
        }
        $results = $results['data'];
        if ($request->ajax()) {
            return response()->json($results);
        }
        // $results = $results->data;
        return view('/template', compact('results', 'categories')); 
        // return view('search-results', ['results' => $results]);
    }
}
