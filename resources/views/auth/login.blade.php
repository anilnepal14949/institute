@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 authDiv" data-appear-animation="bounceIn" data-appear-delay="800">
			<div class="panel panel-default">
				<div class="panel-heading">ProIMAN Login</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label" for="username">User Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="password">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" id="password" name="password" required="required">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<input type="checkbox" value="None" id="remember" name="remember" />
								<label for="remember">Remember Me</label>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('footerContent')
	<script type="text/javascript">
		$(document).ready(function(e){
			$('#username').focus();
		});
	</script>
@stop
