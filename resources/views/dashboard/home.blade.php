@extends('dashboard')

@section('dashboardContent')
    <div class="pro_main_div pro_main_div_5">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><span class="glyphicon glyphicon-blackboard"></span> Dashboard</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 dashboard_left">
                <div class="search_input col-md-12 col-lg-12">
                    <div class="row">
                        <input type="text" class="form-control input-lg firstInput" title="Type Name and Search Students" data-placement="bottom" name="search_student" id="search_student" placeholder="Search Student...">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel panel-default course_panel" data-appear-animation="fadeInLeft" data-appear-delay="1200">
                    <div class="panel-body">
                        <!-- Table -->
                        <table class="table">
                            <tr>
                                <th>
                                    Course
                                </th>
                                <th width="15%">
                                    Room
                                </th>
                                <th width="15%">
                                    Teacher
                                </th>
                                <th width="15%">
                                    Time
                                </th>
                                <th width="15%">
                                    Duration
                                </th>
                            </tr>
                            @if($ourCourses)
                                @foreach($ourCourses as $ourCourse1)
                                    <tr @if($ourCourse1->status_id == 2) class="warning" @elseif($ourCourse1->status_id == 3) class="success" @elseif($ourCourse1->status_id == 4) class="danger" @else  @endif>
                                        <td>
                                            {!!
                                                $ourCourse1->name
                                                .'<br /><small><label class="label label-info">'.$ourCourse1->subject->courseTypeLevel->name.'</label> <label class="label label-warning"> '.$ourCourse1->subject->name.'</label></small>'
                                            !!}
                                        </td>
                                        <td>
                                            {!! $ourCourse1->room->name.'('.$ourCourse1->room->number.')' !!}
                                        </td>
                                        <td>
                                            {!! $ourCourse1->teacher->userDetail->name !!}
                                        </td>
                                        <td>
                                            {!! date('g:ia',strtotime($ourCourse1->start_time)).' to <br />'.date('g:ia',strtotime($ourCourse1->end_time)) !!}
                                        </td>
                                        <td>
                                            {!! date('jS F Y',strtotime($ourCourse1->start_date)).' to <br />'.date('jS F Y',strtotime($ourCourse1->end_date)) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-info" role="alert">
                                            No any courses recorded!!
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </table>

                    </div>
                    <div class="panel-footer">
                        <a href="{{route('report.our-course.index')}}" title="Advance" class="btn btn-info" role="button">Advance <span class="glyphicon glyphicon-download faa-tada animated-hover"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-lg-5 dashboard_right">
                <div class="panel panel-default pro_drag_window" data-appear-animation="fadeInRight" data-appear-delay="1400">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Running Now!!</h3>
                    </div>
                    <div class="panel-body">
                        @if($upcomingCourses)

                            <table class="table">
                                <tr>
                                    <th>Room</th><th>Course Name</th><th>Time</th><th>By</th><th>No. of Stds.</th>
                                </tr>
                                <?php $i = 1; ?>
                                @foreach($upcomingCourses as $upcomingCourse)
                                    <tr>
                                        <td>{!! $upcomingCourse->room->name.' ('.$upcomingCourse->room->number.')' !!}</td>
                                        <td>{{$upcomingCourse->name}}</td>
                                        <td>{{date('g:ia',strtotime($upcomingCourse->start_time)).'-'.date('g:ia',strtotime($upcomingCourse->end_time))}}</td>
                                        <td>{{$upcomingCourse->teacher->userDetail->name}}</td>
                                        <td><span class="badge pro_badge">{{$upcomingCourse->studentEnroll->count()}}</span></td>
                                    </tr>
                                @endforeach
                            </table>

                        @else
                            <div class="alert alert-warning" role="alert">No any classes for today.</div>
                        @endif

                    </div>
                </div>

                <div class="panel panel-default pro_drag_window" data-appear-animation="fadeInRight" data-appear-delay="1600">
                    <div class="panel-body">
                        <div class="col-md-6 col-lg-6 pro_link_not_effect pro_room_info">

                        </div>

                        <div class="col-md-6 col-lg-6 pro_link_not_effect pro_total_info">
                            <a href="{{route('inquiry.subject.index')}}" title="See Enrolled Students">
                                <div class="pro_short_info pro_short_info_2">
                                    <h4>Total Inquiries <span class="badge pro_badge showToolTip" title="Today Inquiries">{{$inquiriesToday}}</span> <h1>{{$totalInquiries}}</h1> </h4>
                                </div>
                            </a>
                            <a href="{{route('enroll.student.index')}}" title="See Enrolled Students">
                                <div class="pro_short_info pro_short_info_1">
                                    <h4>Total Enrolled <span class="badge pro_badge showToolTip" title="Enrolled Today">{{$enrolledToday}}</span> <h1>{{$totalEnrolled}}</h1></h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('dashboardFooter')
    <script type="text/javascript">
        var $timer;
        $(document).ready(function(){
            var $search = $('#search_student');
            $search.keyup(function() {
                var $val = $(this).val();
                $timer = setTimeout(function(){
                            searchUsers($val,1)
                        },500);
            });

            $search.focus(function(){
                var $val = $(this).val();
                $timer = setTimeout(function(){
                    searchUsers($val,1)
                },100);
            });

            $search.click(function(){
                var $val = $(this).val();
                $timer = setTimeout(function(){
                    searchUsers($val,1)
                },100);
            });

            $search.keydown(function() {
                clearTimeout($timer);
            });

            $("body").click(function(){
                $('.pro_under_box').slideUp('slow');
            });

        });
        function searchUsers($val, $selector){
            var $this = $("#search_student");
            var $url = $('#homePath').val()+'/ajax-request/dashboard/users';
            $.ajax({
                url: $url,
                dataType: 'html',
                data: 'input='+$val+'&selector='+$selector,
                type: 'GET',
                cache: false,
                success: function(rval){
                    $this.after("<div class='pro_under_box'></div>");
                    var $underbox = $(".pro_under_box");
                    var left = $this.position().left;
                    var top = $this.position().top;
                    top += $this.outerHeight();
                    $underbox.hide();
                    $underbox.css("top",top);
                    $underbox.css("left",left);
                    $underbox.css("width",$this.outerWidth());
                    $underbox.html(rval);
                    $underbox.slideDown("slow");
                }
            });
        }
    </script>
@stop