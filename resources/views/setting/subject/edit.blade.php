@extends('setting')

@section('settingHeader')

@stop

@section('settingContent')
    <div class="pro_main_div pro_main_div_1">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('setting')}}" title="Setting"><span class="glyphicon glyphicon-wrench"></span> Setting</a></li>
            <li><a href="{{route('subject.index')}}" title="Setting"><span class="glyphicon glyphicon-star"></span> Subject</a></li>
            <li><span class="glyphicon glyphicon-pencil"></span> Edit</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Edit Subject</h3>
                    </div>
                    {!!Form::model($subject,['route'=>['setting.subject.update',$subject->id],'method'=>'put','class'=>'scrIfExcess showSavingOnSubmit'])!!}
                    <div class="panel-body">

                        <!-- course_type_id -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('course_type_id')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('course_type_id')) title="{!!$errors->first('course_type_id')!!}" @endif>
                                {!!Form::label('course_type_id','Course Type:')!!}
                                <select class="form-control" name="course_type_id" id="course_type_id" required="required">
                                    @foreach($courseTypes as $courseType)
                                        <option value="{{ $courseType->id }}" @if($courseType->id == \ProIMAN\CourseTypeLevel::whereId($subject->course_type_level_id)->first()->course_type_id) selected="selected" @endif>{!! $courseType->name !!}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('course_type_id'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="course_type_idStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="course_type_idStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>

                        <!-- course_type_level_id -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('course_type_level_id')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('course_type_level_id')) title="{!!$errors->first('course_type_level_id')!!}" @endif>
                                {!!Form::label('course_type_level_id','Course Type Level:')!!}
                                <span id="ajaxSelectbox"><br /><span class="glyphicon glyphicon-cog faa-spin animated"></span></span>
                                @if($errors->has('course_type_level_id'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="course_type_idStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="course_type_idStatus" class="sr-only">(success)</span>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <!-- name -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('name')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('name')) title="{!!$errors->first('name')!!}" @endif>
                                {!!Form::label('name','Name:')!!}
                                {!!Form::text('name', null, ['class'=>'form-control','required'=>'required'])!!}
                                @if($errors->has('name'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="nameStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="nameStatus" class="sr-only">(success)</span>
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
                            <input type="checkbox" name="status" id="status" class="first_color" @if(old('status') || $subject->status=='0') checked="checked" @endif />
                            <label for="status">Is Active?</label>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-success" data-loading-text="Updating..." autocomplete="off">Update</button>
                        <button class="btn btn-default" type="reset">Reset</button>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
            <div class="col-md-5 col-lg-5 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1800">
                @include('setting.subject._list')
            </div>
        </div>
    </div>
@stop

@section('settingFooter')
    <script type="text/javascript">
        $(document).ready(function(){
            showCourseTypeLevel($('#course_type_id').val(),{!! $subject->course_type_level_id !!});
        });
    </script>
    <script src="{{asset('/public/js/setting/subject.js')}}" type="text/javascript"></script>
@stop