<x-app-layout>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
body { background: #f4f7fb; }

.dashboard { display: flex; min-height: 100vh; min-width: 0; width: 100%; }

/* MAIN CONTENT */
.main { flex: 1; min-width: 0; width: 100%; padding: 30px 40px; overflow-x: hidden; background: #f4f7fb; }

.header-top {
    display: flex; justify-content: space-between; align-items: flex-start;
    margin-bottom: 30px;
}
.header-top .welcome h1 { color: #1a202c; font-size: 26px; font-weight: 800; margin-bottom: 5px; }
.header-top .welcome p { color: #a0aec0; font-size: 14px; }

.header-time {
    display: flex; gap: 20px; color: #2d3748; font-weight: 700; font-size: 13px;
    background: transparent; padding: 5px; border-radius: 8px;
}

/* STATS ROW */
.stats-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px; margin-bottom: 30px; }
.stat-card {
    background: #fff; border-radius: 12px; padding: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    display: flex; align-items: center; gap: 15px;
    position: relative; overflow: hidden;
}
/* Left border colors */
.stat-card:nth-child(1)::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #4299e1; }
.stat-card:nth-child(2)::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #38b2ac; }
.stat-card:nth-child(3)::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #48bb78; }
.stat-card:nth-child(4)::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #ecc94b; }
.stat-card:nth-child(5)::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #f97316; }
.stat-card:nth-child(6)::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #ed64a6; }

.stat-icon {
    width: 45px; height: 45px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; flex-shrink: 0;
}
.stat-card:nth-child(1) .stat-icon { background: #ebf8ff; color: #3182ce; }
.stat-card:nth-child(2) .stat-icon { background: #e6fffa; color: #319795; }
.stat-card:nth-child(3) .stat-icon { background: #f0fff4; color: #38a169; }
.stat-card:nth-child(4) .stat-icon { background: #fffff0; color: #d69e2e; }
.stat-card:nth-child(5) .stat-icon { background: #fff7ed; color: #ea580c; }
.stat-card:nth-child(6) .stat-icon { background: #fff5f7; color: #d53f8c; }

.stat-info { display: flex; flex-direction: column; }
.stat-info p { font-size: 12px; color: #4a5568; font-weight: 600; margin-bottom: 5px; line-height: 1.2; }
.stat-info h3 { font-size: 24px; font-weight: 800; color: #1a202c; line-height: 1; }

/* MIDDLE SECTION */
.middle-row { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 20px; }
.card {
    background: #fff; border-radius: 12px; padding: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    position: relative; overflow: hidden;
}
.card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #4299e1; }
.card-header { font-size: 16px; font-weight: 700; color: #1a202c; margin-bottom: 15px; display: flex; align-items: center; gap: 8px; }

/* TABLE */
table { width: 100%; border-collapse: collapse; }
th, td { padding: 10px; text-align: left; border: 1px solid #e2e8f0; font-size: 12px; }
th { background: #f7fafc; color: #4a5568; font-weight: 700; }
td { color: #2d3748; }
.empty-rows td { height: 35px; }

/* LIST */
.activity-list { list-style: none; }
.activity-list li {
    display: flex; align-items: center; gap: 15px;
    font-size: 12px; font-weight: 600; color: #2d3748;
    padding: 12px 0; border-bottom: 1px solid #e2e8f0;
}
.activity-list li:last-child { border-bottom: none; }
.dot { width: 8px; height: 8px; border-radius: 50%; }
.dot-blue { background: #3182ce; }
.dot-yellow { background: #ecc94b; }
.dot-green { background: #48bb78; }

/* BOTTOM SECTION */
.bottom-row { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }

.chart-container {
    position: relative;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px 0;
}
.chart-container.pie-chart {
    max-width: 280px;
    margin: 0 auto;
}
.chart-container.bar-chart {
    height: 280px;
    max-width: 100%;
}

@media (max-width: 900px) {
    .bottom-row {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="dashboard">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar-pmik')

    {{-- MAIN CONTENT --}}
    <div class="main">
        @include('layouts.navbar', [
            'title' => '👋 Selamat datang, PMIK!',
            'description' => 'Berikut ringkasan aktivitas Anda hari ini'
        ])

        {{-- STATS --}}
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-info">
                    <p>Total Pasien<br>Terdaftar Hari Ini</p>
                    <h3>{{ $totalPasienHariIni ?? 0 }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📘</div>
                <div class="stat-info">
                    <p>Total Rekam<br>Medis</p>
                    <h3>{{ $totalRm ?? 0 }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🛏️</div>
                <div class="stat-info">
                    <p>Pasien<br>Dirawat</p>
                    <h3>{{ $pasienDirawat ?? 0 }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <p>Pasien<br>Pulang</p>
                    <h3>{{ $tlPulang ?? 0 }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏥</div>
                <div class="stat-info">
                    <p>Pasien<br>Rujuk</p>
                    <h3>{{ $tlRujuk ?? 0 }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⚰️</div>
                <div class="stat-info">
                    <p>Pasien<br>Meninggal</p>
                    <h3>{{ $tlMeninggal ?? 0 }}</h3>
                </div>
            </div>
        </div>

        {{-- MIDDLE --}}
        <div class="middle-row">
            <div class="card">
                <div class="card-header">🩺 Rekam Medis Terbaru</div>
                <table>
                    <thead>
                        <tr>
                            <th>No.RM</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Masuk</th>
                            <th>L/P</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekamMedis ?? [] as $rm)
                        <tr>
                            <td><strong>{{ $rm->no_rm }}</strong></td>
                            <td>{{ $rm->nama_pasien }}</td>
                            <td>{{ $rm->created_at->format('d M Y') }}</td>
                            <td>{{ $rm->jenis_kelamin }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #aaa; padding: 20px;">Belum ada data rekam medis terbaru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card">
                <div class="card-header">📈 Aktivitas Terakhir</div>
                <ul class="activity-list">
                    @forelse($rekamMedis ?? [] as $rm)
                    <li>
                        <span>{{ $rm->created_at->format('H:i') }}</span>
                        <div class="dot dot-blue"></div>
                        <span>RM Baru: {{ $rm->nama_pasien }}</span>
                    </li>
                    @empty
                    <li style="color: #aaa; padding: 10px 0;">Belum ada aktivitas.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- BOTTOM --}}
        @php
            $tindakData = [
                ['label' => 'Pulang', 'value' => $tlPulang ?? 0, 'color' => '#48bb78'],
                ['label' => 'Rawat Inap', 'value' => $tlRawatInap ?? 0, 'color' => '#3182ce'],
                ['label' => 'Rujuk', 'value' => $tlRujuk ?? 0, 'color' => '#f59e0b'],
                ['label' => 'Meninggal', 'value' => $tlMeninggal ?? 0, 'color' => '#dc2626'],
            ];
        @endphp
        <div class="bottom-row">
            {{-- PIE CHART: Tindak Lanjut --}}
            <div class="card">
                <div class="card-header">🥧 Tindak Lanjut Pasien</div>
                <div class="chart-container pie-chart">
                    <canvas id="chartTindakLanjut"></canvas>
                </div>
            </div>

            {{-- BAR CHART: Pendaftaran --}}
            <div class="card">
                <div class="card-header">📊 Tren Pendaftaran 7 Hari Terakhir</div>
                <div class="chart-container bar-chart">
                    <canvas id="chartPendaftaran"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // ===== PIE CHART — Tindak Lanjut Pasien =====
    const tindakLabels = @json(array_column($tindakData, 'label'));
    const tindakValues = @json(array_column($tindakData, 'value'));
    const tindakColors = @json(array_column($tindakData, 'color'));

    new Chart(document.getElementById('chartTindakLanjut'), {
        type: 'pie',
        data: {
            labels: tindakLabels,
            datasets: [{
                data: tindakValues,
                backgroundColor: tindakColors,
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 16,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 12,
                            weight: '600',
                            family: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"
                        },
                        color: '#4a5568'
                    }
                },
                tooltip: {
                    backgroundColor: '#1a202c',
                    titleFont: { size: 13, weight: '700' },
                    bodyFont: { size: 12 },
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const pct = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                            return ' ' + context.label + ': ' + context.parsed + ' (' + pct + '%)';
                        }
                    }
                }
            }
        }
    });

    // ===== BAR CHART — Pendaftaran 7 Hari =====
    const pendaftaranData = @json($pendaftaran7Hari ?? []);
    const pendLabels = pendaftaranData.map(item => item.label);
    const pendValues = pendaftaranData.map(item => item.count);

    new Chart(document.getElementById('chartPendaftaran'), {
        type: 'bar',
        data: {
            labels: pendLabels,
            datasets: [{
                label: 'Jumlah Pendaftaran',
                data: pendValues,
                backgroundColor: 'rgba(66, 153, 225, 0.75)',
                borderColor: '#3182ce',
                borderWidth: 2,
                borderRadius: 6,
                borderSkipped: false,
                barPercentage: 0.6,
                categoryPercentage: 0.7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1a202c',
                    titleFont: { size: 13, weight: '700' },
                    bodyFont: { size: 12 },
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return ' Pendaftaran: ' + context.parsed.y + ' pasien';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    border: {
                        display: true,
                        color: '#cbd5e0',
                        width: 2
                    },
                    ticks: {
                        font: {
                            size: 11,
                            weight: '600',
                            family: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"
                        },
                        color: '#4a5568'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#edf2f7',
                        drawTicks: false
                    },
                    border: {
                        display: true,
                        color: '#cbd5e0',
                        width: 2
                    },
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 11,
                            weight: '600',
                            family: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"
                        },
                        color: '#4a5568',
                        padding: 8
                    }
                }
            }
        }
    });

});
</script>

</x-app-layout>
