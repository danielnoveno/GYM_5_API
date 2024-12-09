<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of Activities.
     */
    public function index(Request $request)
    {
        $date = $request->query('date');
        $activities = Activity::when($date, function ($query, $date) {
            return $query->whereDate('date', $date);
        })->get();

        return response()->json([
            'status' => true,
            'message' => 'Activities retrieved successfully',
            'data' => $activities,
        ]);
    }

    /**
     * Store a newly created Activity in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'activity' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $activity = Activity::create([
            'activity' => $validatedData['activity'],
            'date' => $validatedData['date'],
            'created_at' => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Activity created successfully',
            'data' => $activity,
        ], 201);
    }

    /**
     * Display the specified Activity.
     */
    public function show($id)
    {
        $activity = Activity::find($id);

        if (!$activity) {
            return response()->json([
                'status' => false,
                'message' => 'Activity not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Activity retrieved successfully',
            'data' => $activity,
        ]);
    }

    /**
     * Update the specified Activity in storage.
     */
    public function update(Request $request, $id)
    {
        $activity = Activity::find($id);

        if (!$activity) {
            return response()->json([
                'status' => false,
                'message' => 'Activity not found',
            ], 404);
        }

        $validatedData = $request->validate([
            'activity' => 'sometimes|string|max:255',
            'date' => 'sometimes|date',
        ]);

        $activity->update($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'Activity updated successfully',
            'data' => $activity,
        ]);
    }

    /**
     * Remove the specified Activity from storage.
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);

        if (!$activity) {
            return response()->json([
                'status' => false,
                'message' => 'Activity not found',
            ], 404);
        }

        $activity->delete();

        return response()->json([
            'status' => true,
            'message' => 'Activity deleted successfully',
        ], 204);
    }
}
