@extends('report')

@section('reportContent')
    <div class="pro_main_div pro_main_div_2">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><span class="glyphicon glyphicon-stats"></span> Report</li>
        </ol>
        <div class="pro_main_body">
            <div class="row pro-tab-options">

                <a href="{{route('report.receipt.index')}}" title="Show Daily Receipt Collection">
                    <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="1200">
                        <span class="glyphicon glyphicon-paperclip faa-flash animated-hover showToolTip" data-placement="top" title="Show Daily Receipt Collection"></span>
                            Daily Receipt Collection
                    </div>
                </a>

                <a href="{{route('report.our-course.index')}}" title="View Course Report">
                    <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="1400">
                            <span class="glyphicon glyphicon-grain faa-flash animated-hover showToolTip" data-placement="top" title="View Course Report"></span>
                            Our Course
                    </div>
                </a>

                <a href="{{route('report.teacher.index')}}" title="View Teacher Report">
                    <div class="col-md-3 col-lg-3" data-appear-animation="fadeIn" data-appear-delay="1400">
                        <span class="glyphicon glyphicon-briefcase faa-flash animated-hover showToolTip" data-placement="top" title="View Teacher Report"></span>
                        Teacher
                    </div>
                </a>

            </div>
        </div>
    </div>
@stop