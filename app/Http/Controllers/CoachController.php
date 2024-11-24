<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index(Request $request)
    {
        $query = Coach::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_coach', 'like', "%$search%");
        }

        $coaches = $query->get();

        return view('coach.index', compact('coaches'));
    }

    public function create()
    {
        return view('coach.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_coach' => 'required|string|max:255',
        ]);

        Coach::create([
            'nama_coach' => $request->nama_coach,
        ]);

        return redirect()->route('coach.index')->with('success', 'Coach berhasil ditambahkan');
    }

    public function edit($id)
    {
        $coach = Coach::findOrFail($id);

        return view('coach.edit', compact('coach'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_coach' => 'required|string|max:255',
        ]);

        $coach = Coach::findOrFail($id);
        $coach->update([
            'nama_coach' => $request->nama_coach,
        ]);

        return redirect()->route('coach.index')->with('success', 'Coach berhasil diperbarui');
    }

    public function destroy($id)
    {
        Coach::destroy($id);

        return redirect()->route('coach.index')->with('success', 'Coach berhasil dihapus');
    }
}
