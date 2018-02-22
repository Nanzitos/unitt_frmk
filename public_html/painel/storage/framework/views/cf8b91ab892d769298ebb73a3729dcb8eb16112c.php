<div class="sidebar-panel offscreen-left">
  <div class="brand">
    <!-- toggle small sidebar menu -->
    <a href="javascript:;" class="toggle-apps hidden-xs" data-toggle="quick-launch">
      <i class="icon-grid"></i>
    </a>
    <!-- /toggle small sidebar menu -->
    <!-- toggle offscreen menu -->
    <div class="toggle-offscreen">
      <a href="javascript:;" class="visible-xs hamburger-icon" data-toggle="offscreen" data-move="ltr">
        <span></span>
        <span></span>
        <span></span>
      </a>
    </div>
    <!-- /toggle offscreen menu -->
    <!-- logo -->
      <a href="<?php echo e(url('perfil/')); ?>" class="brand-logo" style="padding: 10px;">ADM AFIA</a>

    <a href="<?php echo e(url('perfil/')); ?>" class="small-menu-visible brand-logo">AFIA</a>
    <!-- /logo -->
  </div>
  <!-- main navigation -->
  <nav role="navigation">
    <ul class="nav">
      <?php $AreasPermissoes = explode(',', \Auth::user()->areas_permissoes); ?>
      <?php foreach(App\Areas::where(array('ativo' => 1, 'id_pai' => NULL))->orWhere(array('ativo' => 1, 'id_pai' => 0))->orderBy('order_by', 'asc')->get() AS $Area): ?>
      <?php $Area->Subareas = App\Areas::where(array('ativo' => 1, 'id_pai' => $Area->id))->orderBy('order_by', 'asc')->get(); ?>
      <?php if(in_array($Area->id, $AreasPermissoes) || \Auth::user()->superadmin ): ?>
      <?php if($Area->controller): ?>
      <li>
        <a href="<?php echo e(url($Area->url)); ?>">
          <i class="<?php echo e($Area->icon); ?>"></i>
          <span><?php echo e($Area->titulo); ?></span>
        </a>
      </li>
      <?php else: ?>
      <li class="menu-accordion">
        <?php
          $style = '';
          if($Area->super_admin){
            $style = 'background-color:#6164C1 !important; color:#FFF !important;';
          }
        ?>
        <a href="javascript:;" style="<?php echo e($style); ?>">
            <i class="<?php echo e($Area->icon); ?>"></i>
            <span><?php echo e($Area->titulo); ?></span>
          </a>
          <ul class="sub-menu">
            <?php foreach($Area->Subareas AS $SubArea): ?>
            <?php if( in_array($SubArea->id, $AreasPermissoes) || \Auth::user()->superadmin ): ?>
            <li>
              <a href="<?php echo e(url($SubArea->url)); ?>">
                <i class="<?php echo e($SubArea->icon); ?>"></i>
                <span><?php echo e($SubArea->titulo); ?></span>
              </a>
            </li>
            <?php endif; ?>
            <?php endforeach; ?>
          </ul>
      </li>
      <?php endif; ?>
      <?php endif; ?>
      <!-- /<?php echo e(strtolower($Area->titulo)); ?> -->
      <?php endforeach; ?>
    </ul>
  </nav>
  <!-- /main navigation -->
</div>
