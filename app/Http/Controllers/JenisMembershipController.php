<?php

// app/Http/Controllers/JenisMembershipController.php

namespace App\Http\Controllers;

use App\Models\JenisMembership;
use Illuminate\Http\Request;

class JenisMembershipController extends Controller
{
    public function index(Request $request)
    {
        // Pencarian berdasarkan nama jenis membership
        $query = JenisMembership::query();

        if ($request->has('search')) {
            $query->where('nama_jenis_membership', 'like', '%' . $request->search . '%');
        }

        $jenisMemberships = $query->get();

        return response()->json($jenisMemberships);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis_membership' => 'required|string|max:255',
            'harga_membership' => 'required|numeric',
            'jadwal' => 'required|string|max:255',
            'durasi' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        $jenisMembership = JenisMembership::create($validated);

        return response()->json($jenisMembership, 201);
    }

    public function show($id)
    {
        $jenisMembership = JenisMembership::findOrFail($id);

        return response()->json($jenisMembership);
    }

    public function update(Request $request, $id)
    {
        $jenisMembership = JenisMembership::findOrFail($id);

        $validated = $request->validate([
            'nama_jenis_membership' => 'required|string|max:255',
            'harga_membership' => 'required|numeric',
            'jadwal' => 'required|string|max:255',
            'durasi' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        $jenisMembership->update($validated);

        return response()->json($jenisMembership);
    }

    public function destroy($id)
    {
        $jenisMembership = JenisMembership::findOrFail($id);
        $jenisMembership->delete();

        return response()->json(null, 204);
    }
}
