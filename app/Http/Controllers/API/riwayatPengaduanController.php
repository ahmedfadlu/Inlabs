<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RiwayatPengaduanResource;
use App\Models\RiwayatPengaduan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class RiwayatPengaduanController extends Controller
{
    public function index() { return RiwayatPengaduanResource::collection(RiwayatPengaduan::all()); }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_pengaduan' => 'required|exists:pengaduan,id_pengaduan',
                'status_lama' => 'required|in:menunggu,diproses,selesai',
                'status_baru' => 'required|in:menunggu,diproses,selesai',
                'diperbarui_oleh' => 'required|exists:users,id_user'
            ], [
                'id_pengaduan.required' => 'Pengaduan wajib dipilih.',
                'status_lama.required' => 'Status lama wajib diisi.',
                'status_baru.required' => 'Status baru wajib diisi.',
                'diperbarui_oleh.required' => 'Petugas yang memperbarui wajib diisi.'
            ]);

            $validated['tanggal_update'] = now();

            $riwayat = RiwayatPengaduan::create($validated);
            return new RiwayatPengaduanResource($riwayat);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
        }
    }

    public function show($id) { return new RiwayatPengaduanResource(RiwayatPengaduan::findOrFail($id)); }

    public function destroy($id)
    {
        try {
            $riwayat = RiwayatPengaduan::findOrFail($id);
            $riwayat->delete();
            return response()->json(['message' => 'Riwayat berhasil dihapus', 'id' => $id]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Riwayat pengaduan tidak ditemukan'], 404);
        }
    }
}
