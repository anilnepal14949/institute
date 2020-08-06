@extends('enroll')

@section('enrollHeader')

@stop

@section('enrollContent')
    <div class="pro_main_div pro_main_div_4">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('enroll.student.index')}}" title="Setting"><span class="glyphicon glyphicon-certificate"></span> Enroll</a></li>
            <li><a href="{{route('enroll.student-bill.index')}}" title="Show Student Bills"><span class="glyphicon glyphicon-list-alt"></span> Student Bills</a></li>
            <li><span class="glyphicon glyphicon-file"></span> Student Receipt</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-8 col-lg-8 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Student Receipt</h3>
                    </div>
                    {!!Form::model($studentEnrollInfo,['route'=>['enroll.enroll-student-bill.update',$studentEnrollInfo->student_id],'method'=>'put','class'=>'scrollIfExcess showSavingOnSubmit','files'=> true])!!}
                    <div class="panel-body">
                        <div class="alert alert-success" role="alert">
                            Name: <a href="#" class="alert-link">{{$studentEnrollInfo->name}}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Address: {{$studentEnrollInfo->address}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Contact: {{$studentEnrollInfo->contact}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Email: {{$studentEnrollInfo->email}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                        <!-- Table -->
                        <table class="table pro_table">
                            <tr>
                                <th width="5%">
                                    S.N.
                                </th>
                                <th width="12%">
                                    Date
                                </th>
                                <th>
                                    Description
                                </th>
                                <th width="8%">
                                    Paid
                                </th>
                                <th width="8%">
                                    Discount
                                </th>
                                <th width="8%">
                                    Due
                                </th>
                            </tr>
                        <?php $i=1;$totalAmount=0; ?>
                        @foreach($bill_data as $bill)
                            <tr>
                                <td>
                                    {!! $i; !!}.
                                </td>
                                <td>
                                    {!! date('Y-m-d', strtotime($bill->created_at)); !!}
                                </td>
                                <td>
                                    {!! $bill->ourCourse->name !!}
                                    @if($bill->bill_type == 0) <label class="label label-warning label-xs">Course Fee</label> @else <label class="label label-info label-xs">Form Fee</label>  @endif
                                </td>
                                <td>
                                    <input type="text" name="bill_amount_paid[]" id="bill_amount_paid{!! $i !!}" class="pro_bill_input do_change_paid" value="0" data-selector="{!! $i !!}" />
                                </td>
                                <td>
                                    <input type="text" name="bill_amount_discount[]" id="bill_amount_discount{!! $i !!}" class="pro_bill_input do_change_discount" value="0" data-selector="{!! $i !!}" />
                                </td>
                                <td>
                                    <input type="hidden" id="bill_amount_due_ghost{!! $i !!}" value="{!! $bill->due !!}" />
                                    <input type="text" name="bill_amount_due[]" id="bill_amount_due{!! $i !!}" class="pro_bill_input do_change_due" value="{!! $bill->due !!}" data-selector="{!! $i !!}" />
                                </td>
                            </tr>
                            <?php
                                $i++;
                                $totalAmount += $bill->due;
                            ?>
                        @endforeach
                            <tr style="border-top: 2px solid #666">
                                <td>

                                </td>
                                <td colspan="2">
                                    <strong>Total</strong>
                                </td>
                                <td>
                                    <input type="text" name="total_paid_amount" id="total_paid_amount" class="pro_bill_input" value="0" readonly="readonly" />
                                </td>
                                <td>
                                    <input type="text" name="total_discount_amount" id="total_discount_amount" class="pro_bill_input" value="0" readonly="readonly" />
                                </td>
                                <td>
                                    <input type="text" name="total_due_amount" id="total_due_amount" class="pro_bill_input" value="{{$totalAmount}}" readonly="readonly" />
                                </td>
                            </tr>
                        </table>
                        <hr />
                        <!-- receipt_note -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('receipt_note')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback showToolTip" title="Add Receipt Note">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('receipt_note')) title="{!!$errors->first('receipt_note')!!}" @endif>
                                {!!Form::label('receipt_note','Receipt Note:')!!}
                                {!!Form::textarea('receipt_note', null, ['class'=>'form-control','rows'=>'6'])!!}
                                @if($errors->has('receipt_note'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="receipt_noteStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="receipt_noteStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- account_note -->
                        <div class="form-group col-md-6 col-lg-6 has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" title="Account Note">
                                {!!Form::label('account_note','Account Note:')!!}
                                <div class="alert alert-warning pro_account_note" role="alert">
                                    @if($studentEnrollInfo->account_note !='')
                                        {{$studentEnrollInfo->account_note}}
                                    @else
                                        Not Mentioned!!!
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-success" data-loading-text="Saving..." autocomplete="off">Save & Print</button>
                        <button class="btn btn-default" type="reset">Reset</button>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
            <div class="col-md-4 col-lg-4 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1800">
                @include('enroll.student-bill._list')
            </div>
        </div>
    </div>
@stop

@section('enrollFooter')
    <script type="text/javascript">
        $(document).ready(function(){
            var $class = $('.do_change_due');
            var $class1 = $('.do_change_paid');
            var $class2 = $('.do_change_discount');


            $class.blur(function(){
                var $selector = $(this).attr('data-selector');
                var $due = $('#bill_amount_due'+$selector);
                var $dueGhost = $('#bill_amount_due_ghost'+$selector);
                var $discount = $('#bill_amount_discount'+$selector);
                var $paid = $('#bill_amount_paid'+$selector);
                var paidInsert = $dueGhost.val()-$discount.val()-$due.val();
                $paid.val(paidInsert);
                showTotal();
            });

            $class1.blur(function(){
                var $selector = $(this).attr('data-selector');
                var $due = $('#bill_amount_due'+$selector);
                var $dueGhost = $('#bill_amount_due_ghost'+$selector);
                var $discount = $('#bill_amount_discount'+$selector);
                var $paid = $('#bill_amount_paid'+$selector);

                var dueInsert = $dueGhost.val()-$discount.val()-$paid.val();
                $due.val(dueInsert);
                showTotal();
            });

            $class2.blur(function(){
                var $selector = $(this).attr('data-selector');
                var $due = $('#bill_amount_due'+$selector);
                var $dueGhost = $('#bill_amount_due_ghost'+$selector);
                var $discount = $('#bill_amount_discount'+$selector);
                var $paid = $('#bill_amount_paid'+$selector);

                var dueInsert = $dueGhost.val()-$discount.val()-$paid.val();
                $due.val(dueInsert);
                showTotal();
            });
        });
        function showTotal(){
            var totalDue= 0, totalDiscount =0, totalPaid=0;
            $('.do_change_due').each(function(){
                totalDue = Number(Number(totalDue) + Number($(this).val()));
            });
            $('.do_change_discount').each(function(){
                totalDiscount = Number(Number(totalDiscount) + Number($(this).val()));
            });
            $('.do_change_paid').each(function(){
                totalPaid = Number(Number(totalPaid) + Number($(this).val()));
            });
            $('#total_due_amount').val(totalDue);
            $('#total_paid_amount').val(totalPaid);
            $('#total_discount_amount').val(totalDiscount);

        }
    </script>
@stop