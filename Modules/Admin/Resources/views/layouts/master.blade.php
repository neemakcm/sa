<!DOCTYPE html>
<html lang="en" dir="">
<head>
    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Impex Admin</title>
    <link rel="icon" href="{{asset('public/admins/images/favicon.png')}}" type="image/gif" sizes="32x32">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{asset('public/admins/css/themes/lite-purple.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/admins/css/plugins/perfect-scrollbar.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('public/admins/css/plugins/datatables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/admins/plugin/datatable/buttons.dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/admins/css/plugins/sweetalert2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('public/admins/css/style.css')}}" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" /> -->
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('public/admins/plugin/datepick/datepicker.min.css')}}">
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('public/admins/plugin/line-icons/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admins/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('public/admins/css/image-uploader.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admins/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('public/admins/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('public/admins/css/select2.css')}}">

    <link rel="stylesheet" href="{{asset('public/admins/plugin/grapejs/dist/css/grapes.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/admins/css/dev.css')}}">
    <link rel="icon" href="{{asset('public/admins/images/favicon.png')}}" type="image/gif" sizes="16x16">

    <script src="{{asset('public/admins/js/plugins/jquery-3.3.1.min.js')}}"></script>

    <script src="{{asset('public/admins/plugin/grapejs/dist/grapes.min.js')}}"></script>
    <script src="{{asset('public/admins/plugin/grapejs/dist/grapesjs-blocks-bootstrap4.min.js')}}"></script>
    @yield('css')
    <script type="text/javascript">
        var base_url="{{url('/')}}";
        var storage_url="{{storage_url()}}";
    </script>
</head>

    @yield('content')
<script>
        $(".allow_decimal").on("input", function(evt) {
   var self = $(this);
   self.val(self.val().replace(/[^0-9\.]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
 });
    </script>
    <script src="{{asset('public/admins/js/plugins/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/admins/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('public/admins/js/scripts/script.min.js')}}"></script>
    <script src="{{asset('public/admins/js/scripts/sidebar.large.script.min.js')}}"></script>
    <script src="{{asset('public/admins/js/plugins/echarts.min.js')}}"></script>
    <script src="{{asset('public/admins/js/scripts/echart.options.min.js')}}"></script>
    <script src="{{asset('public/admins/js/plugins/datatables.min.js')}}"></script>
    <script src="{{asset('public/admins/js/scripts/datatables.script.min.js')}}"></script>
    <script src="{{asset('public/admins/plugin/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('public/admins/plugin/datatable/buttons.flash.min.js')}}"></script>
    <script src="{{asset('public/admins/plugin/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('public/admins/plugin/datatable/buttons.print.min.js')}}"></script>
    <script src="{{asset('public/admins/plugin/datatable/jszip.min.js')}}"></script>
    <script src="{{asset('public/admins/plugin/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('public/admins/plugin/datatable/vfs_fonts.js')}}"></script>
    <script src="{{asset('public/admins/js/scripts/dashboard.v2.script.min.js')}}"></script>
    <script src="{{asset('public/admins/js/scripts/customizer.script.min.js')}}"></script>
    <script src="{{asset('public/admins/js/plugins/sweetalert2.min.js')}}"></script>
    <script src="{{asset('public/admins/js/scripts/sweetalert.script.min.js')}}"></script>
    <!-- Datepicker -->
    <script src="{{asset('public/admins/plugin/datepick/datepicker.js')}}"></script>
    <script src="{{asset('public/admins/plugin/datepick/date.js')}}"></script>

    <script src="{{asset('public/admins/js/custom.js')}}"></script>
    <script src="{{asset('public/admins/js/custom-charts.js')}}"></script>
    <script src="{{asset('public/admins/js/jquery-ui.js')}}"></script>
    <script src="{{asset('public/admins/js/image-uploader.min.js')}}"></script>
    <script src="{{asset('public/admins/js/underscore-min.js')}}"></script>
    <script src="{{asset('public/admins/js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('public/admins/js/jquery.magnific-popup.js')}}"></script>
    <script src="{{asset('public/admins/js/select2.js')}}"></script>
    <script src="{{asset('public/admins/js/jquery.form.js')}}"></script>
    <script src="{{asset('public/admins/js/slick.min.js')}}"></script>
   
<script src="https://cdn.tiny.cloud/1/nf841dplucdcpncsht4deig4ag4kgdnz3lq23hlxwh5uiesm/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('public/admins/js/dev.js')}}"></script>
    <script src="{{asset('public/admins/js/moment.min.js')}}"></script>
    @yield('script')

</body>

</html>
