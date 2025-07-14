<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InventarisResource;
use App\Models\inventaris;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InventarisController extends Controller
{
    public function index() { return InventarisResource::collection(Inventaris::all()); }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_item' => 'required|string|max:100',
                'jumlah' => 'required|integer|min:1',
                'kondisi' => 'required|string|max:50',
                'id_lab' => 'required|exists:laboratorium,id_lab'
            ], [
                'nama_item.required' => 'Nama item wajib diisi.',
                'jumlah.required' => 'Jumlah wajib diisi dan harus lebih dari 0.',
                'kondisi.required' => 'Kondisi wajib diisi.',
                'id_lab.required' => 'ID Laboratorium wajib diisi.',
                'id_lab.exists' => 'Laboratorium tidak ditemukan.'
            ]);

            $inv = Inventaris::create($validated);
            return new InventarisResource($inv);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $e->errors()], 422);
        }
    }

    public function show($id) { return new InventarisResource(Inventaris::findOrFail($id)); }

    public function update(Request $request, $id)
    {
        $inv = Inventaris::findOrFail($id);
        $inv->update($request->all());
        return new InventarisResource($inv);
    }

    public function destroy($id)
    {
        try {
            $inv = Inventaris::findOrFail($id);
            $inv->delete();
            return response()->json(['message' => 'Inventaris berhasil dihapus', 'id' => $id]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data Inventaris tidak ditemukan'], 404);
        }
    }
}
