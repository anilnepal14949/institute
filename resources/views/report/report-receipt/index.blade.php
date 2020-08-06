@extends('report')

@section('reportHeader')

@stop

@section('reportContent')
    <div class="pro_main_div pro_main_div_2">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('report')}}" title="Setting"><span class="glyphicon glyphicon-stats"></span> Report</a></li>
            <li><span class="glyphicon glyphicon-paperclip"></span> Daily Receipt Collection</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Daily Receipt Collection
                        </h3>
                    </div>
                    <div class="panel-body">
                        @if($receipts != '')
                        <table class="table">
                            <tr>
                                <th width="8%">S.N.</th>
                                <th>Student Name</th>
                                <th width="12%">Receipt No.</th>
                                <th width="10%">Bill No.</th>
                                <th width="12%">Paid Amount</th>
                                <th width="12%">Discount</th>
                                <th width="15%">Date</th>
                            </tr>
                            <?php $i = 1; ?>
                        @foreach($receipts as $receipt)
                            <tr>
                                <td>
                                    {{$i++}}.
                                </td>
                                <td>
                                    {{$receipt->student_name}}
                                </td>
                                <td>
                                    {{$receipt->receipt_id}}
                                </td>
                                <td>
                                    {{ \ProIMAN\StudentBill::whereId($receipt->bill_no)->first()->bill_no}}
                                </td>

                                <td>
                                    {{$receipt->paid_amount}}
                                </td>
                                <td>
                                    {{$receipt->discount_amount}}
                                </td>
                                <td>
                                    {{date('jS F Y',strtotime($receipt->created_at))}}
                                </td>
                            </tr>
                        @endforeach
                        </table>
                        @else
                            <div class="alert alert-warning" role="alert">No Receipts Found!!</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-lg-5 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1800">

            </div>
        </div>
    </div>
@stop

@section('reportFooter')

@stop