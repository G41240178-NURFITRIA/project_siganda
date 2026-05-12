<x-app-layout>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#EEF2F7;
}

/* LAYOUT */
.dashboard{
    display:flex;
    min-height:100vh;
}

/* MAIN */
.main{
    flex:1;
    padding:18px;
    overflow-x:auto;
    background:#EEF2F7;
}

/* HEADER */
.header-top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:18px;
}

.welcome h1{
    font-size:22px;
    font-weight:800;
    color:#111827;
    margin-bottom:4px;
}

.welcome p{
    font-size:14px;
    color:#9CA3AF;
}

.header-time{
    display:flex;
    gap:18px;
    font-size:14px;
    font-weight:700;
    color:#374151;
}

/* STATS */
.stats-row{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
    margin-bottom:16px;
}

.stat-card{
    background:#fff;
    border-radius:14px;
    padding:16px;
    display:flex;
    gap:14px;
    align-items:flex-start;
    position:relative;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
    overflow:hidden;
}

.stat-card::before{
    content:'';
    position:absolute;
    left:0;
    top:0;
    bottom:0;
    width:6px;
}

.stat-card:nth-child(1)::before{
    background:#42C5F5;
}

.stat-card:nth-child(2)::before{
    background:#7CC576;
}

.stat-card:nth-child(3)::before{
    background:#F6A44D;
}

.stat-card:nth-child(4)::before{
    background:#D66BFF;
}

.stat-icon{
    width:46px;
    height:46px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
    flex-shrink:0;
}

.stat-card:nth-child(1) .stat-icon{
    background:#EAF4FF;
    color:#2563EB;
}

.stat-card:nth-child(2) .stat-icon{
    background:#EDFCEB;
    color:#16A34A;
}

.stat-card:nth-child(3) .stat-icon{
    background:#FFF4E8;
    color:#EA580C;
}

.stat-card:nth-child(4) .stat-icon{
    background:#FAE8FF;
    color:#C026D3;
}

.stat-content{
    flex:1;
}

.stat-content h4{
    font-size:14px;
    font-weight:700;
    color:#222;
    margin-bottom:5px;
}

.stat-content h2{
    font-size:40px;
    line-height:1;
    font-weight:800;
    color:#111827;
}

.stat-content p{
    font-size:11px;
    color:#A0AEC0;
    margin-top:6px;
}

/* GRID */
.middle-row{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:14px;
    margin-bottom:16px;
}

.bottom-row{
    display:grid;
    grid-template-columns:1fr 1fr 1fr;
    gap:14px;
}

/* CARD */
.card{
    background:#fff;
    border-radius:16px;
    padding:18px;
    box-shadow:0 3px 12px rgba(0,0,0,0.05);
    border-left:6px solid #42C5F5;
}

.card-header{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:15px;
    font-weight:800;
    color:#1F2937;
    margin-bottom:14px;
}

/* TABLE */
.table-label{
    color:#A0AEC0;
    font-size:11px;
    margin-top:-8px;
    margin-bottom:10px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#F8FAFC;
    color:#4B5563;
    font-size:10px;
    padding:10px;
    border:1px solid #E5E7EB;
    text-transform:uppercase;
}

td{
    border:1px solid #E5E7EB;
    padding:12px;
    height:34px;
}

/* AKTIVITAS */
.activity-item{
    display:flex;
    align-items:flex-start;
    gap:10px;
    margin-bottom:16px;
    font-size:11px;
}

.activity-time{
    font-weight:800;
    color:#111827;
    width:40px;
}

.activity-dot{
    width:8px;
    height:8px;
    border-radius:50%;
    margin-top:5px;
}

.blue{ background:#2563EB; }
.green{ background:#16A34A; }

.activity-text{
    color:#374151;
    line-height:1.5;
}

.view-btn{
    margin-top:18px;
    display:flex;
    justify-content:center;
}

.view-btn a{
    text-decoration:none;
    color:#2563EB;
    font-size:13px;
    font-weight:700;
}

/* CHARTS */
.chart-wrapper{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
}

.donut-chart{
    width:120px;
    height:120px;
    border-radius:50%;
    position:relative;
}

.donut-chart::after{
    content:'';
    position:absolute;
    width:56px;
    height:56px;
    background:#fff;
    border-radius:50%;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
}

.triage-chart{
    background:
    conic-gradient(
        #EF4444 0% 20%,
        #F59E0B 20% 45%,
        #22C55E 45% 80%,
        #3B82F6 80% 100%
    );
}

.gender-chart{
    background:
    conic-gradient(
        #3B82F6 0% 57%,
        #EC4899 57% 100%
    );
}

.legend{
    flex:1;
    font-size:10px;
    font-weight:700;
    color:#374151;
}

.legend div{
    display:flex;
    align-items:center;
    gap:8px;
    margin-bottom:10px;
}

.legend-color{
    width:10px;
    height:10px;
    border-radius:2px;
}

.summary-box{
    background:#F8FAFC;
    border-radius:12px;
    padding:12px 14px;
    margin-top:16px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.summary-box h3{
    font-size:28px;
    font-weight:800;
    color:#111827;
}

.summary-box p{
    font-size:11px;
    color:#9CA3AF;
}

.growth{
    background:#DCFCE7;
    color:#16A34A;
    padding:4px 10px;
    border-radius:8px;
    font-size:11px;
    font-weight:700;
}

/* RINGKASAN */
.summary-list{
    display:flex;
    flex-direction:column;
    gap:16px;
    margin-top:10px;
}

.summary-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.summary-left{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:12px;
    font-weight:700;
    color:#374151;
}

.summary-icon{
    width:30px;
    height:30px;
    border-radius:8px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:14px;
}

.bg-blue{
    background:#EAF4FF;
    color:#2563EB;
}

.bg-green{
    background:#EDFCEB;
    color:#16A34A;
}

.bg-purple{
    background:#FAE8FF;
    color:#C026D3;
}

.bg-orange{
    background:#FFF4E8;
    color:#EA580C;
}

.summary-badge{
    min-width:42px;
    text-align:center;
    padding:4px 10px;
    border-radius:8px;
    font-size:12px;
    font-weight:800;
}

.badge-blue{
    background:#DBEAFE;
    color:#2563EB;
}

.badge-green{
    background:#DCFCE7;
    color:#16A34A;
}

.badge-purple{
    background:#F5D0FE;
    color:#C026D3;
}

.badge-orange{
    background:#FED7AA;
    color:#EA580C;
}

/* RESPONSIVE */
@media(max-width:1200px){

    .stats-row{
        grid-template-columns:repeat(2,1fr);
    }

    .middle-row{
        grid-template-columns:1fr;
    }

    .bottom-row{
        grid-template-columns:1fr;
    }
}

@media(max-width:768px){

    .dashboard{
        flex-direction:column;
    }

    .stats-row{
        grid-template-columns:1fr;
    }

    .header-top{
        flex-direction:column;
        gap:10px;
    }
}
</style>

<div class="dashboard">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar-perawat')

    {{-- MAIN --}}
    <div class="main">

        {{-- HEADER --}}
        <div class="header-top">

            <div class="welcome">
                <h1>Selamat datang, Perawat</h1>
                <p>Berikut ringkasan aktivitas Anda hari ini</p>
            </div>

            <div class="header-time">
                <span>📅 Rabu, 06 Mei 2026</span>
                <span>🕙 10:30 WIB</span>
            </div>

        </div>

        {{-- STATS --}}
        <div class="stats-row">

            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-content">
                    <h4>Total Pasien (Hari ini)</h4>
                    <h2>{{ $stats['total_triage'] }}</h2>
                    <p>Total pasien terdaftar di IGD</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🚨</div>
                <div class="stat-content">
                    <h4>Merah (Gawat Darurat)</h4>
                    <h2>{{ $stats['merah'] }}</h2>
                    <p>Pasien kondisi kritis</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⚠️</div>
                <div class="stat-content">
                    <h4>Kuning (Urgensi Tinggi)</h4>
                    <h2>{{ $stats['kuning'] }}</h2>
                    <p>Perlu pengawasan medis</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-content">
                    <h4>Hijau (Non-Gawat)</h4>
                    <h2>{{ $stats['hijau'] }}</h2>
                    <p>Kondisi aman</p>
                </div>
            </div>

        </div>

        {{-- MIDDLE --}}
        <div class="middle-row">

            {{-- TABLE --}}
            <div class="card">

                <div class="card-header">
                    👥 Antrian Triage
                </div>

                <div class="table-label">
                    Frame
                </div>

                <div style="max-height: 350px; overflow-y: auto;">
                    <table>

                    <thead>
                        <tr>
                            <th>NO.ANTRI</th>
                            <th>NAMA PASIEN</th>
                            <th>USIA</th>
                            <th>KATEGORI</th>
                            <th>WAKTU DAFTAR</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($triages as $triage)
                        <tr>
                            <td style="font-weight:700;">#{{ $triage->id }}</td>
                            <td>{{ $triage->nama_pasien }}</td>
                            <td>{{ $triage->umur }} thn</td>
                            <td>
                                @if($triage->kategori == 'merah')
                                    <span style="color:#EF4444; font-weight:700;">Merah</span>
                                @elseif($triage->kategori == 'kuning')
                                    <span style="color:#F59E0B; font-weight:700;">Kuning</span>
                                @elseif($triage->kategori == 'hijau')
                                    <span style="color:#22C55E; font-weight:700;">Hijau</span>
                                @endif
                            </td>
                            <td>{{ $triage->created_at->format('H:i') }}</td>
                            <td>
                                <span style="background:#E5E7EB; padding:3px 8px; border-radius:10px; font-size:10px;">
                                    Triage Selesai
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding:20px; color:#9CA3AF;">Belum ada pasien IGD terdaftar hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
                </div>

            </div>

            {{-- ACTIVITY --}}
            <div class="card">

                <div class="card-header">
                    📈 Aktivitas Terakhir
                </div>

                <div style="max-height: 350px; overflow-y: auto; padding-right: 10px;">
                @forelse($activities as $act)
                <div class="activity-item">
                    <div class="activity-time">{{ $act->time->format('H:i') }}</div>
                    <div class="activity-dot {{ $act->kategori == 'merah' ? 'bg-red-500' : 'blue' }}" style="{{ $act->type == 'selesai' ? 'background:#10b981;' : '' }}"></div>

                    <div class="activity-text">
                        @if($act->type == 'daftar')
                            Pendaftaran Triage untuk pasien <strong>{{ $act->nama }}</strong> (Kategori {{ ucfirst($act->kategori) }})
                        @else
                            Observasi selesai: Pasien <strong>{{ $act->nama }}</strong> diputuskan untuk <strong>{{ $act->tindak_lanjut ?? 'Selesai' }}</strong>.
                        @endif
                    </div>
                </div>
                @empty
                <div class="activity-item">
                    <div class="activity-text" style="color:#9CA3AF;">Belum ada aktivitas terekam.</div>
                </div>
                @endforelse
                </div>

            </div>

        </div>

        {{-- BOTTOM --}}
        @php
            $tot = $stats['total_triage'] > 0 ? $stats['total_triage'] : 1;
            $pm = ($stats['merah'] / $tot) * 100;
            $pk = ($stats['kuning'] / $tot) * 100;
            $ph = ($stats['hijau'] / $tot) * 100;
            $p2 = $pm + $pk;
            $p3 = $p2 + $ph;

            $tl = $stats['laki'];
            $tp = $stats['perempuan'];
            $totGender = ($tl + $tp) > 0 ? ($tl + $tp) : 1;
            $pl = ($tl / $totGender) * 100;
        @endphp

        <style>
            .triage-chart{
                background: conic-gradient(
                    #EF4444 0% {{ $pm }}%,
                    #F59E0B {{ $pm }}% {{ $p2 }}%,
                    #22C55E {{ $p2 }}% 100%
                );
            }
            .gender-chart{
                background: conic-gradient(
                    #3B82F6 0% {{ $pl }}%,
                    #EC4899 {{ $pl }}% 100%
                );
            }
        </style>

        <div class="bottom-row">

            {{-- TRIAGE --}}
            <div class="card">
                <div class="card-header">
                    Statistik Triage Hari Ini
                </div>
                <div class="chart-wrapper">
                    <div class="donut-chart triage-chart" style="{{ $stats['total_triage'] == 0 ? 'background:#E5E7EB;' : '' }}"></div>
                    <div class="legend">
                        <div>
                            <span class="legend-color" style="background:#EF4444"></span> Merah ({{ $stats['merah'] }})
                        </div>
                        <div>
                            <span class="legend-color" style="background:#F59E0B"></span> Kuning ({{ $stats['kuning'] }})
                        </div>
                        <div>
                            <span class="legend-color" style="background:#22C55E"></span> Hijau ({{ $stats['hijau'] }})
                        </div>
                    </div>
                </div>
                <div class="summary-box">
                    <div>
                        <p>Total Triage</p>
                        <h3>{{ $stats['total_triage'] }}</h3>
                    </div>
                </div>
            </div>

            {{-- GENDER --}}
            <div class="card">
                <div class="card-header">
                    Pasien Berdasarkan Jenis Kelamin
                </div>
                <div class="chart-wrapper">
                    <div class="donut-chart gender-chart" style="{{ ($tl + $tp) == 0 ? 'background:#E5E7EB;' : '' }}"></div>
                    <div class="legend">
                        <div>
                            <span class="legend-color" style="background:#3B82F6"></span> Laki-laki ({{ $tl }})
                        </div>
                        <div>
                            <span class="legend-color" style="background:#EC4899"></span> Perempuan ({{ $tp }})
                        </div>
                    </div>
                </div>
                <div class="summary-box">
                    <div>
                        <p>Total Pasien</p>
                        <h3>{{ $tl + $tp }}</h3>
                    </div>
                </div>
            </div>

            {{-- RINGKASAN --}}
            <div class="card">
                <div class="card-header">
                    Ringkasan Hari ini
                </div>
                <div class="summary-list">

                    <div class="summary-item">
                        <div class="summary-left">
                            <div class="summary-icon bg-blue">⚕️</div>
                            Triage Dilakukan
                        </div>
                        <div class="summary-badge badge-blue">
                            {{ $stats['total_triage'] }}
                        </div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-left">
                            <div class="summary-icon bg-orange">⚠️</div>
                            Kondisi Kritis / Berat (Merah + Kuning)
                        </div>
                        <div class="summary-badge badge-orange">
                            {{ $stats['merah'] + $stats['kuning'] }}
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

</x-app-layout>