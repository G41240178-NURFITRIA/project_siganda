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
</style>

<div class="dashboard">
    @include('layouts.sidebar-pmik')

    <div class="main">
        @include('layouts.navbar', [
            'title' => '📊 Dashboard Pelaporan',
            'description' => 'Lihat statistik sensus harian dan morbiditas pasien.'
        ])

        <div class="reports-container">
            
            {{-- Sensus Harian --}}
            <div class="report-card border-blue">
                <div class="report-header">
                    <div class="report-title">
                        <span style="color: #3B82F6;">📊</span> Sensus Harian
                    </div>
                </div>
                <div class="report-number">124</div>
                <div class="report-label">Pasien</div>
                <div class="report-trend">
                    <span>▲</span> 12% dari kemarin
                </div>
                <!-- Simple SVG sparkline -->
                <svg class="mini-chart" viewBox="0 0 100 40" preserveAspectRatio="none">
                    <polyline fill="none" stroke="#60A5FA" stroke-width="2" points="0,30 20,20 40,35 60,10 80,25 100,5"/>
                </svg>
            </div>

            {{-- 10 Besar Penyakit --}}
            <div class="report-card border-indigo">
                <div class="report-header">
                    <div class="report-title">
                        <span style="color: #6366F1;">📈</span> 10 Besar Penyakit
                    </div>
                    <a href="#" class="report-link">Lihat Detail</a>
                </div>
                <ul class="disease-list">
                    <li><span>1. Hipertensi</span> <span>28 (22%)</span></li>
                    <li><span>2. ISPA</span> <span>21 (17%)</span></li>
                    <li><span>3. Diare</span> <span>15 (12%)</span></li>
                    <li><span>4. Gastritis</span> <span>12 (10%)</span></li>
                    <li><span>5. Lainnya</span> <span>48 (39%)</span></li>
                </ul>
            </div>

            {{-- Morbiditas Bulanan --}}
            <div class="report-card border-cyan">
                <div class="report-header">
                    <div class="report-title">
                        <span style="color: #06B6D4;">🧬</span> Morbiditas Bulanan
                    </div>
                    <a href="#" class="report-link">Lihat Detail</a>
                </div>
                <div class="report-number">386</div>
                <div class="report-label">Kasus</div>
                <div class="report-trend">
                    <span>▲</span> 15% dari bulan lalu
                </div>
                <svg class="mini-chart" viewBox="0 0 100 40" preserveAspectRatio="none">
                    <polyline fill="none" stroke="#22D3EE" stroke-width="2" points="0,25 20,15 40,25 60,5 80,15 100,2"/>
                </svg>
            </div>

        </div>
    </div>
</div>
</x-app-layout>