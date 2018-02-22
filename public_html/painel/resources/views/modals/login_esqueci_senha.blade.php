<div class="modal bs-modal-sm in" tabindex="-1" role="dialog" aria-hidden="true" id="EsqueciSenha">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	      <h4 class="modal-title">{{ trans('login.forgotten') }}</h4>
	    </div>
	    <div class="modal-body">
	      <p>{{ trans('login.forgotten_subtitle') }}</p><br />
	      <form role="form" id="EsqueciForm" method="POST" class="form-horizontal" action="login/esqueci">
	        <div class="form-group">
	          <label class="col-sm-2 control-label">{{ trans('login.email') }}</label>
	          <div class="col-sm-9">
	          	<input type="text" class="form-control" placeholder="Email" id="EsqueciEmail">
	          </div>
	        </div>
	    </div>
	    <div class="modal-footer no-border">

	    	<div id="ModalLoader" style="display:none;">
	    		<img src="assets/images/ajax-loader.gif" />
	    	</div>
			
			<div id="ModalButtonGroup">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('login.cancel') }}</button>
				<input type="submit" class="btn btn-primary append-loader" value="{{ trans('login.send') }}" />
			</div>

	    </div>
	    </form>
	  </div>
	</div>
</div>