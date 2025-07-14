<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use App\Models\Inventaris;
use App\Models\JadwalLab;
use App\Models\Pengaduan;
use App\Models\RiwayatPengaduan;
use App\Models\User;

class ApiController extends Controller
{
    // ==================== LABORATORIUM ====================
    public function getLaboratorium()
    {
        return response()->json(Laboratorium::all());
    }

    public function storeLaboratorium(Request $request)
    {
        $request->validate([
            'nama_lab' => 'required',
            'lokasi' => 'required',
            'kapasitas' => 'required|integer',
        ]);

        $lab = Laboratorium::create($request->all());
        return response()->json($lab, 201);
    }

    public function updateLaboratorium(Request $request, $id)
    {
        $lab = Laboratorium::findOrFail($id);
        $lab->update($request->all());
        return response()->json($lab);
    }

    public function deleteLaboratorium($id)
    {
        Laboratorium::destroy($id);
        return response()->json(['message' => 'Laboratorium dihapus']);
    }

    // ==================== INVENTARIS ====================
    public function getInventaris()
    {
        return response()->json(Inventaris::with('laboratorium')->get());
    }

    public function storeInventaris(Request $request)
    {
        $request->validate([
            'nama_item' => 'required',
            'jumlah' => 'required|integer',
            'kondisi' => 'required',
            'id_lab' => 'required|exists:laboratorium,id_lab'
        ]);

        $item = Inventaris::create($request->all());
        return response()->json($item, 201);
    }

    // ==================== PENGADUAN ====================
    public function getPengaduan()
    {
        return response()->json(Pengaduan::with(['user', 'laboratorium'])->get());
    }

    public function storePengaduan(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_lab' => 'required|exists:laboratorium,id_lab',
            'deskripsi' => 'required'
        ]);

        $pengaduan = Pengaduan::create([
            'id_user' => $request->id_user,
            'id_lab' => $request->id_lab,
            'deskripsi' => $request->deskripsi,
            'foto_kerusakan' => $request->foto_kerusakan ?? null,
            'tanggal_lapor' => now(),
            'status' => 'menunggu'
        ]);

        return response()->json($pengaduan, 201);
    }

    public function updateStatusPengaduan(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $riwayat = RiwayatPengaduan::create([
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'status_lama' => $pengaduan->status,
            'status_baru' => $request->status,
            'diperbarui_oleh' => $request->diperbarui_oleh,
        ]);

        $pengaduan->status = $request->status;
        $pengaduan->save();

        return response()->json(['pengaduan' => $pengaduan, 'riwayat' => $riwayat]);
    }
}
