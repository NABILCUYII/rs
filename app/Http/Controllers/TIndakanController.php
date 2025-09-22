<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Tindakan;
use Illuminate\Http\Request;



class TindakanController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        return Inertia::render('tindakan/index', [
            'tindakan' => Tindakan::all()
        ]);
    }


public function create()
    {
        return Inertia::render('tindakan/create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pasien' => 'required|string|max:255',
            'dokter' => 'required|string|max:255',
            'tindakan' => 'required|string|max:255',
            'jumlah' => 'required|integer',
        ]);

      Tindakan::create([
    'id_pasien' => $request->id_pasien,
    'dokter'    => $request->dokter,
    'tindakan'  => $request->tindakan,
    'jumlah'    => $request->jumlah,
]);


        return response()->json([
            'message' => 'Data tindakan berhasil ditambahkan',
            
        ], 201);
    }

    // Menampilkan data by ID
    public function show($id)
    {
        $tindakan = Tindakan::findOrFail($id);
        return response()->json($tindakan);
    }

    // Update data
    public function update(Request $request, $id)
    {
        $tindakan = Tindakan::findOrFail($id);

        $validated = $request->validate([
            'id_pasien' => 'required|string|max:255',
            'dokter' => 'required|string|max:255',
            'tindakan' => 'required|string|max:255',
            'jumlah' => 'required|integer',
        ]);

        $tindakan->update($validated);

        return response()->json([
            'message' => 'Data tindakan berhasil diperbarui',
            'data' => $tindakan
        ]);
    }

    // Hapus data
    public function destroy($id)
    {
        $tindakan = Tindakan::findOrFail($id);
        $tindakan->delete();

       return redirect()->route('tindakan.index')->with('success', 'User deleted successfully!');
    }
}
