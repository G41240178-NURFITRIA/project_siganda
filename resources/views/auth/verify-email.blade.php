<x-guest-layout>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, sans-serif;
}

body {
    background: linear-gradient(135deg, #EAF3FF, #5DAEF5);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.verify-wrapper {
    width: 100%;
    max-width: 480px;
    padding: 20px;
}

.verify-card {
    background: #fff;
    border-radius: 24px;
    padding: 45px 40px;
    box-shadow: 0 20px 60px rgba(0, 61, 145, 0.15);
    text-align: center;
    animation: fadeUp 0.5s ease;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

.email-icon {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, #EAF3FF, #5DAEF5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    font-size: 40px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%   { box-shadow: 0 0 0 0 rgba(93, 174, 245, 0.4); }
    70%  { box-shadow: 0 0 0 15px rgba(93, 174, 245, 0); }
    100% { box-shadow: 0 0 0 0 rgba(93, 174, 245, 0); }
}

.verify-card h1 {
    color: #0A3D91;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 12px;
}

.verify-card p {
    color: #666;
    font-size: 14px;
    line-height: 1.7;
    margin-bottom: 28px;
}

.verify-card p strong {
    color: #0A3D91;
}

.alert-success {
    background: #E8F5E9;
    border: 1px solid #A5D6A7;
    color: #2E7D32;
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 13px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    width: 100%;
    height: 44px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #5DAEF5, #0A3D91);
    color: #fff;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s;
    margin-bottom: 12px;
    letter-spacing: 0.5px;
}

.btn-primary:hover {
    opacity: 0.9;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(10, 61, 145, 0.3);
}

.divider {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 16px 0;
    color: #aaa;
    font-size: 12px;
}

.divider::before,
.divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #e0e0e0;
}

.btn-logout {
    width: 100%;
    height: 38px;
    border: 1.5px solid #dc3545;
    border-radius: 12px;
    background: transparent;
    color: #dc3545;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.btn-logout:hover {
    background: #dc3545;
    color: #fff;
}

.info-steps {
    background: #F0F7FF;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 24px;
    text-align: left;
}

.info-steps h4 {
    font-size: 12px;
    font-weight: 700;
    color: #0A3D91;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.step {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 8px;
}

.step:last-child { margin-bottom: 0; }

.step-num {
    width: 20px;
    height: 20px;
    min-width: 20px;
    background: #0A3D91;
    color: #fff;
    border-radius: 50%;
    font-size: 11px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1px;
}

.step-text {
    font-size: 12px;
    color: #555;
    line-height: 1.5;
}

.logo-top {
    text-align: center;
    margin-bottom: 20px;
}

.logo-top h3 {
    color: #0A3D91;
    font-size: 18px;
    font-weight: 800;
    letter-spacing: 1px;
}

.logo-top p {
    color: #5DAEF5;
    font-size: 11px;
}
</style>

<div class="verify-wrapper">
    <div class="logo-top">
        <h3>🏥 SIGANDA</h3>
        <p>Sistem Gawat Darurat</p>
    </div>

    <div class="verify-card">
        <div class="email-icon">📧</div>

        <h1>Verifikasi Email Anda</h1>
        <p>
            Terima kasih telah mendaftar! Kami telah mengirimkan link verifikasi ke
            <strong>{{ Auth::user()->email }}</strong>.
            Silakan cek inbox atau folder spam Anda.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert-success">
                ✅ Link verifikasi baru telah dikirim ke email Anda!
            </div>
        @endif

        <div class="info-steps">
            <h4>📋 Cara Verifikasi</h4>
            <div class="step">
                <div class="step-num">1</div>
                <div class="step-text">Buka aplikasi email Anda (Gmail, Outlook, dll)</div>
            </div>
            <div class="step">
                <div class="step-num">2</div>
                <div class="step-text">Cari email dari <strong>SIGANDA</strong> di inbox atau spam</div>
            </div>
            <div class="step">
                <div class="step-num">3</div>
                <div class="step-text">Klik tombol "Verify Email Address" di dalam email</div>
            </div>
            <div class="step">
                <div class="step-num">4</div>
                <div class="step-text">Anda akan otomatis diarahkan ke Dashboard</div>
            </div>
        </div>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary">
                📨 Kirim Ulang Email Verifikasi
            </button>
        </form>

        <div class="divider">atau</div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                🚪 Keluar / Ganti Akun
            </button>
        </form>
    </div>
</div>

</x-guest-layout>
