<?php

namespace App\Http\Controllers;

use App\Models\jadwallab;
use Illuminate\Http\Request;
use App\Models\Laboratorium;


class jadwallabController extends Controller
{
    public function index()
    {
        $jadwals = jadwallab::with('laboratorium')->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
{
    $laboratoriums = Laboratorium::all();
    return view('admin.jadwal.create', compact('laboratoriums'));
}

    public function store(Request $request)
    {
        $request->validate([
            'id_lab' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kegiatan' => 'required',
            'dosen_pengampu' => 'required',
        ]);

        jadwallab::create($request->all());
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
{
    $jadwal = JadwalLab::findOrFail($id);
    $laboratoriums = Laboratorium::all();
    return view('admin.jadwal.edit', compact('jadwal', 'laboratoriums'));
}

    public function update(Request $request, $id)
    {
        $jadwal = jadwallab::findOrFail($id);
        $jadwal->update($request->all());
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diupdate.');
    }

    public function destroy($id)
    {
        jadwallab::destroy($id);
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}

