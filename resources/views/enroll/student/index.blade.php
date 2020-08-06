@extends('enroll')

@section('enrollHeader')

@stop

@section('enrollContent')
    <div class="pro_main_div pro_main_div_4">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><span class="glyphicon glyphicon-certificate"></span> Enroll Student</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <div class="panel-heading-left">
                            <h3 class="panel-title">Enroll Student</h3>
                        </div>
                        <div class="panel-heading-right">

                            <a href="{{route('student.index')}}" title="Add New Student" class="btn btn-info btn-xs showToolTip" data-placement="left" role="button"><span class="glyphicon glyphicon-education"></span> Add Student</a> &nbsp;&nbsp;

                            <a href="{{route('enroll.student-bill.index')}}" title="Browse Bills and Edit" class="btn btn-info btn-xs showToolTip" data-placement="left" role="button"><span class="glyphicon glyphicon-list-alt"></span> Show Bills</a> &nbsp;&nbsp;

                        </div>
                    </div>
                    {!!Form::open(['route'=>'enroll.enroll-student.store','method'=>'post','class'=>'scrollIfExcess showSavingOnSubmit','files'=> true])!!}
                    <div class="panel-body">

                        <!-- student_id -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('student_id')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('student_id')) title="{!!$errors->first('student_id')!!}" @endif>
                                {!!Form::label('student_id','Student:')!!}
                                {!!Form::label('student_id','Student:')!!}
                                <select name="student_id" id="student_id" class="form-control">
                                    <option value="0">Choose Student</option>
                                    @foreach($students as $student)
                                        <option value="{{$student->id}}" @if($userId == $student->user_id) selected="selected" @endif>{!! $student->userDetail->name.' ('.$student->userDetail->contact.')' !!}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('student_id'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="student_idStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="student_idStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- our_course_id -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('our_course_id')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('our_course_id')) title="{!!$errors->first('our_course_id')!!}" @endif>
                                {!!Form::label('our_course_id','Our Course:')!!}
                                <select name="our_course_id" id="our_course_id" class="form-control">
                                    <option value="0">Choose Course Type</option>
                                    @foreach($ourCourses as $ourCourse)
                                        <option value="{{$ourCourse->id}}">{!! $ourCourse->name !!}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('our_course_id'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="our_course_idStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="our_course_idStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- referer_id -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('referer_id')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('referer_id')) title="{!!$errors->first('referer_id')!!}" @endif>
                                {!!Form::label('referer_id','Referer:')!!}
                                <select name="referer_id" id="referer_id" class="form-control">
                                    <option value="0">Choose Course Type</option>
                                    @foreach($referers as $referer)
                                        <option value="{{$referer->id}}">{!! $referer->userDetail->name !!}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('referer_id'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="referer_idStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="referer_idStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- enroll_date -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('enroll_date')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('enroll_date')) title="{!!$errors->first('enroll_date')!!}" @endif>
                                {!!Form::label('enroll_date','Enroll Date:')!!}
                                <input type="date" name="enroll_date" id="enroll_date" class="form-control" value="{{date('Y-m-d')}}" />
                                @if($errors->has('enroll_date'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="enroll_dateStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="enroll_dateStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- account_note -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('account_note')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('account_note')) title="{!!$errors->first('account_note')!!}" @endif>
                                {!!Form::label('account_note','Account Note:')!!}
                                {!!Form::textarea('account_note', null, ['class'=>'form-control'])!!}
                                @if($errors->has('account_note'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="account_noteStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="account_noteStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- admin_note -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('admin_note')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('admin_note')) title="{!!$errors->first('admin_note')!!}" @endif>
                                {!!Form::label('admin_note','Admin Note:')!!}
                                {!!Form::textarea('admin_note', null, ['class'=>'form-control'])!!}
                                @if($errors->has('admin_note'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="admin_noteStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="admin_noteStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- status -->
                        <div class="form-group col-md-12 col-lg-12 pro_checkbox">
                            <input type="checkbox" name="status" id="status" class="first_color" @if(old('status'))  @else checked="checked" @endif />
                            <label for="status">Is Active?</label>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-success" data-loading-text="Saving..." autocomplete="off">Save</button>
                        <button class="btn btn-default" type="reset">Reset</button>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
            <div class="col-md-5 col-lg-5 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1800">
                @include('enroll.student._list')
            </div>
        </div>
    </div>
@stop

@section('enrollFooter')

@stop