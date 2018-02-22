<?php /*
@if(isset($Model->id) && $Model->id)
<div class="card bg-white m-b">
  <div class="card-header">
    Permissões de tasks
  </div>
  <div class="card-block">
    <div class="row">
      <div class="col-sm-12">
        <div class="alert alert-info">
          <?php $TasksPermissoes = explode(',', App\Usuarios::find($Model->id)->tasks_permissoes);?>
          @foreach(App\TasksAreas::get() AS $TaskArea)
          <div class="cs-checkbox">
            <input name="TasksPermissoes[]" type="checkbox" id="task_{{ $TaskArea->id }}" value="{{ $TaskArea->id }}" <?php echo (in_array($TaskArea->id, $TasksPermissoes))?"checked='checked'":'';?>>
            <label for="task_{{ $TaskArea->id }}">{{ $TaskArea->nome }}</label>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@else
<div class="alert alert-warning"><i class="icon-close"> </i> Para visualizar esse campo, você precisa estar <b>editando</b> um registro.</div>
@endif */ ?>