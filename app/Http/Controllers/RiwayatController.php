<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    // Display a listing of the resource
    public function index(Request $request)
    {
        // Check if the 'idPelanggan' query parameter is present
        if ($request->has('idPelanggan')) {
            $idPelanggan = $request->query('idPelanggan');
            // Fetch the riwayat records for the specific pelanggan ID
            $riwayats = Riwayat::with('pelanggan')->where('id_pelanggan', $idPelanggan)->get();
        } else {
            // Fetch all records if no specific pelanggan ID is provided
            $riwayats = Riwayat::with('pelanggan')->get();
        }

        return response()->json($riwayats);
    }


    // Store a newly created resource in storage
    public function store(Request $request)
    {
        
        $request->validate([
            'tanggal_riwayat' => 'required|date',
            'jenis_layanan' => 'required|string',
            'total_harga' => 'required|numeric',
        ]);

        $riwayat = Riwayat::create($request->all());

        return response()->json($riwayat, 201);
    }

    // Display the specified resource
    public function show($id)
    {
        $riwayat = Riwayat::with('pelanggan')->find($id);

        if (!$riwayat) {
            return response()->json(['message' => 'Riwayat not found'], 404);
        }

        return response()->json($riwayat);
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        // Return a view to edit the Riwayat if needed
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $riwayat = Riwayat::find($id);

        if (!$riwayat) {
            return response()->json(['message' => 'Riwayat not found'], 404);
        }

        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'tanggal_riwayat' => 'required|date',
            'jenis_layanan' => 'required|string',
            'total_harga' => 'required|numeric',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image update if exists
        if ($request->hasFile('image_path')) {
            // Delete old image if it exists
            if ($riwayat->image_path) {
                Storage::delete('public/' . $riwayat->image_path);
            }

            // Store new image
            $imagePath = $request->file('image_path')->store('riwayat_images', 'public');
            $riwayat->image_path = $imagePath;
        }

        $riwayat->update([
            'id_pelanggan' => $request->id_pelanggan,
            'tanggal_riwayat' => $request->tanggal_riwayat,
            'jenis_layanan' => $request->jenis_layanan,
            'total_harga' => $request->total_harga,
        ]);

        return response()->json($riwayat);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $riwayat = Riwayat::find($id);

        if (!$riwayat) {
            return response()->json(['message' => 'Riwayat not found'], 404);
        }

        // Delete the associated image if exists
        if ($riwayat->image_path) {
            Storage::delete('public/' . $riwayat->image_path);
        }

        $riwayat->delete();

        return response()->json(['message' => 'Riwayat deleted successfully']);
    }
}
