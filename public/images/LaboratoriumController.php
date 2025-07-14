<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaboratoriumResource;
use App\Models\laboratorium;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LaboratoriumController extends Controller
{
    public function index() { return LaboratoriumResource::collection(Laboratorium::all()); }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_lab' => 'required|string|max:100',
                'lokasi' => 'required|string|max:100',
                'kapasitas' => 'required|integer|min:1',
                'status' => 'required|in:tersedia,dipakai'
            ], [
                'nama_lab.required' => 'Nama laboratorium wajib diisi.',
                'lokasi.required' => 'Lokasi wajib diisi.',
                'kapasitas.required' => 'Kapasitas wajib diisi dan harus lebih dari 0.',
                'status.required' => 'Status wajib diisi.',
                'status.in' => 'Status harus "tersedia" atau "dipakai".'
            ]);

            $lab = Laboratorium::create($validated);
            return new LaboratoriumResource($lab);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
        }
    }

    public function show($id) { return new LaboratoriumResource(Laboratorium::findOrFail($id)); }

    public function update(Request $request, $id)
    {
        $lab = Laboratorium::findOrFail($id);
        $lab->update($request->all());
        return new LaboratoriumResource($lab);
    }

    public function destroy($id)
    {
        try {
            $lab = Laboratorium::findOrFail($id);
            $lab->delete();
            return response()->json(['message' => 'Laboratorium berhasil dihapus', 'id' => $id]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Laboratorium tidak ditemukan'], 404);
        }
    }
}

