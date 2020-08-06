@extends('enroll')

@section('enrollHeader')

@stop

@section('enrollContent')
    <div class="pro_main_div pro_main_div_4">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('enroll.student.index')}}" title="Setting"><span class="glyphicon glyphicon-certificate"></span> Enroll</a></li>
            <li><span class="glyphicon glyphicon-list-alt"></span> Student Bill</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-9 col-lg-9 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Student Bills</h3>
                    </div>
                    <div class="panel-body">
                        <!-- Table -->
                        <table class="table">
                            <tr>
                                <th width="4%">
                                    S.N.
                                </th>
                                <th width="12%">
                                    Date
                                </th>
                                <th>
                                    Student Name
                                </th>
                                <th width="20%">
                                    Our Course
                                </th>
                                <th width="10%">
                                    Amount
                                </th>
                                <th width="10%">
                                    Due
                                </th>
                                <th width="18%">
                                   Action
                                </th>
                            </tr>
                            @if(!empty($bills))
                                <?php $i=1; ?>
                                @foreach($bills as $bill)
                                    <tr>
                                        <td>
                                            {!! $i; !!}.
                                        </td>
                                        <td>
                                            {!! date('Y-m-d', strtotime($bill->created_at)); !!}
                                        </td>
                                        <td>
                                            {!! $bill->name !!}
                                        </td>
                                        <td>
                                            {!! $bill->course_name !!}
                                        </td>
                                        <td>
                                            Rs.{!! $bill->amount !!}
                                        </td>
                                        <td>
                                            Rs.{!! $bill->due !!}
                                        </td>
                                        <td>
                                            {!! Form::open(['route'=>'enroll.enroll-student-bill.create','method'=>'get','class'=>'form_inline']) !!}
                                            {!! Form::hidden('student_enroll_id',$bill->student_enroll_id) !!}
                                            <button class="btn btn-success btn-xs showToolTip" title="Create Receipt" data-placement="top"><span class="glyphicon glyphicon-open-file"></span></button>
                                            {!!Form::close()!!}
                                            <a href="{{route('enroll.enroll-student-bill.edit',$bill->id)}}" class="btn btn-info btn-xs showToolTip" title="Edit" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>

                                            <a href="{{route('enroll.enroll-student-bill.show',$bill->id)}}" class="btn btn-warning btn-xs showToolTip" title="View" data-placement="top"><span class="glyphicon glyphicon-zoom-in"></span></a>

                                            <a href="#" class="btn btn-danger btn-xs showToolTip confirmButton" title="Delete" data-placement="top" data-form-id="pro_my_form{{$i}}"><span class="glyphicon glyphicon-trash"></span></a>

                                            {!! delete_form(['enroll.enroll-student-bill.destroy',$bill->id], 'pro_my_form'.$i++) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-info" role="alert">
                                            No any bills available!! <br />Please add some bill first. <a href="{{route('enroll.student.index')}}" title="Create Bill" class="showToolTip">Create Bill</a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1800">
                
            </div>
        </div>
    </div>
@stop

@section('enrollFooter')

@stop