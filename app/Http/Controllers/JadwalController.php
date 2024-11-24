<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\Trainer;
use App\Models\KelasOlahraga;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with(['ruangan', 'trainer', 'kelasOlahraga'])->get();
        return response()->json($jadwals);
    }

    public function create()
    {
        $ruangans = Ruangan::all();
        $trainers = Trainer::all();
        $kelasOlahragas = KelasOlahraga::all();

        return response()->json(compact('ruangans', 'trainers', 'kelasOlahragas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'waktu' => 'required|date_format:H:i',
            'id_ruangan' => 'required|exists:ruangans,id_ruangan',
            'id_trainer' => 'required|exists:trainers,id_trainer',
        ]);

        $jadwal = Jadwal::create($validated);

        if ($request->has('kelas_olahragas')) {
            $jadwal->kelasOlahraga()->sync($request->kelas_olahragas);
        }

        return response()->json($jadwal, 201);
    }

    public function show($id)
    {
        $jadwal = Jadwal::with(['ruangan', 'trainer', 'kelasOlahraga'])->findOrFail($id);
        return response()->json($jadwal);
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $ruangans = Ruangan::all();
        $trainers = Trainer::all();
        $kelasOlahragas = KelasOlahraga::all();

        return response()->json(compact('jadwal', 'ruangans', 'trainers', 'kelasOlahragas'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'waktu' => 'required|date_format:H:i',
            'id_ruangan' => 'required|exists:ruangans,id_ruangan',
            'id_trainer' => 'required|exists:trainers,id_trainer',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($validated);

        if ($request->has('kelas_olahragas')) {
            $jadwal->kelasOlahraga()->sync($request->kelas_olahragas);
        }

        return response()->json($jadwal);
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return response()->json(['message' => 'Jadwal deleted successfully']);
    }
    public function search(Request $request)
    {
        $query = Jadwal::query();

        if ($request->has('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->has('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->has('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $jadwals = $query->with(['ruangan', 'trainer', 'kelasOlahraga'])->get();

        return response()->json($jadwals);
    }
}
