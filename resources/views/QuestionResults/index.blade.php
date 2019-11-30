<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ Admin::title() }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @if(!is_null($favicon = Admin::favicon()))
    <link rel="shortcut icon" href="{{$favicon}}">
    @endif

    {!! Admin::css() !!}

    <script src="{{ Admin::jQuery() }}"></script>
    {!! Admin::headerJs() !!}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition {{config('admin.skin')}} {{join(' ', config('admin.layout'))}}">

@if($alert = config('admin.top_alert'))
    <div style="text-align: center;padding: 5px;font-size: 12px;background-color: #ffffd5;color: #ff0000;">
        {!! $alert !!}
    </div>
@endif

<div class="wrapper">


    <div class="content-wrapper" id="pjax-container">
        {!! Admin::style() !!}
        <div id="app">
        {!!$gird !!}
        </div>
        {!! Admin::script() !!}
        {!! Admin::html() !!}
    </div>

    @include('admin::partials.footer')

</div>

<button id="totop" title="Go to top" style="display: none;"><i class="fa fa-chevron-up"></i></button>

<script>
    function LA() {}
    LA.token = "{{ csrf_token() }}";
    LA.user = {};
</script>

<!-- REQUIRED JS SCRIPTS -->
<script src="{{asset('vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/AdminLTE/dist/js/app.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/jquery-pjax/jquery.pjax.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/nprogress/nprogress.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/nestable/jquery.nestable.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/toastr/build/toastr.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/bootstrap3-editable/js/bootstrap-editable.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/laravel-admin/laravel-admin.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/AdminLTE/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/AdminLTE/plugins/input-mask/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/moment/min/moment-with-locales.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/bootstrap-fileinput/js/fileinput.min.js?v=4.5.2')}}"></script>
<script src="{{asset('vendor/laravel-admin/AdminLTE/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/number-input/bootstrap-number-input.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/AdminLTE/plugins/ionslider/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/bootstrap-switch/dist/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js')}}"></script>
<script src="{{asset('vendor/laravel-admin/bootstrap-fileinput/js/plugins/sortable.min.js?v=4.5.2')}}"></script>
<script src="{{asset('vendor/laravel-admin/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js')}}"></script>
</body>
</html>
