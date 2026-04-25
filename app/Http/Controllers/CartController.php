<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->product->price);
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add($productId)
    {
        $exists = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();
        if (!$exists) {
            Cart::create(['user_id' => Auth::id(), 'product_id' => $productId]);
        }
        return back()->with('success', 'Added to cart!');
    }

    public function remove($productId)
    {
        Cart::where('user_id', Auth::id())->where('product_id', $productId)->delete();
        return back()->with('success', 'Removed from cart!');
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Cart is empty!');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price);

        $order = Order::create([
            'buyer_id'    => Auth::id(),
            'total_price' => $total,
            'status'      => 'completed',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'price'      => $item->product->price,
            ]);
            $item->product->increment('downloads');
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect('/orders')->with('success', 'Purchase successful!');
    }
}