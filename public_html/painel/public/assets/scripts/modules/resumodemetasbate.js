$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    $('#dp').datepicker({
        format: 'yyyy-mm-dd',
        defaultDate: "+1w",
        startDate:'01/01/dp',
        inline:true,
        autoclose: true
    });

    $('#obterBancoDados').on('click', function()
    {
        swal({
            title: 'Aguarde!',
            html: true
        });

        swal.disableButtons();

        data = $('#dp').val();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/resumodemetas-bate-obter-banco',
            data:{"data_bate":data},
            method:'POST',
            dataType:'json'
        }).done(function(ret) {
            if(ret.response)
            {
                $("#bd_cielo").val(ret.data['cielo']);
                $("#bd_rede").val(ret.data['rede']);
                $("#bd_pagseguro").val(ret.data['pagseguro']);
                $("#bd_triagem").val(ret.data['triagem']);
                swal.close();
                notification('Dados do banco de tados obtidos com sucesso!','success','bottomRight',3000,'icon-success');          
            } 
            else 
            {
                swal.close();
                notification('Ocorreu um erro ao obter os dados do banco de tados!','error','bottomRight',3000,'icon-error');          
            }
        });
        return false;
    });

    $('#obterResumoMetas').on('click', function()
    {
        swal({
            title: 'Aguarde!',
            html: true
        });

        swal.disableButtons();

        data = $('#dp').val();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/resumodemetas-bate-obter-resumo-base-final',
            data:{"data_bate":data},
            method:'POST',
            dataType:'json'
        }).done(function(ret) {
            if(ret.response)
            {
                $("#rm_cc").val(ret.data['cc']);
                $("#rm_boleto").val(ret.data['boleto']);
                $("#rm_triagem").val(ret.data['triagem']);
                swal.close();
                notification('Dados do resumo de metas obtidos com sucesso!','success','bottomRight',3000,'icon-success');          
            } 
            else 
            {
                swal.close();
                notification('Ocorreu um erro ao obter os dados do resumo de metas!','error','bottomRight',3000,'icon-error');          
            }
        });
        return false;
    });

    $('#analisaDados').on('click', function()
    {
        $.each($('.receita'), function()
        {
            if($(this).val() == "")
            {
                notification('Nenhum campo deve ficar vazio!','error','bottomRight',3000,'icon-error');
                die();
            }
        });

        swal({
            title: 'Aguarde!',
            html: true
        });

        swal.disableButtons();

        var dados = [];

        $.each($('.receita'), function()
        {
            var id = this.id;

            receita = $(this).val();

            dados.push({"id":id,"receita":receita});
        });

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/resumodemetas-bate-analisa',
            data:{"dados":dados},
            method:'POST',
            dataType:'json'
        }).done(function(ret) {
            if(ret.response == true)
            {
                console.log(ret);

                $('#cc_mysql').html(ret.data.bd_cc);
                $('#boleto_mysql').html(ret.data.bd_boleto);

                $('#cc_rm').html(ret.data.rm_cc);
                $('#boleto_rm').html(ret.data.rm_boleto);

                $('#cc_dif').html(ret.data.dif_cc + '%');
                $('#boleto_dif').html(ret.data.dif_boleto + '%');

                $('#triagem_mysql').html(ret.data.bd_triagem);
                $('#triagem_rm').html(ret.data.rm_triagem);
                $('#triagem_dif').html(ret.data.dif_triagem);


                $('#total_mysql').html(ret.data.total_mysql);
                $('#total_rm').html(ret.data.total_rm);

                swal.close();
                $('#popup-rm-bate').modal('show');
            } 
            else 
            {
                swal.close();
                notification('Ocorreu um erro!','error','bottomRight',3000,'icon-error');          
            }
        });
        return false;
    });


});
//resumodemetas-bate-obter-resumo-base-bruta