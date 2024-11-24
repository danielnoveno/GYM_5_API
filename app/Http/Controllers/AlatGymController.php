<?php

namespace App\Http\Controllers;

use App\Models\AlatGym;
use Illuminate\Http\Request;

class AlatGymController extends Controller
{
    // Menampilkan semua alat atau mencari berdasarkan nama
    public function index(Request $request)
    {
        $query = AlatGym::query();

        // Fitur pencarian berdasarkan nama alat
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama_alat', 'like', "%{$search}%");
        }

        $alatGyms = $query->get();

        return response()->json($alatGyms);
    }

    // Menyimpan alat gym baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|string',
            'kategori' => 'required|string',
            'status' => 'required|in:available,unavailable',
            'harga' => 'required|numeric',
        ]);

        $alatGym = AlatGym::create($validated);

        return response()->json($alatGym, 201);
    }

    // Menampilkan alat gym berdasarkan ID
    public function show($id)
    {
        $alatGym = AlatGym::findOrFail($id);

        return response()->json($alatGym);
    }

    // Mengupdate data alat gym
    public function update(Request $request, $id)
    {
        $alatGym = AlatGym::findOrFail($id);
        $alatGym->update($request->all());

        return response()->json($alatGym);
    }

    // Menghapus alat gym
    public function destroy($id)
    {
        $alatGym = AlatGym::findOrFail($id);
        $alatGym->delete();

        return response()->json(['message' => 'Alat Gym deleted successfully']);
    }
}
