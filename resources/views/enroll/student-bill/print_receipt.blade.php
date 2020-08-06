@extends('layouts.default')

@section('headerContent')
    <style type="text/css">
        #pro_receipt_wrapper{
            width:5.5in;
            height: 8in;
            border:1px solid;
            padding: 0.3in;
        }
        h1{
            text-align: center;
        }
        .pro_signature{
            text-align: center;
        }
        .pro_well{
            margin-top: 5px;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div id="pro_receipt_wrapper">
        <h1>Sagarmatha Institute</h1>
        <table class="table">
            <tr>
                <td>Name</td><td>{{$receiptDetail->student->userDetail->name}}</td>
            </tr>
            <tr>
                <td>Address</td><td>{{$receiptDetail->student->userDetail->address}}</td>
            </tr>
            <tr>
                <td>Contact</td><td>{{$receiptDetail->student->userDetail->contact}}</td>
            </tr>
        </table>

        <table class="table">
            <tr>
                <th>S.N.</th><th>Description</th><th>Discount Amount</th><th>Paid Amount</th><th>Net Amount</th>
            </tr>
            <?php $i=1;$totalPaid = $totalDiscount = $totalNet = 0; ?>
            @foreach($receiptDetail->receiptDetail as $receipt)
                <tr>
                    <td>{!! $i++ !!}.</td>
                    <td>

                        {{\ProIMAN\OurCourse::whereId((\ProIMAN\StudentBill::whereId($receipt->bill_no)->first()->our_course_id))->first()->name}}
                        @if(\ProIMAN\StudentBill::whereId($receipt->bill_no)->first()->bill_type == 0)
                            Course Fee
                        @else
                            Form Fee
                        @endif
                    </td>
                    <td>@if($receipt->disount_amount=='') - @else {{$receipt->disount_amount}} @endif</td>
                    <td>{{$receipt->paid_amount}}</td>
                    <td>{{$receipt->paid_amount-$receipt->discount_amount}}</td>
                </tr>
                <?php
                    $totalPaid += $receipt->paid_amount;
                    $totalDiscount+= $receipt->disount_amount;
                    $totalNet += $receipt->paid_amount-$receipt->disount_amount;
                ?>
            @endforeach
            <tr style="border-top: 2px solid #333">
                <td colspan="2">
                    <b>Total</b>
                </td>
                <td>{{$totalDiscount}}</td>
                <td>{{$totalPaid}}</td>
                <td>{{$totalNet}}</td>
            </tr>
        </table>
        <div class="col-md-6 col-lg-6">
            <small>
                <u>Created By</u><br />{{\ProIMAN\UserDetail::whereId($receiptDetail->created_by)->first()->name}}
            </small>
        </div>
        <div class="col-md-6 col-lg-6 pull-right pro_signature">
           <small>
               _________________<br />
                Signature
           </small>
        </div>
        <div class="clearfix"></div>
        <div class="well pro_well">Have a nice day!! :) </div>
    </div>
@endsection

@section('footerContent')
    <script type="text/javascript">
        $(document).ready(function(){
            window.print();
            document.location.href = 'http://localhost/ProIMAN/enroll';
        });
    </script>
@endsection