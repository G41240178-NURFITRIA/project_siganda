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

/* SIDEBAR */
.sidebar{
    width:240px;
    background:#F7FAFD;
    padding:20px;
    border-right:1px solid #E4EAF2;
    flex-shrink:0;
}

.logo{
    text-align:center;
    margin-bottom:25px;
}

.logo img{
    width:75px;
    margin-bottom:8px;
}

.logo h3{
    color:#0A3D91;
    font-size:18px;
    font-weight:700;
}

.role-badge{
    display:inline-block;
    margin-top:6px;
    background:#E53935;
    color:white;
    padding:4px 12px;
    border-radius:20px;
    font-size:10px;
    font-weight:700;
    letter-spacing:1px;
}

/* MENU */
.menu-label{
    font-size:10px;
    color:#9aa4b2;
    margin:18px 10px 5px;
    font-weight:700;
    letter-spacing:1px;
    text-transform:uppercase;
}

.menu a{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 14px;
    border-radius:12px;
    text-decoration:none;
    color:#374151;
    font-size:14px;
    font-weight:600;
    margin-bottom:8px;
    transition:0.2s;
}

.menu a:hover,
.menu a.active{
    background:#E8F1FD;
    color:#0A3D91;
    transform:translateX(3px);
}

/* MAIN */
.main{
    flex:1;
    padding:22px;
    overflow-x:auto;
}

/* HEADER */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:20px;
}

.topbar h1{
    font-size:22px;
    font-weight:700;
    color:#111827;
}

.topbar p{
    color:#9CA3AF;
    margin-top:4px;
    font-size:14px;
}

.top-info{
    display:flex;
    gap:18px;
    align-items:center;
    color:#374151;
    font-size:14px;
    font-weight:600;
}

/* STAT CARD */
.stats-row{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:18px;
    margin-bottom:20px;
}

.stat-card{
    background:#fff;
    border-radius:16px;
    padding:16px;
    display:flex;
    align-items:center;
    gap:14px;
    box-shadow:0 3px 12px rgba(0,0,0,0.06);
    border-left:6px solid #42C5F5;
}

.stat-icon{
    width:52px;
    height:52px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    font-weight:bold;
}

.bg-blue{
    background:#EAF4FF;
    color:#2563EB;
}

.bg-green{
    background:#EAFBF0;
    color:#16A34A;
}

.bg-orange{
    background:#FFF4E8;
    color:#EA580C;
}

.bg-purple{
    background:#F4ECFF;
    color:#9333EA;
}

.stat-content h4{
    font-size:14px;
    color:#111827;
    margin-bottom:4px;
}

.stat-content h2{
    font-size:34px;
    line-height:1;
    color:#111827;
    font-weight:700;
}

.stat-content p{
    color:#9CA3AF;
    font-size:12px;
    margin-top:4px;
}

/* GRID */
.grid-layout{
    display:grid;
    grid-template-columns:2fr 1.1fr;
    gap:18px;
    margin-bottom:18px;
}

/* CARD */
.card{
    background:#fff;
    border-radius:18px;
    padding:20px;
    box-shadow:0 3px 15px rgba(0,0,0,0.06);
    border-left:6px solid #42C5F5;
}

.card h3{
    font-size:20px;
    margin-bottom:5px;
    color:#111827;
}

.card small{
    color:#9CA3AF;
}

/* CHART PLACEHOLDER */
.chart-box{
    margin-top:20px;
    height:250px;
    border-radius:12px;
    background:
        linear-gradient(#E5E7EB 1px, transparent 1px),
        linear-gradient(90deg,#E5E7EB 1px, transparent 1px);
    background-size:40px 40px;
    position:relative;
    overflow:hidden;
}

.chart-line{
    position:absolute;
    width:100%;
    height:100%;
}

/* ACTIVITY */
.activity-item{
    display:flex;
    gap:14px;
    align-items:flex-start;
    padding:14px 0;
    border-bottom:1px solid #EDF2F7;
}

.activity-item:last-child{
    border-bottom:none;
}

.activity-time{
    font-size:12px;
    color:#9CA3AF;
    width:45px;
}

.activity-icon{
    width:42px;
    height:42px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

.activity-content h5{
    font-size:14px;
    color:#111827;
    margin-bottom:3px;
}

.activity-content p{
    font-size:12px;
    color:#9CA3AF;
}

/* BOTTOM */
.bottom-grid{
    display:grid;
    grid-template-columns:1.2fr 1fr 1fr;
    gap:18px;
}

.pie-chart{
    width:130px;
    height:130px;
    border-radius:50%;
    background:
    conic-gradient(
        #EF4444 0% 25%,
        #F59E0B 25% 50%,
        #22C55E 50% 80%,
        #3B82F6 80% 100%
    );
    margin:auto;
}

.legend{
    margin-top:15px;
}

.legend div{
    display:flex;
    align-items:center;
    gap:8px;
    margin-bottom:8px;
    font-size:13px;
}

.legend span{
    width:12px;
    height:12px;
    border-radius:3px;
    display:inline-block;
}

.big-number{
    font-size:48px;
    font-weight:700;
    color:#111827;
}

.green-badge{
    display:inline-block;
    background:#DCFCE7;
    color:#16A34A;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    margin-top:10px;
}

.system-status{
    margin-top:10px;
}

.system-status div{
    display:flex;
    justify-content:space-between;
    margin-bottom:14px;
    font-size:13px;
}

.online{
    color:#22C55E;
    font-weight:700;
}

/* RESPONSIVE */
@media(max-width:1200px){

    .stats-row{
        grid-template-columns:repeat(2,1fr);
    }

    .grid-layout{
        grid-template-columns:1fr;
    }

    .bottom-grid{
        grid-template-columns:1fr;
    }
}

@media(max-width:768px){

    .dashboard{
        flex-direction:column;
    }

    .sidebar{
        width:100%;
    }

    .stats-row{
        grid-template-columns:1fr;
    }
}
</style>

<div class="dashboard">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar-admin')

    {{-- MAIN --}}
    <div class="main">

        {{-- HEADER --}}
        @include('layouts.navbar', ['title' => 'Selamat datang, Admin'])

        {{-- STATS --}}
        <div class="stats-row">

            <div class="stat-card">
                <div class="stat-icon bg-blue">👥</div>

                <div class="stat-content">
                    <h4>User Online</h4>
                    <h2>{{ $stats['total'] }}</h2>
                    <p>Total akun yang sedang login</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon bg-green">🩺</div>

                <div class="stat-content">
                    <h4>Dokter Aktif</h4>
                    <h2>{{ $stats['dokter'] }}</h2>
                    <p>Login saat ini</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon bg-orange">🧑‍⚕️</div>

                <div class="stat-content">
                    <h4>Perawat Aktif</h4>
                    <h2>{{ $stats['perawat'] }}</h2>
                    <p>Login saat ini</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon bg-purple">📁</div>

                <div class="stat-content">
                    <h4>PMIK Aktif</h4>
                    <h2>{{ $stats['pmik'] }}</h2>
                    <p>Login saat ini</p>
                </div>
            </div>

        </div>

        {{-- MIDDLE --}}
        <div class="grid-layout" style="grid-template-columns: 1.5fr 1fr;">

            {{-- AKTIVITAS --}}
            <div class="card">

                <h3>Riwayat Login (Real-time)</h3>

                @forelse($activities ?? [] as $act)
                <div class="activity-item">
                    <div class="activity-time">{{ $act->time->format('H:i') }}</div>

                    <div class="activity-icon {{ $act->color }}">
                        {{ $act->icon }}
                    </div>

                    <div class="activity-content">
                        <h5>{{ $act->title }}</h5>
                        <p>{{ $act->desc }}</p>
                    </div>
                </div>
                @empty
                <div class="activity-item">
                    <p style="color: #9CA3AF; font-size: 13px;">Belum ada aktivitas terekam.</p>
                </div>
                @endforelse

            </div>

            {{-- STATUS --}}
            <div class="card">

                <h3>Status Sistem</h3>

                <div class="system-status">

                    <div>
                        <span>Database</span>
                        <span class="online">● Online</span>
                    </div>

                    <div>
                        <span>Server Laravel</span>
                        <span class="online">● Online</span>
                    </div>

                    <div>
                        <span>Keamanan CSRF</span>
                        <span class="online">● Aktif</span>
                    </div>

                    <div>
                        <span>Versi Aplikasi</span>
                        <span style="color:#64748b; font-weight:600;">v1.0.0</span>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
</x-app-layout>