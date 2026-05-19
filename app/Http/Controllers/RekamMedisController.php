<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $data = RekamMedis::latest()->get();
        $role = auth()->user()->role;
        return view("{$role}.rekam_medis", compact('data'));
    }

            public function store(Request $request)
    {
        $request->validate([
            'no_rm' => 'required|unique:rekam_medis',
            'nik' => 'required|string|size:16',
            'nama_pasien' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable',
            'no_telepon' => 'nullable|string|max:20',
        ]);

        RekamMedis::create($request->all());
        return back()->with('success', 'Data rekam medis berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $rm = RekamMedis::findOrFail($id);
        
        $request->validate([
            'no_rm' => 'required|unique:rekam_medis,no_rm,' . $rm->id,
            'nik' => 'required|string|size:16',
            'nama_pasien' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable',
            'no_telepon' => 'nullable|string|max:20',
        ]);

        $rm->update($request->all());
        return back()->with('success', 'Data rekam medis berhasil diperbarui!');
    }
}