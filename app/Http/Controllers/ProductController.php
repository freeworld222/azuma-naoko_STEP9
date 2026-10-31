<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\PurchaseRequest;

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
    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('img_path')) {
            $validatedData['img_path'] = $request->file('img_path')
                ->store('products', 'public');
        }

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

    // 出品商品詳細画面を表示
    public function myShow($id)
    {
        $product = Product::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('products.my_show', compact('product'));
    }

    // 出品商品編集画面を表示
    public function editMyProduct($id)
    {
        $product = Product::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('products.my_edit', compact('product'));
    }

    // 出品商品を更新
    public function updateMyProduct(ProductRequest $request, $id)
    {
        $validatedData = $request->validated();

        // 更新対象の商品を取得する
        $product = Product::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $product->product_name = $validatedData['product_name'];
        $product->price = $validatedData['price'];
        $product->description = $validatedData['description'];
        $product->stock = $validatedData['stock'];

        if ($request->hasFile('img_path')) {
            $product->img_path = $request->file('img_path')
                ->store('products', 'public');
        }

        $product->save();

        return redirect('/my-products/' . $product->id);
    }

    // 出品商品を削除
    public function destroyMyProduct($id)
    {
        $product = Product::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $product->delete();

        return redirect('/products');
    }


    // 購入確認画面を表示
    public function purchase($id)
    {
        $product = Product::findOrFail($id);

        return view('products.purchase', compact('product'));
    }

    // 購入処理
    public function storePurchase(PurchaseRequest $request, $id)
    {

        // バリデーション済みの購入数を取得する
        $validatedData = $request->validated();
        $quantity = (int) $validatedData['quantity'];

        // 在庫をロックして購入対象の商品を取得する
        DB::transaction(function () use ($quantity, $id) {
            $product = Product::where('id', $id)
                ->lockForUpdate()
                ->firstOrFail();

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

        return redirect('/products')
            ->with('success', '購入が完了しました。');
    }
}
