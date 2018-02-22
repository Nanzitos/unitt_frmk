<?php echo $__env->make('layouts.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body class="page-loading">

  <!-- LOADER -->
  <?php echo $__env->make('layouts.loader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- /LOADER -->
  
  <!-- ALL BEGIN HERE -->
  <div class="app layout-fixed-header">
  
    <!-- SIDEBAR -->
    <?php echo $__env->make('layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- /SIDEBAR -->

      <!-- CONTENT PANEL -->
      <div class="main-panel">
        
        <!-- TOP HEADER -->
        <?php echo $__env->make('layouts.top_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- /TOP HEADER -->

        <!-- MAIN AREA -->
        <?php echo $__env->yieldContent('main'); ?>
        <!-- /MAIN AREA -->
      </div>
      <!-- /CONTENT PANEL -->


    <!-- FOOTER -->
    <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- /FOOTER -->

    <!-- CHAT -->
    <?php echo $__env->make('layouts.chat', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- /CHAT -->

  </div>
  <!-- ALL END HERE -->

<?php echo $__env->make('layouts.bottom', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;