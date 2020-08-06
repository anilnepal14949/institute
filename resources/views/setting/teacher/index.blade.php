@extends('setting')

@section('settingHeader')

@stop

@section('settingContent')
    <div class="pro_main_div pro_main_div_1">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{url('setting')}}" title="Setting"><span class="glyphicon glyphicon-wrench"></span> Setting</a></li>
            <li><span class="glyphicon glyphicon-briefcase"></span> Teacher</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Add Teacher</h3>
                    </div>
                    {!!Form::open(['route'=>'setting.teacher.store','method'=>'post','class'=>'scrollIfExcess showSavingOnSubmit','files'=> true])!!}
                    <div class="panel-body">

                        @include('setting._basic_info')

                        <section class="pro_advance_info">
                            
                            <!-- qualification -->
                                <div class="form-group col-md-6 col-lg-6 @if($errors->has('qualification')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                    <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('qualification')) title="{!!$errors->first('qualification')!!}" @endif>
                                    {!!Form::label('qualification','Qualification:')!!}
                                    {!!Form::text('qualification', null, ['class'=>'form-control'])!!}
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
                                    {!!Form::text('associated_in', null, ['class'=>'form-control'])!!}
                                    @if($errors->has('associated_in'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="associated_inStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="associated_inStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- extra_qualification -->
                                <div class="form-group col-md-6 col-lg-6 @if($errors->has('extra_qualification')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                    <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('extra_qualification')) title="{!!$errors->first('extra_qualification')!!}" @endif>
                                    {!!Form::label('extra_qualification','Extra Qualification:')!!}
                                    {!!Form::text('extra_qualification', null, ['class'=>'form-control'])!!}
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

                        <!-- status -->
                        <div class="form-group col-md-12 col-lg-12 pro_checkbox">
                            <input type="checkbox" name="status" id="status" class="first_color" @if(old('status')) @else checked="checked" @endif />
                            <label for="status">Is Active?</label>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-success" data-loading-text="Saving..." autocomplete="off">Save</button>
                        <button class="btn btn-default" type="reset">Reset</button>
                        <button class="btn btn-info pro_advance_button_footer" type="button" data-toggle-id="1">Advance <span class="glyphicon glyphicon-download faa-tada animated-hover"></span></button>
                    </div>
                    {!!Form::close()!!}
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