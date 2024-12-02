<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\JenisMembership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Membership::query();

            if ($request->has('search')) {
                $query->whereHas('jenisMembership', function ($q) use ($request) {
                    $q->where('nama_jenis_membership', 'like', '%' . $request->search . '%');
                });
            }

            $memberships = $query->with(['pelanggan', 'jenisMembership'])->get();

            return response()->json([
                'status' => true,
                'message' => 'Memberships fetched successfully',
                'data' => $memberships
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
                'id_jenis_membership' => 'required|exists:jenis_memberships,id_jenis_membership',
                'jenis_membership' => 'required|string|max:255',
                'tanggal_mulai' => 'required|date',
                'tanggal_berakhir' => 'required|date',
                'status' => 'required|string|max:255',
            ]);

            // Membuat data membership baru
            $membership = Membership::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Membership created successfully',
                'data' => $membership
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error storing data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $membership = Membership::with(['pelanggan', 'jenisMembership'])->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Membership fetched successfully',
                'data' => $membership
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Membership not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
                'id_jenis_membership' => 'required|exists:jenis_memberships,id_jenis_membership',
                'jenis_membership' => 'required|string|max:255',
                'tanggal_mulai' => 'required|date',
                'tanggal_berakhir' => 'required|date',
                'status' => 'required|string|max:255',
            ]);

            $membership = Membership::findOrFail($id);
            $membership->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Membership updated successfully',
                'data' => $membership
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Membership not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $membership = Membership::findOrFail($id);
            $membership->delete();

            return response()->json([
                'status' => true,
                'message' => 'Membership deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Membership not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
