<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Vendor;
use App\Http\Requests\ProductStoreRequest;
use App\Events\ProductAddedEvent;

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

    public function create() {
        $vendor_codes = Vendor::pluck('vendor_code');

        return view('products.create', compact('vendor_codes'));
    }

    public function store(ProductStoreRequest $request){
        // フォームの入力内容を元に、テーブルにデータを追加
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->vendor_code =$request->input('vendor_code');

        // アップロードされたファイル(name=＂image"）が存在すれば処理を実行する
        if($request->hasFile('image')) {
            // アップロードされたファイル(name=#image")をstorage/app/public/productsフォルダに保存し、戻り値（ファイルパス）を変数$image_pathに代入
            $image_path = $request->file('image')->store('public/products');
            // ファイルパスからファイル名のみを取得し、Productインスタンスのimage_nameプロパティに代入
            $product->image_name =basename($image_path);
        }

        $product->save();

        // ProductAddedEventを発生
        event(new ProductAddedEvent($product));

        // リダイレクトさせる
        return redirect("/products/{$product->id}");
    }
}
