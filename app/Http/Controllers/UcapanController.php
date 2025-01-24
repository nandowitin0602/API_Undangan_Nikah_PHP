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
            'nama' => 'nullable|string',
            'ucapan' => 'required|string',
            'konfirmasi_kehadiran' => 'required|string',
        ]);

        // Daftar nama yang Valid
        $validNames = [
            'Loretta',
            'Pricilia Rey',
            'Yoga Wijaya & Partner',
            'Fendi & Keluarga',
            'Agung Sanjaya & Istri',
            'Dedi Suryadi & Keluarga',
            'Muliono Rudy & Keluarga',
            'Jan Rahanra & keluarga',
            'Edi Oilira & keluarga',
            'Cut Mega',
            'Diah Nurul Fajrina',
            'Simon Liu & Keluarga',
            'Liu Se Lim & Keluarga',
            'Liu Hie Lim',
            'Sally',
            'Selvi Angelia',
            'Prasetya Setiawan & Family',
            'Henry Denata & Family',
            'Emi Suherna & Family',
            'Lenny Adelina & Partner',
            'Roselina & Partner',
            'Halimah & Keluarga',
            'Ci Lianna',
            'Juneike',
            'Indah Fatma',
            'Cynthia',
            'Dewi Purnamasari',
            'Frisca lychia & Partner',
            'Hengky & Keluarga',
            'Mega',
            'Nita Caroline',
            'Sarah Devina & Keluarga',
            'Stephanie',
            'Welly',
            'Yefieka Liestiyani',
            'Yohanes C Tanjung & Partner',
            'Cindy Lie & Keluarga',
            'Nicky',
            'Elyanti & Keluarga',
            'Rifky Wilantara & Hartina Naga Wijaya',
            'Putu Gita Andika & Harlina Naga Wijaya',
            'Gunadi Naga Wijaya & Partner',
            'Haryani Naga Wijaya & Partner',
            'Muhammad Mustofa & Keluarga',
            'William Linandry Wijaya & Keluarga',
            'Herlina & Partner',
            'Ivan',
            'Andreano Lieonard & Keluarga',
            'Rendy Leonardo & Keluarga',
            'Vanesa Moe & Keluarga',
            'Andrianto Handojo & Keluarga',
            'Pavita Priscilia & Keluarga',
            'Metta Lastiawani & Keluarga',
            'Jufeity Kosasih',
            'Fendy Tjie',
            'Andy Daniswara',
            'Raka Al Fajri',
            'Sisielius Yuan Reynaldo',
            'Ardiawan Kurniandi & Keluarga',
            'Santo Hura',
            'Ryan Putra & Partner',
            'Owen Putra Wijaya & Keluarga',
            'Kendry Juwono & Keluarga',
            'Steven Liao & Partner',
            'Patrick Fernando Ciputra & Partner',
            'Christopher Jeremy & Partner',
            'Oktavianus Kurniawan & Keluarga',
            'Andrean & Partner',
            'Nico Liu & Marco Nicholas',
            'Willy Leonardi & partner',
            'Yucia Juniar & Partner',
            'William Manopo & Keluarga',
            'Rudy Ming & Keluarga',
            'Deddy Sanjaya & Partner',
            'Dyana Septeani',
            'Rendy Purnama & Keluarga',
            'Handika & Keluarga',
            'Wirananda Eka Wijaya & Partner',
            'Novi & Partner',
            'Ronny',
            'Jessica Hartono',
            'Ko Irwan & Keluarga',
            'Fredy Onggo & Partner',
            'Visarada & Partner',
            'Evirna Ester & Partner',
            'Jessica Wijaya & Partner',
            'PT Pejuang Senyum Abadi',
            'Alfred',
            'Nita',
            'Steven & Elvia',
            'Daniel Budi & partner',
            'Ricky & Linsye',
            'Vincent & Gresyeila',
            'Pedro',
            'Lydia Maheswari',
            'Sunaryo',
            'Aryo & Partner',
            'Fendy & Partner',
            'Feber',
            'Vera & Partner',
            'Sulli'
        ];

        // Trim dan lowercase setiap elemen dalam validNames
        $validNames = array_map(function ($name) {
            return strtolower(trim($name));
        }, $validNames);

        // Trim dan lowercase nama yang diinputkan
        $namaInput = strtolower(trim($validated['nama'] ?? ''));

        // Jika nama kosong atau tidak ada di array validNames, maka diisi "Tamu Undangan"
        $nama = empty($namaInput) || !in_array($namaInput, $validNames) ? 'Tamu Undangan' : $validated['nama'];

        try {
            DB::insert("
            INSERT INTO ucapan (Nama, Ucapan, Konfirmasi_Kehadiran, Addtime)
            VALUES (?, ?, ?, NOW())
        ", [
                $nama,
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
