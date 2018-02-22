@include('layouts.head')

<body class="page-loading">

  <!-- LOADER -->
  @include('layouts.loader')
  <!-- /LOADER -->
  
  <!-- ALL BEGIN HERE -->
  <div class="app layout-fixed-header">
  
    <!-- SIDEBAR -->
    @include('layouts.sidebar')
    <!-- /SIDEBAR -->

      <!-- CONTENT PANEL -->
      <div class="main-panel">
        
        <!-- TOP HEADER -->
        @include('layouts.top_header')
        <!-- /TOP HEADER -->

        <!-- MAIN AREA -->
        @yield('main')
        <!-- /MAIN AREA -->
      </div>
      <!-- /CONTENT PANEL -->


    <!-- FOOTER -->
    @include('layouts.footer')
    <!-- /FOOTER -->

    <!-- CHAT -->
    @include('layouts.chat')
    <!-- /CHAT -->

  </div>
  <!-- ALL END HERE -->

@include('layouts.bottom');