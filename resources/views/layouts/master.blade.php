<!DOCTYPE html>
<html>

<head>
   @include('partials.header')

</head>
<body>
<div class="main-wrapper">
    @include('partials.navbar')
    @include('partials.sidebar')
    @yield('content')
</div>
<div class="sidebar-overlay" data-reff="#sidebar"></div>
<script type="text/javascript" src="{{URL::to('assets/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/js/jquery.slimscroll.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/js/moment.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('assets/js/app.js')}}"></script>
</body>
</html>
