<!-- PRIORIDADE DE CRIAÇÃO -->
<?php if( $TaskArea->id == 2 ):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	      <h4 class="modal-title" id="TaskTitulo"></h4>
	    </div>
	    <div class="modal-body">

        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <!-- Editar Task -->
        <div class="ButtonEditarTask">
          <input type="submit" class="btn btn-primary EditarTaskAberta" value="Editar Task" />
        </div>
        <!-- /Editar Task -->

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="4" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group">
              <label class="col-sm-2 control-label">Redator</label>
              <div class="col-sm-10">
                <select name="id_redator" id="id_redator" data-placeholder="Selecione um redator" class="form-control" style="width:90%;">
                <option value="">Selecione um redator</option>
                <option value="0">Não existe</option>
                @foreach(App\Usuarios::where('id_grupo',7)->get() AS $Usuario)
                <option value="{{ $Usuario->id }}">{{ $Usuario->nome.' '.$Usuario->sobrenome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group" style="margin-bottom:0;">
              <label class="col-sm-2 control-label">Prazo Redator</label>
              <div class="col-sm-10">
                <input type="text" name="prazo_redator" class="form-control m-b datepicker" placeholder="Selecione um prazo"  style="width:90%;">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Link Briefing Redator</label>
              <div class="col-sm-10">
                <input type="text" name="link_briefing_redator" id="link_briefing_redator" class="form-control" placeholder="Cole aqui o link do conteúdo" style="width:90%;">
                <br />
                <div class="alert alert-info" style="width:90%;">
                  Caso esteja usando um link compartilhado, lembre-se de dar permissões para todos.
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Diretor de arte</label>
              <div class="col-sm-10">
                <select name="id_layout" id="id_layout" data-placeholder="Selecione um diretor de arte" class="form-control" style="width:90%;">
                <option value="">Selecione um diretor de arte</option>
                <option value="0">Não existe</option>
                @foreach(App\Usuarios::where('id_grupo',8)->get() AS $Usuario)
                <option value="{{ $Usuario->id }}">{{ $Usuario->nome.' '.$Usuario->sobrenome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group" style="margin-bottom:0;">
              <label class="col-sm-2 control-label">Prazo DA</label>
              <div class="col-sm-10">
                <input type="text" name="prazo_da" class="form-control m-b datepicker" placeholder="Selecione um prazo"  style="width:90%;">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Link Briefing Criação</label>
              <div class="col-sm-10">
                <input type="text" name="link_briefing_layout" id="link_briefing_layout" class="form-control" placeholder="Cole aqui o link do conteúdo" style="width:90%;">
                <br />
                <div class="alert alert-info" style="width:90%;">
                  Caso esteja usando um link compartilhado, lembre-se de dar permissões para todos.
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">HTML</label>
              <div class="col-sm-10">
                <select name="id_layout" id="id_layout" data-placeholder="Selecione um diretor de arte" class="form-control" style="width:90%;">
                <option value="">Selecione um programador HTML</option>
                <option value="0">Não existe</option>
                @foreach(App\Usuarios::where('id_grupo',5)->get() AS $Usuario)
                <option value="{{ $Usuario->id }}">{{ $Usuario->nome.' '.$Usuario->sobrenome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group" style="margin-bottom:0;">
              <label class="col-sm-2 control-label">Prazo HTML</label>
              <div class="col-sm-10">
                <input type="text" name="prazo_frontend" class="form-control m-b datepicker" placeholder="Selecione um prazo"  style="width:90%;">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Link Briefing HTML</label>
              <div class="col-sm-10">
                <input type="text" name="comentarios_html" id="comentarios_html" class="form-control" placeholder="Cole aqui o link do conteúdo" style="width:90%;">
                <br />
                <div class="alert alert-info" style="width:90%;">
                  Caso esteja usando um link compartilhado, lembre-se de dar permissões para todos.
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Esforço/Tempo</label>
              <div class="col-sm-10">
                <select name="id_complexidade" data-placeholder="Selecione o esforço/tempo" class="form-control" style="width:90%;">
                  <option value="">Selecione o esforço/tempo</option>
                  @foreach(App\TasksComplexidades::get() AS $TaskComplexidade)
                  <option value="{{ $TaskComplexidade->id }}">{{ $TaskComplexidade->titulo }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Prioridade</label>
              <div class="col-sm-10">
                <select name="id_prioridade" data-placeholder="Selecione o esforço/tempo" class="form-control" style="width:90%;">
                  <option value="">Selecione a prioridade</option>
                  @foreach(App\TasksPrioridades::get() AS $TaskPrioridade)
                  <option value="{{ $TaskPrioridade->id }}">{{ $TaskPrioridade->titulo }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          
          </div>

          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Priorizar Task" />
          </div>

        </form>
	    </div>
	  </div>
	</div>
</div>
<?php endif;?>
<!-- /PRIORIDADE DE CRIAÇÃO -->

<!-- CRIAÇÃO REDAÇÃO -->
<?php if($TaskArea->id == 3):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="16" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group">
              <label class="col-sm-2 control-label">Link</label>
              <div class="col-sm-10">
                <input type="text" name="link_redacao" id="link_redacao" class="form-control" placeholder="Cole aqui o link do conteúdo" style="width:90%;">
                <br />
                <div class="alert alert-info" style="width:90%;">
                  Caso esteja usando um link compartilhado, lembre-se de dar permissões para todos.
                </div>
              </div>
            </div>
          
          </div>

          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-warning" id="VoltarTask" data-to="2">Voltar task</button>
            <button type="button" class="btn btn-danger" id="ApagarTask">Apagar task</button>
            <input type="submit" class="btn btn-primary" value="Finalizar Task" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<?php endif;?>
<!-- /CRIAÇÃO REDAÇÃO -->

<!-- CRIAÇÃO LAYOUT -->
<?php if($TaskArea->id == 4):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="17" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group">
              <label class="col-sm-2 control-label">Link</label>
              <div class="col-sm-10">
                <input type="text" name="link_layout" id="link_layout" class="form-control" placeholder="Cole aqui o link do layout/PSD" style="width:90%;">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Link</label>
              <div class="col-sm-10">
                <input type="text" name="link_jpg" id="link_jpg" class="form-control" placeholder="Cole aqui o link do JPG." style="width:90%;">
                <br />
                <div class="alert alert-info" style="width:90%;">
                  Caso esteja usando um link compartilhado, lembre-se de dar permissões para todos.
                </div>
              </div>
            </div>
          
          </div>

          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-warning" id="VoltarTask" data-to="2">Voltar task</button>
            <button type="button" class="btn btn-danger" id="ApagarTask">Apagar task</button>
            <input type="submit" class="btn btn-primary" value="Finalizar Task" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<?php endif;?>
<!-- /CRIAÇÃO LAYOUT -->

<!-- APROVAÇÃO CONCEITUAL -->
<?php if($TaskArea->id == 16):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
          
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="4" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="aprovado_conceito_em" value="{{ date('Y-m-d H:i:s') }}" />
          <input type="hidden" name="aprovado_conceito_por" value="{{ \Auth::user()->id }}" />

          <div class="form-group">
              <label class="col-sm-2 control-label">Link Briefing Layout</label>
              <div class="col-sm-10">
                <input type="text" name="link_briefing_layout" id="link_briefing_layout" class="form-control" placeholder="Cole aqui o link do conteúdo" style="width:90%;">
                <br />
                <div class="alert alert-info" style="width:90%;">
                  Caso esteja usando um link compartilhado, lembre-se de dar permissões para todos.
                </div>
              </div>
            </div>
          
          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a href="#ModalReprovarRedacao" class="btn btn-danger" data-toggle="modal">Reprovar Redação</a>
            <input type="submit" class="btn btn-success" value="Aprovar Task" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- REPROVAR REDAÇÃO -->
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalReprovarRedacao">
  <div class="modal-dialog" style="margin-top:120px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reprovação de redação</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" class="form-horizontal" action="">
          
          <div class="form-group">
            <div class="col-sm-12">
              <textarea class="form-control" id="ReprovarRedacaoTxt" rows="10" placeholder="Especifique em 300 caracteres o motivo da reprovação." maxlength="300"></textarea>
            </div>
          </div>
          
          <div class="modal-footer no-border" style="text-align:center;">
            <input type="submit" class="btn btn-danger" id="ReprovarRedacao" value="Reprovar" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- /REPROVAR REDAÇÃO -->

<?php endif;?>
<!-- /APROVAÇÃO CONCEITUAL -->

<!-- APROVACAO LAYOUT -->
<?php if($TaskArea->id == 17):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="7" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="aprovado_conceito_em" value="{{ date('Y-m-d H:i:s') }}" />
          <input type="hidden" name="aprovado_conceito_por" value="{{ \Auth::user()->id }}" />

          <div class="form-group">
              <label class="col-sm-2 control-label">Comentários HTML</label>
              <div class="col-sm-10">
                <textarea name="comentarios_html" class="form-control" rows="4" style="width:90%;"></textarea>
              </div>
            </div>
          
          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a href="#ModalReprovarLayout" class="btn btn-danger" data-toggle="modal">Reprovar Layout</a>
            <input type="submit" class="btn btn-success" value="Aprovar Task" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- REPROVAR LAYOUT -->
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalReprovarLayout">
  <div class="modal-dialog" style="margin-top:120px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reprovação de layout</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" class="form-horizontal" action="">
          
          <div class="form-group">
            <div class="col-sm-12">
              <textarea class="form-control" id="ReprovarLayoutTxt" rows="10" placeholder="Especifique em 300 caracteres o motivo da reprovação." maxlength="300"></textarea>
            </div>
          </div>
          
          <div class="modal-footer no-border" style="text-align:center;">
            <input type="submit" class="btn btn-danger" id="ReprovarLayout" value="Reprovar" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- /REPROVAR LAYOUT -->

<?php endif;?>
<!-- /APROVACAO LAYOUT -->


<!-- PRIORIDADE PROGRAMAÇÃO -->
<?php if($TaskArea->id == 6):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="11" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-sm-2 control-label">Programador Técnico</label>
              <div class="col-sm-10">
                <select name="id_programador_tecnico" id="id_programador_tecnico" data-placeholder="Selecione um programador" class="form-control" style="width:90%;">
                <option value="">Selecione um programador</option>
                <option value="0">Não existe</option>
                @foreach(App\Usuarios::where('id_grupo',6)->get() AS $Usuario)
                <option value="{{ $Usuario->id }}">{{ $Usuario->nome.' '.$Usuario->sobrenome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Esforço/Tempo</label>
              <div class="col-sm-10">
                <select name="id_complexidade_frontend" id="id_complexidade_frontend" data-placeholder="Selecione o esforço/tempo" class="form-control" style="width:90%;">
                  <option value="">Selecione o esforço/tempo</option>
                  @foreach(App\TasksComplexidades::get() AS $TaskComplexidade)
                  <option value="{{ $TaskComplexidade->id }}">{{ $TaskComplexidade->titulo }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Prazo</label>
              <div class="col-sm-10">
                <input type="text" name="prazo_programacao" id="prazo_programacao" class="form-control m-b datepicker" placeholder="Selecione um prazo"  style="width:90%;">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Descrição</label>
              <div class="col-sm-10">
                <textarea name="descricao_programacao_tecnica" class="form-control" rows="4" style="width:90%;"></textarea>
              </div>
            </div>
          
          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Priorizar Task" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<?php endif;?>
<!-- /PRIORIDADE PROGRAMAÇÃO -->

<!-- FILA DE PROGRAMAÇÃO -->
<?php if($TaskArea->id == 7):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="8" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
              <label class="col-sm-2 control-label">Link</label>
              <div class="col-sm-10">
                <input type="text" name="link_frontend" id="link_frontend" class="form-control" placeholder="Cole aqui o link do material" style="width:90%;">
                <br />
                <div class="alert alert-info" style="width:90%;">
                  Caso esteja usando um link compartilhado, lembre-se de dar permissões para todos.
                </div>
              </div>
            </div>
          
          </div>

          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-warning" id="VoltarTask" data-to="6">Voltar task</button>
            <button type="button" class="btn btn-danger" id="ApagarTask">Apagar task</button>
            <input type="submit" class="btn btn-primary" value="Finalizar Task" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<?php endif;?>
<!-- /FILA DE PROGRAMAÇÃO -->

<!-- APROVAÇÃO PROGRAMAÇÃO -->
<?php if($TaskArea->id == 8):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="6" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="aprovado_frontend_em" value="{{ date('Y-m-d H:i:s') }}" />
          <input type="hidden" name="aprovado_frontend_por" value="{{ \Auth::user()->id }}" />
          
          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a href="#ModalReprovarFrontend" class="btn btn-danger" data-toggle="modal">Reprovar Frontend</a>
            <input type="submit" class="btn btn-success" value="Aprovar Task" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- REPROVAR FRONTEND -->
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalReprovarFrontend">
  <div class="modal-dialog" style="margin-top:120px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reprovação de frontend</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" class="form-horizontal" action="">
          
          <div class="form-group">
            <div class="col-sm-12">
              <textarea class="form-control" id="ReprovarFrontendTxt" rows="10" placeholder="Especifique em 300 caracteres o motivo da reprovação." maxlength="300"></textarea>
            </div>
          </div>
          
          <div class="modal-footer no-border" style="text-align:center;">
            <input type="submit" class="btn btn-danger" id="ReprovarFrontend" value="Reprovar" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- /REPROVAR FRONTEND -->

<?php endif;?>
<!-- /APROVAÇÃO PROGRAMAÇÃO -->


<!-- PROGRAMACAO TECNICA -->
<?php if($TaskArea->id == 11):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="12" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
              <label class="col-sm-2 control-label">Link</label>
              <div class="col-sm-10">
                <input type="text" name="link_programacao_tecnica" id="link_programacao_tecnica" class="form-control" placeholder="Cole aqui o link do material" style="width:90%;">
                <br />
                <div class="alert alert-info" style="width:90%;">
                  Caso esteja usando um link compartilhado, lembre-se de dar permissões para todos.
                </div>
              </div>
          </div>

          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-success" value="Finalizar Task" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<?php endif;?>
<!-- /PROGRAMACAO TECNICA -->


<!-- APROVACAO PROGRAMACAO TECNICA -->
<?php if($TaskArea->id == 12):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="9" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <input type="hidden" name="aprovado_frontend_em" value="{{ date('Y-m-d H:i:s') }}" />
          <input type="hidden" name="aprovado_frontend_por" value="{{ \Auth::user()->id }}" />
          
          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a href="#ModalReprovarProgramacao" class="btn btn-danger" data-toggle="modal">Reprovar Programação</a>
            <input type="submit" class="btn btn-success" value="Aprovar Task" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- REPROVAR PROGRAMACAO TECNICA -->
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalReprovarProgramacao">
  <div class="modal-dialog" style="margin-top:120px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reprovação de programação tecnica</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" class="form-horizontal" action="">
          
          <div class="form-group">
            <div class="col-sm-12">
              <textarea class="form-control" id="ReprovarProgramacaoTecnicaTxt" rows="10" placeholder="Especifique em 300 caracteres o motivo da reprovação." maxlength="300"></textarea>
            </div>
          </div>
          
          <div class="modal-footer no-border" style="text-align:center;">
            <input type="submit" class="btn btn-danger" id="ReprovarProgramacaoTecnica" value="Reprovar" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- /REPROVAR PROGRAMACAO TECNICA -->

<?php endif;?>
<!-- /APROVACAO PROGRAMACAO TECNICA -->

<!-- TASKS FINALIZADAS -->
<?php if($TaskArea->id == 9):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="13" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <label class="col-sm-2 control-label">Data subida prevista</label>
            <div class="col-sm-10">
              <input type="text" name="data_subida_prevista" id="data_subida_prevista" class="form-control m-b datepicker" placeholder="Selecione uma data de subida"  style="width:90%;">
            </div>
          </div>
          
          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a href="#ModalReprovarCriacao" class="btn btn-danger" data-toggle="modal">Reprovar Criação</a>
            <a href="#ModalReprovarProgramacao" class="btn btn-danger" data-toggle="modal">Reprovar Programação</a>
            <input type="submit" class="btn btn-success" value="Finalizar" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- REPROVAR CRIACAO -->
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalReprovarCriacao">
  <div class="modal-dialog" style="margin-top:120px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reprovação de Criação</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" class="form-horizontal" action="">
          
          <div class="form-group">
            <div class="col-sm-12">
              <textarea class="form-control" id="ReprovarCriacaoTxt" rows="10" placeholder="Especifique em 300 caracteres o motivo da reprovação." maxlength="300"></textarea>
            </div>
          </div>
          
          <div class="modal-footer no-border" style="text-align:center;">
            <input type="submit" class="btn btn-danger" id="ReprovarCriacao" value="Reprovar" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- /REPROVAR CRIACAO -->

<!-- REPROVAR PROGRAMACAO -->
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalReprovarProgramacao">
  <div class="modal-dialog" style="margin-top:120px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reprovação de programação</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" class="form-horizontal" action="">
          
          <div class="form-group">
            <div class="col-sm-12">
              <textarea class="form-control" id="ReprovarProgramacaoTxt" rows="10" placeholder="Especifique em 300 caracteres o motivo da reprovação." maxlength="300"></textarea>
            </div>
          </div>
          
          <div class="modal-footer no-border" style="text-align:center;">
            <input type="submit" class="btn btn-danger" id="ReprovarProgramacao" value="Reprovar" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- /REPROVAR PROGRAMACAO -->

<?php endif;?>
<!-- /TASKS FINALIZADAS -->

<!-- AGUARDANDO SUBIDA -->
<?php if($TaskArea->id == 13):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
          
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="10" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          <div class="form-group">
            <label class="col-sm-2 control-label">Data subida</label>
            <div class="col-sm-10">
              <input type="text" name="data_subida" id="data_subida" class="form-control m-b datepicker" placeholder="Selecione uma data de subida"  style="width:90%;">
            </div>
          </div>
          
          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-success" value="Finalizar" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<?php endif;?>
<!-- /AGUARDANDO SUBIDA -->

<!-- TASKS NO AR -->
<?php if($TaskArea->id == 10):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="14" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <label class="col-sm-2 control-label">Data análise 1 prevista</label>
            <div class="col-sm-10">
              <input type="text" name="data_analise1_prevista" id="data_analise1_prevista" class="form-control m-b datepicker" placeholder="Selecione uma data"  style="width:90%;">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Data análise 2 prevista</label>
            <div class="col-sm-10">
              <input type="text" name="data_analise2_prevista" id="data_analise2_prevista" class="form-control m-b datepicker" placeholder="Selecione uma data"  style="width:90%;">
            </div>
          </div>
          
          
          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-success" value="Finalizar" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<?php endif;?>
<!-- /TASKS NO AR -->

<!-- AGUARDANDO ANÁLISE -->
<?php if($TaskArea->id == 14):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="15" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <label class="col-sm-2 control-label">Análise Desempenho 1</label>
            <div class="col-sm-10">
              <input type="text" name="link_analise1" id="link_analise1" class="form-control" placeholder="Cole aqui o link" style="width:90%;">
            </div>
          </div>

          <div class="form-group">
              <label class="col-sm-2 control-label">Análise Desempenho 2</label>
              <div class="col-sm-10">
                <input type="text" name="link_analise2" id="link_analise2" class="form-control" placeholder="Cole aqui o link" style="width:90%;">
                <br />
                <div class="alert alert-info" style="width:90%;">
                  Caso esteja usando um link compartilhado, lembre-se de dar permissões para todos.
                </div>
              </div>
          </div>

          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-success" value="Finalizar" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<?php endif;?>
<!-- /AGUARDANDO ANÁLISE -->

<!-- AVALICAO DE DESEMPENHO -->
<?php if($TaskArea->id == 15):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="18" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <label class="col-sm-2 control-label">Resultado</label>
            <div class="col-sm-10">
              <select name="id_resultado" id="id_resultado" data-placeholder="Selecione um redator" class="form-control" style="width:90%;">
                @foreach(App\TasksResultados::all() AS $Resultado)
                <option value="{{ $Resultado->nivel }}">{{ $Resultado->titulo }}</option>
                @endforeach
                </select>
            </div>
          </div>
          
          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-success" value="Finalizar" />
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<?php endif;?>
<!-- /AVALICAO DE DESEMPENHO -->

<!-- TASK ENCERRADA -->
<?php if($TaskArea->id == 18):?>
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalVerTask">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="TaskTitulo"></h4>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive flip-scroll TaskScrollArea">
          <table class="table table-bordered table-striped m-b-0">
            <tbody class="tasks-infos"></tbody>
          </table>
        </div>

        <form role="form" id="EditarTaskForm" method="POST" class="form-horizontal" action="{{ url('editar-task') }}">
          
          <input type="hidden" name="id" id="id_task" value="" />
          <input type="hidden" name="id_area" id="id_area" value="18" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <!--<div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-success" value="Finalizar" />
          </div>-->

        </form>
      </div>
    </div>
  </div>
</div>

<?php endif;?>
<!-- /TASK ENCERRADA -->


<!-- MODAL DESCRIÇÃO -->
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalDescricao">
  <div class="modal-dialog" style="margin-top:120px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Descrição</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" class="form-horizontal" action="">
          
          <div class="form-group">
            <div class="col-sm-12" id="TaskDescricao">
              <p id="TaskDescricao" style="padding:0 10px;"></p>
            </div>
          </div>
          
          <div class="modal-footer no-border" style="text-align:center;">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- /MODAL DESCRIÇÃO -->

<!-- MODAL IMPORTÂNCIA -->
<div class="modal bs-modal-sm in" aria-hidden="true" id="ModalImportancia">
  <div class="modal-dialog" style="margin-top:120px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Importância</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" class="form-horizontal" action="">
          
          <div class="form-group">
            <div class="col-sm-12">
              <p id="TaskImportancia" style="padding:0 10px;"></p>
            </div>
          </div>
          
          <div class="modal-footer no-border" style="text-align:center;">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- /MODAL IMPORTÂNCIA -->

