$(document).ready(function()
{   
    var token = $('meta[name="csrf-token"]').attr('content');

    $('#ToggleMenu').trigger('click');

    $('.PausarCampanha').click(function(){
        var clickedID = this.id;

        $('#budget_' + clickedID).val(10);
        $('#budget_' + clickedID).css('border-color', '#FF0000');
    });

    $('.form-control').attr('placeholder', 'Procurar...');

    $('#AtualizarCampanhas').click(function()
    {
        swal({
            title: 'Aguarde!',
            text: '<div class="sk-rotating-plane center-block m-y-lg"></div><br>Dentro de alguns minutos os dados serão atualizados!!',
            html: true
        });

        swal.disableButtons();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/atualizadsets',
            method:'POST',
            dataType:'json'
        }).done(function(ret) {
            if(ret.response)
            {
                swal.close();
                notification('Campanhas atualizadas com sucesso!','success','bottomRight',3000,'icon-success');
                window.location = '/edicao-facebid';          
            } 
            else 
            {
                swal.close();
                notification('Ocorreu um erro ao atualizar campanhas!','error','bottomRight',3000,'icon-error');          
            }
        });

        return false;
        
    });

    $('#SalvarLista').on('click', function()
    { 
        var data = [];
        bid = 0;
        budget = 0;

        $.each($('.Rows'), function(){

            var id = this.id;

            bid_budget = $(this).val();

            data.push({"id":id,"bid_budget":bid_budget});

        });

        swal({
            title: 'Você tem certeza?',
            text: 'Deseja realmente realizar as alterações?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Sim, tenho certeza.',
            closeOnConfirm: true,
        }, function (confirm) {

            if(confirm)
            {
                swal({
                    title: 'Aguarde!',
                    html: true
                });

                swal.disableButtons();

                $.ajax({
                    headers:{'X-CSRF-TOKEN':token},
                    url:'/updatebidbudget',
                    data:{"dados":data},
                    method:'POST',
                    dataType:'json'
                }).done(function(ret) {
                    if(ret.response)
                    {
                        swal.close();
                        notification('Alterações feitas com sucesso!','success','bottomRight',5000,'icon-success');
                    }
                });
            }
        });

        return false;

    });
});