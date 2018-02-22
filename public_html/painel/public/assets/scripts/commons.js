/**
* Commons.js
*
* Arquivo com funções em comum para apoio aos outros scripts JS
*
*/


	//var ConfigFile = Contém o arquivo JSON de configuração do módulo em execução.

	/**
     * runValidator
     *
     * Executa o método de validação javacript de acordo com a configuração do arquivo
     *
     */
     var validatorFields = [];
     var token = $('meta[name="csrf-token"]').attr('content');

    //  function runValidator(form)
    //  {
    //  	if(typeof(ConfigFile) == 'undefined' && typeof(ConfigFile['fields']) == 'undefined'){
    //  		return false;
    //  	}
     //
    //  	var rules = {};
     //
    //  	$.each(ConfigFile['fields'], function(key,val){
     //
    //  		if( typeof(val.validate) != 'undefined' && val.validate != '' ){
     //
    //  			var name        = val.name;
    //  			var configRules = val.validate.split('|');
    //  			rules[name]     = {};
     //
    //  			rules[name]['required'] = true;
     //
    //  			$.each(configRules, function(key2,val2){
     //
    //  				var exploded = val2.split(':');
    //  				switch (exploded[0])
	  //    			{
		// 			    case 'min':
		// 			    	rules[name]['minlength'] = parseInt(exploded[1]);
		// 			        break;
     //
		// 			    case 'max':
		// 			        rules[name]['maxlength'] = parseInt(exploded[1]);
		// 			        break;
		// 			    case 'email':
		// 			        rules[name]['email'] = true;
		// 			        break;
     //
		// 			}
     //
    //  			});
     //
    //  			validatorFields.push(val.id);
     //
    //  		}

    //  	});
    //
    //  	/***********************
		// | Registra a validação
		// /***********************/
		// form.validate({
	  //       errorElement: 'span', //default input error message container
	  //       errorClass: 'help-block help-block-error', // default input error message class
	  //       focusInvalid: true, // do not focus the last invalid input
	  //       ignore: "",  // validate all fields including form hidden input
	  //       rules: rules,
    //
	  //       invalidHandler: function (event, validator) { //display error alert on form submit
    //
	  //       },
    //
	  //       errorPlacement: function (error, element) { // render error placement for each input type
    //             error.insertAfter(element);
    //         },
    //
    // 	    highlight: function (element) { // hightlight error inputs
	  //           $(element).parent().addClass('has-error');
	  //       },
    //
	  //       unhighlight: function (element) { // revert the change done by hightlight
	  //       	$(element).parent().removeClass('has-error');
	  //           $(element).parent().addClass('has-success');
	  //       },
    //
	  //       success: function (label, element) {
	  //           var icon = $(element).parent('.input-icon').children('i');
	  //           $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
	  //           icon.removeClass("fa-warning").addClass("fa-check");
	  //       },
    //
	  //       submitHandler: function (form) {
	  //       	form.submit();
	  //       }
	  //   });
    // }

    /*
     * Decide se carrega a validação automatica
     */
    $( document ).ready(function() {
        $(".btnLang").on('click',function(){

            var id = window.location.href.split("/").reverse()[0].replace("#", "");
            var area = $("#id_area").attr("data-id");

            var idLang = $(this).attr('id');

            $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/painel/public/get-translate',
            data:{"area":area,"lingua":$(this).attr('id'), "id_registro": id},
            method:'POST',
            }).done(function(ret) {
                jQuery.each(JSON.parse(ret), function(i, val) {            
                 $("#" + i).val(val);
                 for(name in CKEDITOR.instances)
                  {
                      if(name == i){
                        CKEDITOR.instances[name].setData(val);
                      }

                  }
                 $("#" + i).addClass("langChange");
                });

                if(idLang != "PT"){
                    $("#enviarForm").attr("type","button");
                    $("#enviarForm").attr("data-lang", idLang);                
                }else{
                    $("#enviarForm").attr("type","submit");
                    $("#enviarForm").attr("data-lang", idLang);                
                }    
            });  
        }); 


        $("#enviarForm").on('click',function(){       
            var lang = $(this).attr("data-lang");

            if(lang != "PT"){

                var id = window.location.href.split("/").reverse()[0].replace("#", "");
                var area = $("#id_area").attr("data-id");

                var arrCampos = new Array();
                var arrValues = new Array();
                $(".langChange").each(function(){                   
                    arrCampos.push($(this).attr('name'));                    
                    if($(this).attr("type") != null){                      
                      arrValues.push($(this).val());
                    }else{  
                      for(name in CKEDITOR.instances)
                      {                          
                          if(name == this.id){
                            arrValues.push(CKEDITOR.instances[name].getData());
                          }
                      }
                    }  
                });
                
                arrCampos = JSON.stringify(arrCampos);
                arrValues = JSON.stringify(arrValues);


                $.ajax({
                headers:{'X-CSRF-TOKEN':token},
                url:'/painel/public/save-translate',
                data:{"area":area,"lingua":lang, "id_registro": id, "campos": arrCampos, "valores": arrValues},
                method:'POST',
                }).done(function(ret) {            
                        alert("Termo salvo com sucesso!");
                        location.reload();            
                });

            }      
        });
      });

     /**
     * validateEmail
     *
     * Validação simples de e-mail
     *
     */

     function validateEmail(email)
     {
	    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(email);
	}

	/**
	* Inicializa o select2 para objetos select contendo a classe select2
	*
	*/
  	$('.select2').select2();

  	/**
  	* $_GET em javascript
  	*
  	*/
  	var parts = window.location.search.substr(1).split("&");
	var $_GET = {};

	for (var i = 0; i < parts.length; i++) {
	    var temp = parts[i].split("=");
	    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
	}

  	/**
  	* Exibe notificação conforme configuração solicitada
  	*
  	*/
  	var notification = function(msg,type,position,duration,icon)
  	{
  		if (!msg) {
	      msg = 'error';
	    }

	    if (!type) {
	      type = 'error';
	    }

	    if(!duration){
	    	duration = 5000;
	    }

	    if(!icon){
	    	icon = 'icon-close';
	    }

	    if(type=='success'){
	    	icon = 'icon-check';
	    }

	    msg = '<i class="'+icon+'"> </i>&nbsp;&nbsp;'+msg;

	    noty({
	      theme: 'app-noty',
	      text: msg,
	      type: type,
	      timeout: duration,
	      layout: position,
	      closeWith: ['button', 'click'],
	      animation: {
	        open: 'in',
	        close: 'out'
	      },
	    });
  	}

  	/**
  	* Definição das mascaras padrões
  	* É declarado como função para utilizar as chamadas na hora de inclusão
  	* de inputs com javascript.
  	*
  	*/
  	var defineMasks = function()
  	{
  		$.mask.definitions['~'] = '[+-]';
	  	$('.cpf').mask('999.999.999-99');
	  	$('.cnpj').mask('99.999.999/9999-99');
	  	$('.cep').mask('99999-999');
	  	$('.telefone').mask('(99) 9999-9999');
	  	$('.celular').mask('(99) 9999-9999?9');
	  	$('.data_completa').mask('99/99/9999 99:99:99');
      $('.data').mask('99/99/9999');
	  	$('.time').mask('99:99:99');
      $(".float_ ").maskMoney();
      $('.money').maskMoney();

	  	$("[data-toggle=tooltip]").tooltip();
	    $("[data-toggle=popover]")
	      .popover()
	      .click(function (e) {
	        e.preventDefault();
	    });

	    $(".select2").select2();
  	}

  	defineMasks();

  	/**
  	* DeletarRegistro
  	*
  	* Executa confirmação de exclusão da linha antes de continuar
  	*/

  	$('.DeletarRegistro').on('click', function(){

  		var href = $(this).attr('href');

  		swal({
	      title: 'Você tem certeza?',
	      text: 'Você não poderá recuperar esse registro.',
	      type: 'warning',
	      showCancelButton: true,
	      confirmButtonColor: '#DD6B55',
	      confirmButtonText: 'Sim, tenho certeza.',
	      closeOnConfirm: true,
	    }, function (confirm) {

	    	if(confirm){
	    		window.location=href;
	    	}

	    });

	    return false;

  	});

  	/**
  	* Configura o datepicker
  	*
  	*/
  	$('.datepicker').datepicker({
	    format: 'dd/mm/yyyy',
	    defaultDate: "+1w",
	    startDate:'01/01/2013',
	    inline:true

	});

	/**
  	* Troca os radios por inputs hidden no submit
  	*
  	*/
  	$('form').on('submit', function(){
  		$.each($('input[type=radio]'), function(key,val){
  			name  = $(this).attr('name');
  			value = ($(this).is(':checked'))?1:0;
  			$(this).parent().append('<input type="hidden" name="'+name+'" value="'+value+'" />');
  			$(this).remove();
	  	});
  	});

  	/**
  	* Radios com o mesmo nome também aplicam a função de um único ativo
  	*
  	*/
  	$('input[type=radio]').on('change',function(){
        $('input[type=radio]:checked').not(this).prop('checked', false);
    });

    /**
    * Somente números
    */
    $(".only_numbers").on('keydown', function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    var number_format = function(number, decimals, decPoint, thousandsSep) {

	  number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
	  var n = !isFinite(+number) ? 0 : +number
	  var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
	  var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
	  var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
	  var s = ''

	  var toFixedFix = function (n, prec) {
	    var k = Math.pow(10, prec)
	    return '' + (Math.round(n * k) / k)
	      .toFixed(prec)
	  }

	  // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
	  if (s[0].length > 3) {
	    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
	  }
	  if ((s[1] || '').length < prec) {
	    s[1] = s[1] || ''
	    s[1] += new Array(prec - s[1].length + 1).join('0')
	  }

	  return s.join(dec)
	}
