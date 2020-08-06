@extends('setting')

@section('settingHeader')

@stop

@section('settingContent')
    <div class="pro_main_div pro_main_div_1">
        <ol class="breadcrumb probreadcrumb">
            <li><a href="" title="Home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="{{route('setting')}}" title="Setting"><span class="glyphicon glyphicon-wrench"></span> Setting</a></li>
            <li><a href="{{route('room.index')}}" title="Room"><span class="glyphicon glyphicon-th"></span> Room</a></li>
            <li><span class="glyphicon glyphicon-pencil"></span> Edit</li>
        </ol>
        <div class="pro_main_body">
            <div class="col-md-7 col-lg-7 pro_do_task" data-appear-animation="fadeIn" data-appear-delay="1400">
                <div class="panel panel-default pro_window">
                    <div class="panel-heading pro_titlebar">
                        <h3 class="panel-title">Edit Room</h3>
                    </div>

                    {!!Form::model($room,['route'=>['setting.room.update',$room->id],'method'=>'put','class'=>'scrollIfExcess showSavingOnSubmit'])!!}
                    <div class="panel-body">

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
                        
                        <!-- number -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('number')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('number')) title="{!!$errors->first('number')!!}" @endif>
                                {!!Form::label('number','Number:')!!}
                                {!!Form::text('number', null, ['class'=>'form-control','required'=>'required'])!!}
                                @if($errors->has('number'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="numberStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="numberStatus" class="sr-only">(success)</span>
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
                        
                        <!-- image -->
                            <div class="form-group col-md-6 col-lg-6 @if($errors->has('image')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
                                <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('image')) title="{!!$errors->first('image')!!}" @endif>
                                {!!Form::label('image','Image:')!!}
                                    <span class="glyphicon glyphicon-info-sign showInfo" title="Image File" data-content="Please Provide image file having extension jpg, png, bmp or jpeg." data-trigger="focus" data-placement="top" data-toggle="popover" tabindex="0" role="button"></span>
                                {!!Form::file('image', ['class'=>'form-control'])!!}
                                @if($errors->has('image'))
                                    <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="imageStatus" class="sr-only">(error)</span>
                                @elseif(count($errors->all())>0)
                                    <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
                                    <span id="imageStatus" class="sr-only">(success)</span>
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
                            <input type="checkbox" name="status" id="status" class="first_color" @if(old('status') || $room->status=="0") checked="checked" @endif />
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
                @include('setting.room._list')
            </div>
        </div>
    </div>
@stop

@section('settingFooter')

@stop