<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advertentie;
use App\Category;
use App\Subcategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.home')
        ->withCategories(Category::all());
    }
}
