<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        // produntsテーブルから全てのデータを取得し、変数$productsに代入
        $products = DB::table('products')->get();

        // 変数$productsをproducts/index/blade.phpファイルに渡す
        return view('products.index', compact('products'));
    }

    public function show($id) {
        // URL'/products/{id}の{id}部分と主キー（idカラム）の値が一致するデータをprodctsテーブルから取得し、変数#productに代入
        $product = Product::find($id);

        // 変数$productをproduct.show.blade.phpファイルに渡す
        return view('products.show', compact('product'));
    }
}
