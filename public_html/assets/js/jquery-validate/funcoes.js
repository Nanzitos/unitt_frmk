// JavaScript Document
$(function () {

    var owl = $("#owl-carrinho");

    owl.owlCarousel({
        pagination: false,
        items: 3, //3 items above 1200px browser width
        itemsDesktop: [1200, 2], //2 items between 1200px and 901px
        itemsDesktopSmall: [900, 1], //1 items betweem 900px and 781px
        itemsTablet: [678, 1], //2 items between 678px and 
        itemsMobile: false //1 item itemsMobile disabled - inherit from itemsTablet option
    });

    // Custom Navigation Events
    $(".next-carrinho").click(function () {
        owl.trigger('owl.next');
    });
    $(".prev-carrinho").click(function () {
        owl.trigger('owl.prev');
    });


    $('.carrinho-topo .qtde-info').click(function () {
        var seta = $(this).children('#seta-qtde-carrinho');
        var valorEmPixels;

        if (seta.hasClass('glyphicon-menu-down')) {
            valorEmPixels = '0px';
            executaAnimacaoMenuCarrinho($('.carrinho-topo'), seta, 'up', 'down', valorEmPixels);
        } else {
            valorEmPixels = '-150px';
            executaAnimacaoMenuCarrinho($('.carrinho-topo'), seta, 'down', 'up', valorEmPixels);
        }
    });
});

function executaAnimacaoMenuCarrinho(obj, seta, direcaoAtual, direcaoNova, valorEmPixels) {
    seta.removeClass('glyphicon-menu-' + direcaoNova).addClass('glyphicon-menu-' + direcaoAtual);
    obj.animate({marginTop: valorEmPixels}, 200);
}



//####################################################################################################
//FORMATACAO DOS CAMPOS DENTRO DO FORM ###############################################################
//----------------------------------------------------------------------------------------------------
function mascara(o, f) {
    v_obj = o
    v_fun = f
    setTimeout("execmascara()", 1)
}

function execmascara() {
    v_obj.value = v_fun(v_obj.value);
}

function leech(v) {
    v = v.replace(/o/gi, "0")
    v = v.replace(/i/gi, "1")
    v = v.replace(/z/gi, "2")
    v = v.replace(/e/gi, "3")
    v = v.replace(/a/gi, "4")
    v = v.replace(/s/gi, "5")
    v = v.replace(/t/gi, "7")
    return v;
}
function soNumeros(v) {
    return v.replace(/\D/g, "")
}
function maskcnpj(v) {
    v = v.replace(/\D/g, "")                           //Remove tudo o que nÃ£o Ã© dÃ­gito
    v = v.replace(/^(\d{2})(\d)/, "$1.$2")             //Coloca ponto entre o segundo e o terceiro dÃ­gitos
    v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3") //Coloca ponto entre o quinto e o sexto dÃ­gitos
    v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")           //Coloca uma barra entre o oitavo e o nono dÃ­gitos
    v = v.replace(/(\d{4})(\d)/, "$1-$2")              //Coloca um hÃ­fen depois do bloco de quatro dÃ­gitos
    return v;
}
function maskdata(v) {
    v = v.replace(/\D/g, "")                    //Remove tudo o que nÃ£o Ã© dÃ­gito
    v = v.replace(/(\d{2})(\d)/, "$1/$2")       //Coloca um ponto entre o terceiro e o quarto dÃ­gitos
    v = v.replace(/(\d{2})(\d)/, "$1/$2")       //Coloca um ponto entre o terceiro e o quarto dÃ­gitos
    return v;
}
function masktime(v) {
    v = v.replace(/\D/g, "")                    //Remove tudo o que nÃ£o Ã© dÃ­gito
    v = v.replace(/(\d{2})(\d)/, "$1:$2")       //Coloca um ponto entre o terceiro e o quarto dÃ­gitos
    v = v.replace(/(\d{2})(\d)/, "$1:$2")       //Coloca um ponto entre o terceiro e o quarto dÃ­gitos
    return v;
}
function masktelefone(v) {
    v = v.replace(/\D/g, "")                 //Remove tudo o que nÃ£o Ã© dÃ­gito
    v = v.replace(/^(\d\d)(\d)/g, "($1) $2") //Coloca parÃªnteses em volta dos dois primeiros dÃ­gitos
    v = v.replace(/(\d{4})(\d)/, "$1-$2")    //Coloca hÃ­fen entre o quarto e o quinto dÃ­gitos
    return v;
}
function maskcelular(v) {
    v = v.replace(/\D/g, "")                 //Remove tudo o que nÃ£o Ã© dÃ­gito
    v = v.replace(/^(\d\d)(\d)/g, "($1) $2") //Coloca parÃªnteses em volta dos dois primeiros dÃ­gitos
    v = v.replace(/(\d{5})(\d)/, "$1-$2")    //Coloca hÃ­fen entre o quarto e o quinto dÃ­gitos
    return v;
}
function maskhora(v) {
    v = v.replace(/\D/g, "")                           //Remove tudo o que nÃ£o digitado
    v = v.replace(/^(\d{2})(\d)/, "$1:$2")             //Coloca ponto entre o segundo e o terceiro digitos
    return v
}
function maskcpf(v) {
    v = v.replace(/\D/g, "")                    //Remove tudo o que nÃ£o Ã© dÃ­gito
    v = v.replace(/(\d{3})(\d)/, "$1.$2")       //Coloca um ponto entre o terceiro e o quarto dÃ­gitos
    v = v.replace(/(\d{3})(\d)/, "$1.$2")       //Coloca um ponto entre o terceiro e o quarto dÃ­gitos
    //de novo (para o segundo bloco de nÃºmeros)
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2") //Coloca um hÃ­fen entre o terceiro e o quarto dÃ­gitos
    return v;
}
function maskcep(v) {
    v = v.replace(/D/g, "")                //Remove tudo o que nÃ£o Ã© dÃ­gito
    v = v.replace(/^(\d{5})(\d)/, "$1-$2") //Esse Ã© tÃ£o fÃ¡cil que nÃ£o merece explicaÃ§Ãµes
    return v;
}
function romanos(v) {
    v = v.toUpperCase()             //MaiÃºsculas
    v = v.replace(/[^IVXLCDM]/g, "") //Remove tudo o que nÃ£o for I, V, X, L, C, D ou M
    //Essa Ã© complicada! Copiei daqui: http://www.diveintopython.org/refactoring/refactoring.html
    while (v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/, "") != "")
        v = v.replace(/.$/, "")
    return v;
}

function masksite(v) {
    //Esse sem comentarios para que vocÃª entenda sozinho ;-)
    v = v.replace(/^http:\/\/?/, "")
    dominio = v
    caminho = ""
    if (v.indexOf("/") > -1)
        dominio = v.split("/")[0]
    caminho = v.replace(/[^\/]*/, "")
    dominio = dominio.replace(/[^\w\.\+-:@]/g, "")
    caminho = caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g, "")
    caminho = caminho.replace(/([\?&])=/, "$1")
    if (caminho != "")
        dominio = dominio.replace(/\.+$/, "")
    v = "http://" + dominio + caminho
    return v;
}

$(document).ready(function () {

    $("#gsr-contact").submit(function () {
//       
        $.ajax({
            url: '/contato',
            data: {"form": $(this)},
            dataType: 'json',
            method: 'POST',
        }).done(function (ret) {
 alert("Socorro");
        });
    });
});