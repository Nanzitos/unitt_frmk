$(function () {


    jQuery('#FormSignin').validate({
        focusInvalid: true,
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            nome_fantasia: {
                required: true,
            },
            cnpj: {
                required: true,
                cnpj: true,
            },
            telefone: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            cidade: {
                required: true,
            },
            estado: {
                required: true,
            },
        },
        messages: {
            nome_fantasia: {
                required: "Informe o nome da sua empresa"
            },
            cnpj: {
                required: "Informe o CNPJ da sua empresa",
            },
            telefone: {
                required: "Informe o telefone da sua empresa",
            },
            email: {
                required: "Informe o e-mail da sua empresa",
                email: "E-mail inválido, verifique o e-mail digitado e tente novamente"
            },
            cidade: {
                required: "Informe a cidade da empresa",
            },
            estado: {
                required: "Informe o estado da empresa",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }

    });
    
    
    jQuery('#FormLogin').validate({
        focusInvalid: true,
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },            
        },
        messages: {
            email: {
                required: "Informe seu e-mail de acesso",
                email: "E-mail inválido, verifique o e-mail digitado e tente novamente"
            },
            password: {
                required: "Informe sua senha"
            },             
        },
        submitHandler: function (form) {
            form.submit();
        }

    });


    jQuery('#FormX').validate({
        focusInvalid: true,
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            nome: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
        },
        messages: {
            nome: {
                required: "Informe seu nome"
            },
            email: {
                required: "Informe seu e-mail",
                email: "E-mail inválido, verifique o e-mail digitado e tente novamente"
            },
            telefone: {
                required: "Informe seu telefone",
            },
            cidade: {
                required: "Informe sua cidade",
            },
            estado: {
                required: "Informe seu estado",
            },
            mensagem: {
                required: "Nos informe sua mensagem",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }

    });


    jQuery('#FormCalc').validate({
        focusInvalid: true,
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            altura_1: {
                required: true,
            },
            largura_1: {
                required: true,
            },
            product_height: {
                required: true,
            }, 
        },
        messages: {
            altura_1: {
                required: "Informe a altura da primeira parede."
            }, 
            largura_1: {
                required: "Informe a largura da primeira parede.",
            },
            product_height: {
                required: "Informe o tipo do rolo.",
            },
        },
        submitHandler: function (form) {
            //var changeData = $('#FormX').serialize(); 
            jQuery('#FormCalc').each(function () {
                $.ajax({
                    url: '/calculadora/execute/',
                    data: $(this).serialize(),
                    type: 'POST',
                    success: function(data){
                        $('#return_calc').html('<h2>Você precisa de <strong>'+data+'</strong> rolos</h2>');
                        $('#return_calc').show('fast'); 
                     }// end successful POST function
                }); // end jQuery ajax call
            }); // end setting up the autosave on every form on the page
        }

    });
    
    jQuery('#FormLogin').validate({
        focusInvalid: true,
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },            
        },
        messages: {
            email: {
                required: "Informe seu e-mail de acesso",
                email: "E-mail inválido, verifique o e-mail digitado e tente novamente"
            },
            password: {
                required: "Informe sua senha"
            },             
        },
        submitHandler: function (form) {
            form.submit();
        }

    });


    jQuery('#FormFinishCart').validate({
        focusInvalid: true,
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        rules: {
            cep: {
                required: true,
            },
            logradouro: {
                required: true,
            },
            numero: {
                required: true,
            },
            bairro: {
                required: true,
            },
            uf: {
                required: true,
            },
            cidade: {
                required: true,
            },
            'payment_method[]': {
                required: true,
            }, 
        },
        messages: {
             cep: {
                required: "Informe seu cep",
            },
            logradouro: {
                required: "Informe seu endereço",
            },
            numero: {
                required: "Informe o numero do seu endereço",
            },
            bairro: {
                required: "Informe o bairro do seu endereço",
            },
            uf: {
                required: "Informe o estado do seu endereço",
            },
            cidade: {
                required: "Informe a cidade do seu endereço",
            },
            'payment_method[]': {
                required: "Informe o método de pagamento",
            }, 
             
        },
        submitHandler: function (form) {
            form.submit();
        }

    });
    
    
    
    
    
    
});
