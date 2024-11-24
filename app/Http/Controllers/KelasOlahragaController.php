<?php

namespace App\Http\Controllers;

use App\Models\KelasOlahraga;
use App\Models\Coach;
use Illuminate\Http\Request;

class KelasOlahragaController extends Controller
{
    public function index(Request $request)
    {
        $query = KelasOlahraga::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_olahraga', 'like', "%$search%")
                ->orWhere('deskripsi', 'like', "%$search%");
        }

        $kelasOlahraga = $query->with(['coach', 'ruangan', 'jadwal'])->get();

        return view('kelas_olahraga.index', compact('kelasOlahraga'));
    }

    public function create()
    {
        $coaches = Coach::all();
        return view('kelas_olahraga.create', compact('coaches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_olahraga' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'id_jadwal' => 'required|exists:jadwals,id_jadwal',
            'id_ruangan' => 'required|exists:ruangans,id_ruangan',
            'id_coach' => 'required|exists:coaches,id_coach',
            'deskripsi' => 'nullable|string',
        ]);

        KelasOlahraga::create($request->all());

        return redirect()->route('kelas_olahraga.index')->with('success', 'Kelas olahraga berhasil dibuat');
    }

    public function edit($id)
    {
        $kelasOlahraga = KelasOlahraga::findOrFail($id);
        $coaches = Coach::all();

        return view('kelas_olahraga.edit', compact('kelasOlahraga', 'coaches'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_olahraga' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'id_jadwal' => 'required|exists:jadwals,id_jadwal',
            'id_ruangan' => 'required|exists:ruangans,id_ruangan',
            'id_coach' => 'required|exists:coaches,id_coach',
            'deskripsi' => 'nullable|string',
        ]);

        $kelasOlahraga = KelasOlahraga::findOrFail($id);
        $kelasOlahraga->update($request->all());

        return redirect()->route('kelas_olahraga.index')->with('success', 'Kelas olahraga berhasil diperbarui');
    }

    public function destroy($id)
    {
        KelasOlahraga::destroy($id);

        return redirect()->route('kelas_olahraga.index')->with('success', 'Kelas olahraga berhasil dihapus');
    }
}
