<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $query = RekamMedis::latest();
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_pasien', 'like', "%{$search}%")
                  ->orWhere('no_rm', 'like', "%{$search}%");
        }

        $data = $query->paginate(10);
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

    public function validasi(Request $request, $id)
    {
        $rm = RekamMedis::findOrFail($id);
        $rm->update(['status_validasi' => $request->status_validasi]);
        return back()->with('success', 'Status validasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        RekamMedis::findOrFail($id)->delete();
        return back()->with('success', 'Data rekam medis berhasil dihapus!');
    }
}
