<!-- SIDEBAR -->
<div class="sidebar">

    <!-- LOGO -->
    <div class="logo">

        <img src="{{ asset('image/Logo siganda.png') }}"
             onerror="this.style.display='none'">

        <h3 class="logo-text">SIGANDA</h3>

    </div>

    <!-- PROFILE CARD (PMIK VERSION) -->
    <div class="profile-card">

        <div class="profile-top">

            <div class="profile-avatar">
                👩🏻
            </div>

            <div class="profile-info">
                <h4>{{ Auth::user()->name ?? 'PMIK User' }}</h4>
                <p>Petugas Rekam Medis</p>
            </div>

        </div>

        <div class="profile-status">
            <span class="status-dot"></span>
            <span>PMIK Active</span>
        </div>

    </div>

    <!-- MENU UTAMA -->
    <div class="menu-label">Menu Utama</div>

    <div class="menu">

        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">🏠 Dashboard</a>

        <div class="menu-dropdown {{ request()->routeIs('rekam.medis.*') || request()->routeIs('pmik.pelaporan') ? 'open' : '' }}">
            <a href="{{ route('rekam.medis.index') }}" class="{{ request()->routeIs('rekam.medis.index') ? 'active' : '' }}">📋 Rekam Medis</a>
            <div class="submenu">
                <a href="{{ route('pmik.pelaporan') }}" class="{{ request()->routeIs('pmik.pelaporan') ? 'active' : '' }}">📊 Pelaporan</a>
            </div>
        </div>

        <a href="{{ route('monitoring') }}" class="{{ request()->routeIs('monitoring') ? 'active' : '' }}">📡 Monitoring</a>

    </div>

    <!-- AKUN -->
    <div class="menu-label">Akun</div>

    <div class="menu">

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                🚪 Logout
            </button>
        </form>

    </div>

</div>

<style>

/* ================= SIDEBAR ================= */

.sidebar{
    width:260px;
    height:100vh;

    padding:10px 14px;

    display:flex;
    flex-direction:column;

    background:linear-gradient(
        180deg,
        #a8c7ff 0%,
        #cfe3ff 40%,
        #e6f1ff 75%,
        #f5f9ff 100%
    );

    position:fixed;
    top:0;
    left:0;

    overflow-y:auto;
}

/* ================= LOGO ================= */

.logo{
    display:flex;
    align-items:center;
    gap:3px;
    margin-bottom:6px;
}

.logo img{
    width:115px;
    height:115px;
    object-fit:contain;
}

/* ================= SIGANDA ================= */

.logo-text{
    margin:0 !important;
    font-size:38px;
    font-weight:900;
    color:#1e3a8a;
    line-height:1;
}

/* ================= PROFILE CARD ================= */

.profile-card{
    background:rgba(255,255,255,0.75);
    backdrop-filter:blur(14px);

    border-radius:18px;
    padding:12px;

    margin-bottom:10px;
}

.profile-top{
    display:flex;
    align-items:center;
    gap:10px;
}

.profile-avatar{
    width:42px;
    height:42px;
    border-radius:50%;
    background:white;

    display:flex;
    justify-content:center;
    align-items:center;
    font-size:18px;
}

.profile-info h4{
    font-size:13px;
    font-weight:700;
    color:#1e3a8a;
}

.profile-info p{
    font-size:11px;
    color:#64748b;
}

/* STATUS */

.profile-status{
    margin-top:10px;
    display:flex;
    align-items:center;
    gap:6px;

    background:#ffffff90;
    width:fit-content;

    padding:5px 10px;
    border-radius:10px;

    font-size:11px;
    font-weight:600;
    color:#16a34a;
}

.status-dot{
    width:7px;
    height:7px;
    border-radius:50%;
    background:#22c55e;
}

/* ================= MENU ================= */

.menu-label{
    font-size:12px;
    font-weight:800;
    color:#1f2937;
    text-transform:uppercase;

    margin:10px 6px 6px;
}

.menu a{
    text-decoration:none;
    color:#0f172a;

    font-size:14px;
    font-weight:600;

    padding:11px 13px;

    border-radius:13px;

    display:flex;
    align-items:center;
    gap:10px;
}

.menu a:hover{
    background:rgba(255,255,255,0.6);
}

.menu a.active{
    background:white;
    color:#2563eb;
}

/* ================= SUBMENU ================= */
.submenu {
    display: none;
    flex-direction: column;
    margin-left: 25px;
    margin-top: 4px;
    margin-bottom: 4px;
    border-left: 2px solid rgba(0,0,0,0.1);
    padding-left: 8px;
    gap: 4px;
}
.menu-dropdown.open .submenu {
    display: flex;
}
.submenu a {
    font-size: 13px;
    padding: 8px 12px;
}

/* ================= LOGOUT ================= */

.logout-btn{
    width:100%;
    background:none;
    border:none;

    cursor:pointer;
    text-align:left;

    padding:11px 13px;

    border-radius:13px;

    font-size:14px;
    font-weight:600;

    display:flex;
    align-items:center;
    gap:10px;
}

.logout-btn:hover{
    background:#fee2e2;
    color:#dc2626;
}

</style>@include('layouts.global_fixes')
