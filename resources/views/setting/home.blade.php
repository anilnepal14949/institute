@extends('setting')

@section('settingContent')
    <div class="pro_main_div pro_main_div_1">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><span class="glyphicon glyphicon-wrench"></span> Setting</li>
        </ol>
        <div class="pro_main_body">
            <div class="row pro-tab-options">

                <a href="{{route('student.index')}}" title="Manage Student">
                    <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="1200">
                            <span class="glyphicon glyphicon-education faa-flash animated-hover showToolTip" data-placement="top" title="Manage Student"></span>
                            Student
                    </div>
                </a>

                <a href="{{route('teacher.index')}}" title="Manage Teacher">
                    <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="1400">
                            <span class="glyphicon glyphicon-briefcase faa-flash animated-hover showToolTip" data-placement="top" title="Manage Teacher"></span>
                            Teacher
                    </div>
                </a>

                <a href="{{route('course-type.index')}}" title="Manage Course Type">
                    <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="1600">
                            <span class="glyphicon glyphicon-check faa-flash animated-hover showToolTip" data-placement="top" title="Manage Course Type"></span>
                            Course Type
                    </div>
                </a>

                <a href="{{route('course-type-level.index')}}" title="Manage Course Level">
                    <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="1800">
                            <span class="glyphicon glyphicon-equalizer faa-flash animated-hover showToolTip" data-placement="top" title="Manage Course Level"></span>
                            Course Level
                    </div>
                </a>
            </div>

            <div class="clearfix"></div>
            <div class="row pro-tab-options">

                <a href="{{route('room.index')}}" title="Manage Room">
                    <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="2000">
                            <span class="glyphicon glyphicon-th faa-flash animated-hover showToolTip" data-placement="top" title="Manage Room"></span>
                            Room
                    </div>
                </a>

                <a href="{{route('subject.index')}}" title="Manage Subject">
                <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="2200">
                        <span class="glyphicon glyphicon-star faa-flash animated-hover showToolTip" data-placement="top" title="Manage Subject"></span>
                        Subject
                </div>
                </a>

                <a href="{{route('our-course.index')}}" title="Manage Our Courses">
                <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="2400">
                        <span class="glyphicon glyphicon-grain faa-flash animated-hover showToolTip" data-placement="top" title="Manage Our Courses"></span>
                        Our Courses
                </div>
                </a>
                <a href="{{route('referer.index')}}" title="Manage Referer">
                <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="2600">
                        <span class="glyphicon glyphicon-transfer faa-flash animated-hove showToolTip" data-placement="top" title="Manage Referer"></span>
                        Referer
                </div>
            </div>
            </a>

            <div class="clearfix"></div>
            <div class="row pro-tab-options">
                <a href="{{route('setting')}}" title="Manage Time">
                    <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="2800">
                            <span class="glyphicon glyphicon-time faa-flash animated-hover showToolTip" data-placement="top" title="Manage Time"></span>
                            Time
                    </div>
                </a>

                <a href="{{route('setting')}}" title="Manage">
                <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="3000">
                        <span class="glyphicon glyphicon-globe faa-flash animated-hover showToolTip" data-placement="top" title="Manage"></span>
                        Language
                </div>
                </a>

                <a href="{{route('setting')}}" title="Manage">
                <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="3200">
                        <span class="glyphicon glyphicon-eye-open faa-flash animated-hover showToolTip" data-placement="top" title="Manage"></span>
                        Meeting
                </div>
                </a>

                <a href="{{route('setting')}}" title="Manage Accounts">
                <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="3400">
                        <span class="glyphicon glyphicon-scale faa-flash animated-hover showToolTip" data-placement="top" title="Manage Accounts"></span>
                        Account
                </div>
                </a>
            </div>
            <div class="clearfix"></div>
            <div class="row pro-tab-options">
                <a href="{{route('setting')}}" title="Manage Others">
                <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="400">
                        <span class="glyphicon glyphicon-apple faa-flash animated-hover showToolTip" data-placement="top" title="Manage Others"></span>
                        Others
                </div>
                </a>
            </div>
        </div>
    </div>
@stop