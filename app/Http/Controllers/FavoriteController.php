<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FavoriteController extends Controller
{
    // 一覧表示
    public function index()
    {
        $favoriteIds = session('favorites', []);
        $favorites = Product::whereIn('id', $favoriteIds)->get();

        return view('favorites.index', compact('favorites'));
    }

    // 商品選択ページ
    public function create() {
        $products = Product::all();
        return view('favorites.create', compact('products'));
    }

    // お気に入りに追加
    public function store(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $favorites = session('favorites', []);
        if (!in_array($request->product_id, $favorites)){
            $favorites[] = $request->product_id;
            session(['favorites' => $favorites]);
        }
        return redirect('/favorites');
    }

    // お気に入り解除
    public function destroy(Request $request, $id){
        $favorites = session('favorites', []);
        $favorites = array_filter($favorites, fn($favId) => $favId != $id);
        session(['favorites' => array_values($favorites)]);

        return redirect('/favorites');
    }
}
