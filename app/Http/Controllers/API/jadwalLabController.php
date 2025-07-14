<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\JadwalLabResource;
use App\Models\jadwallab;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class JadwalLabController extends Controller
{
    public function index()
{
    $jadwal = JadwalLab::with('laboratorium')->get(); // ← ini penting
    return JadwalLabResource::collection($jadwal);
}

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_lab' => 'required|exists:laboratorium,id_lab',
                'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
                'kegiatan' => 'required|string|max:255',
                'dosen_pengampu' => 'required|string|max:100'
            ], [
                'id_lab.required' => 'Laboratorium wajib dipilih.',
                'hari.required' => 'Hari wajib diisi.',
                'jam_mulai.required' => 'Jam mulai wajib diisi.',
                'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
                'kegiatan.required' => 'Kegiatan wajib diisi.',
                'dosen_pengampu.required' => 'Dosen pengampu wajib diisi.'
            ]);

            $jadwal = JadwalLab::create($validated);
            return new JadwalLabResource($jadwal);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
        }
    }

    public function show($id) { return new JadwalLabResource(JadwalLab::findOrFail($id)); }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalLab::findOrFail($id);
        $jadwal->update($request->all());
        return new JadwalLabResource($jadwal);
    }

    public function destroy($id)
    {
        try {
            $jadwal = JadwalLab::findOrFail($id);
            $jadwal->delete();
            return response()->json(['message' => 'Jadwal berhasil dihapus', 'id' => $id]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Jadwal tidak ditemukan'], 404);
        }
    }
    
}
