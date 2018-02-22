<div class="modal bs-modal-sm in" aria-hidden="true" id="NovaTaskModal">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	      <h4 class="modal-title">Nova Task</h4>
	    </div>
	    <div class="modal-body">
	      <p>Preencha todas as informações abaixo</p><br />
	      <form role="form" id="NovaTaskForm" method="POST" class="form-horizontal" action="{{ url('nova-task') }}">
          <input type="hidden" name="id_area" value="2" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
	        <div class="form-group">
              <label class="col-sm-2 control-label">Solicitante</label>
              <div class="col-sm-10" style="padding-top:7px;">
                <!--<select name="id_usuario" data-placeholder="Selecione um solicitante" class="form-control" style="width:90%;">
                <option value="">Selecione um solicitante</option>
                @foreach(App\Usuarios::where('id_grupo',4)->orWhere('id_grupo',1)->get() AS $Usuario)
                <option value="{{ $Usuario->id }}">{{ $Usuario->nome.' '.$Usuario->sobrenome }}</option>
                @endforeach
                </select>-->
                <input type="hidden" name="id_usuario" id="id_usuario" value="{{ \Auth::user()->id }}" />
                {{ \Auth::user()->nome.' '.\Auth::user()->sobrenome }}
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10">
                <input type="text" name="nome" placeholder="Digite um nome para task" class="form-control" style="width:90%;">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Marca</label>
              <div class="col-sm-10">
                <select name="id_marca" data-placeholder="Selecione uma marca" class="form-control" style="width:90%;">
                <option value="">Selecione uma marca</option>
                @foreach(App\Marcas::all() AS $Marca)
                <option value="{{ $Marca->id }}">{{ $Marca->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Categoria</label>
              <div class="col-sm-10">
                <select name="id_categoria" data-placeholder="Selecione uma categoria" class="form-control" style="width:90%;">
                <option value="">Selecione uma categoria</option>
                @foreach(App\TasksCategorias::all() AS $TaskCategoria)
                <option value="{{ $TaskCategoria->id }}">{{ $TaskCategoria->titulo }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Tipo</label>
              <div class="col-sm-10">
                <select name="id_tipo" data-placeholder="Selecione um tipo" class="form-control" style="width:90%;">
	                <option value="">Selecione um tipo</option>
	                @foreach(App\TasksTipos::all() AS $TaskTipo)
	                <option value="{{ $TaskTipo->id }}">{{ $TaskTipo->titulo }}</option>
	                @endforeach
                </select>
              </div>
            </div>
	
			      <div class="form-group">
              <label class="col-sm-2 control-label">Descrição</label>
              <div class="col-sm-10">
                <textarea name="descricao" class="form-control" maxlength="1000" rows="4" style="width:90%; height:230px;"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Importância</label>
              <div class="col-sm-10">
                <textarea name="importancia" class="form-control" maxlength="200" rows="4" style="width:90%;"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Recorrência</label>
              <div class="col-sm-10">
                <select name="id_recorrencia" data-placeholder="Selecione uma recorrência" class="form-control" style="width:90%;">
                <option value="">Selecione uma recorrência</option>
                @foreach(App\TasksRecorrencias::all() AS $Recorrencia)
                <option value="{{ $Recorrencia->id }}">{{ $Recorrencia->titulo }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Enviar direto para</label>
              <div class="col-sm-10">
                <select name="id_area" data-placeholder="Selecione para onde deseja enviar" class="form-control" style="width:90%;">
                  <option value="">Selecione para onde deseja enviar</option>
                  @foreach(App\TasksAreas::where('id','!=',1)->get() AS $TaskArea)
                  <option value="{{ $TaskArea->id }}">{{ $TaskArea->nome }}</option>
                  @endforeach
                </select>
                <br /><small>Campo opcional</small>
              </div>
            </div>

	    </div>
	    
      <div class="modal-footer no-border">
				<button type="button" class="btn btn-default" id="CancelarTask">Cancelar</button>
				<input type="submit" class="btn btn-primary" value="Criar Task" />
	    </div>

	    </form>
	  </div>
	</div>
</div>