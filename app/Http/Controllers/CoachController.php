<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index(Request $request)
    {
        $query = Coach::query();

        // Fitur pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_coach', 'like', "%$search%");
        }

        // Ambil semua coach yang sesuai dengan pencarian
        $coaches = $query->get();

        // Tampilkan halaman daftar coach
        return view('coach.index', compact('coaches'));
    }

    public function create()
    {
        // Tampilkan halaman tambah coach
        return view('coach.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_coach' => 'required|string|max:255',
        ]);

        // Simpan data coach baru
        Coach::create([
            'nama_coach' => $request->nama_coach,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('coach.index')->with('success', 'Coach berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Ambil data coach berdasarkan ID
        $coach = Coach::findOrFail($id);

        // Tampilkan halaman edit coach
        return view('coach.edit', compact('coach'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_coach' => 'required|string|max:255',
        ]);

        // Cari dan update data coach
        $coach = Coach::findOrFail($id);
        $coach->update([
            'nama_coach' => $request->nama_coach,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('coach.index')->with('success', 'Coach berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Hapus data coach
        Coach::destroy($id);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('coach.index')->with('success', 'Coach berhasil dihapus');
    }
}
