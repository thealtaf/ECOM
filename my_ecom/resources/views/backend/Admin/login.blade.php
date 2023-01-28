<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags-->
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Title Page-->
      <title>Login</title>
      <!--Adim CSS-->
      <link href="{{asset('admin_assets/css/font-face.css')}}" rel="stylesheet" media="all">
      <link href="{{asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
      <link href="{{asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
      <link href="{{asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
      <link href="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
      <link href="{{asset('admin_assets/css/theme.css')}}" rel="stylesheet" media="all">
   </head>
   <body class="animsition">
      <div class="page-wrapper">
         <div class="page-content--bge5">
            <div class="container">
               <div class="login-wrap">
                  <div class="login-content">
                     <div class="login-logo">
                        <!-- {{Config::get('constants.SIET_NAME')}} -->
                        <a href="#">
                        <img src="{{asset('admin_assets/images/icon/logo.png')}}" alt="CoolAdmin">
                        </a>
                     </div>
                     <div class="login-form">
                        <form action="{{route('admin.auth')}}" method="post">
                           @csrf
                           <div class="form-group">
                              <label>Email Address</label>
                              <input class="au-input au-input--full" type="email" name="email" placeholder="Email" required>
                           </div>
                           <div class="form-group">
                              <label>Password</label>
                              <input class="au-input au-input--full" type="password" name="password" id="myInput" placeholder="Password" required>
                              <input type="checkbox" onclick="myFunction()"> Show Password
                           </div>
                           <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                           @if(session()->has('error'))
                           <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                              {{session('error')}}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           @endif
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Jquery JS-->
      <script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>
      <script src="{{asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
      <script src="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
      <script src="{{asset('admin_assets/vendor/wow/wow.min.js')}}"></script>
      <script src="{{asset('admin_assets/js/main.js')}}"></script>
   </body>
   <script>
      function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
   </script>
</html>
<!-- end document-->