<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name='csrf-param' content='authenticity_token'>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>CUSTODE</title>

  <!-- Bootstrap -->
  {!!Html::style('vendors/bootstrap/dist/css/bootstrap.min.css')!!} 
  <!-- Font Awesome -->
  {!!Html::style('vendors/font-awesome/css/font-awesome.min.css')!!}

  {!!Html::style('vendors/select2/dist/css/select2.min.css')!!}
  <!-- iCheck -->
  <!-- {!!Html::style('vendors/iCheck/skins/flat/green.css')!!}-->
  <!-- bootstrap-progressbar -->
  {!!Html::style('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')!!}
  <!-- jVectorMap -->
  <!-- {!!Html::style('css/maps/jquery-jvectormap-2.0.3.css')!!} -->
  <!-- Custom Theme Style -->
  {!!Html::style('build/css/custom.css')!!}
  <!-- Kendo css-->
  {!!Html::style('css/kendo/kendo.common.min.css')!!}
  {!!Html::style('css/kendo/kendo.bootstrap.min.css')!!}
  <!-- msgbox css-->
  {!!Html::style('css/msgbox/jquery.msgbox.css')!!}

  <!-- Datatables -->
  
  {!!Html::style('vendors/datatable/css/jquery.dataTables.css')!!}

  {!!Html::style('css/general.css')!!}

  @yield('css')

</head>

<body class="nav-md">

  <div class="animacarga">

    <div class="cssload-thecube">
      <div class="cssload-cube cssload-c1"></div>
      <div class="cssload-cube cssload-c2"></div>
      <div class="cssload-cube cssload-c4"></div>
      <div class="cssload-cube cssload-c3"></div>
    </div>

  </div>

  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">

            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 522.301 199" enable-background="new 0 0 522.301 199" xml:space="preserve">
            <g id="XMLID_460_">
              <g id="XMLID_462_">
                <g>
                  <g>
                    <defs>
                      <path id="SVGID_1_" d="M136.559,19.021c0,0-48.561,20.641-53.521,40.479c-9.76,38.801-5.681,149.92-5.681,149.92L-7.2,184.301
                      L-22,52.063L23.84-20.5l74.159-3.92h9.2L136.559,19.021z"/>
                    </defs>
                    <clipPath id="SVGID_2_">
                      <use xlink:href="#SVGID_1_"  overflow="visible"/>
                    </clipPath>
                    <path id="XMLID_464_" clip-path="url(#SVGID_2_)" fill="#E7AE18" d="M135.679,70.141h-8.08
                    c0-35.039-21.601-56.961-51.359-56.961c-29.76,0-51.36,21.922-51.36,56.961H16.8c-7.04-0.078-6,0.08-6.16,5.682v76
                    c0,12-0.96,29.359,10.96,29.359h114.08c11.92,0,18.16-17.359,18.16-29.359v-76C153.84,63.9,147.599,70.141,135.679,70.141z
                    M89.76,160.781h-27.04l5.199-42.32c-5.279-2.961-8.88-11.6-8.88-18.16c0-9.68,7.761-18.961,17.359-18.961
                    c9.6,0,17.36,7.121,17.36,16.723c0,6.639-3.761,17.92-9.2,20.879L89.76,160.781z M41.12,70.141
                    c0-35.039,17.681-40.721,35.12-40.721c17.521,0,35.12,5.602,35.12,40.721H41.12z"/>
                  </g>
                </g>
              </g>
              <g enable-background="new    ">
                <path fill="#EAEAEA" d="M99.704,103.583c0-15.175,10.304-29.832,28.508-29.832c18.205,0,29.367,15.864,29.367,31.557
                c0,8.277,0,9.312-2.061,9.484l-22.498,1.207c-1.203,0.172-2.061-1.035-2.061-2.069v-12.761c0-2.069-1.374-3.449-2.748-3.449
                c-1.202,0-2.748,1.38-2.748,3.449v45.869c0,2.069,1.545,3.448,2.919,3.448c1.202,0,2.576-1.379,2.576-3.448v-11.036
                c0-1.035,0.687-1.725,1.889-1.725l22.841,1.207c1.202,0.173,1.889,1.035,1.889,2.069c0,11.726,0,39.661-30.054,39.661
                c-16.486,0-27.821-12.933-27.821-32.936V103.583z"/>
                <path fill="#EAEAEA" d="M163.416,75.476c0-1.035,0.516-1.725,1.374-1.725h21.639c0.858,0,1.374,0.518,1.374,1.38v65.872
                c0,2.586,1.546,3.448,2.748,3.448c1.374,0,2.748-0.862,2.748-3.448V75.131c0-0.862,0.516-1.38,1.202-1.38h22.326
                c0.859,0,1.545,0.518,1.545,1.207v101.05c0,0.689-0.515,1.207-1.374,1.207h-20.265c-1.03,0-2.061-6.035-3.091-6.035
                c-0.344,0-0.859,0.345-1.889,1.379c-3.091,2.932-6.011,4.656-12.193,4.656c-7.042,0-16.144-5.863-16.144-17.934V75.476z"/>
                <path fill="#EAEAEA" d="M257.868,109.618c-0.858,0.173-1.373-0.517-1.373-1.552c0-5.346-1.202-8.104-3.778-8.104
                c-1.374,0-2.576,1.207-2.576,3.104c0,3.622,5.152,8.795,14.598,17.417c10.133,8.967,14.426,16.382,14.426,27.418
                c0,14.829-7.385,29.314-28.337,29.314c-11.506,0-26.962-6.38-26.962-35.351c0-0.861,0.515-1.552,1.202-1.552l18.719-1.207
                c0.687,0,1.202,0.518,1.374,1.207c0.344,6.208,2.404,10.002,4.98,10.002c1.546,0,2.404-1.207,2.404-2.932
                c0-4.139-6.526-10.691-16.144-18.796c-7.041-5.69-13.224-15.002-13.224-27.936c0-15.347,12.193-26.9,27.478-26.9
                c20.609,0,29.367,16.037,29.367,33.108c0,0.862-0.858,1.552-1.717,1.552L257.868,109.618z"/>
                <path fill="#EAEAEA" d="M287.748,102.376c0-0.689-0.343-1.207-1.03-1.207c-3.606,0-3.95,0-3.95-1.207V74.786
                c0-0.518,0.344-1.035,0.688-1.035c3.95,0,4.293,0,4.293-1.207V57.369c0-0.689,0.516-1.207,1.202-1.207h24.73
                c1.718,0,1.718,0.345,1.718,1.552v14.485c0,1.034,0.515,1.552,1.373,1.552c5.324,0,5.84,0,5.84,1.207v25.004
                c0,0.689-0.516,1.207-1.202,1.207c-5.324,0-6.011,0-6.011,1.38V147.9c0,0.689,0.515,1.379,1.03,1.379c6.011,0,6.697,0,6.697,1.035
                c0,9.829,0,26.9-17.517,26.9c-10.305,0-17.861-6.38-17.861-27.073V102.376z"/>
                <path fill="#EAEAEA" d="M327.247,100.479c0-15.864,11.85-26.729,29.539-26.729c17.688,0,29.539,10.691,29.539,27.591v48.973
                c0,16.037-11.851,26.9-29.539,26.9c-17.518,0-29.539-11.036-29.539-26.9V100.479z M354.038,145.831
                c0,2.069,0.858,3.448,2.748,3.448c1.889,0,2.748-1.379,2.748-3.448V104.79c0-1.896-1.031-3.448-2.748-3.448
                c-1.89,0-2.748,1.552-2.748,3.448V145.831z"/>
                <path fill="#EAEAEA" d="M424.792,177.215c-0.858,0-2.575-4.311-3.263-4.311c-0.344,0-0.858,0.345-2.061,1.207
                c-2.404,1.896-6.011,3.104-9.961,3.104c-8.587,0-18.376-6.035-18.376-34.315v-36.04c0-26.211,10.647-33.108,19.578-33.108
                c3.95,0,7.213,1.207,9.617,3.621c0.858,0.862,1.374,1.207,1.718,1.207c0.172,0,0.515-0.345,0.515-1.379V47.023
                c0-0.862,0.688-1.725,1.546-1.725h22.326c0.858,0,1.545,0.517,1.545,1.379v128.985c0,0.862-0.858,1.552-1.545,1.552H424.792z
                M422.559,105.48c0-2.587-1.545-4.484-3.263-4.484c-1.546,0-2.232,1.553-2.232,3.276v43.283c0,1.034,0,3.276,2.232,3.276
                c0.687,0,1.374-0.346,1.889-0.862c0.688-0.69,1.374-1.725,1.374-3.276V105.48z"/>
                <path fill="#EAEAEA" d="M453.986,101.687c0-20.348,15.628-27.936,29.539-27.936c19.406,0,30.569,15.002,30.569,31.901v10.519
                c0,0.862-0.688,1.553-1.546,1.553h-28.68c-0.688,0-1.031,0.517-1.031,1.379v27.073c0,2.759,1.202,3.794,2.748,3.794
                c1.202,0,2.748-1.035,2.748-3.621v-10.52c0-0.689,0.515-1.379,1.546-1.379l22.154,1.207c1.03,0.172,1.717,0.862,1.717,1.896
                v11.036c0,22.072-15.113,28.625-30.913,28.625c-18.376,0-28.852-13.105-28.852-32.764V101.687z M482.838,107.549
                c0,0.518,0.516,0.862,1.031,0.862c3.949,0,4.465,0,4.465-0.862c0-11.036-0.172-12.243-2.92-12.243
                c-1.374,0-2.576,1.035-2.576,3.622V107.549z"/>
              </g>
            </g>
            <polygon id="XMLID_1_" opacity="0.13" fill="#95A4CF" enable-background="new    " points="25.439,69.82 40.719,69.82 40.96,63.021 
            25.439,67.42 "/>
            <polygon id="XMLID_6_" opacity="0.13" fill="#95A4CF" enable-background="new    " points="26,68.941 40.479,68.941 40.479,62.141 
            26,66.541 "/>
            <path id="XMLID_2_" opacity="0.13" fill="#95A4CF" enable-background="new    " d="M78.16,80.461l0.561-2.479
            c0,0-10.479-0.723-16.721,5.119c-6.239,5.84-7.521,11.6-7.76,16c-0.24,3.84,0.239,10.158,4.08,14.881
            c4.079,5.039,8.159,7.68,8.159,7.68l0.641-3.041c0,0-3.2-1.199-7.279-9.84c-2.961-6.24-1.12-13.521-1.12-13.521s1.76-6.318,5.68-10
            C69.28,80.621,78.16,80.461,78.16,80.461z"/>
            <path id="XMLID_7_" opacity="0.13" fill="#95A4CF" enable-background="new    " d="M78.399,79.9l0.561-2.48
            c0,0-11.119-0.639-18.319,5.76c-6.399,5.682-7.521,11.602-7.761,16c-0.239,3.842,0.24,10.16,4.08,14.883
            c4.08,5.039,9.2,8.639,9.2,8.639l0.641-3.039c0,0-4.16-2.16-8.24-10.721c-2.96-6.24-1.12-13.521-1.12-13.521s1.761-6.318,5.681-10
            C68,80.621,78.399,79.9,78.399,79.9z"/>
            <polygon id="XMLID_3_" opacity="0.13" fill="#95A4CF" enable-background="new    " points="63.76,139.82 58.639,162.781 
            74.719,162.781 75.76,161.18 62.08,161.18 65.2,135.58 "/>
            <polygon id="XMLID_8_" opacity="0.13" fill="#95A4CF" enable-background="new    " points="63.12,139.82 58,163.58 74.16,163.58 
            75.2,161.58 61.519,161.58 66,128.541 "/>
            <polygon id="XMLID_5_" opacity="0.13" fill="#95A4CF" enable-background="new    " points="68.399,180.541 75.76,180.541 
            75.76,162.781 74.559,165.26 74.639,179.34 "/>
            <polygon id="XMLID_4_" opacity="0.13" fill="#95A4CF" enable-background="new    " points="67.92,180.701 75.92,180.701 76,161.58 
            74.8,165.26 75.28,179.74 "/>
            <linearGradient id="XMLID_11_" gradientUnits="userSpaceOnUse" x1="-168.5173" y1="-328.0986" x2="-158.6535" y2="-328.0986" gradientTransform="matrix(0.8 0 0 0.8 148.4299 388.7008)">
              <stop  offset="0" style="stop-color:#FFFFFF;stop-opacity:0"/>
              <stop  offset="1" style="stop-color:#95A4CF"/>
            </linearGradient>
            <path id="XMLID_9_" opacity="0.31" fill="url(#XMLID_11_)" enable-background="new    " d="M18.399,74.301c0,0-1.039,70.16,0,91.199
            c0.32,7.041,5.2,12.801,2,12.641c-2.64-0.158-7.76-4.398-6.64-12.158c0.88-6.24,0-91.682,0-91.682H18.399L18.399,74.301z"/>
            <rect id="_x3C_Sector_x3E_" x="0.8" y="9.74" fill="none" width="653.601" height="176"/>
          </svg>

        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
          <!-- <div class="profile">
            <div class="profile_pic">
              <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>John Doe</h2>
            </div>
          </div>  Esta seria usada en caso que este manejando usuarios con avatar   --> 
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          @include('layouts.admin.menusliderbar')
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <!--@include('layouts.admin.menufootherslider')-->
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->

      @include('layouts.admin.menutop')

      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         @yield('content')
       </div>


     </div>
     <!-- /page content -->

     <!-- footer content -->
     <footer>
      <div class="pull-right">
        Ceindetec llanos - 2016
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
  </div>
</div>


<!-- Modal Bootstrap-->
<div id='modalBs' class='modal fade bs-example-modal-lg'>
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>

<!-- jQuery -->
{!!Html::script('vendors/jquery/dist/jquery.min.js')!!}
<!-- Bootstrap -->
{!!Html::script('vendors/bootstrap/dist/js/bootstrap.min.js')!!}
<!-- FastClick -->
<!-- {!!Html::script('vendors/fastclick/lib/fastclick.js')!!} -->
<!-- NProgress -->
<!-- {!!Html::script('vendors/nprogress/nprogress.js')!!} -->
<!-- Chart.js -->
<!-- {!!Html::script('vendors/Chart.js/dist/Chart.min.js')!!} -->
<!-- gauge.js -->
<!-- {!!Html::script('vendors/gauge.js/dist/gauge.min.js')!!} -->
<!-- bootstrap-progressbar -->
{!!Html::script('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')!!}
<!-- iCheck -->
<!-- {!!Html::script('vendors/iCheck/icheck.min.js')!!} -->
<!-- Skycons -->
<!-- {!!Html::script('vendors/skycons/skycons.js')!!} -->
<!-- Flot -->
<!-- {!!Html::script('vendors/Flot/jquery.flot.js')!!}
{!!Html::script('vendors/Flot/jquery.flot.pie.js')!!}
{!!Html::script('vendors/Flot/jquery.flot.time.js')!!}
{!!Html::script('vendors/Flot/jquery.flot.stack.js')!!}
{!!Html::script('vendors/Flot/jquery.flot.resize.js')!!} -->
<!-- Flot plugins -->
<!-- {!!Html::script('js/flot/jquery.flot.orderBars.js')!!}
{!!Html::script('js/flot/date.js')!!}
{!!Html::script('js/flot/jquery.flot.spline.js')!!}
{!!Html::script('js/flot/curvedLines.js')!!} -->
<!-- jVectorMap -->
<!-- {!!Html::script('js/maps/jquery-jvectormap-2.0.3.min.js')!!} -->
<!-- bootstrap-daterangepicker -->
{!!Html::script('js/moment/moment.min.js')!!}
{!!Html::script('js/datepicker/daterangepicker.js')!!}

<!-- Datatables -->
{!!Html::script('vendors/datatable/js/jquery.dataTables.js')!!}


{!!Html::script('/vendors/select2/dist/js/select2.full.min.js')!!}

<!-- Custom Theme Scripts -->
{!!Html::script('build/js/custom.min.js')!!}

<!-- msgbox js-->
{!!Html::script('js/msgbox/jquery.msgbox.js')!!}

<!-- moment js-->
{!!Html::script('js/moment/moment.min.js')!!}

<!--kendojs -->
{!!Html::script('js/kendo/kendo.all.min.js')!!}
{!!Html::script('js/kendo/cultures/kendo.culture.es-ES.min.js')!!}
{!!Html::script('js/kendo/lang/kendo.es-ES.js')!!}


<script type="text/javascript">
kendo.culture("es-ES");
</script>

{!!Html::script('js/inicio.js')!!}  


<!-- jVectorMap -->
<!--{!!Html::script('js/maps/jquery-jvectormap-world-mill-en.js')!!}
{!!Html::script('js/maps/jquery-jvectormap-us-aea-en.js')!!}
{!!Html::script('js/maps/gdp-data.js')!!}-->

@yield('scripts')

</body>
</html>