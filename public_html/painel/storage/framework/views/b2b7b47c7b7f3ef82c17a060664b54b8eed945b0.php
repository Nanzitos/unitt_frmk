<?php

$pk = $Model->pk;

?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
	<div class="page-title" style="position:fixed; width:100%; z-index:10;">
	  <div class="title"><?php echo e($Area->titulo); ?></div>
	  <div class="sub-title"><?php echo e($Area->subtitulo); ?></div>
	  <div id="id_area" data-id="<?php echo e($Area->id); ?>"></div>
	</div>
	<div class="" style="margin-top:65px;">
	  <div class="row">
	    <div class="col-sm-12">
	      <div class="card bg-white">
			  <div class="card-header">
			  	<?php echo e(isset($Model->$pk)?'Editando registro':'Novo registro'); ?>

			  	<div style="float: right;">			  		
					<?php if(isset($ConfigFile['langs'])): ?>
						<?php foreach($ConfigFile['langs'] AS $lang ): ?>
						<a href="#" class="btnLang" id="<?php echo e($lang); ?>"> <?php echo e($lang); ?> </a>
						<?php endforeach; ?>
					<?php endif; ?>					
			  	</div>
			  </div>
			  <div class="card-block">
			    <div class="row m-a-0">
			      <div class="col-lg-12">
			      	<form id="FormContent" class="form-horizontal" role="form" method="POST" action="<?php echo e(url($Area->url.'/form')); ?>" enctype="multipart/form-data">
			      	  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

			      	  <?php if(isset($Model->$pk)): ?>
			      	  <input type="hidden" name="<?php echo e($pk); ?>" id="<?php echo e($pk); ?>" value="<?php echo e($Model->$pk); ?>" />
			      	  <?php endif; ?>

			      	  <?php foreach($ConfigFile['fields'] AS $field): ?>
	                  <div class="form-group"> 
	                  <?php 
	                  	$ModelId = isset($Model)?$Model->$pk:null;
	                  	$col_sm  = isset($field['col-sm'])?$field['col-sm']:2;
	                  ?>
	                  <?php echo e(FormHelper::getInput($field, $ModelId, $col_sm)); ?>

	                  </div>
	                  <?php endforeach; ?>

	                  <?php if( !isset($Model) || $Model->send_form_button): ?>
	                  <div class="form-group">
	                  	<input type="submit" data-lang="PT" value="Enviar" id="enviarForm" class="btn btn-primary" style="float:right;" />
	                  </div>
	                  <?php endif; ?>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>
	    </div>
	  </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>