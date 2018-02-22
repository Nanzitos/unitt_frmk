<?php
	if(isset($Model->fornecedores)){
		$Fornecedores = $Model->fornecedores;

		$idFornecedores = array();
		$categoriaFornecedor = "";

		foreach ($Fornecedores as $key => $value) {

			$idFornecedores[] = $value->id;
			$categoriaFornecedor = $value->id_categoria_fornecedor;
			// print_r($value);
		}

		// var_dump($categoriaFornecedor); die();
		$idFornecedores = implode('-', $idFornecedores);
	}

?>



<div class="card bg-white">
	<div class="card-block" id='div-fornecedor'>
		<h4>Selecione Primeiro uma categoria</h1>
	</div>
<?php	if(isset($idFornecedores)){ ?>
	<input type="hidden" id="id_fornecedores" value="{{ $idFornecedores }}" />
	<input type="hidden" id="categoriaFornecedor" value="{{ $categoriaFornecedor }}" />
<?php } ?>



</div>
