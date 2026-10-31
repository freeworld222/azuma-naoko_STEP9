<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    // ログイン画面を表示
    public function login()
    {
        return view('users.login');
    }

    // ログイン情報を送信
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'password.required' => 'パスワードを入力してください。',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/products');
        }

        return back()->withErrors([
            'login' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }


    // ログアウト
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'name_kanji' => 'required',
            'name_kana' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create($validatedData);

        return redirect('/login');
    }

    // アカウント編集画面を表示
    public function edit()
    {
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    // アカウント情報を更新
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'name_kanji' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->update($validatedData);

        return redirect('/mypage')->with('success', 'アカウント情報を更新しました。');
    }

    // マイページを表示
    public function myPage()
    {
        $user = Auth::user();

        // 出品商品を商品番号の昇順で取得
        $products = $user->products()
            ->orderBy('id', 'asc')
            ->get();

        // 購入した商品を購入日の昇順で取得
        $sales = $user->sales()
            ->with('product')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('users.mypage', compact('user', 'products', 'sales'));
    }
}
