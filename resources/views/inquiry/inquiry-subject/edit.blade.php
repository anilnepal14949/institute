@extends('inquiry')

@section('inquiryHeader')

@stop

@section('inquiryContent')
    <div class="pro_main_div pro_main_div_3">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('inquiry')}}" title="Setting"><span class="glyphicon glyphicon-eye-open"></span> Inquiry</a></li>
            <li><span class="glyphicon glyphicon-pencil"></span> Edit</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Edit Inquiry</h3>
                    </div>
                    {!!Form::model($inquiry,['route'=>['inquiry.inquiry-subject.update',$inquiry->id],'method'=>'put','class'=>'scrollIfExcess showSavingOnSubmit','files'=>true])!!}
                    <div class="panel-body">

                        <!-- subject_id -->
                        <div class="form-group col-md-6 col-lg-6 @if($errors->has('subject_id')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                            <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('subject_id')) title="{!!$errors->first('subject_id')!!}" @endif>
                                {!!Form::label('subject_id','Subject:')!!}
                                <select name="subject_id" id="subject_id" class="form-control">
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}" @if($subject->id == $inquiry->subject_id) selected="selected" @endif>{{$subject->courseTypeLevel->name}} >>>> {{$subject->name}}</option>
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

                        @include('inquiry._basic_info')

                        <section class="pro_advance_info">

                            <!-- parent_name -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('parent_name')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('parent_name')) title="{!!$errors->first('parent_name')!!}" @endif>
                                    {!!Form::label('parent_name','Guardian Name:')!!}
                                    {!!Form::text('parent_name', $inquiry->parent_name, ['class'=>'form-control'])!!}
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
                                    {!!Form::text('parent_contact', $inquiry->parent_contact, ['class'=>'form-control'])!!}
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
                                    {!!Form::text('parent_email', $inquiry->parent_email, ['class'=>'form-control'])!!}
                                    @if($errors->has('parent_email'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="parent_emailStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="parent_emailStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- preferred_time -->
                                <div class="form-group col-md-6 col-lg-6 @if($errors->has('preferred_time')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                    <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('preferred_time')) title="{!!$errors->first('preferred_time')!!}" @endif>
                                    {!!Form::label('preferred_time','Preferred Time:')!!}
                                    <input type="time" class="form-control" name="preferred_time" id="preferred_time" value="{{$inquiry->preferred_time}}" />
                                    @if($errors->has('preferred_time'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="preferred_timeStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="preferred_timeStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- other_preference -->
                                <div class="form-group col-md-6 col-lg-6 @if($errors->has('other_preference')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                    <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('other_preference')) title="{!!$errors->first('other_preference')!!}" @endif>
                                    {!!Form::label('other_preference','Other Preference:')!!}
                                    {!!Form::textarea('other_preference', $inquiry->other_preference, ['class'=>'form-control'])!!}
                                    @if($errors->has('other_preference'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="other_preferenceStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="other_preferenceStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                        </section>

                        @if($inquiry->image != null && $inquiry->image != '' && file_exists('public/images/inquiry/'.$inquiry->image))
                            <div class="col-md-12 col-lg-12 pro_edit_image">
                                <img src="{{asset('/public/images/inquiry/thumbnail/thumbvtx'.$inquiry->image)}}" title="{{$inquiry->image}}" alt="{{$inquiry->image}}" class="img-thumbnail" />
                                <button class="btn btn-warning" type="button">Download</button>
                                <button class="btn btn-danger pro_delete_file_button" type="button" data-delete-form-id={{$inquiry->id."file_delete_form"}}>Delete</button>
                            </div>
                        @endif

                        <!-- status -->
                        <div class="form-group col-md-12 col-lg-12 pro_checkbox">
                            <input type="checkbox" name="status" id="status" class="first_color" @if(old('status') || $inquiry->status=='0') checked="checked" @endif />
                            <label for="status">Is Active?</label>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-success" data-loading-text="Updating..." autocomplete="off">Update</button>
                        <button class="btn btn-default" type="reset">Reset</button>
                        <button class="btn btn-info pro_advance_button_footer" type="button" data-toggle-id="1">Advance <span class="glyphicon glyphicon-download faa-tada animated-hover"></span></button>
                    </div>
                    {!!Form::close()!!}
                    {!! delete_file_form(['inquiry','image',$inquiry->image], $inquiry->id.'file_delete_form') !!}
                </div>

            </div>
            <div class="col-md-5 col-lg-5 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1800">
                @include('inquiry.inquiry-subject._list')
            </div>
        </div>
    </div>
@stop

@section('inquiryFooter')

@stop