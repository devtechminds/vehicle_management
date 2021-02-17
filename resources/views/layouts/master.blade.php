<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Mirrored from colorlib.com/polygon/admindek/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:07:52 GMT -->
      <!-- Added by HTTrack -->
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <!-- /Added by HTTrack -->
      <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
      <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="colorlib" />
      <title>ETC Cargo | CFS Management System</title>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('css/waves.min.css')}}" type="text/css" media="all">
      <link rel="stylesheet" type="text/css" href="{{asset('css/feather.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome-n.min.css')}}">
      <link rel="stylesheet" href="{{asset('css/chartist.css')}}" type="text/css" media="all">
      <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('css/widget.css')}}">
      <style>
      .notification-view.show{
         
      }
      </style>
      @yield('css')
   </head>
   <body>
      <div class="loader-bg">
         <div class="loader-bar"></div>
      </div>
      <div id="pcoded" class="pcoded">
         <div class="pcoded-overlay-box"></div>
         <div class="pcoded-container navbar-wrapper">
            @include('layouts.header')
            <div class="pcoded-main-container">
               <div class="pcoded-wrapper">
                  @include('layouts.sidenav')
                  <div class="pcoded-content">
                     
                     <div class="pcoded-inner-content">
                        <div class="main-body">
                           <div class="page-wrapper">
                              <div class="page-body">
                                 @yield('content')
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="styleSelector"></div>
               </div>
            </div>
         </div>
      </div>
      <script data-cfasync="false" src="{{asset('js/email-decode.min.js')}}"></script><script type="d2d1d6e2f87cbebdf4013b26-text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
      <script type="d2d1d6e2f87cbebdf4013b26-text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
      <script type="d2d1d6e2f87cbebdf4013b26-text/javascript" src="{{asset('js/popper.min.js')}}"></script>
      <script type="d2d1d6e2f87cbebdf4013b26-text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
      <script src="{{asset('js/waves.min.js')}}" type="d2d1d6e2f87cbebdf4013b26-text/javascript"></script>
      <script type="d2d1d6e2f87cbebdf4013b26-text/javascript" src="{{asset('js/jquery.slimscroll.js')}}"></script>
      <script src="{{asset('js/jquery.flot.js')}}" type="d2d1d6e2f87cbebdf4013b26-text/javascript"></script>
      <script src="{{asset('js/jquery.flot.categories.js')}}" type="d2d1d6e2f87cbebdf4013b26-text/javascript"></script>
      <script src="{{asset('js/curvedlines.js')}}" type="d2d1d6e2f87cbebdf4013b26-text/javascript"></script>
      <script src="{{asset('js/jquery.flot.tooltip.min.js')}}" type="d2d1d6e2f87cbebdf4013b26-text/javascript"></script>
      <script src="{{asset('js/chartist.js')}}" type="d2d1d6e2f87cbebdf4013b26-text/javascript"></script>
      <script src="{{asset('js/amcharts.js')}}" type="d2d1d6e2f87cbebdf4013b26-text/javascript"></script>
      <script src="{{asset('js/serial.js')}}" type="d2d1d6e2f87cbebdf4013b26-text/javascript"></script>
      <script src="{{asset('js/light.js')}}" type="d2d1d6e2f87cbebdf4013b26-text/javascript"></script>
      <script src="{{asset('js/pcoded.min.js')}}" type="d2d1d6e2f87cbebdf4013b26-text/javascript"></script>
      <script src="{{asset('js/vertical-layout.min.js')}}" type="d2d1d6e2f87cbebdf4013b26-text/javascript"></script>
      <script type="d2d1d6e2f87cbebdf4013b26-text/javascript" src="{{asset('js/custom-dashboard.min.js')}}"></script>
      <script type="d2d1d6e2f87cbebdf4013b26-text/javascript" src="{{asset('js/script.min.js')}}"></script>
      <script src="{{asset('js/rocket-loader.min.js')}}" data-cf-settings="d2d1d6e2f87cbebdf4013b26-|49" defer=""></script>
      @yield('js')
   </body>
   <!-- Mirrored from colorlib.com/polygon/admindek/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:25 GMT -->
</html>
<script>
$(document).on( 'click', '.viewModal', function () { 
   var id =$(this).attr("data-id");
   var data_type =$(this).attr("data-type");
   var dataname =$(this).attr("data-name");
   var title =$(this).attr("data-title") + dataname;
   var msg =  $(this).attr("data-msg") + dataname +'?';
   var btn = '<a href="'+ $(this).attr("data-url") +'" class="btn btn-primary">'+data_type+'</a>';
   $(".modal-title").html(title);
   $(".modal-body-text").html(msg);
   $(".btnDelete").html(btn);
   $('#commonDeleteModal').modal('toggle');
});
$(document).on( 'click', '.view_notification', function () { 
   var notification_id = $(this).attr("data-notificationid");
   var url = $(this).attr("data-url");
   $.ajax({
        type:'POST',
        url:'/update-notification/',
        data:{notification_id:notification_id,"_token": "{{ csrf_token() }}"},
        success:function(data){
            window.location.href = url;
        }
    });
});
</script>