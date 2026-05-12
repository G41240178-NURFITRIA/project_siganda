<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGANDA</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;500;500;600&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Inter',sans-serif;
            background:#f5f7fb;
            overflow:hidden;
            height:100vh;
            color:#111827;
        }

        /* ================= NAVBAR ================= */

        nav{
            width:100%;
            height:90px;
            background:white;
            padding:0 60px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            box-shadow:0 2px 10px rgba(0,0,0,0.03);
            position:relative;
            z-index:100;
        }

        .logo{
            display:flex;
            align-items:center;
            gap:18px;
        }

        .logo img{
            width:95px;
            height:95px;
            object-fit:contain;
        }

        .logo-text h1{
            font-size:34px;
            font-weight:800;
            color:#082567;
            line-height:1;
        }

        .logo-text p{
            font-size:15px;
            color:#4b5563;
            margin-top:5px;
            font-weight:600;
        }

        .login-btn{
            background:#2563eb;
            color:white;
            text-decoration:none;
            padding:13px 28px;
            border-radius:14px;
            font-size:15px;
            font-weight:600;
            box-shadow:0 10px 25px rgba(37,99,235,0.25);
            transition:0.3s;
        }

        .login-btn:hover{
            transform:translateY(-2px);
        }

        /* ================= HERO ================= */

        .hero{
            height:calc(100vh - 90px);
            position:relative;
            overflow:hidden;
            padding:10px 55px 0;
        }

        .hero-container{
            height:100%;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        /* ================= LEFT ================= */

        .left{
            width:44%;
            z-index:5;
            margin-top:-70px;
        }

        .left h1{
            font-size:62px;
            font-weight:800;
            color:#001B5E;
            line-height:1;
        }

        .left h2{
            margin-top:12px;
            font-size:32px;
            line-height:1.3;
            font-weight:800;
            color:#001B5E;
        }

        .left h2 span{
            color:#2563eb;
        }

        .left p{
            margin-top:20px;
            font-family:'Poppins',sans-serif;
            font-size:15px;
            line-height:2;
            color:#4b5563;
            max-width:470px;
            font-weight:500;
        }

        .buttons{
            margin-top:28px;
            display:flex;
            gap:15px;
        }

        .btn-primary{
            background:#2563eb;
            color:white;
            text-decoration:none;
            padding:15px 24px;
            border-radius:12px;
            font-size:15px;
            font-weight:700;
            box-shadow:0 12px 24px rgba(37,99,235,0.22);
        }

        .btn-secondary{
            background:white;
            border:2px solid #2563eb;
            color:#2563eb;
            text-decoration:none;
            padding:15px 24px;
            border-radius:12px;
            font-size:15px;
            font-weight:700;
            cursor:pointer;
        }

        /* ================= RIGHT ================= */

        .right{
            width:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            position:relative;
        }

        .circle{
            position:absolute;
            width:650px;
            height:650px;
            background:#e8f0ff;
            border-radius:50%;
            top:-40px;
            right:-80px;
            z-index:1;
        }

        .hero-image{
            width:100%;
            max-width:540px;
            height:360px;
            border-radius:45px;
            overflow:hidden;
            position:relative;
            z-index:5;
            margin-top:-30px;
        }

        .hero-image img{
            width:100%;
            height:100%;
            object-fit:cover;
            border-radius:45px;
        }

        /* ================= FEATURES ================= */

        .feature-wrapper{
            position:absolute;
            left:50%;
            transform:translateX(-50%);
            bottom:20px;
            width:90%;
            background:white;
            border-radius:22px;
            padding:16px 5px;
            display:grid;
            grid-template-columns:repeat(5,1fr);
            box-shadow:0 10px 30px rgba(0,0,0,0.05);
            z-index:20;
        }

        .feature{
            display:flex;
            gap:10px;
            padding:0 14px;
            border-right:1px solid #edf2f7;
        }

        .feature:last-child{
            border-right:none;
        }

        .icon{
            width:46px;
            height:46px;
            background:#eef4ff;
            border-radius:14px;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:20px;
            flex-shrink:0;
        }

        .feature h3{
            font-size:14px;
            margin-bottom:5px;
            color:#111827;
        }

        .feature p{
            font-size:10px;
            line-height:1.8;
            color:#6b7280;
            font-family:'Poppins',sans-serif;
        }

        /* ================= WAVE ================= */

        .wave{
            position:absolute;
            width:120%;
            height:170px;
            background:linear-gradient(90deg,#2563eb,#3b82f6);
            left:-10%;
            bottom:-145px;
            border-radius:50%;
            z-index:2;
        }

        /* ================= MODAL ================= */

        .modal{
            display:none;
            position:fixed;
            z-index:999;
            left:0;
            top:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.45);
            justify-content:center;
            align-items:center;
            padding:20px;
        }

        .modal-content{
            background:white;
            width:100%;
            max-width:560px;
            padding:35px;
            border-radius:24px;
            position:relative;
            animation:fadeIn 0.3s ease;
            box-shadow:0 20px 40px rgba(0,0,0,0.15);
        }

        .modal-content h2{
            font-size:28px;
            color:#0B2C6A;
            margin-bottom:20px;
            font-weight:800;
        }

        .modal-content p{
            font-size:15px;
            line-height:2;
            color:#4b5563;
            margin-bottom:15px;
            font-family:'Poppins',sans-serif;
        }

        .close{
            position:absolute;
            right:22px;
            top:16px;
            font-size:32px;
            cursor:pointer;
            color:#6b7280;
        }

        .close:hover{
            color:#111827;
        }

        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translateY(20px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:1200px){

            body{
                overflow:auto;
            }

            .hero{
                height:auto;
                padding-bottom:40px;
            }

            .hero-container{
                flex-direction:column;
                text-align:center;
            }

            .left,
            .right{
                width:100%;
            }

            .buttons{
                justify-content:center;
                flex-wrap:wrap;
            }

            .feature-wrapper{
                position:relative;
                width:100%;
                margin-top:25px;
                grid-template-columns:1fr;
                gap:18px;
                padding:24px;
            }

            .feature{
                border-right:none;
                border-bottom:1px solid #edf2f7;
                padding-bottom:18px;
            }

            .feature:last-child{
                border-bottom:none;
            }

            .wave{
                display:none;
            }

            .left{
                margin-top:20px;
            }

            .hero-image{
                height:320px;
                margin-top:20px;
            }

        }

    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav>

        <div class="logo">

            <img src="{{ asset('image/Logo siganda.png') }}" alt="logo">

            <div class="logo-text">
                <h1>SIGANDA</h1>
                <p>Sistem Informasi Gawat Darurat</p>
            </div>

        </div>

        <a href="{{ route('login') }}" class="login-btn">
            🔒 Login
        </a>

    </nav>

    <!-- HERO -->
    <section class="hero">

        <div class="hero-container">

            <!-- LEFT -->
            <div class="left">

                <h1>SIGANDA</h1>

                <h2>
                    Sistem Informasi <br>
                    <span>Gawat Darurat</span>
                </h2>

                <p>
                    Solusi digital modern untuk membantu pelayanan pasien
                    gawat darurat menjadi lebih cepat, aman,
                    efisien, dan terintegrasi dalam satu sistem.
                </p>

                <div class="buttons">

                    <a href="{{ route('login') }}" class="btn-primary">
                        🚀 Mulai Sekarang
                    </a>

                    <a href="javascript:void(0)" class="btn-secondary" onclick="openModal()">
                        ▶ Pelajari Lebih Lanjut
                    </a>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="right">

                <div class="circle"></div>

                <div class="hero-image">
                    <img src="{{ asset('image/igd.jpg') }}" alt="IGD">
                </div>

            </div>

        </div>

        <!-- FEATURES -->
        <div class="feature-wrapper">

            <div class="feature">

                <div class="icon">📊</div>

                <div>
                    <h3>Dashboard</h3>
                    <p>Ringkasan data pasien dan statistik IGD secara real-time.</p>
                </div>

            </div>

            <div class="feature">

                <div class="icon">📋</div>

                <div>
                    <h3>Triage</h3>
                    <p>Sistem prioritas pasien berdasarkan tingkat kegawatan.</p>
                </div>

            </div>

            <div class="feature">

                <div class="icon">👤</div>

                <div>
                    <h3>Registrasi</h3>
                    <p>Pendaftaran pasien baru dengan cepat dan terintegrasi.</p>
                </div>

            </div>

            <div class="feature">

                <div class="icon">📁</div>

                <div>
                    <h3>Rekam Medis</h3>
                    <p>Penyimpanan riwayat medis pasien secara aman.</p>
                </div>

            </div>

            <div class="feature">

                <div class="icon">💙</div>

                <div>
                    <h3>Monitoring</h3>
                    <p>Pantau kondisi pasien dan aktivitas IGD real-time.</p>
                </div>

            </div>

        </div>

        <!-- WAVE -->
        <div class="wave"></div>

    </section>

    <!-- MODAL -->
    <div class="modal" id="aboutModal">

        <div class="modal-content">

            <span class="close" onclick="closeModal()">&times;</span>

            <h2>Tentang SIGANDA</h2>

            <p>
                SIGANDA merupakan Sistem Informasi Gawat Darurat yang dirancang
                untuk membantu rumah sakit dalam mengelola pelayanan pasien IGD
                secara cepat, aman, dan terintegrasi.
            </p>

            <p>
                Sistem ini mendukung proses triage pasien, registrasi,
                rekam medis digital, monitoring pelayanan, serta pengelolaan
                data pasien secara real-time untuk meningkatkan kualitas
                pelayanan rumah sakit.
            </p>

            <p>
                Dengan SIGANDA, proses pelayanan menjadi lebih efisien,
                meminimalisir kesalahan pencatatan, serta membantu tenaga
                medis dalam memberikan pelayanan yang lebih optimal.
            </p>

        </div>

    </div>

    <script>

        function openModal(){
            document.getElementById("aboutModal").style.display = "flex";
        }

        function closeModal(){
            document.getElementById("aboutModal").style.display = "none";
        }

        window.onclick = function(event){

            const modal = document.getElementById("aboutModal");

            if(event.target == modal){
                modal.style.display = "none";
            }

        }

    </script>

</body>
</html>