@extends('home')

@section('dynamicHeader')
   @yield('reportHeader')
@endsection


@section('dynamicContent')

   <div class="container-fluid" data-appear-animation="zoomIn" data-appear-delay="1000">
      <div class="row">
         <div class="col-md-12 col-lg-12">

            @yield('reportContent')

         </div>
      </div>
   </div>
@endsection


@section('dynamicFooter')
   @yield('reportFooter')
@endsection