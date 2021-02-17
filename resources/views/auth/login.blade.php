<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from colorlib.com/polygon/admindek/default/auth-sign-in-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:30 GMT -->
   <!-- Added by HTTrack -->
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <!-- /Added by HTTrack -->
   <head>
      <title>Login</title>
      <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
      <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
      <meta name="author" content="colorlib" />
      <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/waves.min.css" type="text/css" media="all">
      <link rel="stylesheet" type="text/css" href="css/feather.css">
      <link rel="stylesheet" type="text/css" href="css/themify-icons.css">
      <link rel="stylesheet" type="text/css" href="css/icofont.css">
      <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/pages.css">
   </head>
   <body themebg-pattern="theme1">
      <section class="login-block">
         <div class="container-fluid">
            <div class="row">
            
               <div class="col-sm-12">
               
                  <form method="POST" class="md-float-material form-material" action="{{ route('login') }}">
                        @csrf
                     <div class="text-center">
                        <img src="png/logo.png" alt="logo.png">
                     </div>
                        
                     <div class="auth-box card">
                        <div class="card-block">
                           <div class="row m-b-20">
                              <div class="col-md-12">
                                 <h3 class="text-center txt-primary">Sign In</h3>
                              </div>
                           </div>
                           @if(count($errors) > 0 )
                           <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                              <ul class="p-0 m-0" style="list-style: none;">
                                 @foreach($errors->all() as $error)
                                 <li>{{$error}}</li>
                                 @endforeach
                              </ul>
                           </div>
                           @endif
                           <div class="form-group form-primary">
                               <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              <span class="form-bar"></span>
                              <label class="float-label">Username</label>
                           </div>
                           <div class="form-group form-primary">
                           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                              <span class="form-bar"></span>
                              <label class="float-label">Password</label>
                              @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           </div>
                           <div class="row m-t-25 text-left">
                              <div class="col-12">
                                 <div class="checkbox-fade fade-in-primary">
                                    <label>
                                    <input type="checkbox" name="remember" id="remember" value="" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    <span class="text-inverse" for="remember">Remember me</span>
                                    </label>
                                 </div>
                                 <div class="forgot-phone text-right float-right">
                                    <a href="{{route('password.request')}}" class="text-right f-w-600"> Forgot Password?</a>
                                 </div>
                              </div>
                           </div>
                           <div class="row m-t-30">
                              <div class="col-md-12">
                                 <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                              </div>
                           </div>
                           <!-- <p class="text-inverse text-left">Don't have an account?<a href="{{ route('register') }}"> <b>Register here </b></a></p> -->
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         </div>
      </section>
      <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="js/jquery.min.js"></script>
      <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="js/jquery-ui.min.js"></script>
      <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="js/popper.min.js"></script>
      <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="js/bootstrap.min.js"></script>
      <script src="js/waves.min.js" type="4878d7dfa7bc22a8dfa99416-text/javascript"></script>
      <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="js/jquery.slimscroll.js"></script>
      <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="js/modernizr.js"></script>
      <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="js/css-scrollbars.js"></script>
      <script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="js/common-pages.js"></script>
      <script src="js/rocket-loader.min.js" data-cf-settings="4878d7dfa7bc22a8dfa99416-|49" defer=""></script>
   </body>
   <!-- Mirrored from colorlib.com/polygon/admindek/default/auth-sign-in-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:30 GMT -->
</html>