<nav class="navbar header-navbar pcoded-header">
               <div class="navbar-wrapper">
                  <div class="navbar-logo">
                     <a class="lg" href="index.html">
                        <img class="img-fluid logom" src="{{ asset('png/etc-pnglogo.png')}}" alt="Theme-Logo" style="
                           padding-bottom: 8px;" />
                        <h3 class="logom">ETC CARGO</h3>
                     </a>
                     <a class="mobile-menu" id="mobile-collapse" href="#!">
                     <i class="feather icon-menu icon-toggle-right"></i>
                     </a>
                     <a class="mobile-options waves-effect waves-light">
                     <i class="feather icon-more-horizontal"></i>
                     </a>
                  </div>
                  <div class="navbar-container container-fluid">
                     <ul class="nav-left">
                        <li>
                           <a href="#!" onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()" class="waves-effect waves-light" data-cf-modified-d2d1d6e2f87cbebdf4013b26-="">
                           <i class="full-screen feather icon-maximize"></i>
                           </a>
                        </li>
                        <li>
                           <h4 class="mxtxt">{{strlen(trim($header)) > 0 ? $header : 'Vehicle Management System (CFS Module)'}}</h4>
                        </li>
                     </ul>
                     <ul class="nav-right">
                           @php 
                              $notifications = App\Notifications::getNotification();
                             
                           @endphp
                        <li class="header-notification">
                           <div class="dropdown-primary dropdown">
                              <div class="dropdown-toggle" data-toggle="dropdown">
                                 <i class="feather icon-bell"></i>
                                 @if(count($notifications))
                                 <span class="badge bg-c-red">{{count($notifications)}}</span>
                                 @endif
                              </div>
                              <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" style="height: auto;max-height: 200px;overflow-x: hidden;">
                                 @if(count($notifications))
                                    <li>
                                       <h6>Notifications</h6>
                                       <label class="label label-danger">New</label>
                                    </li>
                                    @foreach($notifications as $notification)
                                       <li class="view_notification" data-notificationid="{{$notification->id}}" data-url="{{$notification->url}}">
                                          <div class="media">
                                             <div class="media-body">
                                                <p class="notification-msg">{{$notification->title}}</p>
                                                <span class="notification-time">{{$notification->time_elapsed_string($notification->created_at)}}</span>
                                             </div>
                                          </div>
                                       </li>
                                    @endforeach
                                 @else
                                    <li>
                                       <div class="media">
                                          <div class="media-body text-center">
                                             <p class="notification-msg">No New Notifications</p>
                                          </div>
                                       </div>
                                    </li>
                                 @endif
                              </ul>
                           </div>
                        </li>
                        <li class="user-profile header-notification">
                           <div class="dropdown-primary dropdown">
                              <div class="dropdown-toggle" data-toggle="dropdown">
                                 <img src="{{ asset('jpg/avathar-default.jpg')}}" class="img-radius" alt="User-Profile-Image">
                                 <span>{{auth()->user()->name}}</span>
                                 <i class="feather icon-chevron-down"></i>
                              </div>
                              <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                 <li>
                                    <a href="#!">
                                    <i class="feather icon-settings"></i> Settings
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#">
                                    <i class="feather icon-user"></i> Profile
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#">
                                    <i class="feather icon-bell"></i> My Notification
                                    </a>
                                 </li>
                                 <li>
                                    <a href="{{route('logout')}}">
                                    <i class="feather icon-log-out"></i> Logout
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>
              <!-- Modal For Common Delete Popup -->
  <div class="modal fade" id="commonDeleteModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header alert-info">
          <h4 class="modal-title"></h4>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p class="modal-body-text"></p>
        </div>

        <div class="modal-footer">
        <div class="btnDelete"></div>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
      
    </div>
  </div>
<!-- End Modal For Common Delete Popup -->