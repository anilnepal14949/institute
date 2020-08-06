@extends('report')

@section('reportHeader')

@stop

@section('reportContent')
    <div class="pro_main_div pro_main_div_2">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('report')}}" title="Setting"><span class="glyphicon glyphicon-stats"></span> Report</a></li>
            <li><span class="glyphicon glyphicon-briefcase"></span> Teacher</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Teacher
                        </h3>
                    </div>
                    <div class="panel-body">
                        <input type="text" class="form-control input-lg" name="search_teachers" id="search_teachers" placeholder="Search Teachers..." />
                        <div class="pro_result_table" id="search_result"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-lg-5 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1800">

            </div>
        </div>
    </div>
@stop

@section('reportFooter')
    <script type="text/javascript">
        var $timer2;
        $('document').ready(function(){
            var $search = $('#search_teachers');
            $search.keyup(function() {
                var $val = $(this).val();
                $timer2 = setTimeout(function(){
                    searchUsers($val)
                },500);
            });

            $search.focus(function(){
                var $val = $(this).val();
                $timer2 = setTimeout(function(){
                    searchUsers($val)
                },100);
            });

            $search.keydown(function() {
                clearTimeout($timer2);
            });
            searchUsers('');
        });
        function searchUsers($val){
            var $url = $('#homePath').val()+'/ajax-request/report/users';
            searchData($url, $val, 2);
        }
    </script>
@stop