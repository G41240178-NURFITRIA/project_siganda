<style>
/* SIMPLE TOP NAVBAR */
.top-navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #ffffff;
    padding: 16px 24px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    margin-bottom: 24px;
}

.nav-title h1 {
    font-size: 22px;
    font-weight: 800;
    color: #1e293b;
    margin: 0;
}

.nav-time {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #f8fafc;
    padding: 10px 16px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
    color: #334155;
    border: 1px solid #e2e8f0;
}

@media(max-width: 768px) {
    .top-navbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
}
</style>

<div class="top-navbar">
    <div class="nav-title">
        <h1>{{ $title ?? 'Fitur' }}</h1>
    </div>

    <div class="nav-time">
        <span class="icon">📅</span>
        <span id="nav-tanggal">{{ \Carbon\Carbon::now()->translatedFormat('l, d M Y') }}</span>
        <span class="icon">🕒</span>
        <span id="nav-jam">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</span>
    </div>
</div>

<script>
    function updateNavbarTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const clock = document.getElementById('nav-jam');
        if (clock) {
            clock.textContent = hours + ':' + minutes + ' WIB';
        }
    }
    // Update every minute
    setInterval(updateNavbarTime, 1000);
</script>