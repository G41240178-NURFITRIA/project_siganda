<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>403 - Akses Ditolak | SIGANDA</title>
    <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
    body {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #EAF3FF, #5DAEF5);
    }
    .card {
        background: #fff;
        border-radius: 24px;
        padding: 50px 40px;
        text-align: center;
        max-width: 420px;
        box-shadow: 0 20px 60px rgba(0,61,145,0.15);
        animation: fadeUp 0.5s ease;
    }
    @keyframes fadeUp {
        from { opacity:0; transform:translateY(20px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .icon { font-size: 70px; margin-bottom: 20px; }
    h1 { color: #0A3D91; font-size: 28px; margin-bottom: 10px; }
    p { color: #666; font-size: 14px; line-height: 1.7; margin-bottom: 30px; }
    .btn {
        display: inline-block;
        padding: 12px 30px;
        border-radius: 12px;
        background: linear-gradient(135deg, #5DAEF5, #0A3D91);
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: 0.3s;
    }
    .btn:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(10,61,145,0.3); }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">🚫</div>
        <h1>Akses Ditolak</h1>
        <p>Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.<br>
        Silakan hubungi administrator jika Anda yakin ini adalah kesalahan.</p>
        <a href="{{ url('/dashboard') }}" class="btn">🏠 Kembali ke Dashboard</a>
    </div>
</body>
</html>
