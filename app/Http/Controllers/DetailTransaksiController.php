<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    // Fungsi untuk menampilkan semua data
    public function index(Request $request)
    {
        $query = DetailTransaksi::query();

        if ($request->has('search')) {
            $query->whereHas('transaksi', function ($q) use ($request) {
                $q->where('id_transaksi', 'like', '%' . $request->search . '%');
            });
        }

        $detailTransaksi = $query->with(['transaksi', 'layanan'])->get();

        return response()->json($detailTransaksi);
    }

    // Fungsi untuk menampilkan satu data
    public function show($id)
    {
        $detailTransaksi = DetailTransaksi::with(['transaksi', 'layanan'])->findOrFail($id);

        return response()->json($detailTransaksi);
    }

    // Fungsi untuk menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksis,id_transaksi',
            'id_layanan' => 'required|exists:layanans,id_layanan',
        ]);

        $detailTransaksi = DetailTransaksi::create($request->all());

        return response()->json($detailTransaksi, 201);
    }

    // Fungsi untuk memperbarui data
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksis,id_transaksi',
            'id_layanan' => 'required|exists:layanans,id_layanan',
        ]);

        $detailTransaksi = DetailTransaksi::findOrFail($id);
        $detailTransaksi->update($request->all());

        return response()->json($detailTransaksi);
    }

    // Fungsi untuk menghapus data
    public function destroy($id)
    {
        $detailTransaksi = DetailTransaksi::findOrFail($id);
        $detailTransaksi->delete();

        return response()->json(null, 204);
    }
}
