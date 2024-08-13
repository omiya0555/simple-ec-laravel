<?php

namespace App\Http\Controllers\Ecapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $products = Product::all();
        //dd($products);
        return view('ecapp.index',compact('products'));
    }
}
