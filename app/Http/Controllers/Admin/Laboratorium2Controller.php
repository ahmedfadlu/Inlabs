<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laboratorium;
use Illuminate\Support\Facades\Storage;

class Laboratorium2Controller extends Controller
{
    public function index()
    {
        $labs = Laboratorium::all();
        return view('admin.laboratorium.index', compact('labs'));
    }

    public function create()
    {
        return view('admin.laboratorium.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lab' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|string',
            'gambar_lab' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar_lab')) {
            $gambarPath = $request->file('gambar_lab')->store('images/lab', 'public');
        }

        Laboratorium::create([
            'nama_lab' => $request->nama_lab,
            'lokasi' => $request->lokasi,
            'kapasitas' => $request->kapasitas,
            'status' => $request->status,
            'gambar_lab' => $gambarPath,
        ]);

        return redirect()->route('admin.laboratorium.index')->with('success', 'Data laboratorium berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $lab = Laboratorium::findOrFail($id);
        return view('admin.laboratorium.edit', compact('lab'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lab' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|string',
            'gambar_lab' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $lab = Laboratorium::findOrFail($id);

        if ($request->hasFile('gambar_lab')) {
            if ($lab->gambar_lab) {
                Storage::disk('public')->delete($lab->gambar_lab);
            }
            $lab->gambar_lab = $request->file('gambar_lab')->store('images/lab', 'public');
        }

        $lab->nama_lab = $request->nama_lab;
        $lab->lokasi = $request->lokasi;
        $lab->kapasitas = $request->kapasitas;
        $lab->status = $request->status;
        $lab->save();

        return redirect()->route('admin.laboratorium.index')->with('success', 'Data laboratorium berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lab = Laboratorium::findOrFail($id);
        if ($lab->gambar_lab) {
            Storage::disk('public')->delete($lab->gambar_lab);
        }
        $lab->delete();

        return redirect()->route('admin.laboratorium.index')->with('success', 'Data laboratorium berhasil dihapus.');
    }
}
