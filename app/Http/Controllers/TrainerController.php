<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index(Request $request)
    {
        $query = Trainer::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $trainers = $query->get();

        return response()->json($trainers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer',
            'lama_pengalaman' => 'required|integer',
            'spesialis' => 'required|in:Fitness,Yoga,Aerobics,Strength Training',
            'id_paket_personal_trainer' => 'required|exists:personal_trainers,id_paket_personal_trainer',
        ]);

        $trainer = Trainer::create($request->all());

        return response()->json($trainer, 201);
    }

    public function show($id)
    {
        $trainer = Trainer::findOrFail($id);

        return response()->json($trainer);
    }

    public function update(Request $request, $id)
    {
        $trainer = Trainer::findOrFail($id);

        $trainer->update($request->all());

        return response()->json($trainer);
    }

    public function destroy($id)
    {
        $trainer = Trainer::findOrFail($id);

        $trainer->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
