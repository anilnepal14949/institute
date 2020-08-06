<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ProIMAN</title>

	<link href="{{ asset('/public/css/all.css') }}" rel="stylesheet">

	<!-- Fonts -->
	{{--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>--}}

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		*[data-appear-animation] {
			opacity: 0;
		}
		*[data-appear-animation].animated {
			opacity: 1;
		}
	</style>

	@yield('headerContent')

</head>
<body>

	<input type="hidden" value="{{route('home')}}" name="homePath" id="homePath" />

	@yield('content')

	<!-- Scripts -->
	<script src="{{asset('/public/js/jquery.min.js')}}"></script>
	<script src="{{asset('/public/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/public/js/sweet-alert.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('/public/js/appear/jquery.appear.js')}}" type="text/javascript"></script>
	<script src="{{asset('/public/js/nicescroll.js')}}" type="text/javascript"></script>
	<script src="{{asset('/public/js/common.js')}}" type="text/javascript"></script>

	<script type="text/javascript">
		$('document').ready(function(){
			@if(isset($delete_success_info))
				delete_success_info(<?php echo $delete_success_info; ?>);
			@endif

            @if(isset($update_success_info))
				update_success_info(<?php echo $update_success_info; ?>);
			@endif

            @if(isset($store_success_info))
				store_success_info(<?php echo $store_success_info; ?>);
			@endif

			@if(isset($delete_file_success_info))
				delete_file_success_info(<?php echo $delete_file_success_info; ?>);
			@endif

			@if(isset($redirect_to))
				redirect_to(<?php echo $redirect_to; ?>);
			@endif

			@if(isset($page_linker))
				page_linker(<?php echo $page_linker; ?>);
			@endif


        });
	</script>
	@yield('footerContent')
</body>
</html>
