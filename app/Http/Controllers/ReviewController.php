<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $exists = Review::where('user_id', Auth::id())
            ->where('product_id', $productId)->first();

        if (!$exists) {
            Review::create([
                'product_id' => $productId,
                'user_id'    => Auth::id(),
                'rating'     => $request->rating,
                'comment'    => $request->comment,
            ]);

            $avg = Review::where('product_id', $productId)->avg('rating');
            Product::find($productId)->update(['rating' => $avg]);
        }

        return back()->with('success', 'Review submitted!');
    }
}