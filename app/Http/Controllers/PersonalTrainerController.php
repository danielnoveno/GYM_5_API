<?php

namespace App\Http\Controllers;

use App\Models\PersonalTrainer;
use Illuminate\Http\Request;

class PersonalTrainerController extends Controller
{
    public function index(Request $request)
    {
        $query = PersonalTrainer::query();

        if ($request->has('search')) {
            $query->where('nama_paket', 'like', '%' . $request->search . '%');
        }

        $personalTrainers = $query->get();

        return response()->json($personalTrainers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        $personalTrainer = PersonalTrainer::create($request->all());

        return response()->json($personalTrainer, 201);
    }

    public function show($id)
    {
        $personalTrainer = PersonalTrainer::findOrFail($id);

        return response()->json($personalTrainer);
    }

    public function update(Request $request, $id)
    {
        $personalTrainer = PersonalTrainer::findOrFail($id);

        $personalTrainer->update($request->all());

        return response()->json($personalTrainer);
    }

    public function destroy($id)
    {
        $personalTrainer = PersonalTrainer::findOrFail($id);

        $personalTrainer->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
