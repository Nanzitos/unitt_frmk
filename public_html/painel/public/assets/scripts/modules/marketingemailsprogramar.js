$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    $('#id_marca').on('change', function(){

        var id_marca     = $(this).val();
        var ListasAllin  = $('#nm_lista');
        var FiltrosAllin = $('#nm_filtro');
        var Templates    = $('#id_template');
        //var Promocoes    = $('#id_promocao');

        $.blockUI();

        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: '/getMktEmailsProgramarInfo',
            data: {"id_marca": id_marca},
            method: 'POST',
            dataType: 'json'
        }).done(function (ret) {

            /*
             * Listas
             */

            var htmlListas = '';

            $.each(ret.Listas.itensConteudo, function(key,val){
                htmlListas+='<option value="'+val.itensConteudo_nm_lista+'">'+val.itensConteudo_nm_lista+'</option>';
            });

            ListasAllin.html(htmlListas);

            /*
             * Filtros
             */

            var htmlFiltros = '';

            $.each(ret.Filtros.itensConteudo, function(key,val){
                htmlFiltros+='<option value="'+val.itensConteudo_nm_filtro+'">'+val.itensConteudo_nm_filtro+'</option>';
            });

            FiltrosAllin.html(htmlFiltros);

            /*
             * Templates
             */

            var htmlTemplates = '';

            $.each(ret.Templates, function(key,val){
                htmlTemplates+='<option value="'+val.id+'">'+val.titulo+'</option>';
            });

            Templates.html(htmlTemplates);

            /*
             * Promocoes
             */

            // var htmlPromocoes = '';
            //
            // $.each(ret.Cupons, function(key,val){
            //     htmlPromocoes+='<option value="'+val.id+'">'+val.nome+'</option>';
            // });
            //
            // Promocoes.html(htmlPromocoes);

            ListasAllin.select2();
            FiltrosAllin.select2();
            Templates.select2();
            //Promocoes.select2();

            $('#nm_remetente').val('atendimento@'+ret.Marca.url);
            $('#nm_reply').val('atendimento@'+ret.Marca.url);
            $('#nm_remetente_nome').val(ret.Marca.nome);
            $('#nm_link').val('https://'+ret.Marca.url+'/produtos?utm_source=EmailMarketing_News&utm_medium=CRM&utm_content=&utm_campaign=SC.20170508_0078_perfsf_ativos_com_boleto&utm_term=LogoSlimCaps&cupom=slimsem-frete');

            $.unblockUI();

        });

    });

});