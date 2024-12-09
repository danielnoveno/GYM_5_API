<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the trainers.
     */
    public function index(Request $request)
    {
        try {
            $query = Trainer::query();

            // Pencarian berdasarkan nama trainer
            if ($request->has('search')) {
                $search = $request->search;
                $query->where('nama', 'like', '%' . $search . '%');
            }

            $trainers = $query->get();

            return response()->json([
                'status' => true,
                'message' => 'Trainers fetched successfully',
                'data' => $trainers
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
     * Store a newly created trainer.
     */
    public function store(Request $request)
    {
        try {
            // Validasi data input
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'duration' => 'required|string|max:255',
                'imagePath' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|numeric',
                'specialization' => 'required|string|max:255',
                'id_paket_personal_trainer' => 'required|exists:personal_trainers,id_paket_personal_trainer',
            ]);

            // Membuat trainer baru
            $trainer = Trainer::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Trainer created successfully',
                'data' => $trainer
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
     * Display the specified trainer.
     */
    public function show($id)
    {
        try {
            $trainer = Trainer::find($id);

            if ($trainer) {
                return response()->json([
                    'status' => true,
                    'message' => 'Trainer found',
                    'data' => $trainer
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'Trainer not found'
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
     * Update the specified trainer.
     */
    public function update(Request $request, $id)
    {
        try {
            $trainer = Trainer::find($id);

            if ($trainer) {
                // Validasi data input
                $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'duration' => 'required|string|max:255',
                    'imagePath' => 'required|string|max:255',
                    'email' => 'required|string|max:255',
                    'description' => 'required|string|max:255',
                    'price' => 'required|numeric',
                    'specialization' => 'required|in:Fitness,Yoga,Aerobics,Strength Training',
                    'id_paket_personal_trainer' => 'required|exists:personal_trainers,id_paket_personal_trainer',
                ]);

                // Update trainer
                $trainer->update($validated);

                return response()->json([
                    'status' => true,
                    'message' => 'Trainer updated successfully',
                    'data' => $trainer
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'Trainer not found'
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
     * Remove the specified trainer.
     */
    public function destroy($id)
    {
        try {
            $trainer = Trainer::find($id);

            if ($trainer) {
                $trainer->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Trainer deleted successfully'
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'Trainer not found'
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
