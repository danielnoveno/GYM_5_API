<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Ruangan::query();

        if ($request->has('search')) {
            $query->where('kapasitas', 'like', '%' . $request->search . '%');
        }

        $ruangans = $query->get();

        return response()->json($ruangans);
    }
    public function store(Request $request)
    {
        $request->validate([
            'kapasitas' => 'required|integer',
        ]);

        $ruangan = Ruangan::create([
            'kapasitas' => $request->kapasitas,
        ]);

        return response()->json($ruangan, 201);
    }

    public function show($id)
    {
        $ruangan = Ruangan::find($id);

        if (!$ruangan) {
            return response()->json(['message' => 'Ruangan tidak ditemukan'], 404);
        }

        return response()->json($ruangan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kapasitas' => 'required|integer',
        ]);

        $ruangan = Ruangan::find($id);

        if (!$ruangan) {
            return response()->json(['message' => 'Ruangan tidak ditemukan'], 404);
        }

        $ruangan->update([
            'kapasitas' => $request->kapasitas,
        ]);

        return response()->json($ruangan);
    }

    public function destroy($id)
    {
        $ruangan = Ruangan::find($id);

        if (!$ruangan) {
            return response()->json(['message' => 'Ruangan tidak ditemukan'], 404);
        }

        $ruangan->delete();

        return response()->json(['message' => 'Ruangan berhasil dihapus']);
    }
}
