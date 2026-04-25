<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('seller');

        // Search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Category Filter
        if ($request->category) {
            $query->where('category', $request->category);
        }

        // Free/Paid Filter
        if ($request->type == 'free') {
            $query->where('is_free', true);
        } elseif ($request->type == 'paid') {
            $query->where('is_free', false);
        }

        // Sort
        if ($request->sort == 'popular') {
            $query->orderBy('downloads', 'desc');
        } elseif ($request->sort == 'rating') {
            $query->orderBy('rating', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);

        return view('marketplace.index', compact('products'));
    }
}