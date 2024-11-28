<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Review;
use App\Models\Tag;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('buku', 'tags')->get();
        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        $bukus = Buku::all();
        $tags = Tag::all();
        return view('reviews.create', compact('bukus', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'review' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string',
        ]);

        $review_date = Carbon::now()->format('d/m/Y');

        $review = Review::create([
            'buku_id' => $request->buku_id,
            'review' => $request->review,
            'review_date' => Carbon::createFromFormat('d/m/Y', $review_date),
        ]);

        if ($request->tags) {
            foreach ($request->tags as $tagName) {
                $tagName = trim($tagName);
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $review->tags()->attach($tag);
            }
        }

        return redirect()->route('reviews.index')->with('success', 'Review berhasil ditambahkan');
    }
}
