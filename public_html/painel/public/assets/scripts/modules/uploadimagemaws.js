$(document).ready(function(){

  var token = $('meta[name="csrf-token"]').attr('content');


  $(".diretorio").on('click',function(){

    var id = $(this).attr('id');
    var pula = false;

    if($(".diretorioAtivo").attr("id") == id){
      pula = true;
    }

    $(".diretorioAtivo").each(function(){
      $(this).removeClass("diretorioAtivo");
    });

    if(!pula){
      $(this).addClass("diretorioAtivo");
      $("#diretorioAtivo").val(id);
      $("#spanDiretorio").html(id);
      $("#addPasta").val("mkt/"+id+"/");
    }else{
      $("#diretorioAtivo").val("mkt");
      $("#spanDiretorio").html("mkt");
    }

  }); 

  $("#btnAddPasta").click(function(){

      if($("#divAddPasta").is(":visible")){        
        $("#divAddPasta").fadeOut();
        return false;
      }
      var caminho = $("#diretorioAtivo").val();
      if($(".diretorioAtivo").length > 0){
        caminho = "mkt/"+caminho;
      }
      $("#addPasta").val(caminho+"/");
      $("#divAddPasta").fadeIn();

  }); 

  $("#btnEnvPasta").click(function(){

    var caminho = $("#addPasta").val();

    $.ajax({
      headers:{'X-CSRF-TOKEN':token},
      url:'/nova-pasta-aws',
      data:{"caminho":caminho},
      method:'POST',          
    }).done(function(ret) {

        if(ret == 1){
          alert('Diretorio já existe');          
        }else{ 
         location.reload();
        } 
    });
  });

  $(".delDiretorio").click(function(){         
    
      var b = confirm("Você tem certeza que deseja apagar esse diretório? Todas as imagens contidas dentro dele serão removidas");     

      if(b === true){
        var caminho = $(this).attr("id");
        var tipo = "diretorio";

        $.ajax({
        headers:{'X-CSRF-TOKEN':token},
        url:'/del-aws',
        data:{"caminho":caminho, "tipo": tipo},
        method:'POST',          
      }).done(function(ret) {
        alert("Diretório excluido com sucesso");
        location.reload();
        $(this).parent().next().remove(); 
        $(this).parent().remove();           
      });
      }
  });

  $(".delImagem").click(function(){

      var b = confirm("Você tem certeza que deseja apagar essa imagem?");     

      if(b === true){
        var caminho = $(this).attr("id");
        var tipo = "imagem";
        var id = $(this).attr('id').substring(4);    


        $.ajax({
        headers:{'X-CSRF-TOKEN':token},
        url:'/del-aws',
        data:{"caminho":caminho, "tipo": tipo},
        method:'POST',          
      }).done(function(ret) {
        alert("Imagem excluida com sucesso");  
        location.reload();     
        $("#"+id).remove();           
      });
      }
  }); 
    
});



