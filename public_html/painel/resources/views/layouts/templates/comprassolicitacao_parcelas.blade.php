<?php 

	$Parcelas = (isset($Model->parcelas) && $Model->parcelas)?json_decode($Model->parcelas):array(); 
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
          	@if(isset($Parcelas))
          	@foreach($Parcelas AS $key => $val)
          	<div class="row ParcelasRow">
	            <div class="col-sm-12">
	              <div class="row" style="margin-bottom:10px;">	              	
	              	<div class="col-xs-2">
	                  <input type="text" name="Parcelas[{{ $ct }}][data]" class="form-control" placeholder="Data" value="{{ $val->data }}">
	                </div>
	                	                
	                <div class="col-xs-2">
	                  <input type="text" name="Parcelas[{{ $ct }}][valor]" class="form-control" placeholder="Valor" value="{{ $val->valor }}">
	                </div>	                
	              </div>
	            </div>
            </div>
            <?php $ct++;?>
            @endforeach
            @endif
            <div class="row" style="margin-bottom:20px;">	              	
          	  <div class="col-xs-2">
                <input type="text" id="qtdParcelas" name="Parcela[qtdParcelas]" class="form-control" placeholder="Qtd de Parcelas">
              </div>

              <div class="col-xs-1">
              	<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="parcelas">
                  <i class="icon-plus"></i>
              	</button>
              </div>
          	</div>                
          </div>
        </div>
	</div>
</div>