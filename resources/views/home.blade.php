@extends('layouts.default')

@section('headerContent')
	@yield('dynamicHeader')
@endsection

@section('content')

	@include('layouts.header')
	@yield('dynamicContent')
	@include('layouts.footer')

@endsection

@section('footerContent')
	@yield('dynamicFooter')
@endsection
