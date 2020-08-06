@extends('inquiry')

@section('inquiryHeader')

@stop

@section('inquiryContent')
    <div class="pro_main_div pro_main_div_3">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('inquiry')}}" title="Inquiry"><span class="glyphicon glyphicon-eye-open"></span> Inquiry</a></li>
            <li><span class="glyphicon glyphicon-folder-open"></span> Subject wise Inquiries</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Subject wise inquiries</h3>
                    </div>
                    <div class="panel-body">
                       <input type="text" name="search_inquiry" id="search_inquiry" class="form-control input-lg firstInput" placeholder="Search Inquiry..." />
                        <div id="search_result">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-5 col-lg-5 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1800">
                @include('inquiry.inquiry-subject._list')
            </div>
        </div>
    </div>
@stop

@section('inquiryFooter')
    <script type="text/javascript">
        var $timer1;
        $(document).ready(function(){
            var $search_inquiry = $('#search_inquiry');
            $search_inquiry.keyup(function() {
                searchInquiryBegin($(this).val());
            });

            $search_inquiry.keydown(function() {
                clearTimeout($timer1);
            });
            searchInquiryBegin('');
        });
        function searchInquiryBegin($val){
            var $url = $('#homePath').val()+'/ajax-request/inquiry/inquiry-subject';
            $timer1 = setTimeout(function(){
                searchData($url, $val, 1);
            },800);
        }

    </script>
@stop