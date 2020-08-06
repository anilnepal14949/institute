@extends('setting')

@section('settingHeader')

@stop

@section('settingContent')
    <div class="pro_main_div pro_main_div_1">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('setting')}}" title="Setting"><span class="glyphicon glyphicon-wrench"></span> Setting</a></li>
            <li><a href="{{route('teacher.index')}}" title="Setting"><span class="glyphicon glyphicon-education"></span> Teacher</a></li>
            <li><span class="glyphicon glyphicon-pencil"></span> Edit</li>
        </ol>

        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Edit Teacher</h3>
                    </div>
                    {!!Form::model($userDetail,['route'=>['setting.teacher.update',$userDetail->id],'method'=>'put','class'=>'scrollIfExcess showSavingOnSubmit','files'=>true])!!}

                    <div class="panel-body">

                        @include('setting._basic_info')

                        <section class="pro_advance_info">

                            <!-- qualification -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('qualification')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('qualification')) title="{!!$errors->first('qualification')!!}" @endif>
                                    {!!Form::label('qualification','Qualification:')!!}
                                    {!!Form::text('qualification', $teacher->qualification, ['class'=>'form-control'])!!}
                                    @if($errors->has('qualification'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="qualificationStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="qualificationStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- associated_in -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('associated_in')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('associated_in')) title="{!!$errors->first('associated_in')!!}" @endif>
                                    {!!Form::label('associated_in','Associated In:')!!}
                                    {!!Form::text('associated_in', $teacher->associated_in, ['class'=>'form-control'])!!}
                                    @if($errors->has('associated_in'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="associated_toStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="associated_toStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- extra_qualification -->
                                <div class="form-group col-md-6 col-lg-6 @if($errors->has('extra_qualification')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                    <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('extra_qualification')) title="{!!$errors->first('extra_qualification')!!}" @endif>
                                    {!!Form::label('extra_qualification','Extra Qualification:')!!}
                                    {!!Form::text('extra_qualification', $teacher->extra_qualification, ['class'=>'form-control'])!!}
                                    @if($errors->has('extra_qualification'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="extra_qualificationStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="extra_qualificationStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>


                        </section>

                        @if($userDetail->image != null && $userDetail->image != '' && file_exists('public/images/teacher/'.$userDetail->image))
                            <div class="col-md-12 col-lg-12 pro_edit_image">
                                <img src="{{asset('/public/images/teacher/thumbnail/thumbvtx'.$userDetail->image)}}" title="{{$userDetail->image}}" align="{{$userDetail->image}}" class="img-thumbnail" />
                                <button class="btn btn-warning" type="button">Download</button>
                                <button class="btn btn-danger pro_delete_file_button" type="button" data-delete-form-id={{$userDetail->id."file_delete_form"}}>Delete</button>
                            </div>
                        @endif

                        <!-- status -->
                        <div class="form-group col-md-12 col-lg-12 pro_checkbox">
                            <input type="checkbox" name="status" id="status" class="first_color" @if(old('status') || $userDetail->status=='0') checked="checked" @endif />
                            <label for="status">Is Active?</label>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-success" data-loading-text="Updating..." autocomplete="off">Update</button>
                        <button class="btn btn-default" type="reset">Reset</button>
                        <button class="btn btn-info pro_advance_button_footer" type="button" data-toggle-id="1">Advance <span class="glyphicon glyphicon-download faa-tada animated-hover"></span></button>
                    </div>
                    {!!Form::close()!!}
                    {!! delete_file_form(['teacher','image',$userDetail->image], $userDetail->id.'file_delete_form') !!}
                </div>
            </div>
            <div class="col-md-5 col-lg-5 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1800">
                @include('setting.teacher._list')
            </div>
        </div>
    </div>
@stop

@section('settingFooter')

@stop