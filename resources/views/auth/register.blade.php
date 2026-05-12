<x-guest-layout>

{{-- POPUP ERROR --}}
@if ($errors->any())
<script>
    alert(`{{ implode('\n', $errors->all()) }}`);
</script>
@endif

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

.wrapper{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
}

.main-card{
    width:100%;
    max-width:1000px;
    background:#DCE9F9;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
    padding:25px 40px;
}

.header{
    text-align:center;
    margin-bottom:15px;
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

.main-icon{
    width:320px;
    max-width:100%;
    z-index:2;
}

.icon-circle{
    position:absolute;
    width:300px;
    height:300px;
    top:0px;
}

.small-icon{
    position:absolute;
    width:55px;
    height:55px;
    background:#fff;
    border-radius:14px;
    display:flex;
    justify-content:center;
    align-items:center;
    box-shadow:0 6px 15px rgba(0,0,0,0.15);
}

.small-icon img{
    width:28px;
    height:28px;
    object-fit:contain;
}

/* POSISI */
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
    padding:20px;
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
    margin-bottom:8px;
}

select.form-control{
    appearance:none;
    background-image:url("data:image/svg+xml;utf8,<svg fill='%23333' height='20' viewBox='0 0 20 20' width='20'><path d='M5 7l5 5 5-5z'/></svg>");
    background-repeat:no-repeat;
    background-position:right 10px center;
}

.btn-login{
    width:100%;
    height:36px;
    border:none;
    border-radius:10px;
    background:#5DAEF5;
    color:#fff;
    font-weight:600;
    cursor:pointer;
    margin-top:6px;
}

.btn-login:hover{
    background:#0A3D91;
}
</style>

<div class="wrapper">
    <div class="main-card">

        <div class="header">
            <h2>RUMAH SAKIT CIPTA SEHAT</h2>
            <p>Register Gawat Darurat</p>
        </div>

        <div class="content">

            <!-- LEFT -->
            <div class="left">
                <img class="main-icon" src="{{ asset('image/Logo siganda.png') }}">

                <div class="icon-circle">
                    <div class="small-icon icon1">
                        <img src="https://www.nicepng.com/png/detail/457-4579873_mobile-clinic-health-icons.png">
                    </div>
                    <div class="small-icon icon2">
                        <img src="https://www.freeiconspng.com/uploads/clinic-hospital-medical-icon--8.png">
                    </div>
                    <div class="small-icon icon3">
                        <img src="https://img2.clipart-library.com/28/transparent-medical-clipart/transparent-medical-clipart-25.png">
                    </div>
                    <div class="small-icon icon4">
                        <img src="https://static.vecteezy.com/system/resources/thumbnails/040/502/138/small_2x/3d-illustration-healthy-png.png">
                    </div>
                    <div class="small-icon icon5">
                        <img src="https://png.pngtree.com/png-vector/20240815/ourlarge/pngtree-patient-care-icon-png-image_13483620.png">
                    </div>
                    <div class="small-icon icon6">
                        <img src="https://static.vecteezy.com/system/resources/previews/012/173/858/original/medical-3d-render-icon-illustration-png.png">
                    </div>
                    <div class="small-icon icon7">
                        <img src="https://png.pngtree.com/png-clipart/20211024/original/pngtree-medical-injection-cartoon-vector-illustration-png-image_6869434.png">
                    </div>
                    <div class="small-icon icon8">
                        <img src="https://toppng.com/uploads/preview/coronavirus-covid-19-11582576817stitsadz7y.png">
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="right">
                <div class="form-box">

                    <div class="form-title">Registrasi SIGANDA</div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>

                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>

                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>

                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>

                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="">Pilih Role</option>
                            <option value="dokter" {{ old('role')=='dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="perawat" {{ old('role')=='perawat' ? 'selected' : '' }}>Perawat</option>
                            <option value="pmik" {{ old('role')=='pmik' ? 'selected' : '' }}>PMIK</option>
                            <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                        </select>

                        <button type="submit" class="btn-login">REGISTER</button>
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

</x-guest-layout>