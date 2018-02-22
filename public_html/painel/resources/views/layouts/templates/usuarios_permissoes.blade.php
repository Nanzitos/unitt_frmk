@if(isset($Model->id) && $Model->id)
<div class="card bg-white m-b">
  <div class="card-header">
    Permissões do usuário
  </div>
  <div class="card-block">
    <div class="row">
      <div class="col-sm-12">
        <?php $AreasPermissoes = explode(',', App\Usuarios::find($Model->id)->areas_permissoes);?>
        @foreach(App\Areas::where(array('ativo' => 1, 'id_pai' => NULL))->orWhere(array('ativo' => 1, 'id_pai' => 0))->orderBy('order_by', 'asc')->get() AS $Area)
        <?php $Area->Subareas = App\Areas::where(array('ativo' => 1, 'id_pai' => $Area->id))->orderBy('order_by', 'asc')->get(); ?>
        <div class="alert alert-info">
          <div class="cs-checkbox">
            <input name="AreasPermissoes[]" type="checkbox" id="{{ 'r'.$Area->id }}" value="{{ $Area->id }}" <?php echo (in_array($Area->id, $AreasPermissoes))?"checked='checked'":'';?>>
            <label for="{{ 'r'.$Area->id }}"><i class="{{ $Area->icon }}"></i> {{ $Area->titulo }}</label>
          </div>
          @foreach($Area->Subareas AS $SubArea)
          <div class="cs-checkbox" style="padding-left:23px;">
            <input name="AreasPermissoes[]" type="checkbox" id="{{ 'r'.$SubArea->id }}" value="{{ $SubArea->id }}" <?php echo (in_array($SubArea->id, $AreasPermissoes))?"checked='checked'":'';?>>
            <label for="{{ 'r'.$SubArea->id }}"><i class="{{ $SubArea->icon }}"></i> {{ $SubArea->titulo }}</label>
          </div>
          @endforeach
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@else
<div class="alert alert-warning"><i class="icon-close"> </i> Para visualizar esse campo, você precisa estar <b>editando</b> um registro.</div>
@endif