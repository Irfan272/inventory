<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Siswa</title>

    <!-- Bootstrap -->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('assets/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
    

      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  {{-- @error('nama_ekskul')
  <ul class="parsley-errors-list filled">
      <li class="parsley-required">{{ $message }}</li>
  </ul>   
  @enderror 
</div> --}}
      <div class="login_wrapper">
        
        <div class="animate form login_form">
          <section class="login_content">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1MT641Rsmo35-95u5wLtg7XVrIvcQH_01EJATVxumWY-Y5quX45SBusZa8isxwAhB8xo" alt="">
            <h1>Login Siswa</h1>
            <form method="POST" action="{{ route('login') }}" novalidate>
              @csrf
                {{-- <img src="{{asset('assets/build/images/logo-removebg-preview.png')}}" alt=""> --}}
         
              <div>
                <input type="email" class="form-control" placeholder="Masukan Email" required="" id="email" name="email" autofocus />
              @error('email')
              <span class="text-danger">{{$message}}</span>
              @enderror
              
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="" />
                @if ($errors->has('password'))
                <span class="text-danger">{{$errors->first('password')}}</span>
            @endif
              </div>
              <div>
                <button type='submit' class="btn btn-primary">Login</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                  <a href="/loginGuru" class="to_register">Login Sebagai Guru</a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>©2023 Created By Sawiyan</div>
              </div>
            </form>
          </section>
        </div>

     
      </div>
    </div>
  </body>
</html>
