<?php $__env->startSection('main'); ?>

<div class="main-content">
	<div class="page-title">
	  <div class="title"><?php echo e($Area->titulo); ?></div>
	  <div class="sub-title"><?php echo e($Area->subtitulo); ?></div>
	</div>
	<div class="card bg-white m-b" >
	  <div class="card-header">
	    <div class="row">
	    	<div class="col-sm-6">
	    		<?php echo e($Area->descricao); ?>

	    		<?php

	    			$filtros = [];

	    			if( isset($_GET['filtros']) ){

	    				foreach($_GET AS $filtro){
		    				$filtros[] = $filtro;
		    			}
		    		}

	    		?>
	    		<?php if(count($filtros)): ?>
			  	<!--<input id="filtros" type="text" value="<?php echo e(implode(',',$filtros)); ?>" />-->
			  	<?php endif; ?>
	    	</div>
	    	<div class="col-sm-6" style="text-align:right;">
	    		<?php if($Controller->novo_registro): ?>
		    		<a href="<?php echo e(url($Area->url.'/form/')); ?>" class="btn btn-primary btn-sm btn-icon mr5">
	                  <i class="icon-plus"></i>
	                  <span>Novo registro</span>
	                </a>
	            <?php endif; ?>
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
		    	<a href="<?php echo e($button['url']); ?>" class="btn btn-sm btn-icon mr5 <?php echo e($button['class']); ?>" id="<?php echo e($button['id']); ?>" <?php echo e($data_attr); ?>>
                  <i class="<?php echo e($button['icon']); ?>"></i>
                  <span><?php echo e($button['titulo']); ?></span>
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
		        <?php foreach($ConfigFile['list_fields'] AS $value => $field): ?>
		        	<th><b><?php echo e($field); ?></b></th>
		        <?php endforeach; ?>
		        <?php if($Controller->index_acoes): ?>
		        	<th><b>Ações</b></th>
		        <?php endif; ?>
		        </tr>
		      </thead>
		      <tbody>
		      	<?php if(count($Model)): ?>
		      	<?php foreach($Model AS $key => $val): ?>
	      		<tr>
	        		<?php foreach($ConfigFile['list_fields'] AS $value => $field): ?>
	        		<?php

	        			$method_test = 'get_'.$value;

						if(method_exists($val, $method_test)){
							$value = $val->$method_test($val);
	        			} else {
	        				$value = $val->$value;
	        			}

	        		?>
	        		<td><?php echo $value; ?></td>
	        		<?php endforeach; ?>
	        		<?php if($Controller->index_acoes): ?>
	        		<td>
			        	<!-- Editar -->
			        	<?php if($val->btn_editar): ?>
			        	<a href="<?php echo e(url($Area->url.'/form/'.$val->pk())); ?>" class="btn btn-primary btn-xs">Editar</a>
			        	<?php endif; ?>

			        	<!-- Deletar -->
			        	<?php if($val->btn_deletar): ?>
			        	<a href="<?php echo e(url($Area->url.'/delete/'.$val->pk())); ?>" class="btn btn-danger btn-xs DeletarRegistro">Deletar</a>
			        	<?php endif; ?>

			        	<?php if($Controller->botaoVisualizar): ?>
			        	<a href="#" class="btn btn-info btn-xs visualizarRegistro" id="<?php echo e($val->pk()); ?>">Visualizar</a>
			        	<?php endif; ?>
			        </td>
			        <?php endif; ?>
	        	</tr>
		        <?php endforeach; ?>
		        <?php else: ?>
		        <tr>
		        	<td colspan="<?php echo e(count($ConfigFile['list_fields'])+1); ?>">Nenhum registro encontrado.</td>
		        </tr>
		        <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>