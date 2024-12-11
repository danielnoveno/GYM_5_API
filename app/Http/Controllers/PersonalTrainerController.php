<?php

namespace App\Http\Controllers;

use App\Models\PersonalTrainer;
use Illuminate\Http\Request;

class PersonalTrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = PersonalTrainer::query();

            // Menambahkan pencarian berdasarkan title atau specialization
            if ($request->has('search')) {
                $query->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('specialization', 'like', '%' . $request->search . '%');
            }

            // Menampilkan data dengan paginasi (opsional, bisa disesuaikan)
            $personalTrainers = $query->get();

            return response()->json([
                'status' => true,
                'message' => 'Personal Trainers fetched successfully',
                'data' => $personalTrainers
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
            // Validasi data input
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'duration' => 'required|integer',
                'image_path' => 'nullable|string',
                'email' => 'required|email|max:255|unique:trainers',
                'description' => 'nullable|string',
                'specialization' => 'required|string|max:255',
                'price' => 'required|numeric',
                'id_paket_personal_trainer' => 'nullable|exists:trainers,id',
            ]);

            // Membuat personal trainer baru
            $personalTrainer = PersonalTrainer::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Personal Trainer created successfully',
                'data' => $personalTrainer
            ], 201);
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
            // Menampilkan detail personal trainer berdasarkan ID
            $personalTrainer = PersonalTrainer::findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Personal Trainer fetched successfully',
                'data' => $personalTrainer
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Personal Trainer not found',
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
            // Validasi data input
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'duration' => 'required|integer',
                'image_path' => 'nullable|string',
                'email' => 'required|email|max:255|unique:trainers,email,' . $id,
                'description' => 'nullable|string',
                'specialization' => 'required|string|max:255',
                'price' => 'required|numeric',
                'id_paket_personal_trainer' => 'nullable|exists:trainers,id',
            ]);

            // Menemukan personal trainer berdasarkan ID dan memperbarui datanya
            $personalTrainer = PersonalTrainer::findOrFail($id);
            $personalTrainer->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Personal Trainer updated successfully',
                'data' => $personalTrainer
            ], 200);
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
            // Menemukan personal trainer berdasarkan ID dan menghapusnya
            $personalTrainer = PersonalTrainer::findOrFail($id);
            $personalTrainer->delete();

            return response()->json([
                'status' => true,
                'message' => 'Personal Trainer deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
