<!DOCTYPE html>
<html>
<head>
    <title>Cetak Hasil Triage</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; color: #333; max-width: 800px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 26px; text-transform: uppercase; color: #111827; }
        .header p { margin: 5px 0 0 0; font-size: 14px; color: #4b5563; }
        .section { margin-bottom: 25px; }
        .section-title { font-size: 16px; font-weight: bold; background: #f3f4f6; padding: 8px 12px; border-left: 5px solid #111827; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 10px; border-bottom: 1px solid #f3f4f6; }
        td:first-child { width: 200px; font-weight: bold; color: #4b5563; }
        .badge { display: inline-block; padding: 15px 30px; font-weight: bold; color: white; border-radius: 8px; font-size: 20px; text-transform: uppercase; letter-spacing: 1px; }
        .bg-merah { background-color: #EF4444; }
        .bg-kuning { background-color: #F59E0B; }
        .bg-hijau { background-color: #10B981; }
        .bg-biru { background-color: #3B82F6; }
        
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

<a href="{{ route('triage') }}" class="back-btn">Kembali</a>
<button class="print-btn" onclick="window.print()">🖨️ Cetak</button>

<div class="header">
    <h1>Hasil Pemeriksaan Triage</h1>
    <p>Rumah Sakit Siganda | Tanggal Cetak: {{ date('d M Y, H:i') }}</p>
</div>

<div class="section">
    <div class="section-title">Identitas Pasien</div>
    <table>
        <tr><td>Nama Pasien</td><td>: {{ $data['nama_pasien'] }}</td></tr>
        <tr><td>Umur</td><td>: {{ $data['umur'] }} Tahun</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $data['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
        <tr><td>Alergi</td><td>: {{ $data['alergi'] ?: 'Tidak ada alergi' }}</td></tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Keluhan Utama</div>
    <p style="padding: 10px; line-height: 1.6; border: 1px solid #f3f4f6; margin-top: 10px; border-radius: 5px;">{{ $data['keluhan_utama'] }}</p>
</div>

<div class="section">
    <div class="section-title">Tanda Vital</div>
    <table>
        <tr><td>Tekanan Darah</td><td>: {{ $data['td'] }} mmHg</td></tr>
        <tr><td>Suhu Badan</td><td>: {{ $data['suhu'] }} °C</td></tr>
        <tr><td>Nadi</td><td>: {{ $data['nadi'] }} x/mnt</td></tr>
        <tr><td>Respirasi</td><td>: {{ $data['respirasi'] }} x/mnt</td></tr>
        <tr><td>Saturasi Oksigen (SpO2)</td><td>: {{ $data['saturasi'] }} %</td></tr>
    </table>
</div>

<div class="section">
    <div class="section-title">Kategori Triage</div>
    <div style="padding: 30px; text-align: center;">
        <div class="badge bg-{{ strtolower($data['kategori']) }}">
            Kategori {{ ucfirst($data['kategori']) }}
        </div>
    </div>
</div>

<div style="margin-top: 60px; text-align: right; margin-right: 20px;">
    <p style="color: #4b5563;">Petugas Pemeriksa Triage,</p>
    <br><br><br><br>
    <p style="text-decoration: underline;"><strong>{{ auth()->user()->name ?? 'Perawat Bertugas' }}</strong></p>
</div>

</body>
</html>
