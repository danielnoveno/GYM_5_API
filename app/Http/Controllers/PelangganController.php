<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $pelanggans = Pelanggan::all();
            return response()->json([
                'status' => true,
                'message' => 'Pelanggan fetched successfully',
                'data' => $pelanggans
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
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $pelanggan = Pelanggan::find($id);
            if ($pelanggan) {
                return response()->json([
                    'status' => true,
                    'message' => 'Pelanggan found',
                    'data' => $pelanggan
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'Pelanggan not found'
            ], 404);
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
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'umur' => 'required|integer',
                'alamat' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:15',
                'email' => 'required|email|max:255',
                'id_jadwal' => 'required|integer|exists:jadwals,id_jadwal', // Assuming 'jadwals' table exists
            ]);

            $pelanggan = Pelanggan::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Pelanggan created successfully',
                'data' => $pelanggan
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $pelanggan = Pelanggan::find($id);
            if ($pelanggan) {
                $validated = $request->validate([
                    'nama' => 'required|string|max:255',
                    'umur' => 'required|integer',
                    'alamat' => 'required|string|max:255',
                    'no_telepon' => 'required|string|max:15',
                    'email' => 'required|email|max:255',
                    'id_jadwal' => 'required|integer|exists:jadwals,id_jadwal', // Assuming 'jadwals' table exists
                ]);

                $pelanggan->update($validated);

                return response()->json([
                    'status' => true,
                    'message' => 'Pelanggan updated successfully',
                    'data' => $pelanggan
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'Pelanggan not found'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pelanggan = Pelanggan::find($id);
            if ($pelanggan) {
                $pelanggan->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Pelanggan deleted successfully'
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'Pelanggan not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
