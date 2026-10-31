<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactReceived;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        // ContactRequestで検証済みの入力データを取得する
        $validated = $request->validated();

        $contact = Contact::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        // お問い合わせ内容をデータベースに保存したあと、入力されたメールアドレス宛てにメールを送信する処理
        // Mail::to($contact->email)->send(new ContactReceived($contact));

        return redirect('/products')->with('success', 'お問い合わせを送信しました。');
    }
}
