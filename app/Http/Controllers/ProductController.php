<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with('seller')->findOrFail($id);
        return view('marketplace.show', compact('product'));
    }
}