<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewFormRequest;

class ReviewController extends Controller
{
    public function review($id)
    {
        $user = auth()->user();
        $shop = Shop::find($id);

        $existingReview = Review::where('user_id', $user->id)
            ->where('shop_id', $shop->id)
            ->first();
        if ($existingReview) {
            return redirect()->back()->with('error', 'レビュー済みです');
        }

        return view('review', compact('shop', 'user', 'existingReview'));
    }

    public function reviewStore(ReviewFormRequest $request)
    {
        $user = auth()->user();
        Review::create([
            'user_id' => $user->id,
            'shop_id' => $request->shop_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'img_path' => $request->file('img_path')->store('public/images'),
        ]);
        return view('posting');
    }

    public function reviewDelete(Request $request)
    {
        Review::find($request->id)->delete();
        return redirect()->back();
    }

    public function reviewEdit($id)
    {
        $user = auth()->user();
        $shop = Shop::find($id);
        $review = Review::where('user_id', $user->id)
            ->where('shop_id', $shop->id)
            ->firstOrFail();
        return view('reviewEdit', compact('shop', 'user', 'review'));
    }

    public function reviewUpdate(ReviewFormRequest $request)
    {
        $reviewId = $request->id;
        Review::where('id', $reviewId)->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'img_path' => $request->file('img_path')->store('public/images'),
        ]);
        return view('posting');
    }


    public function reviewList($id)
    {
        $shop = Shop::find($id);
        $reviews = Review::where('shop_id', $shop->id)->with('user')->paginate(5);
        return view('review_list', compact('shop', 'reviews'));
    }
}
