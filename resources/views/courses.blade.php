@extends('home')

@section('dynamicHeader')
   @yield('coursesHeader')
@endsection


@section('dynamicContent')

   <div class="container-fluid" data-appear-animation="fadeIn" data-appear-delay="1000">
      <div class="row">
         <div class="col-md-12 col-lg-12">

            @yield('coursesContent')

         </div>
      </div>
   </div>
@endsection


@section('dynamicFooter')
   @yield('coursesFooter')
@endsection