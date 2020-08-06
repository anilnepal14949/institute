@extends('setting')

@section('settingHeader')

@stop

@section('settingContent')
    <div class="pro_main_div pro_main_div_1">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('setting')}}" title="Setting"><span class="glyphicon glyphicon-wrench"></span> Setting</a></li>
            <li><a href="{{route('student.index')}}" title="Setting"><span class="glyphicon glyphicon-education"></span> Student</a></li>
            <li><span class="glyphicon glyphicon-pencil"></span> Edit</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Edit Student</h3>
                    </div>
                    {!!Form::model($userDetail,['route'=>['setting.student.update',$userDetail->id],'method'=>'put','class'=>'scrollIfExcess showSavingOnSubmit','files'=>true])!!}
                    <div class="panel-body">
                        @include('setting._basic_info')

                        <section class="pro_advance_info">

                            <!-- qualification -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('qualification')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('qualification')) title="{!!$errors->first('qualification')!!}" @endif>
                                    {!!Form::label('qualification','Qualification:')!!}
                                    {!!Form::text('qualification', $student->qualification, ['class'=>'form-control'])!!}
                                    @if($errors->has('qualification'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="qualificationStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="qualificationStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- profession -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('profession')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('profession')) title="{!!$errors->first('profession')!!}" @endif>
                                    {!!Form::label('profession','Profession:')!!}
                                    {!!Form::text('profession', $student->profession, ['class'=>'form-control'])!!}
                                    @if($errors->has('profession'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="professionStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="professionStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- associated_to -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('associated_to')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('associated_to')) title="{!!$errors->first('associated_to')!!}" @endif>
                                    {!!Form::label('associated_to','Associated To:')!!}
                                    {!!Form::text('associated_to', $student->associated_to, ['class'=>'form-control'])!!}
                                    @if($errors->has('associated_to'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="associated_toStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="associated_toStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- parent_name -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('parent_name')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('parent_name')) title="{!!$errors->first('parent_name')!!}" @endif>
                                    {!!Form::label('parent_name','Guardian Name:')!!}
                                    {!!Form::text('parent_name', $student->parent_name, ['class'=>'form-control'])!!}
                                    @if($errors->has('parent_name'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="parent_nameStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="parent_nameStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- parent_contact -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('parent_contact')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('parent_contact')) title="{!!$errors->first('parent_contact')!!}" @endif>
                                    {!!Form::label('parent_contact','Guardian Contact:')!!}
                                    {!!Form::text('parent_contact', $student->parent_contact, ['class'=>'form-control'])!!}
                                    @if($errors->has('parent_contact'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="parent_contactStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="parent_contactStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- parent_email -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('parent_email')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('parent_email')) title="{!!$errors->first('parent_email')!!}" @endif>
                                    {!!Form::label('parent_email','Guardian Email:')!!}
                                    {!!Form::text('parent_email', $student->parent_email, ['class'=>'form-control'])!!}
                                    @if($errors->has('parent_email'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="parent_emailStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="parent_emailStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- temp_parent_name -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('temp_parent_name')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('temp_parent_name')) title="{!!$errors->first('temp_parent_name')!!}" @endif>
                                    {!!Form::label('temp_parent_name','Local Guardain Name:')!!}
                                    {!!Form::text('temp_parent_name', $student->temp_parent_name, ['class'=>'form-control'])!!}
                                    @if($errors->has('temp_parent_name'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="temp_parent_nameStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="temp_parent_nameStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- temp_parent_contact -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('temp_parent_contact')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('temp_parent_contact')) title="{!!$errors->first('temp_parent_contact')!!}" @endif>
                                    {!!Form::label('temp_parent_contact','Local Guardian Contact:')!!}
                                    {!!Form::text('temp_parent_contact', $student->temp_parent_contact, ['class'=>'form-control'])!!}
                                    @if($errors->has('temp_parent_contact'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="temp_parent_contactStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="temp_parent_contactStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                        </section>

                        @if($userDetail->image != null && $userDetail->image != '' && file_exists('public/images/student/'.$userDetail->image))
                            <div class="col-md-12 col-lg-12 pro_edit_image">
                                <img src="{{asset('/public/images/student/thumbnail/thumbvtx'.$userDetail->image)}}" title="{{$userDetail->image}}" alt="{{$userDetail->image}}" class="img-thumbnail" />
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
                    {!! delete_file_form(['student','image',$userDetail->image], $userDetail->id.'file_delete_form') !!}
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