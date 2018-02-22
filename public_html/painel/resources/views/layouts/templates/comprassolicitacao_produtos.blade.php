<?php
	$Entregas = (isset($Model->entregas) && $Model->entregas)?json_decode($Model->entregas):array();
	$ct = 0;
?>


		<div class="card bg-white">
      <div class="card-block" id='selecioneProd'>
          <h4>Selecione Primeiro um Fornecedor</h1>
      </div>
			<input type="hidden" id="id_solicitacao" value="{{$Model->id}}" />
      <div style="position:relative; float:left; width: 100%;" id="divRetornoProd" style="display: none;">
      </div>

    </div>
