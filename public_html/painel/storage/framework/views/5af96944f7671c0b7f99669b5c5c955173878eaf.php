<?php echo $__env->make('layouts.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style media="screen">
.container {
  max-width: 490px;
  margin: 0 auto;
  padding: 10% 0;
  height: auto;
  text-align: center;
}
.login-bg{
  background: rgba(0, 0, 0, 0.7);
  color: white;
  border-radius: 1rem;
  padding: 2em;
}
input{    border-radius: 3px !important;
  transition: all 1s !important;
  margin: 0 auto 10px auto;
}
body{background: -webkit-linear-gradient(top left, #e0854f 0%, #cc5a7a 100%);
  background: -moz-linear-gradient(top left, #e0854f 0%, #cc5a7a 100%);
  background: -o-linear-gradient(top left, #e0854f 0%, #cc5a7a 100%);
  background: linear-gradient(to bottom right, #e0854f 0%, #cc5a7a 100%);
}
.btn-primary {
  color: #fff;
  background-color: #3b9a58;
  border-color: rgb(66, 66, 66);
}
</style>
<body class="page-loading">

  <!-- LOADER -->
  <?php echo $__env->make('layouts.loader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- /LOADER -->
  <section>
    <!-- ALL BEGIN HERE -->
    <div class="container">
      <div class="row">
        <div class="text-left login-bg">
          <!-- LOGIN -->
          <form action="<?php echo e(url('login')); ?>" class="form-layout" id="LoginForm" role="form" method="POST">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="text-center m-b">
              <h4 class="text-uppercase"><?php echo e(trans('login.title')); ?></h4>
              <p><?php echo e(trans('login.subtitle')); ?></p>
            </div>
            <?php foreach(App\Http\Controllers\UsuariosController::getConfigFile()['fields'] AS $field): ?>
            <div class="form-group">
              <?php echo e(FormHelper::getInput($field)); ?>

            </div>
            <?php endforeach; ?>
            <input type="submit" value="<?php echo e(trans('login.button')); ?>" class="btn btn-primary btn-block btn-lg m-b" />
            <a href="#EsqueciSenha" data-toggle="modal" class="btn btn-block no-bg btn-lg m-b" href="extras-signin.html"><?php echo e(trans('login.forgotten')); ?></a>
            <p class="text-center">
              <small>
                <em></em>
              </small>
            </p>
          </form>
          <!-- /LOGIN -->
        </div>
      </div>
    </div>
    <!-- ALL END HERE -->
  </section>
  <?php echo $__env->make('layouts.bottom', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
