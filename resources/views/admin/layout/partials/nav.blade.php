<div class="top_nav">
  <div class="nav_menu">
    
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      
      <nav class="nav navbar-nav">
        
      <ul class=" navbar-right">
      
        <li class="nav-item dropdown open" style="padding-left: 15px;">
          <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
            <h6 class="mb-0 text-gray-600">Welcome, {{auth()->user()->name}}</h6>
          </a>
          <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
          
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Log Out</button>
            </form>
          </div>
        </li>

        <li role="presentation" class="nav-item dropdown open">
          <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown"
            aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            {{-- <span class="badge bg-success">{{$countbarang}}</span> --}}
          </a>
          <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
       
            @if(session('notifications'))
            <ul class="navbar-notifications">
              @foreach(session('notifications') as $notification)
                <li class="navbar-notification">
                  {{ $notification }}
                </li>
              @endforeach
            </ul>
          @endif
          

            <li class="nav-item">
              <div class="text-center">
                <a class="dropdown-item">
                  <strong>See All Alerts</strong>
                  <i class="fa fa-angle-right"></i>
                </a>
              </div>
            </li>
          </ul>
        </li>
        
      </ul>
    </nav>
  </div>
</div>