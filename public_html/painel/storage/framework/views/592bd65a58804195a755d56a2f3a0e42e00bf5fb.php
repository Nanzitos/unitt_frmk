<!-- MODALS -->
<?php if(isset($ConfigFile['modals']) && $ConfigFile): ?>
<?php foreach($ConfigFile['modals'] AS $modal ): ?>
<?php echo $__env->make("modals.$modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endforeach; ?>
<?php endif; ?>
<!-- /MODALS -->

<!-- BUILD -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
$('#clock').fitText(0.3);

function update() {
	$('#clock').html(moment().format('H:mm:ss'));
}

setInterval(update, 1000);

var form = eval('<?php echo (count($ConfigFile['fields'])>=1)?'true':'false';?>');

var gifff = '';

$.getJSON('http://api.giphy.com/v1/gifs/random?api_key=dc6zaTOxFJmzC', function(e){
	gifff = e.data.fixed_width_downsampled_url;
	$.blockUI.defaults.message = '<br /><img src="'+gifff+'"><br /><br />Aguarde...<br /><br />';
});

</script>

<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/plugins/jquery.validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/plugins/jquery.blockUi/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/helpers/modernizr.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/vendor/bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/vendor/fastclick/lib/fastclick.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/helpers/smartresize.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/vendor/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/helpers/noty-defaults.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/plugins/jquery.moneyMask/jquery.maskMoney.min.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/vendor/jquery.maskedinput/dist/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/constants.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/vendor/select2/dist/js/select2.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/vendor/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/helpers/classie.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/helpers/inputfx.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/helpers/selectfx.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/main.js"></script>
<script type="text/javascript" src="<?php echo URL::to('/'); ?>/assets/scripts/commons.js"></script>
<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>


</script>





<!-- /BUILD -->

<!-- PAGE SCRIPTS -->
<?php if(isset($ConfigFile['scripts'])): ?>
<?php foreach($ConfigFile['scripts'] AS $script ): ?>
<script type="text/javascript" src="<?php echo e($script); ?>"></script>
<?php endforeach; ?>
<?php endif; ?>
<!-- /PAGE SCRIPTS -->

</body>
</html>
