<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of all reviews (Guests, Director).
     */
    public function index()
    {
        $reviews = Review::with('user')->orderBy('review_date', 'desc')->get();
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new review (Registered users only).
     */
    public function create()
    {
        if (!auth()->user()->hasRole('user')) {
            abort(403);
        }

        return view('reviews.create');
    }

    /**
     * Store a newly created review.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('user')) {
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'username' => 'nullable|string|max:255',
        ]);

        Review::create([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'review_date' => now()->toDateString(),
            'user_id' => auth()->user()->id,
            'username' => $validated['username'],
        ]);

        return redirect()->route('reviews.index')->with('success', 'Atsiliepimas pateiktas sėkmingai');
    }

    /**
     * Get all reviews (API endpoint for guests).
     */
    public function getAll()
    {
        $reviews = Review::with('user')
            ->orderBy('review_date', 'desc')
            ->get()
            ->map(fn($review) => [
                'id' => $review->id,
                'user_name' => $review->username == null ? $review->user->name . ' ' . $review->user->surname : $review->username,
                'rating' => $review->rating,
                'comment' => $review->comment,
                'review_date' => $review->review_date->format('Y-m-d'),
            ]);

        return response()->json($reviews);
    }
}
