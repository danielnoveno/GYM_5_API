<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::query();

        if ($request->has('search')) {
            $query->where('metode_pembayaran', 'like', '%' . $request->search . '%')
                ->orWhere('status_pembayaran', 'like', '%' . $request->search . '%');
        }

        $transaksis = $query->get();

        return response()->json($transaksis);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'jumlah_transaksi' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'status_pembayaran' => 'required|string',
            'id_layanan' => 'required|exists:layanan,id_layanan',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
        ]);

        $transaksi = Transaksi::create([
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'jumlah_transaksi' => $request->jumlah_transaksi,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
            'id_layanan' => $request->id_layanan,
            'id_pelanggan' => $request->id_pelanggan,
        ]);

        return response()->json($transaksi, 201);
    }
    public function show($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        return response()->json($transaksi);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'jumlah_transaksi' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'status_pembayaran' => 'required|string',
        ]);

        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $transaksi->update([
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'jumlah_transaksi' => $request->jumlah_transaksi,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return response()->json($transaksi);
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $transaksi->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus']);
    }
}
