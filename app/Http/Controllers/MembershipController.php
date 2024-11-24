<?php

// app/Http/Controllers/MembershipController.php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\JenisMembership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index(Request $request)
    {
        $query = Membership::query();

        if ($request->has('search')) {
            $query->whereHas('jenisMembership', function ($q) use ($request) {
                $q->where('nama_jenis_membership', 'like', '%' . $request->search . '%');
            });
        }

        $memberships = $query->with(['pelanggan', 'jenisMembership'])->get();

        return response()->json($memberships);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'id_jenis_membership' => 'required|exists:jenis_memberships,id_jenis_membership',
            'jenis_membership' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $membership = Membership::create($validated);

        return response()->json($membership, 201);
    }

    public function show($id)
    {
        $membership = Membership::with(['pelanggan', 'jenisMembership'])->findOrFail($id);

        return response()->json($membership);
    }

    public function update(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);

        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'id_jenis_membership' => 'required|exists:jenis_memberships,id_jenis_membership',
            'jenis_membership' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $membership->update($validated);

        return response()->json($membership);
    }

    public function destroy($id)
    {
        $membership = Membership::findOrFail($id);
        $membership->delete();

        return response()->json(null, 204);
    }
}
