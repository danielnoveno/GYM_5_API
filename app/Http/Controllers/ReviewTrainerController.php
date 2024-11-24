<?php

namespace App\Http\Controllers;

use App\Models\ReviewTrainer;
use Illuminate\Http\Request;

class ReviewTrainerController extends Controller
{
    // Menampilkan semua review atau mencari berdasarkan parameter
    public function index(Request $request)
    {
        $query = ReviewTrainer::query();

        // Fitur pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('review', 'like', "%{$search}%");
        }

        $reviews = $query->with(['trainer', 'pelanggan'])->get();

        return response()->json($reviews);
    }

    // Menampilkan form untuk membuat review
    public function create()
    {
        // return view('review.create');
    }

    // Menyimpan review
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

    // Menampilkan review berdasarkan ID
    public function show($id)
    {
        $review = ReviewTrainer::with(['trainer', 'pelanggan'])->findOrFail($id);

        return response()->json($review);
    }

    // Mengupdate review
    public function update(Request $request, $id)
    {
        $review = ReviewTrainer::findOrFail($id);
        $review->update($request->all());

        return response()->json($review);
    }

    // Menghapus review
    public function destroy($id)
    {
        $review = ReviewTrainer::findOrFail($id);
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully']);
    }
}
