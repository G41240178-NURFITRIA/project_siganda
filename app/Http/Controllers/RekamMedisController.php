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
        \Illuminate\Support\Facades\Log::info('Store method hit!');
        $request->validate([
            'no_rm' => 'required|unique:rekam_medis',
            'nik' => 'required|digits:16',
            'nama_pasien' => 'required|regex:/^[A-Za-zÀ-ÿ\s\-\']+$/u|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|max:255|regex:/^[0-9A-Za-zÀ-ÿ\s,\.\-\/\#]+$/u',
            'no_telepon' => 'nullable|digits_between:10,12',
        ]);

        RekamMedis::create($request->all());

        return back()->with('success', 'Data rekam medis berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        \Illuminate\Support\Facades\Log::info('Form submitted! Diagnosa: ' . $request->diagnosa_dokter);
        $rm = RekamMedis::findOrFail($id);
        $user = auth()->user();

        // Dokter hanya update field medis (diagnosa & tindakan)
        \Illuminate\Support\Facades\Log::info('User Role Update: ' . $user->role);
        if ($user->role === 'dokter') {
            $request->validate([
                'diagnosa_dokter' => 'nullable|string',
                'tindakan_dokter' => 'nullable|string',
                'keluhan_utama' => 'nullable|string',
            ]);

            $rm->update($request->only([
                'keluhan_utama', 'riwayat_penyakit',
                'diagnosa_dokter', 'tindakan_dokter'
            ]));
        } else {
            // PMIK / Admin update data identitas pasien
            $request->validate([
                'no_rm' => 'required|unique:rekam_medis,no_rm,' . $rm->id,
                'nik' => 'required|digits:16',
                'nama_pasien' => 'required|regex:/^[A-Za-zÀ-ÿ\s\-\']+$/u|max:100',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'alamat' => 'nullable',
                'no_telepon' => 'nullable|string|max:20',
            ]);

            $rm->update($request->all());
        }

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
