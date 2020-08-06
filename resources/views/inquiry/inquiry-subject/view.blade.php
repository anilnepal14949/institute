@extends('setting')

@section('settingHeader')

@stop

@section('settingContent')
    <div class="pro_main_div pro_main_div_1">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('setting')}}" title="Setting"><span class="glyphicon glyphicon-wrench"></span> Setting</a></li>
            <li><a href="{{route('student.index')}}" title="Setting"><span class="glyphicon glyphicon-education"></span> Student</a></li>
            <li><span class="glyphicon glyphicon-zoom-in"></span> View</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">View Student</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6 col-lg-6 pro_user_detail">
                            <table class="table pro_view_table">
                                <tr>
                                    <td>
                                        Name:
                                    </td>
                                    <td>
                                        {{$userDetail->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Address:
                                    </td>
                                    <td>
                                        {{$userDetail->address}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Contact:
                                    </td>
                                    <td>
                                        {{$userDetail->contact}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email:
                                    </td>
                                    <td>
                                        {{$userDetail->email}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Gender:
                                    </td>
                                    <td>
                                        @if($userDetail->gender == 'm') Male @elseif($userDetail->gender == 'f') Female @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Date of Birth:
                                    </td>
                                    <td>
                                        {{$userDetail->dob}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Qualification:
                                    </td>
                                    <td>
                                        {{$student->qualification}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Profession:
                                    </td>
                                    <td>
                                        {{$student->profession}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Associated To:
                                    </td>
                                    <td>
                                        {{$student->associated_to}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Guardian Name:
                                    </td>
                                    <td>
                                        {{$student->parent_name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Guardian Contact:
                                    </td>
                                    <td>
                                        {{$student->parent_contact}}
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6 col-lg-6 pro_view_image">
                            @if($userDetail->image != null && $userDetail->image != '' && file_exists('public/images/student/'.$userDetail->image))
                                <img src="{{asset('/public/images/student/'.$userDetail->image)}}" title="{!!$userDetail->image!!}" alt="{!!$userDetail->image!!}" class="img-thumbnail" />
                                <br /><br />
                            @endif

                            {!! Form::open(['route'=>'enroll.enroll-student-bill.create','method'=>'get','class'=>'form_inline']) !!}
                            {!! Form::hidden('student_enroll_id',$student_enroll_id) !!}
                            <button class="@if($student_enroll_id==0) disabled @endif btn btn-warning showToolTip" title="Create Receipt" data-placement="left">Check Account</button>
                            {!!Form::close()!!}

                            <a href="{{route('setting.student.edit',$userDetail->id)}}" class="btn btn-info showToolTip" title="Edit Full Information" data-placement="right">Edit Info</a>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-5 col-lg-5 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1800">
                @include('setting.student._list')
            </div>
        </div>
    </div>
@stop

@section('settingFooter')

@stop