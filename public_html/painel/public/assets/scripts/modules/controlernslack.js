$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    $('#SalvarLista').on('click', function(){

        var data = [];
        valor = 0;

        $.each($('.Rows'), function(){

            var id = this.id;

            valor = $(this).val();

            data.push({"id":id,"valor":valor});

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

                $.blockUI();

                $.ajax({
                    headers:{'X-CSRF-TOKEN':token},
                    url:'/salvartaxas',
                    data:{"dados":data},
                    method:'POST',
                    dataType:'json'
                }).done(function(ret) {
                    if(ret.response){
                        notification('Alterações feitas com sucesso!','success','bottomRight',5000,'icon-success');
                    }
                });

                $.unblockUI();

            }

        });

        return false;

    });
});