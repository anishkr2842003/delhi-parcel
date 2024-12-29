  <!-- header links -->

  <!-- <link rel="shortcut icon" type="image/x-icon" href="../../../assets/images/logo.png"> -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../../code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="./plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="./plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="./plugins/toastr/toastr.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min2167.css?v=3.2.0">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Ui verse io toggle button css start -->

  <style>
    /* From Uiverse.io by Galahhad */
    .switch {
      /* switch */
      --switch-width: 46px;
      --switch-height: 24px;
      --switch-bg: rgb(131, 131, 131);
      --switch-checked-bg: rgb(0, 218, 80);
      --switch-offset: calc((var(--switch-height) - var(--circle-diameter)) / 2);
      --switch-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
      /* circle */
      --circle-diameter: 18px;
      --circle-bg: #fff;
      --circle-shadow: 1px 1px 2px rgba(146, 146, 146, 0.45);
      --circle-checked-shadow: -1px 1px 2px rgba(163, 163, 163, 0.45);
      --circle-transition: var(--switch-transition);
      /* icon */
      --icon-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
      --icon-cross-color: var(--switch-bg);
      --icon-cross-size: 6px;
      --icon-checkmark-color: var(--switch-checked-bg);
      --icon-checkmark-size: 10px;
      /* effect line */
      --effect-width: calc(var(--circle-diameter) / 2);
      --effect-height: calc(var(--effect-width) / 2 - 1px);
      --effect-bg: var(--circle-bg);
      --effect-border-radius: 1px;
      --effect-transition: all .2s ease-in-out;
    }

    .switch input {
      display: none;
    }

    .switch {
      display: inline-block;
    }

    .switch svg {
      -webkit-transition: var(--icon-transition);
      -o-transition: var(--icon-transition);
      transition: var(--icon-transition);
      position: absolute;
      height: auto;
    }

    .switch .checkmark {
      width: var(--icon-checkmark-size);
      color: var(--icon-checkmark-color);
      -webkit-transform: scale(0);
      -ms-transform: scale(0);
      transform: scale(0);
    }

    .switch .cross {
      width: var(--icon-cross-size);
      color: var(--icon-cross-color);
    }

    .slider {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      width: var(--switch-width);
      height: var(--switch-height);
      background: var(--switch-bg);
      border-radius: 999px;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      position: relative;
      -webkit-transition: var(--switch-transition);
      -o-transition: var(--switch-transition);
      transition: var(--switch-transition);
      cursor: pointer;
    }

    .circle {
      width: var(--circle-diameter);
      height: var(--circle-diameter);
      background: var(--circle-bg);
      border-radius: inherit;
      -webkit-box-shadow: var(--circle-shadow);
      box-shadow: var(--circle-shadow);
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-transition: var(--circle-transition);
      -o-transition: var(--circle-transition);
      transition: var(--circle-transition);
      z-index: 1;
      position: absolute;
      left: var(--switch-offset);
    }

    .slider::before {
      content: "";
      position: absolute;
      width: var(--effect-width);
      height: var(--effect-height);
      left: calc(var(--switch-offset) + (var(--effect-width) / 2));
      background: var(--effect-bg);
      border-radius: var(--effect-border-radius);
      -webkit-transition: var(--effect-transition);
      -o-transition: var(--effect-transition);
      transition: var(--effect-transition);
    }

    /* actions */

    .switch input:checked+.slider {
      background: var(--switch-checked-bg);
    }

    .switch input:checked+.slider .checkmark {
      -webkit-transform: scale(1);
      -ms-transform: scale(1);
      transform: scale(1);
    }

    .switch input:checked+.slider .cross {
      -webkit-transform: scale(0);
      -ms-transform: scale(0);
      transform: scale(0);
    }

    .switch input:checked+.slider::before {
      left: calc(100% - var(--effect-width) - (var(--effect-width) / 2) - var(--switch-offset));
    }

    .switch input:checked+.slider .circle {
      left: calc(100% - var(--circle-diameter) - var(--switch-offset));
      -webkit-box-shadow: var(--circle-checked-shadow);
      box-shadow: var(--circle-checked-shadow);
    }
  </style>

  <!-- Ui verse io toggle button css end -->


  <!-- footer links -->

  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="./plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="./plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="./plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="./plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="./plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="./plugins/moment/moment.min.js"></script>
  <script src="./plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="./plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="./plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="./plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="toast.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte2167.js?v=3.2.0"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="./dist/js/pages/dashboard.js"></script>
  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="./plugins/jszip/jszip.min.js"></script>
  <script src="./plugins/pdfmake/pdfmake.min.js"></script>
  <script src="./plugins/pdfmake/vfs_fonts.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Summernote -->
  <script src="./plugins/summernote/summernote-bs4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/dist/js/adminlte.min2167.js?v=3.2.0"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="/dist/js/demo.js"></script>