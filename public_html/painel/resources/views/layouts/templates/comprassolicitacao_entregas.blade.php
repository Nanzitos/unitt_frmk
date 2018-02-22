<?php 

	$Entregas = (isset($Model->entregas) && $Model->entregas)?json_decode($Model->entregas):array(); 
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
          	@if(isset($Entregas))
          	@foreach($Entregas AS $key => $val)
          	<div class="row EntregasRow">
	            <div class="col-sm-12">
	              <div class="row" style="margin-bottom:10px;">	              	
	              	<div class="col-xs-2">
	                  <input type="text" name="Entregas[{{ $ct }}][data]" class="form-control" placeholder="Data" value="{{ $val->data }}">
	                </div>
	                	                
	                <div class="col-xs-2">
	                  <input type="text" name="Entregas[{{ $ct }}][qtd]" class="form-control" placeholder="Quantidade" value="{{ $val->valor }}">
	                </div>	                
	              </div>
	            </div>
            </div>
            <?php $ct++;?>
            @endforeach
            @endif
            <div class="row" style="margin-bottom:20px;">	              	
          	  <div class="col-xs-2">
                <input type="text" id="qtdEntregas" name="Entregas[qtdEntregas]" class="form-control" placeholder="Qtd de Entregas">
              </div>

              <div class="col-xs-1">
              	<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="entregas">
                  <i class="icon-plus"></i>
              	</button>
              </div>
          	</div>    
          </div>
        </div>
	</div>
</div>