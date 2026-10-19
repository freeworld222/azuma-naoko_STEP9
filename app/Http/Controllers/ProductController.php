<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 商品一覧を表示
    public function index()
    {
        $products = Product::where('user_id', '!=', auth()->id())
            ->orderBy('id', 'asc')
            ->get();

        return view('products.index', compact('products'));
    }

    // 商品新規登録画面を表示
    public function create()
    {
        return view('products.create');
    }

    // 商品登録データを受け取る
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'price' => 'required|integer|min:0',
            'description' => 'required',
            'stock' => 'required|integer|min:0',
        ]);

        $user = auth()->user();
        $validatedData['user_id'] = $user->id;
        $validatedData['company_id'] = $user->company_id;

        Product::create($validatedData);

        return redirect('/products');
    }
}
