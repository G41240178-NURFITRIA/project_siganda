*resources/views/pmik/pelaporan.blade.php*
<x-app-layout>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',sans-serif; }
body { background:#EEF2F7; }
.dashboard { display:flex; min-height:100vh; }
.sidebar { width:240px; background:#F7FAFD; padding:20px; border-right:1px solid #E4EAF2; flex-shrink:0; }
.main { flex:1; padding:22px; overflow-x:auto; }

.top-action { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }

/* REPORTING CARDS */
.reports-container { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px; }
.report-card { background: #fff; border-radius: 12px; padding: 20px; flex: 1; min-width: 250px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); position: relative; overflow: hidden; }
.report-card.border-blue { border-left: 5px solid #3B82F6; }
.report-card.border-indigo { border-left: 5px solid #6366F1; }
.report-card.border-cyan { border-left: 5px solid #06B6D4; }

.report-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
.report-title { font-size: 14px; font-weight: 700; color: #111827; display: flex; align-items: center; gap: 8px; }
.report-link { font-size: 12px; color: #3B82F6; text-decoration: none; font-weight: 600; }

.report-number { font-size: 36px; font-weight: 800; color: #111827; line-height: 1.2; }
.report-label { font-size: 14px; color: #111827; font-weight: 600; margin-bottom: 5px; }
.report-trend { font-size: 12px; color: #10B981; font-weight: 600; display: flex; align-items: center; gap: 4px; }
.report-trend.down { color: #EF4444; }

/* LIST PENYAKIT */
.disease-list { list-style: none; padding: 0; margin: 0; font-size: 13px; color: #374151; font-weight: 500; }
.disease-list li { display: flex; justify-content: space-between; margin-bottom: 8px; padding-bottom: 8px; border-bottom: 1px dashed #E5E7EB; }
.disease-list li:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }

/* MINI CHART PLACEHOLDERS */
.mini-chart { position: absolute; bottom: 15px; right: 20px; width: 80px; height: 40px; }

/* BUTTON LIHAT DETAIL */
.btn-lihat-detail {
    display: inline-block;
    background: linear-gradient(135deg, #3B82F6, #2563EB);
    color: #fff;
    padding: 10px 22px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 2px 8px rgba(59,130,246,0.3);
}
.btn-lihat-detail:hover {
    background: linear-gradient(135deg, #2563EB, #1D4ED8);
    box-shadow: 0 4px 14px rgba(59,130,246,0.45);
    transform: translateY(-1px);
}
</style>

<div class="dashboard">
    @include('layouts.sidebar-pmik')

    <div class="main">
        @include('layouts.navbar', [
            'title' => '📊 Dashboard Pelaporan',
            'description' => 'Lihat statistik sensus harian dan morbiditas pasien.'
        ])

        <div class="reports-container">
            
            {{-- Sensus Bulanan --}}
            <div class="report-card border-blue">
                <div class="report-header">
                    <div class="report-title">
                        <span style="color: #3B82F6;">📊</span> Sensus Bulanan
                    </div>
                </div>
                <div class="report-number">{{ $sensusBulanan }}</div>
                <div class="report-label">Total Pasien Bulan Ini</div>
                <div style="margin-top: 18px;">
                    <a href="{{ route('pmik.pelaporan.sensus') }}" class="btn-lihat-detail">
                        Lihat Detail &rarr;
                    </a>
                </div>
            </div>

            {{-- Morbiditas Bulan Ini --}}
            <div class="report-card border-indigo" style="border-left: 5px solid #10B981;">
                <div class="report-header">
                    <div class="report-title">
                        <span style="color: #10B981;">🤍</span> 10 Besar Morbiditas
                    </div>
                    <a href="{{ route('pmik.pelaporan.morbiditas') }}" class="report-link">Lihat Detail &rarr;</a>
                </div>
                <div class="report-number">{{ $morbiditasBulanan }}</div>
                <div class="report-label">Kasus Bulan Ini</div>
                <div class="report-trend {{ $trendMorbiditas < 0 ? 'down' : '' }}">
                    {{ $trendMorbiditasText }}
                </div>
                <svg class="mini-chart" viewBox="0 0 100 40" preserveAspectRatio="none">
                    <polyline fill="none" stroke="#34D399" stroke-width="2" points="0,25 20,15 40,25 60,5 80,15 100,2"/>
                </svg>
            </div>

            {{-- Mortalitas Bulanan --}}
            <div class="report-card" style="border-left: 5px solid #EF4444;">
                <div class="report-header">
                    <div class="report-title">
                        <span style="color: #EF4444;">💀</span> 10 Besar Mortalitas
                    </div>
                    <a href="{{ route('pmik.pelaporan.mortalitas') }}" class="report-link">Lihat Detail &rarr;</a>
                </div>
                <div class="report-number">{{ $mortalitasBulanan }}</div>
                <div class="report-label">Data Kematian Bulan Ini</div>
                <div class="report-trend {{ $trendKematian < 0 ? 'down' : '' }}">
                    {{ $trendKematianText }}
                </div>
                <svg class="mini-chart" viewBox="0 0 100 40" preserveAspectRatio="none">
                    <polyline fill="none" stroke="#F87171" stroke-width="2" points="0,35 20,25 40,30 60,15 80,5 100,0"/>
                </svg>
            </div>

        </div>
    </div>
</div>
</x-app-layout>