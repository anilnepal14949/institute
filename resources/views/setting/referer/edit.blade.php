@extends('setting')

@section('settingHeader')

@stop

@section('settingContent')
    <div class="pro_main_div pro_main_div_1">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('setting')}}" title="Setting"><span class="glyphicon glyphicon-wrench"></span> Setting</a></li>
            <li><a href="{{route('referer.index')}}" title="Setting"><span class="glyphicon glyphicon-transfer"></span> Referer</a></li>
            <li><span class="glyphicon glyphicon-pencil"></span> Edit</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_drag_window">
                    <div class="panel-heading pro_drag_title_bar">
                        <h3 class="panel-title">Edit Referer</h3>
                    </div>

                    {!!Form::model($userDetail,['route'=>['setting.referer.update',$userDetail->id],'method'=>'put','class'=>'scrollIfExcess showSavingOnSubmit','files'=>true])!!}

                    <div class="panel-body">
                        @include('setting._basic_info')

                        <section class="pro_advance_info">

                            <!-- qualification -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('qualification')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('qualification')) title="{!!$errors->first('qualification')!!}" @endif>
                                    {!!Form::label('qualification','Qualification:')!!}
                                    {!!Form::text('qualification', $referer->qualification, ['class'=>'form-control'])!!}
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
                                    {!!Form::text('profession', $referer->profession, ['class'=>'form-control'])!!}
                                    @if($errors->has('profession'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="professionStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="professionStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- description -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('description')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('description')) title="{!!$errors->first('description')!!}" @endif>
                                    {!!Form::label('description','Description:')!!}
                                    {!!Form::text('description', $referer->description, ['class'=>'form-control'])!!}
                                    @if($errors->has('description'))
                                        <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="descriptionStatus" class="sr-only">(error)</span>
                                    @elseif(count($errors->all())>0)
                                        <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                        <span id="descriptionStatus" class="sr-only">(success)</span>
                                    @endif
                                </div>
                            </div>

                        </section>

                        @if($referer->image != null && $referer->image != '' && file_exists('public/images/referer/'.$referer->image))
                            <div class="col-md-12 col-lg-12 pro_edit_image">
                                <img src="{{asset('/public/images/referer/thumbnail/thumbvtx'.$referer->image)}}" title="{{$referer->image}}" align="{{$referer->image}}" class="img-thumbnail" />
                                <button class="btn btn-warning" type="button">Download</button>
                                <button class="btn btn-danger pro_delete_file_button" type="button" data-delete-form-id={{$referer->id."file_delete_form"}}>Delete</button>
                            </div>
                        @endif

                        <!-- status -->
                        <div class="form-group col-md-12 col-lg-12 pro_checkbox">
                            <input type="checkbox" name="status" id="status" class="first_color" @if(old('status') || $referer->status=='0') checked="checked" @endif />
                            <label for="status">Is Active?</label>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-success" data-loading-text="Updating..." autocomplete="off">Update</button>
                        <button class="btn btn-default" type="reset">Reset</button>
                        <button class="btn btn-info pro_advance_button_footer" type="button" data-toggle-id="1">Advance <span class="glyphicon glyphicon-download faa-tada animated-hover"></span></button>
                    </div>
                    {!!Form::close()!!}
                    {!! delete_file_form(['referer','image',$referer->image], $referer->id.'file_delete_form') !!}
                </div>

            </div>
            <div class="col-md-5 col-lg-5 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1800">
                @include('setting.referer._list')
            </div>
        </div>
    </div>
@stop

@section('settingFooter')

@stop