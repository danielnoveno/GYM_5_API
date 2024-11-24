<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    // Fungsi untuk menampilkan semua data
    public function index(Request $request)
    {
        $query = Riwayat::query();

        if ($request->has('search')) {
            $query->whereHas('detailTransaksi', function ($q) use ($request) {
                $q->where('id_transaksi', 'like', '%' . $request->search . '%');
            });
        }

        $riwayat = $query->with(['detailTransaksi', 'layanan'])->get();

        return response()->json($riwayat);
    }

    // Fungsi untuk menampilkan satu data
    public function show($id)
    {
        $riwayat = Riwayat::with(['detailTransaksi', 'layanan'])->findOrFail($id);

        return response()->json($riwayat);
    }

    // Fungsi untuk menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'id_detail_transaksi' => 'required|exists:detail_transaksis,id_detail_transaksi',
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'tanggal_riwayat' => 'required|date',
            'jenis_layanan' => 'required|string',
        ]);

        $riwayat = Riwayat::create($request->all());

        return response()->json($riwayat, 201);
    }

    // Fungsi untuk memperbarui data
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_detail_transaksi' => 'required|exists:detail_transaksis,id_detail_transaksi',
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'tanggal_riwayat' => 'required|date',
            'jenis_layanan' => 'required|string',
        ]);

        $riwayat = Riwayat::findOrFail($id);
        $riwayat->update($request->all());

        return response()->json($riwayat);
    }

    // Fungsi untuk menghapus data
    public function destroy($id)
    {
        $riwayat = Riwayat::findOrFail($id);
        $riwayat->delete();

        return response()->json(null, 204);
    }
}
