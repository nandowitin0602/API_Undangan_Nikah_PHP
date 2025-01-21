<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UcapanController extends Controller
{
    public function addUcapan(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string',
            'ucapan' => 'required|string',
            'konfirmasi_kehadiran' => 'required|string',
        ]);

        try {
            DB::insert("
                INSERT INTO ucapan (Nama, Ucapan, Konfirmasi_Kehadiran, Addtime)
                VALUES (?, ?, ?, NOW())
            ", [
                $validated['nama'],
                $validated['ucapan'],
                $validated['konfirmasi_kehadiran']
            ]);

            return response()->json(['message' => 'Data berhasil ditambahkan.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan.', 'error' => $e->getMessage()], 500);
        }
    }

    public function getUcapan()
    {
        try {
            $ucapans = DB::select("
                SELECT Id, Nama, Ucapan, Konfirmasi_Kehadiran, Addtime
                FROM ucapan
                ORDER BY Addtime DESC
            ");

            return response()->json($ucapans, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan.', 'error' => $e->getMessage()], 500);
        }
    }
}
