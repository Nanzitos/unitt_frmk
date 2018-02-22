$(document).ready(function(){
	$('#ToggleMenu').trigger('click');
	
    var token = $('meta[name="csrf-token"]').attr('content');

    $('.PausarCampanha').click(function(){
        var clickedID = this.id;

        $('#budget_' + clickedID).val(10);
        $('#budget_' + clickedID).css('border-color', '#FF0000');
    });

    $('#SalvarLista').on('click', function(){

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

                $.blockUI();
        
                $.ajax({
                    headers:{'X-CSRF-TOKEN':token},
                    url:'/updatebidbudgetOut',
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