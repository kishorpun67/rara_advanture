  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admin.dashboard')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
     
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" >
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{Auth::guard('admin')->user()->unReadnotifications->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 1000px">
          <span class="dropdown-item dropdown-header">{{Auth::guard('admin')->user()->unReadnotifications->count()}} Notifications</span>
          @foreach(Auth::guard('admin')->user()->unReadnotifications as $notification)
            @if (!empty($notification->data['order']))
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              {{$notification->data['order']['title']}} {{$notification->data['order']['name']}}
              <span class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
            </a>
            @endif
            @if (!empty($notification->data['alert']))
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              {{$notification->data['alert']['title']}} {{$notification->data['alert']['table']}} {{$notification->data['alert']['floor']}} {{$notification->data['alert']['floor_no']}}
              <span class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
            </a>
            @endif
            
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{route('admin.read.all.notification')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link"  href="{{route('admin.logout')}}">
          <i class="fa fa-sign-out" ></i>logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
