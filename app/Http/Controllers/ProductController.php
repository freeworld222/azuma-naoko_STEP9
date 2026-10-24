<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // 商品一覧を表示
    public function index(Request $request)
    {
        $query = Product::where('user_id', '!=', auth()->id());

        // 商品名が入力されている場合、商品名で絞り込む
        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        // 最低価格が入力されている場合
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // 最高価格が入力されている場合
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query
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

    // 商品詳細画面を表示
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $isLiked = $product->likes()
            ->where('user_id', auth()->id())
            ->exists();

        return view('products.show', compact('product', 'isLiked'));
    }

    // 購入確認画面を表示
    public function purchase($id)
    {
        $product = Product::findOrFail($id);

        return view('products.purchase', compact('product'));
    }

    // 購入処理
    public function storePurchase(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $id) {
            $product = Product::where('id', $id)
                ->lockForUpdate()
                ->firstOrFail();

            $quantity = (int) $request->quantity;

            if ($quantity > $product->stock) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'quantity' => '在庫数を超える購入はできません。',
                ]);
            }

            Sale::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);

            $product->decrement('stock', $quantity);
        });

        return redirect('/products/' . $id . '/purchase')
            ->with('success', '購入が完了しました。');
    }
}
