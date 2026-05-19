<x-guest-layout>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', Tahoma, sans-serif;
}

body{
    background:linear-gradient(135deg,#EAF3FF,#5DAEF5);
}

/* WRAPPER (CENTER FIX) */
.wrapper{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center; /* FIX TENGAH */
    padding:20px;
}

/* CARD */
.main-card{
    width:100%;
    max-width:1000px;
    background:#DCE9F9;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
    padding:25px 40px;
}

/* HEADER */
.header{
    text-align:center;
    margin-bottom:18px;
}

.header h2{
    color:#0A3D91;
    font-size:22px;
    font-weight:700;
}

.header p{
    font-size:14px;
    color:#555;
}

/* CONTENT */
.content{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
}

/* LEFT */
.left{
    width:50%;
    position:relative;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* LOGO */
.main-icon{
    width:280px;
    max-width:100%;
    z-index:2;
}

/* ICON CIRCLE (DITURUNIN DIKIT) */
.icon-circle{
    position:absolute;
    width:260px;
    height:260px;
    top:0px; /* 🔥 INI YANG NURUNIN */
}

.small-icon{
    position:absolute;
    width:50px;
    height:50px;
    background:#fff;
    border-radius:12px;
    display:flex;
    justify-content:center;
    align-items:center;
    box-shadow:0 6px 15px rgba(0,0,0,0.15);
}

.small-icon img{
    width:26px;
    height:26px;
}

/* POSISI ICON */
.icon1{ top:0; left:50%; transform:translate(-50%,-50%); }
.icon2{ top:15%; right:0; transform:translate(50%,-50%); }
.icon3{ top:50%; right:0; transform:translate(50%,-50%); }
.icon4{ bottom:15%; right:0; transform:translate(50%,50%); }
.icon5{ bottom:0; left:50%; transform:translate(-50%,50%); }
.icon6{ bottom:15%; left:0; transform:translate(-50%,50%); }
.icon7{ top:50%; left:0; transform:translate(-50%,-50%); }
.icon8{ top:15%; left:0; transform:translate(-50%,-50%); }

/* RIGHT */
.right{
    width:45%;
}

.form-box{
    background:#F2F2F2;
    border-radius:18px;
    padding:18px;
    box-shadow:0 6px 15px rgba(0,0,0,0.12);
}

.form-title{
    text-align:center;
    font-size:17px;
    font-weight:700;
    margin-bottom:12px;
}

label{
    font-size:12px;
    margin-bottom:4px;
    display:block;
}

.form-control{
    width:100%;
    height:34px;
    border:none;
    border-radius:10px;
    background:#EAEAEA;
    padding:0 10px;
    margin-bottom:10px;
}

/* PASSWORD WRAPPER */
.password-wrapper {
    position: relative;
    width: 100%;
    margin-bottom: 10px;
}

.password-wrapper .form-control {
    margin-bottom: 0;
    padding-right: 35px; /* space for icon */
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #888;
}

/* EXTRA */
.extra{
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:12px;
    margin-bottom:12px;
}

.extra label{
    display:flex;
    align-items:center;
    gap:5px;
}

.extra a{
    text-decoration:none;
    color:#0A3D91;
    font-weight:600;
}

/* BUTTON */
.btn-login{
    width:100%;
    height:36px;
    border:none;
    border-radius:10px;
    background:#5DAEF5;
    color:#fff;
    font-weight:600;
    cursor:pointer;
}

.btn-login:hover{
    background:#0A3D91;
}

/* RESPONSIVE */
@media(max-width:900px){
    .content{
        flex-direction:column;
    }

    .left, .right{
        width:100%;
    }

    .main-icon{
        width:220px;
    }

    .icon-circle{
        width:220px;
        height:220px;
        top:10px;
    }
}
</style>


<div class="wrapper">
    <div class="main-card">

        <div class="header">
            <h2>RUMAH SAKIT CIPTA SEHAT</h2>
            <p>Login</p>
        </div>

        <div class="content">

            <!-- LEFT -->
            <div class="left">
                <img class="main-icon" src="{{ asset('image/Logo siganda.png') }}">

                <div class="icon-circle">
                    <div class="small-icon icon1"><img src="https://www.nicepng.com/png/detail/457-4579873_mobile-clinic-health-icons.png"></div>
                    <div class="small-icon icon2"><img src="https://www.freeiconspng.com/uploads/clinic-hospital-medical-icon--8.png"></div>
                    <div class="small-icon icon3"><img src="https://img2.clipart-library.com/28/transparent-medical-clipart/transparent-medical-clipart-25.png"></div>
                    <div class="small-icon icon4"><img src="https://static.vecteezy.com/system/resources/thumbnails/040/502/138/small_2x/3d-illustration-healthy-png.png"></div>
                    <div class="small-icon icon5"><img src="https://png.pngtree.com/png-vector/20240815/ourlarge/pngtree-patient-care-icon-png-image_13483620.png"></div>
                    <div class="small-icon icon6"><img src="https://static.vecteezy.com/system/resources/previews/012/173/858/original/medical-3d-render-icon-illustration-png.png"></div>
                    <div class="small-icon icon7"><img src="https://png.pngtree.com/png-clipart/20211024/original/pngtree-medical-injection-cartoon-vector-illustration-png-image_6869434.png"></div>
                    <div class="small-icon icon8"><img src="https://toppng.com/uploads/preview/coronavirus-covid-19-11582576817stitsadz7y.png"></div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="right">
                <div class="form-box">

                    <div class="form-title">Login SIGANDA</div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        @if($errors->any())
                            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 8px; font-size: 12px; margin-bottom: 15px;">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>

                        <label>Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <span class="toggle-password" onclick="togglePassword()">
                                <!-- Eye Icon SVG -->
                                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            </span>
                        </div>



                        <div class="extra">
                            <label>
                                <input type="checkbox" name="remember">
                                Remember Me
                            </label>


                        </div>

                        <button class="btn-login">LOGIN</button>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

<script>
function togglePassword() {
    var passwordField = document.getElementById("password");
    var eyeIcon = document.getElementById("eye-icon");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.innerHTML = '<path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/><path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>';
    } else {
        passwordField.type = "password";
        eyeIcon.innerHTML = '<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>';
    }
}
</script>

</x-guest-layout>