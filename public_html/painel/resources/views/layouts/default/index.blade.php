@extends('layouts.master')
@section('main')

<div class="main-content">
	<div class="page-title">
	  <div class="title">{{ $Area->titulo }}</div>
	  <div class="sub-title">{{ $Area->subtitulo }}</div>
	</div>
	<div class="card bg-white m-b" >
	  <div class="card-header">
	    <div class="row">
	    	<div class="col-sm-6">
	    		{{ $Area->descricao }}
	    		<?php

	    			$filtros = [];

	    			if( isset($_GET['filtros']) ){

	    				foreach($_GET AS $filtro){
		    				$filtros[] = $filtro;
		    			}
		    		}

	    		?>
	    		@if(count($filtros))
			  	<!--<input id="filtros" type="text" value="{{ implode(',',$filtros) }}" />-->
			  	@endif
	    	</div>
	    	<div class="col-sm-6" style="text-align:right;">
	    		@if($Controller->novo_registro)
		    		<a href="{{ url($Area->url.'/form/') }}" class="btn btn-primary btn-sm btn-icon mr5">
	                  <i class="icon-plus"></i>
	                  <span>Novo registro</span>
	                </a>
	            @endif
                <?php if(isset($ConfigFile['extra_buttons'])): ?>
		    	<?php foreach($ConfigFile['extra_buttons'] AS $button): ?>
		    	<?php

		    		$data_attr = '';

		    		if(isset($button['data'])){
			    		foreach( $button['data'] AS $key => $val ){
			    			$data_attr.=" data-".$key."=".$val."";
			    		}
			    	}

		    	?>
		    	<a href="{{ $button['url'] }}" class="btn btn-sm btn-icon mr5 {{ $button['class'] }}" id="{{ $button['id'] }}" {{ $data_attr }}>
                  <i class="{{ $button['icon'] }}"></i>
                  <span>{{ $button['titulo'] }}</span>
                </a>
		    	<?php endforeach;?>
		    	<?php endif;?>
	    	</div>

	    </div>
	  </div>
	  <div class="card-block">
	  	<div class="table-responsive">
	  	<div class="table-responsive" style="overflow-y: auto;">
		    <table class="table table-bordered table-striped m-b-0 responsive m-b-0">
		      <thead>
		        <tr>
		        @foreach($ConfigFile['list_fields'] AS $value => $field)
		        	<th><b>{{ $field }}</b></th>
		        @endforeach
		        @if($Controller->index_acoes)
		        	<th><b>Ações</b></th>
		        @endif
		        </tr>
		      </thead>
		      <tbody>
		      	@if(count($Model))
		      	@foreach($Model AS $key => $val)
	      		<tr>
	        		@foreach($ConfigFile['list_fields'] AS $value => $field)
	        		<?php

	        			$method_test = 'get_'.$value;

						if(method_exists($val, $method_test)){
							$value = $val->$method_test($val);
	        			} else {
	        				$value = $val->$value;
	        			}

	        		?>
	        		<td>{!! $value !!}</td>
	        		@endforeach
	        		@if($Controller->index_acoes)
	        		<td>
			        	<!-- Editar -->
			        	@if($val->btn_editar)
			        	<a href="{{ url($Area->url.'/form/'.$val->pk()) }}" class="btn btn-primary btn-xs">Editar</a>
			        	@endif

			        	<!-- Deletar -->
			        	@if($val->btn_deletar)
			        	<a href="{{ url($Area->url.'/delete/'.$val->pk()) }}" class="btn btn-danger btn-xs DeletarRegistro">Deletar</a>
			        	@endif

			        	@if($Controller->botaoVisualizar)
			        	<a href="#" class="btn btn-info btn-xs visualizarRegistro" id="{{ $val->pk() }}">Visualizar</a>
			        	@endif
			        </td>
			        @endif
	        	</tr>
		        @endforeach
		        @else
		        <tr>
		        	<td colspan="{{ count($ConfigFile['list_fields'])+1 }}">Nenhum registro encontrado.</td>
		        </tr>
		        @endif
		      </tbody>
		    </table>

			<!-- Pagination -->
			<?php

				if(count($Model)){

					if(isset($_GET) && $_GET){
						echo $Model->appends($_GET)->links();
					} else {
						echo $Model->links();
					}
				}

			?>
		    <!-- /Pagination -->

		</div>
	  </div>
	</div>
</div>
@endsection
