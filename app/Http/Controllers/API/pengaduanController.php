<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PengaduanResource;
use App\Models\pengaduan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PengaduanController extends Controller
{
    public function index() { return PengaduanResource::collection(Pengaduan::all()); }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_lab' => 'required|exists:laboratorium,id_lab',
            'jenis_laporan' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'foto_kerusakan' => 'nullable|file|image|max:2048',
            'status' => 'required|in:menunggu,diproses,selesai'
        ], [
            'id_user.required' => 'Pelapor wajib diisi.',
            'id_lab.required' => 'Laboratorium wajib diisi.',
            'jenis_laporan.required' => 'Jenis laporan wajib diisi.',
            'deskripsi.required' => 'Deskripsi kerusakan wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status hanya boleh: menunggu, diproses, selesai.'
        ]);

        $validated['tanggal_lapor'] = now();

        // ✅ Simpan file jika ada
        if ($request->hasFile('foto_kerusakan')) {
        $file = $request->file('foto_kerusakan');
        $path = $file->store('foto_kerusakan', 'public'); // simpan di storage/app/public/foto_kerusakan
        $validated['foto_kerusakan'] = basename($path);
}


        $pengaduan = Pengaduan::create($validated);
        return new PengaduanResource($pengaduan);

    } catch (ValidationException $e) {
        return response()->json(['message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
    }
}


    public function show($id) { return new PengaduanResource(Pengaduan::findOrFail($id)); }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update($request->all());
        return new PengaduanResource($pengaduan);
    }

    public function destroy($id)
    {
        try {
            $pengaduan = Pengaduan::findOrFail($id);
            $pengaduan->delete();
            return response()->json(['message' => 'Pengaduan berhasil dihapus', 'id' => $id]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Pengaduan tidak ditemukan'], 404);
        }
    }
    // PengaduanController.php
public function getByUser($id)
{
    $pengaduan = Pengaduan::where('id_user', $id)->orderBy('tanggal_lapor', 'desc')->get();
    return PengaduanResource::collection($pengaduan);
}

}