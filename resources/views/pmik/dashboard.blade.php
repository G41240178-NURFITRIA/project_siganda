<x-app-layout>

<style>
body{
    background:#EEF3F8;
}

/* LAYOUT */
.dashboard{
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */
.sidebar{
    width:240px;
    background:#F5F8FC;
    padding:20px;
    box-shadow:2px 0 10px rgba(0,0,0,0.05);
}

.logo{
    text-align:center;
    margin-bottom:25px;
}

.logo img{
    width:90px;
    margin-bottom:10px;
}

.logo h3{
    color:#0A3D91;
}

/* MENU */
.menu a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px;
    margin:10px 0;
    border-radius:10px;
    text-decoration:none;
    color:#333;
    font-weight:500;
    transition:0.2s;
}

.menu a:hover{
    background:#DCE9F9;
    transform:translateX(5px);
}

/* CONTENT */
.main{
    flex:1;
    padding:30px;
}

/* CARD */
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.card{
    background:#fff;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.stat h2{
    font-size:28px;
}

.merah{ color:red; }
.kuning{ color:orange; }
.hijau{ color:green; }

</style>

<div class="dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo">
            <img src="{{ asset('image/Logo siganda.png') }}">
            <h3>SIGANDA</h3>
        </div>

        <div class="menu">
            <a href="{{ route('dashboard') }}">🏠 Home</a>
            <a href="{{ route('triage') }}">🚑 Triage</a>
            <a href="{{ route('registrasi') }}">📝 Registrasi</a>
            <a href="{{ route('rekam.medis') }}">📋 Rekam Medis</a>
            <a href="{{ route('monitoring') }}">📡 Monitoring</a>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="main">

        <h2>Dashboard</h2>

        <br>

        <div class="grid">

            <div class="card stat">
                <p>Pasien Aktif</p>
                <h2>24</h2>
            </div>

            <div class="card stat">
                <p>🔴 Merah</p>
                <h2 class="merah">5</h2>
            </div>

            <div class="card stat">
                <p>🟡 Kuning</p>
                <h2 class="kuning">10</h2>
            </div>

            <div class="card stat">
                <p>🟢 Hijau</p>
                <h2 class="hijau">9</h2>
            </div>

        </div>

    </div>

</div>

</x-app-layout>