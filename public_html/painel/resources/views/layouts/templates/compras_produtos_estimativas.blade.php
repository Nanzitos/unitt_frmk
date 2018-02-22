<?php

	$Estimativas = (isset($Model))?$Model:array();
	//print_r(count($Estimativas)); exit;
	$ct = 0;

	$meses = array(
			1 => 'Janeiro',
			2 => 'Fevereiro',
			3 => 'Março',
			4 => 'Abril',
			5 => 'Maio',
			6 => 'Junho',
			7 => 'Julho',
			8 => 'Agosto',
			9 => 'Setembro',
			10 => 'Outubro',
			11 => 'Novembro',
			12 => 'Dezembro'
	);
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
          	@if($Estimativas->id)

          	<div class="row EstimativasRow">
	            <div class="col-sm-12">
	              <div class="row" style="margin-bottom:10px;">
	              	<div class="col-xs-1">
						<label>Ano</label>
	                  <input type="text" name="Estimativas[{{ $ct }}][ano]" value="2017" class="form-control" placeholder="Ano" value="{{ $Estimativas->ano }}">
	                </div>
	                <div class="col-xs-2">
						<label>Mês</label><br />
	                	<select name="Estimativas[{{ $ct }}][mes]" class="form-control">
	                  		<option value="">Mês</option>
							@foreach($meses AS $key => $val)
	                  		<option value="{{ $key }}" <?php echo ($key == $Estimativas->mes )?'selected="selected"':'';?>>{{ $val }}</option>
							@endforeach
						</select>
	                </div>
	                <div class="col-xs-2">
					  <label>Preço Médio</label>
	                  <input type="text" name="Estimativas[{{ $ct }}][preco_medio]" readonly="readonly" class="form-control float_number precoMedio" placeholder="Preço Médio" value="{{ $Estimativas->preco_medio }}">
	                </div>
	                <div class="col-xs-2">
						<label>Kit Médio</label>
	                  <input type="text" name="Estimativas[{{ $ct }}][kit_medio]" readonly="readonly" class="form-control kitMedio" placeholder="Kit Médio" value="{{ $Estimativas->kit_medio }}">
	                </div>
	                <div class="col-xs-2">
					  <label>Estimativa</label>
										<span class="input-group-addon" style="width: 20%;float:left;height: 34px;line-height: 20px;margin-top: 25px; padding: 6px 6px !important;">R$</span>
	                  <input style="width:80%;" type="text" name="Estimativas[{{ $ct }}][estimativa]" class="form-control estimativaMes" placeholder="Estimativa" value="{{ $Estimativas->estimativa }}">
	                </div>
	                <div class="col-xs-2">
						<label>Quantidade</label>
	                  <input type="text" name="Estimativas[{{ $ct }}][qtd]" readonly="readonly" class="form-control" placeholder="Quantidade" value="{{ $Estimativas->qtd }}">
	                </div>
	              </div>
	            </div>
            </div>

            @else
            <div class="row EstimativasRow">
				<div class="col-sm-12">
	              <div class="row" style="margin-bottom:10px;">
	              	<div class="col-xs-1">
						<label>Ano</label>
	                  <input type="text" name="Estimativas[{{ $ct }}][ano]" value="2017" class="form-control" placeholder="Ano">
	                </div>
	                <div class="col-xs-2">
						<label>Mês</label><br />
	                	<select name="Estimativas[{{ $ct }}][mes]" class="form-control">
	                  		<option value="">Mês</option>
							@foreach($meses AS $key => $val)
	                  		<option value="{{ $key }}">{{ $val }}</option>
							@endforeach
						</select>
	                </div>
	                <div class="col-xs-2">
					  <label>Preço Médio</label>
	                  <input type="text" name="Estimativas[{{ $ct }}][preco_medio]" readonly="readonly" class="form-control float_number precoMedio" placeholder="Preço Médio">
	                </div>
	                <div class="col-xs-2">
						<label>Kit Médio</label>
	                  <input type="text" name="Estimativas[{{ $ct }}][kit_medio]" readonly="readonly" class="form-control kitMedio" placeholder="Kit Médio">
	                </div>
	                <div class="col-xs-2">
					  <label>Estimativa</label>
										<span class="input-group-addon" style="width: 20%;float:left;height: 34px;line-height: 20px;margin-top: 25px; padding: 6px 6px !important;">R$</span>
	                  <input style="width: 80%;" type="text" name="Estimativas[{{ $ct }}][estimativa]" class="form-control estimativaMes" placeholder="Estimativa" style="width: 97%;">
	                </div>
	                <div class="col-xs-2">
						<label>Quantidade</label>
	                  <input type="text" name="Estimativas[{{ $ct }}][qtd]" readonly="readonly" class="form-control" placeholder="Quantidade">
	                </div>
	              </div>
	            </div>
            </div>
			@endif

          </div>
        </div>
	</div>
</div>
