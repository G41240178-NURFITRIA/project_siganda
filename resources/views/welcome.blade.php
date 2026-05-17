<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGANDA - Sistem Informasi Gawat Darurat</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Pengaturan Dasar Supaya 1 Halaman Penuh */
        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            overflow: hidden; /* Tidak bisa scroll */
        }

        /* Background Transparan IGD */
        .page-wrapper {
            height: 100%;
            position: relative;
            background-image: url('{{ asset("image/igd1.jpg") }}');
            background-size: cover;
            background-position: center;
        }

        .page-wrapper::before {
            content: '';
            position: absolute;
            inset: 0;
            background-color: rgba(255, 255, 255, 0.92); /* Putih transparan */
            z-index: 0;
        }

        .main-content {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Styling Navbar */
        .navbar {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            padding-top: 0.2rem !important;
            padding-bottom: 0.2rem !important;
        }

        .hero-section {
            flex-grow: 1; /* Mengisi sisa ruang kosong di tengah */
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .feature-card:hover {
            background: #ffffff;
            border-color: #cbd5e1;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .hero-image {
            border: 4px solid #ffffff;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            height: 320px; /* Diperbesar sedikit tingginya */
            object-fit: cover;
        }
    </style>
</head>
<body>

    <div class="page-wrapper">
        <div class="main-content">

            <!-- NAVBAR -->
            <nav class="navbar navbar-light bg-white">
                <div class="container d-flex justify-content-between">
                    <a class="navbar-brand d-flex align-items-center gap-3" href="#">
                        <img src="{{ asset('image/Logo siganda.png') }}" alt="Logo" width="80" height="80">
                        <div>
                            <h4 class="mb-0 fw-extrabold text-dark" style="font-size: 24px; line-height: 1.1;">SIGANDA</h4>
                            <small class="text-muted" style="font-size: 12px; letter-spacing: 0.2px;">Sistem Informasi Gawat Darurat</small>
                        </div>
                    </a>
                    
                    <!-- Tombol Kanan Atas -->
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary px-3" data-bs-toggle="modal" data-bs-target="#aboutModal">
                            Tentang Sistem
                        </button>
                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary px-3">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </div>
                </div>
            </nav>

            <!-- HERO & FEATURES -->
            <div class="hero-section d-flex align-items-center">
                <div class="container pt-4 pb-2">
                    
                    <!-- DIUBAH: Proporsi kolom diubah jadi 5 (kiri) dan 7 (kanan) -->
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-5 mb-4 mb-lg-0">
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold mb-3" style="font-size: 12px;">
                                <i class="bi bi-shield-check me-1"></i> Terintegrasi & Aman
                            </span>
                            <h1 class="fw-bold text-dark mb-3" style="font-size: 2.5rem; line-height: 1.2;">
                                Kelola Pelayanan<br>
                                <span class="text-primary">Gawat Darurat</span>
                            </h1>
                            <p class="text-secondary pe-lg-3" style="font-size: 15px; line-height: 1.7;">
                                SIGANDA membantu rumah sakit mengelola pelayanan pasien IGD 
                                secara cepat, akurat, dan terintegrasi. Dari triage hingga 
                                rekam medis, semuanya dalam satu sistem.
                            </p>
                        </div>

                        <!-- DIUBAH: Gambar diposisikan di kanan dengan kolom lebih lebar -->
                        <div class="col-lg-7 d-flex justify-content-end">
                            <img src="{{ asset('image/igd1.jpg') }}" alt="Unit Gawat Darurat" class="hero-image img-fluid rounded-4">
                        </div>
                    </div>

                    <!-- 4 Fitur Utama -->
                    <div class="row g-3">
                        <div class="col-xl-3 col-md-6 col-6">
                            <div class="feature-card p-3 rounded-3 text-center h-100">
                                <i class="bi bi-speedometer2 fs-4 text-primary"></i>
                                <h6 class="mt-2 mb-1 fw-bold" style="font-size: 13px;">Dashboard</h6>
                                <small class="text-muted" style="font-size: 11px;">Statistik & data real-time</small>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-6">
                            <div class="feature-card p-3 rounded-3 text-center h-100">
                                <i class="bi bi-heart-pulse fs-4 text-primary"></i>
                                <h6 class="mt-2 mb-1 fw-bold" style="font-size: 13px;">Triage</h6>
                                <small class="text-muted" style="font-size: 11px;">Prioritas kegawatan</small>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-6">
                            <div class="feature-card p-3 rounded-3 text-center h-100">
                                <i class="bi bi-file-earmark-medical-fill fs-4 text-primary"></i>
                                <h6 class="mt-2 mb-1 fw-bold" style="font-size: 13px;">Rekam Medis</h6>
                                <small class="text-muted" style="font-size: 11px;">Riwayat tersimpan aman</small>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-6">
                            <div class="feature-card p-3 rounded-3 text-center h-100">
                                <i class="bi bi-display fs-4 text-primary"></i>
                                <h6 class="mt-2 mb-1 fw-bold" style="font-size: 13px;">Monitoring</h6>
                                <small class="text-muted" style="font-size: 11px;">Pantau kondisi pasien</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-header border-bottom py-3">
                    <h5 class="modal-title fw-bold" style="font-size: 18px;">Tentang SIGANDA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-3">
                    <p style="font-size: 14px; line-height: 1.7;">
                        SIGANDA merupakan Sistem Informasi Gawat Darurat yang dirancang
                        untuk membantu rumah sakit dalam mengelola pelayanan pasien IGD
                        secara cepat, aman, dan terintegrasi.
                    </p>
                    <p style="font-size: 14px; line-height: 1.7;">
                        Sistem ini mendukung proses triage pasien, registrasi,
                        rekam medis digital, monitoring pelayanan, serta pengelolaan
                        data pasien secara real-time.
                    </p>
                </div>
                <div class="modal-footer border-top py-2">
                    <button type="button" class="btn btn-sm btn-light border" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>