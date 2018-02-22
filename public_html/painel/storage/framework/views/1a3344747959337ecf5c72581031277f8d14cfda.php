<?php if(isset($Model->id) && $Model->id): ?>
<div class="card bg-white m-b">
  <div class="card-header">
    Permissões do usuário
  </div>
  <div class="card-block">
    <div class="row">
      <div class="col-sm-12">
        <?php $AreasPermissoes = explode(',', App\Usuarios::find($Model->id)->areas_permissoes);?>
        <?php foreach(App\Areas::where(array('ativo' => 1, 'id_pai' => NULL))->orWhere(array('ativo' => 1, 'id_pai' => 0))->orderBy('order_by', 'asc')->get() AS $Area): ?>
        <?php $Area->Subareas = App\Areas::where(array('ativo' => 1, 'id_pai' => $Area->id))->orderBy('order_by', 'asc')->get(); ?>
        <div class="alert alert-info">
          <div class="cs-checkbox">
            <input name="AreasPermissoes[]" type="checkbox" id="<?php echo e('r'.$Area->id); ?>" value="<?php echo e($Area->id); ?>" <?php echo (in_array($Area->id, $AreasPermissoes))?"checked='checked'":'';?>>
            <label for="<?php echo e('r'.$Area->id); ?>"><i class="<?php echo e($Area->icon); ?>"></i> <?php echo e($Area->titulo); ?></label>
          </div>
          <?php foreach($Area->Subareas AS $SubArea): ?>
          <div class="cs-checkbox" style="padding-left:23px;">
            <input name="AreasPermissoes[]" type="checkbox" id="<?php echo e('r'.$SubArea->id); ?>" value="<?php echo e($SubArea->id); ?>" <?php echo (in_array($SubArea->id, $AreasPermissoes))?"checked='checked'":'';?>>
            <label for="<?php echo e('r'.$SubArea->id); ?>"><i class="<?php echo e($SubArea->icon); ?>"></i> <?php echo e($SubArea->titulo); ?></label>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
<div class="alert alert-warning"><i class="icon-close"> </i> Para visualizar esse campo, você precisa estar <b>editando</b> um registro.</div>
<?php endif; ?>