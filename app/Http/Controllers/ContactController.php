<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactReceived;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        // お問い合わせ内容をデータベースに保存したあと、入力されたメールアドレス宛てにメールを送信する処理
        Mail::to($contact->email)->send(new ContactReceived($contact));

        return redirect('/products')->with('success', 'お問い合わせを送信しました。');
    }
}
