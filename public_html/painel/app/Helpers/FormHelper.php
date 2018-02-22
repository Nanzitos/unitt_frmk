<?php
/*
|--------------------------------------------------------------------------
| FormHelpers
|--------------------------------------------------------------------------
|
| Auxilia na montagem dos formulários de forma dinamica.
|
*/

class FormHelper
{
	/**
     * getInput
     *
     * @param  array
     * @return String
     */

	public static function getInput($data, $id_relation=false, $col_sm_label=false)
	{
		$Route      = \Route::getCurrentRoute()->getAction();
		$Route      = str_replace('@', '\\', $Route['controller']);
		$Route      = explode('\\', $Route);
		$Controller = $Route[3];
		$Controller = str_replace('Controller', '', $Controller);
		$Model      = app("App\\$Controller");

		if($id_relation){
			//$Model = $Model::find($id_relation);
			$Model = $Model::where($Model->pk, $id_relation)->first();
		}

		$name 		   = '';
		$maxlength     = '';
		$translate 	   = '';
		$type 		   = '';
		$id 		   = '';
		$class 		   = '';
		$input         = '';
		$col_sm_input  = '';
		$value         = '';
		$disabled      = '';
		$RelationModel = false;
		$data_attr     = '';

		extract($data);

		if(isset($label) && $label && $col_sm_label){
			$col_sm_input = 'col-sm-'.(12 - $col_sm_label);
			$col_sm_label = 'col-sm-'.$col_sm_label.' control-label';
		} else {
			$col_sm_input = 'col-sm-'.$col_sm_label;
		}

		/**
		* Verifica se existe model e valor
		*
		*/

		if(isset($Model))
			$value = $Model->$name;


		if($type=='password')
			$value = '';


		if(isset($label) && $label)
			$input.='<label for="'.$id.'" class="'.$col_sm_label.'">'.trans($translate).'</label>';


		if($col_sm_label)
			$input.='<div class="'.$col_sm_input.'">';


		if(isset($super_admin) && $super_admin){
			if(!\Auth::user()->superadmin){
				$disabled = 'disabled';
			}
		}

		/**
		* Verifica se existe o atributo de relacionamento
		*
		*/


		if(isset($relation)){
			extract($relation);
			$RelationModel = app("App\\$relation[0]");
			$RelationTo    = $relation[1];

			$seed 		   = $RelationModel->seed;
			$RelationModel = $RelationModel->get();
		}


		switch ($type) {

			case 'text':
				if(isset($icon)){
					$input .= '<span class="input-group-addon" style="width:3%; float:left; height: 34px; line-height: 20px; padding: 6px 6px !important;">'.$icon.'</span>';
					$input.='<input type="text" name="'.$name.'" placeholder="'.trans($translate).'" id="'.$id.'" class="form-control '.$class.'" value="'.$value.'" '.$disabled.' style="width:97%;" />';
				}else{
					$input.='<input type="text" name="'.$name.'" placeholder="'.trans($translate).'" id="'.$id.'" class="form-control '.$class.'" value="'.$value.'" '.$disabled.' />';
				}
				break;

			case 'file':
				
					$input.='<input type="file" name="'.$name.'" id="'.$id.'" class="form-control '.$class.'" '.$disabled.' />';
				
				break;

			case 'textarea':
				$input.='<textarea name="'.$name.'" rows="'.$rows.'" placeholder="'.trans($translate).'" id="'.$id.'" class="form-control '.$class.'" '.$disabled.'>'.$value.'</textarea>';
				$input .= "<script>
								setTimeout(function(){
								   CKEDITOR.replace( '".$name."' );
								}, 1000);					           
					        </script>";
				break;

			case 'date':

				$value = date($format, strtotime($value));

				$input.='<input type="text" name="'.$name.'" maxlength="'.$maxlength.'" placeholder="'.trans($translate).'" id="'.$id.'" class="form-control '.$class.'" value="'.$value.'" '.$disabled.' />';
				break;

			case 'password':
				$input.='<input type="password" name="'.$name.'" placeholder="'.trans($translate).'" id="'.$id.'" class="form-control '.$class.'" value="'.$value.'" '.$disabled.' />';
				break;

			case 'boolean':
				$input.='<label class="switch m-b"><input type="checkbox" name="'.$name.'" '.( ($value)?'checked':'' ).'><span><i class="handle"></i></span></label>';
				break;

			case 'select':

				$input.='<select name="'.$name.'" id="'.$id.'" data-placeholder="'.trans($translate).'" data-value="'.$value.'" class="select2" style="width: 100%;" '.$disabled.'>';

					$input.="<option value='0'>".((isset($placeholder) && ( !isset($label) || !$label))?$placeholder:'Selecione:')."</option>";

					if(isset($values)){

						foreach($values AS $key => $val){
							$input.="<option value='".$key."' ". (($key==$value)?'selected="selected"':'') .">".$val."</option>";
						}

					} else {

						if($RelationModel){

							foreach( $RelationModel AS $key => $val ){

								if(isset($extra_fields) && $extra_fields){

									$data_attr = '';

									foreach($extra_fields AS $ext){
										$data_attr.=' data-'.$ext.'="'.$val->$ext.'"';
									}
								}

								/*if(isset($RelationTo)){
									if(method_exists($Model, $RelationTo)){
										$ModelRelated = $Model->$RelationTo;
										$seed = $ModelRelated->seed;
										$show_val = $ModelRelated->$seed;
									} else {
										$show_val = $val->$seed;
									}
								}*/

								if( !isset($seed) ){
									exit('No seed found!');
								}

								$input.='<option value="'.$val->id.'" '. (($value == $val->id)?'selected="selected"':'') .' '.$data_attr.'>'.(method_exists($val, 'get_seed')?$val->get_seed():$val->$seed).'</option>';
							}
						}
					}

                $input.='</select>';

				break;

			case 'date':

				$value = explode('-', $value);
				$value = $value[2].'/'.$value[1].'/'.$value[0];

				$input.='<input type="text" name="'.$name.'" class="form-control m-b datepicker" data-provide="datepicker" placeholder="'.trans($translate).'" value="'.$value.'">';
				break;

			case 'template':

				if( is_file(base_path().'/resources/views/layouts/templates/'.$template.'.blade.php') ){

					$dataTemplate = array();

					if( isset($Model) ){
						$dataTemplate['Model'] = $Model;
						$dataTemplate['nomeCampo'] = isset($alias) ? $alias : $name;
						$dataTemplate['arrayModel'] = (array) $Model->getAttributes();
					}

					//echo view('layouts.templates/'.$template, $dataTemplate)->render();
					$input.=view('layouts.templates/'.$template, $dataTemplate);

				} else {
					$input.='<div class="alert alert-warning"><i class="icon-close"> </i> Template não encontrado.</div>';
				}

				break;

			default:
				# code...
				break;
		}

		if(isset($box_window)){

			$type = $box_window[0];
			$msg  = $box_window[1];
			$id   = $box_window[2];

			$input.='<div class="alert alert-'.$type.' alert-dismissable" id="'.$id.'" style="margin-top:10px;">';
              $input.=$msg;
            $input.='</div>';
		}

		if(isset($help)){
			$input.='<p class="help-block">'.$help.'</p>';
		}

		if($col_sm_label){
			$input.='</div>';
		}

		echo $input;
	}
}
