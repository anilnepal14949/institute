@extends('setting')

@section('settingHeader')

@stop

@section('settingContent')
    <div class="pro_main_div pro_main_div_1">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{url('setting')}}" title="Setting"><span class="glyphicon glyphicon-wrench"></span> Setting</a></li>
            <li><span class="glyphicon glyphicon-grain"></span> Our Course</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Add Our Course</h3>
                    </div>

                    {!!Form::open(['route'=>'setting.our-course.store','method'=>'post','class'=>'scrollIfExcess showSavingOnSubmit','files'=> true])!!}
                    <div class="panel-body">

                        <!-- subject_id -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('subject_id')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('subject_id')) title="{!!$errors->first('subject_id')!!}" @endif>
                                {!!Form::label('subject_id','Subject:')!!}

                                <select class="form-control" name="subject_id" id="subject_id" required="required">
                                    <option value="0">Choose Subject</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{!! $subject->courseTypeLevel->name !!} >>>> {!! $subject->name !!}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('subject_id'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="subject_idStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="subject_idStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- teacher_id -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('teacher_id')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('teacher_id')) title="{!!$errors->first('teacher_id')!!}" @endif>
                                {!!Form::label('teacher_id','Teacher:')!!}
                                <select class="form-control" name="teacher_id" id="teacher_id" required="required">
                                    <option value="0">Choose Teacher</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{!! $teacher->userDetail->name !!}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('teacher_id'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="teacher_idStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="teacher_idStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- room_id -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('room_id')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('room_id')) title="{!!$errors->first('room_id')!!}" @endif>
                                {!!Form::label('room_id','Room:')!!}
                                <select class="form-control" name="room_id" id="room_id" required="required">
                                    <option value="0">Choose Room</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}">{!! $room->name !!}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('room_id'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="room_idStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="room_idStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- status_id -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('status_id')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('status_id')) title="{!!$errors->first('status_id')!!}" @endif>
                                {!!Form::label('status_id','Status:')!!}
                                <select class="form-control" name="status_id" id="status_id" required="required">
                                    <option value="0">Choose Status</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}">{!! $status->name !!}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('status_id'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="status_idStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="status_idStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- name -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('name')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('name')) title="{!!$errors->first('name')!!}" @endif>
                                {!!Form::label('name','Name:')!!}
                                {!!Form::text('name', null, ['class'=>'form-control'])!!}
                                @if($errors->has('name'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="nameStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="nameStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- capacity -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('capacity')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('capacity')) title="{!!$errors->first('capacity')!!}" @endif>
                                {!!Form::label('capacity','Capacity:')!!}
                                {!!Form::text('capacity', null, ['class'=>'form-control'])!!}
                                @if($errors->has('capacity'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="capacityStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="capacityStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>  
                        
                        <!-- course_fee -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('course_fee')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('course_fee')) title="{!!$errors->first('course_fee')!!}" @endif>
                                {!!Form::label('course_fee','Course Fee:')!!}
                                {!!Form::text('course_fee', null, ['class'=>'form-control','aria-describedby'=>'fee_addon1','placeholder'=>'Amount in Rs.'])!!}
                                @if($errors->has('course_fee'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="course_feeStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="course_feeStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- form_fee -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('form_fee')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('form_fee')) title="{!!$errors->first('form_fee')!!}" @endif>
                                {!!Form::label('form_fee','Form Fee:')!!}
                                {!!Form::text('form_fee', null, ['class'=>'form-control','placeholder'=>'Amount in Rs.'])!!}
                                @if($errors->has('form_fee'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="form_feeStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="form_feeStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- start_date -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('start_date')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('start_date')) title="{!!$errors->first('start_date')!!}" @endif>
                                {!!Form::label('start_date','Start Date:')!!}
                                <input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo date('Y-m-d') ?>" />
                                @if($errors->has('start_date'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="start_dateStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="start_dateStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- end_date -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('end_date')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('end_date')) title="{!!$errors->first('end_date')!!}" @endif>
                                {!!Form::label('end_date','End Date:')!!}
                                <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo date('Y-m-d') ?>" />
                                @if($errors->has('end_date'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="end_dateStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="end_dateStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- start_time -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('start_time')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('start_time')) title="{!!$errors->first('start_time')!!}" @endif>
                                {!!Form::label('start_time','Class Start Time:')!!}
                                <input type="time" class="form-control" name="start_time" id="start_time" value="<?php echo date('G:i:s') ?>" />
                                @if($errors->has('start_time'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="start_timeStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="start_timeStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- end_time -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('end_time')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('end_time')) title="{!!$errors->first('end_time')!!}" @endif>
                                {!!Form::label('end_time','Class End Time:')!!}
                                <input type="time" class="form-control" name="end_time" id="end_time" value="<?php echo date('G:i:s') ?>" />
                                @if($errors->has('end_time'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="end_timeStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="end_timeStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- description -->
                            <div class="form-group col-md-12 col-lg-12 @if($errors->has('description')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('description')) title="{!!$errors->first('description')!!}" @endif>
                                {!!Form::label('description','Description:')!!}
                                {!!Form::textarea('description', null, ['class'=>'form-control'])!!}
                                @if($errors->has('description'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="descriptionStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="descriptionStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- status -->
                        <div class="form-group col-md-6 col-lg-6 pro_checkbox">
                            <input type="checkbox" name="status" id="status" class="first_color" @if(old('status')) @else checked="checked" @endif />
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
                @include('setting.our-course._list')
            </div>
        </div>
    </div>
@stop

@section('settingFooter')
    <script src="{{asset('/public/js/setting/subject.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>

@stop