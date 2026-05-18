<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Morbiditas</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; color: #333; max-width: 800px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 26px; text-transform: uppercase; color: #111827; }
        .header p { margin: 5px 0 0 0; font-size: 14px; color: #4b5563; }
        .section { margin-bottom: 25px; }
        .section-title { font-size: 16px; font-weight: bold; background: #f3f4f6; padding: 8px 12px; border-left: 5px solid #111827; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 10px; border: 1px solid #e5e7eb; }
        th { background: #f9fafb; font-weight: bold; color: #4b5563; text-transform: uppercase; font-size: 13px; }
        .print-btn {
            position: fixed; top: 20px; right: 20px; padding: 10px 20px; background: #2563eb; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold;
        }
        @media print {
            .print-btn, .back-btn { display: none; }
            body { padding: 0; }
        }
        .back-btn {
            position: fixed; top: 20px; right: 120px; padding: 10px 20px; background: #64748b; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; text-decoration: none; font-weight: bold;
        }
    </style>
</head>
<body>

<a href="{{ route('pmik.pelaporan.detail') }}" class="back-btn">Kembali</a>
<button class="print-btn" onclick="window.print()">🖨️ Cetak</button>

<div class="header">
    <h1>Laporan Morbiditas Penyakit</h1>
    <p>Rumah Sakit Siganda | Periode: Bulan {{ date('F Y') }} | Tanggal Cetak: {{ date('d M Y, H:i') }}</p>
</div>

<div class="section">
    <div class="section-title">Daftar Distribusi Penyakit (RL4a)</div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="45%">Nama Penyakit (Diagnosa)</th>
                <th width="15%" style="text-align: center;">Laki-laki</th>
                <th width="15%" style="text-align: center;">Perempuan</th>
                <th width="20%" style="text-align: center;">Total Kasus</th>
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
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="font-weight: bold;">{{ $item->diagnosa_dokter }}</td>
                    <td style="text-align: center;">{{ $item->laki_laki }}</td>
                    <td style="text-align: center;">{{ $item->perempuan }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $item->total }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">Belum ada data diagnosa bulan ini.</td>
                </tr>
            @endforelse
        </tbody>
        @if($grandTotal > 0)
        <tfoot>
            <tr style="background: #f3f4f6; font-weight: bold;">
                <td colspan="2" style="text-align: right;">TOTAL KESELURUHAN</td>
                <td style="text-align: center;">{{ $totL }}</td>
                <td style="text-align: center;">{{ $totP }}</td>
                <td style="text-align: center;">{{ $grandTotal }}</td>
            </tr>
        </tfoot>
        @endif
    </table>
</div>

<div style="margin-top: 60px; text-align: right; margin-right: 20px;">
    <p style="color: #4b5563;">Petugas Pelaporan (PMIK),</p>
    <br><br><br><br>
    <p style="text-decoration: underline;"><strong>{{ auth()->user()->name ?? 'Petugas PMIK' }}</strong></p>
</div>

</body>
</html>
