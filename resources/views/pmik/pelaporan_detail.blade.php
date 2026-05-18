<x-app-layout>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',sans-serif; }
body { background:#EEF2F7; }
.dashboard { display:flex; min-height:100vh; }
.sidebar { width:240px; background:#F7FAFD; padding:20px; border-right:1px solid #E4EAF2; flex-shrink:0; }
.main { flex:1; padding:22px; overflow-x:auto; }

.card { background:#fff; border-radius:18px; padding:25px; box-shadow:0 3px 15px rgba(0,0,0,0.06); }
.top-action { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }

table { width:100%; border-collapse:collapse; margin-top:10px; }
th { background:#F9FAFB; padding:15px; text-align:left; font-size:13px; font-weight:700; color:#4B5563; text-transform:uppercase; border-bottom:2px solid #E5E7EB; }
td { padding:15px; border-bottom:1px solid #E5E7EB; font-size:14px; color:#374151; }
tr:hover td { background-color: #F8FAFC; }

.btn-back { background:#F3F4F6; color:#4B5563; padding:10px 20px; border-radius:10px; text-decoration:none; font-weight:600; display:inline-block; margin-bottom: 20px; }
.btn-back:hover { background:#E5E7EB; }

.btn-print { background:#2563EB; color:white; padding:10px 20px; border-radius:10px; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:8px; border:none; cursor:pointer; }
.btn-print:hover { background:#1D4ED8; }

/* PRINT STYLES */
@media print {
    body { background: white; }
    .sidebar, .top-navbar, .btn-back, .btn-print, .action-area { display: none !important; }
    .main { padding: 0 !important; }
    .card { box-shadow: none !important; padding: 0 !important; border-radius: 0 !important; }
    .print-header { display: block !important; text-align: center; margin-bottom: 30px; }
    .print-header h2 { font-size: 24px; font-weight: bold; margin-bottom: 5px; color: black; }
    .print-header p { font-size: 14px; color: black; }
    table { border: 1px solid #000; }
    th, td { border: 1px solid #000; padding: 10px; color: black; }
}
</style>

<div class="dashboard">
    @include('layouts.sidebar-pmik')

    <div class="main">
        @include('layouts.navbar', [
            'title' => '📄 Detail Morbiditas Bulanan',
            'description' => 'Laporan Rekapitulasi Data Morbiditas Penyakit Pasien Bulan ' . date('F Y')
        ])

        <a href="{{ route('pmik.pelaporan') }}" class="btn-back">⬅️ Kembali ke Dashboard</a>

        <div class="card">
            
            <div class="print-header" style="display: none;">
                <h2>LAPORAN MORBIDITAS PENYAKIT (RL4a)</h2>
                <p>Periode: Bulan {{ date('F Y') }}</p>
                <hr style="margin-top: 15px; border-color: black;">
            </div>

            <div class="top-action action-area">
                <h3 style="color: #111827; font-size: 18px;">Daftar Distribusi Penyakit</h3>
                <a href="{{ route('pmik.pelaporan.cetak') }}" target="_blank" class="btn-print" style="text-decoration: none;">🖨️ Cetak Laporan</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="45%">Nama Penyakit (Diagnosa Dokter)</th>
                        <th width="15%" style="text-align: center;">Pasien Laki-laki</th>
                        <th width="15%" style="text-align: center;">Pasien Perempuan</th>
                        <th width="20%" style="text-align: center;">Total Kasus Baru</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; $totL = 0; $totP = 0; @endphp
                    @forelse($morbiditas as $index => $item)
                        @php 
                            $grandTotal += $item->total;
                            $totL += $item->laki_laki;
                            $totP += $item->perempuan;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td style="font-weight: 600;">{{ $item->diagnosa_dokter }}</td>
                            <td style="text-align: center;">{{ $item->laki_laki }}</td>
                            <td style="text-align: center;">{{ $item->perempuan }}</td>
                            <td style="text-align: center; font-weight: bold; color: #2563EB;">{{ $item->total }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px; color: #6B7280;">Belum ada data rekam medis yang diisi diagnosa pada bulan ini.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if($grandTotal > 0)
                <tfoot>
                    <tr style="background: #F3F4F6; font-weight: bold;">
                        <td colspan="2" style="text-align: right; padding-right: 20px;">TOTAL KESELURUHAN</td>
                        <td style="text-align: center;">{{ $totL }}</td>
                        <td style="text-align: center;">{{ $totP }}</td>
                        <td style="text-align: center; color: #2563EB;">{{ $grandTotal }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>

        </div>
    </div>
</div>
</x-app-layout>
