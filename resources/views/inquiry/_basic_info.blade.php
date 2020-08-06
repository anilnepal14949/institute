<!-- name -->
<div class="form-group col-md-6 col-lg-6 @if($errors->has('name')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
    <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('name')) title="{!!$errors->first('name')!!}" @endif data-placement="bottom">
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

<!-- address -->
<div class="form-group col-md-6 col-lg-6 @if($errors->has('address')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
    <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('address')) title="{!!$errors->first('address')!!}" @endif data-placement="bottom">
        {!!Form::label('address','Address:')!!}
        {!!Form::text('address', null, ['class'=>'form-control','required'=>'required'])!!}
        @if($errors->has('address'))
            <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
            <span id="addressStatus" class="sr-only">(error)</span>
        @elseif(count($errors->all())>0)
            <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
            <span id="addressStatus" class="sr-only">(success)</span>
        @endif
    </div>
</div>

<!-- contact -->
<div class="form-group col-md-6 col-lg-6 @if($errors->has('contact')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
    <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('contact')) title="{!!$errors->first('contact')!!}" @endif>
        {!!Form::label('contact','Contact:')!!}
        {!!Form::text('contact', null, ['class'=>'form-control'])!!}
        @if($errors->has('contact'))
            <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
            <span id="contactStatus" class="sr-only">(error)</span>
        @elseif(count($errors->all())>0)
            <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
            <span id="contactStatus" class="sr-only">(success)</span>
        @endif
    </div>
</div>

<!-- email -->
<div class="form-group col-md-6 col-lg-6 @if($errors->has('email')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
    <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('email')) title="{!!$errors->first('email')!!}" @endif>
        {!!Form::label('email','Email:')!!}
        {!!Form::email('email', null, ['class'=>'form-control'])!!}
        @if($errors->has('email'))
            <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
            <span id="emailStatus" class="sr-only">(error)</span>
        @elseif(count($errors->all())>0)
            <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
            <span id="emailStatus" class="sr-only">(success)</span>
        @endif
    </div>
</div>

<!-- gender -->
<div class="form-group col-md-6 col-lg-6 @if($errors->has('gender')) has-error @elseif(count($errors->all())>0) has-success @endif has-feedback">
    <div class="input-group col-md-12 col-lg-12 showToolTip" @if($errors->has('gender')) title="{!!$errors->first('gender')!!}" @endif>
        {!!Form::label('gender','Gender:')!!}
        {!!Form::select('gender',['m'=>'Male','f'=>'Female'], null, ['class'=>'form-control'])!!}
        @if($errors->has('gender'))
            <span class="glyphicon glyphicon-remove-circle form-control-feedback" aria-hidden="true"></span>
            <span id="genderStatus" class="sr-only">(error)</span>
        @elseif(count($errors->all())>0)
            <span class="glyphicon glyphicon-ok-circle form-control-feedback" aria-hidden="true"></span>
            <span id="genderStatus" class="sr-only">(success)</span>
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