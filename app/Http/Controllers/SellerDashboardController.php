<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $products = Product::where('seller_id', Auth::id())->latest()->get();
        return view('seller.dashboard', compact('products'));
    }

    public function create()
    {
        return view('seller.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|min:3',
            'description'   => 'required|min:10',
            'category'      => 'required',
            'price'         => 'required|numeric|min:0',
            'preview_image' => 'nullable|image|max:2048',
            'file'          => 'nullable|file|max:10240',
        ]);

        $previewPath = null;
        $filePath    = null;

        if ($request->hasFile('preview_image')) {
            $previewPath = $request->file('preview_image')->store('previews', 'public');
        }

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('assets', 'public');
        }

        Product::create([
            'seller_id'     => Auth::id(),
            'title'         => $request->title,
            'description'   => $request->description,
            'category'      => $request->category,
            'price'         => $request->is_free ? 0 : $request->price,
            'is_free'       => $request->has('is_free'),
            'preview_image' => $previewPath,
            'file_path'     => $filePath,
        ]);

        return redirect('/seller/dashboard')->with('success', 'Product uploaded successfully!');
    }

    public function edit($id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);
        return view('seller.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);

        $product->update([
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category,
            'price'       => $request->is_free ? 0 : $request->price,
            'is_free'     => $request->has('is_free'),
        ]);

        return redirect('/seller/dashboard')->with('success', 'Product updated!');
    }

    public function destroy($id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);
        $product->delete();
        return redirect('/seller/dashboard')->with('success', 'Product deleted!');
    }
}