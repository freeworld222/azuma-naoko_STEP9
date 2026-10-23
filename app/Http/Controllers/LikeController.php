<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    // お気に入りを登録・解除する
    public function toggle($productId)
    {
        $like = Like::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
            ]);
        }

        return redirect('/products/' . $productId);
    }
}
