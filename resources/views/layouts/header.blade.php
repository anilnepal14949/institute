<header data-appear-animation="fadeIn" data-appear-delay="400">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4" data-appear-animation="bounceInDown" data-appear-delay="600">
                <span class="glyphicon glyphicon-circle-arrow-left pro_navigation_arrow showToolTip" id="pro_left_history" title="Go Back" data-placement="right"></span> &nbsp;&nbsp;
                <span class="glyphicon glyphicon-circle-arrow-right pro_navigation_arrow showToolTip" id="pro_right_history" title="Go Forward" data-placement="right"></span>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4" data-appear-animation="bounceInDown" data-appear-delay="600">
                <a href="{{url('auth/logout')}}" title="Log Out" class="showToolTip" data-placement="right"><span class="glyphicon glyphicon-off"></span> </a>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4" data-appear-animation="bounceInDown" data-appear-delay="600">
                <span class="user_info">
                    <img src="{{asset('public/images/user.jpg')}}" alt="{{Auth::user()->username}}" title="{{Auth::user()->username}}" class="user_icon" /> Hello, {{Auth::user()->username}}
                </span>
                <span class="glyphicon glyphicon-camera"></span> &nbsp;&nbsp;&nbsp;
                <span class="glyphicon glyphicon-fullscreen"></span>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid pro_tabs_container" data-appear-animation="fadeInUp" data-appear-delay="800">
    <div class="row">
        <div class="col-md-12 pro_tabs">
            <ul class="nav nav-tabs pro_tab_item">
                <li role="presentation"><a href="{{route('dashboard')}}" title="Dashboard"><span class="glyphicon glyphicon-blackboard faa-tada animated-hover"></span> &nbsp; Dashboard</a></li>
                <li role="presentation"><a href="{{route('enroll')}}" title="Enroll"><span class="glyphicon glyphicon-certificate faa-flash animated-hover"></span> &nbsp; Enroll</a></li>
                <li role="presentation"><a href="{{route('inquiry')}}" title="Inquiry"><span class="glyphicon glyphicon-eye-open faa-shake animated-hover"></span> &nbsp; Inquiry</a></li>
                <li role="presentation"><a href="{{route('report')}}" title="Reports"><span class="glyphicon glyphicon-stats faa-pulse animated-hover"></span> &nbsp; Reports</a></li>
                <li role="presentation"><a href="{{route('setting')}}" title="Setting"><span class="glyphicon glyphicon-wrench faa-wrench animated-hover"></span> &nbsp; Setting</a></li>
            </ul>
        </div>
    </div>
</div>