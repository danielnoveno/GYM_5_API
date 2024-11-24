<?php

namespace App\Http\Controllers;

use App\Models\ReviewTrainer;
use Illuminate\Http\Request;

class ReviewTrainerController extends Controller
{
    public function index(Request $request)
    {
        $query = ReviewTrainer::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('review', 'like', "%{$search}%");
        }

        $reviews = $query->with(['trainer', 'pelanggan'])->get();

        return response()->json($reviews);
    }
    public function create() {}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_trainer' => 'required|exists:trainers,id_trainer',
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'tanggal_review' => 'required|date',
            'review' => 'required|string',
        ]);

        $review = ReviewTrainer::create($validated);

        return response()->json($review, 201);
    }

    public function show($id)
    {
        $review = ReviewTrainer::with(['trainer', 'pelanggan'])->findOrFail($id);

        return response()->json($review);
    }

    public function update(Request $request, $id)
    {
        $review = ReviewTrainer::findOrFail($id);

        $validated = $request->validate([
            'id_trainer' => 'sometimes|required|exists:trainers,id_trainer',
            'id_pelanggan' => 'sometimes|required|exists:pelanggans,id_pelanggan',
            'tanggal_review' => 'sometimes|required|date',
            'review' => 'sometimes|required|string',
        ]);

        $review->update($validated);

        return response()->json($review);
    }

    public function destroy($id)
    {
        $review = ReviewTrainer::findOrFail($id);
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully']);
    }
}
