<?php
	$Telefones = (isset($Model->telefone))?json_decode($Model->telefone):array();
	$ct = 0;	
?>
<div class="row">
	<div class="col-sm-12">
		<div class="card bg-white">
          <div class="card-header bg-primary">
            <div class="pull-left">Registros</div>
            <div class="card-controls">
            </div>
          </div>
          <div class="card-block">
          	@if(isset($Telefones))
          	@foreach($Telefones AS $key => $val)
          	<div class="row TelefonesRow">
	            <div class="col-sm-12">
	              <div class="row" style="margin-bottom:10px;">
	                <div class="col-xs-4">
	                  <input type="text" name="telefone[{{ $ct }}][telefone]" class="form-control celular" placeholder="Telefone" value="{{ $val->telefone }}">
	                </div>
	                <div class="col-xs-2">
	                  <button type="button" data-action="del" class="btn btn-danger btn-round btn-icon-icon mr5 ActionButton" data-type="telefones">
		                  <i class="icon-close"></i>
		              </button>
	                </div>
	              </div>
	            </div>
            </div>
            <?php $ct++;?>
            @endforeach
            <div class="row TelefonesRow">
	            <div class="col-sm-12">
	              <div class="row" style="margin-bottom:10px;">
	                <div class="col-xs-4">
	                  <input type="text" name="telefone[{{ $ct+1 }}][telefone]" class="form-control celular" placeholder="Telefone">
	                </div>
	                <div class="col-xs-2">
	                  <button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="telefones">
		                  <i class="icon-plus"></i>
		              </button>
	                </div>
	              </div>
	            </div>
            </div>
            @else
            <div class="row TelefonesRow">
	            <div class="col-sm-12">
	              <div class="row" style="margin-bottom:10px;">
	                <div class="col-xs-4">
	                  <input type="text" name="telefone[{{ $ct }}][telefone]" class="form-control celular" placeholder="Telefone">
	                </div>
	                <div class="col-xs-2">
	                  <button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="telefones">
		                  <i class="icon-plus"></i>
		              </button>
	                </div>
	              </div>
	            </div>
            </div>
            @endif
          </div>
        </div>
	</div>
</div>
