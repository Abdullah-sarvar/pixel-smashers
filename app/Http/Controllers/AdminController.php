<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;

class AdminController extends Controller
{
    public function index()
    {
        $users    = User::latest()->get();
        $products = Product::with('seller')->latest()->get();
        $orders   = Order::with(['user', 'items'])->latest()->get();
        $reviews  = Review::with(['user', 'product'])->latest()->get();

        $stats = [
            'total_users'    => User::count(),
            'total_products' => Product::count(),
            'total_orders'   => Order::count(),
            'total_reviews'  => Review::count(),
        ];

        return view('admin.dashboard', compact('users', 'products', 'orders', 'reviews', 'stats'));
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted!');
    }

    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Product deleted!');
    }

    public function deleteOrder($id)
    {
        Order::findOrFail($id)->delete();
        return back()->with('success', 'Order deleted!');
    }

    public function deleteReview($id)
    {
        Review::findOrFail($id)->delete();
        return back()->with('success', 'Review deleted!');
    }

    public function toggleUserRole($id)
    {
        $user = User::findOrFail($id);
        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();
        return back()->with('success', 'User role updated!');
    }
}