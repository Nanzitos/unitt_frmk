function selectElementContents(el) {
    var body = document.body, range, sel;
    if (document.createRange && window.getSelection) {
        range = document.createRange();
        sel = window.getSelection();
        sel.removeAllRanges();
        try {
            range.selectNodeContents(el);
            sel.addRange(range);
        } catch (e) {
            range.selectNode(el);
            sel.addRange(range);
        }
    } else if (body.createTextRange) {
        range = body.createTextRange();
        range.moveToElementText(el);
        range.select();
    }
}



$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');
    (function DestaqueMarcas(){
        $.each($('.Rows'), function(key,val){
            var str = $(this).data('value');
            str = str.toUpperCase();
            var total  = 'TOTAL';
            var slim   = 'SLIMCAPS';
            var hair   = 'HAIRCAPS';
            var plat   = 'PLATINUM';
            var beauty = 'BEAUTY';

            var patt = new RegExp(total);
            var res = patt.test(str);
            var pattslim = new RegExp(slim);
            var resslim = pattslim.test(str);
            var patthair = new RegExp(hair);
            var reshair = patthair.test(str);
            var pattplat = new RegExp(plat);
            var resplat = pattplat.test(str);
            var pattbeauty = new RegExp(beauty);
            var resbeauty = pattbeauty.test(str);

            if(res && (resslim || reshair || resplat ||resbeauty)){
                console.log(str);
                $(this).css("border-top", "2px solid #000");
                return false;
            }

        });
    })();

    (function DestaqueDisp(){
        $.each($('.Rows'), function(key,val){
            var str = $(this).data('value');
            str = str.toUpperCase();
            var total  = 'TOTAL';
            var desk   = 'DESKTOP';
            var mobile   = 'MOBILE';

            var patt = new RegExp(total);
            var res = patt.test(str);
            var pattdesk = new RegExp(desk);
            var resdesk = pattdesk.test(str);
            var pattmobile = new RegExp(mobile);
            var resmobile = pattmobile.test(str);

            if(res && (resdesk || resmobile)){
                console.log(str);
                $(this).css("border-top", "2px solid #000");
                return false;
            }

        });
    })();
    (function DestaqueGeral(){
        $.each($('.Rows'), function(key,val){
            var str = $(this).data('value');
            str = str.toUpperCase();
            var total  = 'TOTAL';
            var geral   = 'GERAL';

            var patt = new RegExp(total);
            var res = patt.test(str);
            var pattgeral = new RegExp(geral);
            var resgeral = pattgeral.test(str);


            if(res && resgeral){
                console.log(str);
                $(this).css("border-top", "2px solid #000");
                return false;
            }

        });
    })();

	$('#DownloadOutnow').on('click', function(){
		$(this).html('Aguarde...');
		$(this).attr('disabled', true);
		$(this).removeClass('btn-icon');
	});

    $('#DownloadFacenow').on('click', function(){
        $(this).html('Aguarde...');
        $(this).attr('disabled', true);
        $(this).removeClass('btn-icon');
    });

    $('#DownloadTaboolaNow').on('click', function(){
        $(this).html('Aguarde...');
        $(this).attr('disabled', true);
        $(this).removeClass('btn-icon');
    });

    //agora
    $('#DownloadCPANow').on('click', function(){
        $(this).html('Aguarde...');
        $(this).attr('disabled', true);
        $(this).removeClass('btn-icon');
    });
    //fim agora

	/*
	$('#CopyFromTable').on('click', function(){
		selectElementContents($('#TableToCopy')[0]);
	});*/

	$('#CopyFromTable').on('click', function(){
		selectElementContents( document.getElementById('TableToCopy') );
		return false;
	});


    
    $('#FormFiltros').on('submit', function(){

        $.each($('.Rows'), function(key,val){
            $(this).show();
        });

        var receita_total_geral    = 0;
        var custo_total_geral    = 0;
        var ordens_total_geral    = 0;
        var budget_total_geral    = 0;

        var receita_total_mobile   = 0;
        var custo_total_mobile   = 0;
        var ordens_total_mobile   = 0;
        var budget_total_mobile   = 0;

        var receita_total_desktop  = 0;
        var custo_total_desktop  = 0;
        var ordens_total_desktop  = 0;
        var budget_total_desktop  = 0;

        var receita_total_slimcaps = 0;
        var custo_total_slimcaps = 0;
        var ordens_total_slimcaps = 0;
        var budget_total_slimcaps = 0;

        var receita_total_haircaps = 0;
        var custo_total_haircaps = 0;
        var ordens_total_haircaps = 0;
        var budget_total_haircaps = 0;

        var receita_total_platinum = 0;
        var custo_total_platinum = 0;
        var ordens_total_platinum = 0;
        var budget_total_platinum = 0;

        var receita_total_beauty   = 0;
        var custo_total_beauty   = 0;
        var ordens_total_beauty   = 0;
        var budget_total_beauty   = 0;

        var str_mobile = 'MOBILE';
        var str_slim   = "SLIMCAPS";
        var str_hair   = "HAIRCAPS";
        var str_plat   = "PLATINUM";
        var str_beauty = "BEAUTYCAPS";

        //tabela = document.getElementById('TableToCopy');
        /*aplico o filtro*/
        $.each($('.Rows'), function(key,val){
            var row = $(this);

            var strtotal = 'TOTAL';

            var rec = row.find('.receita').html().replace(",", '.');
            var receita = parseFloat(rec);
            var cust   = row.find('.custo').html().replace(",", '.');
            var custo = parseFloat(cust);
            var ord  = row.find('.ordens').html().replace(",", '.');
            var ordens = parseFloat(ord);
            var bud  = row.find('.budget').html().replace(",", '.');
            var budget = parseFloat(bud);


            var str = row.data('value');
            str = str.toUpperCase();
            var filtro = document.getElementById('nome').value;
            filtro = filtro.toUpperCase();

            var patt = new RegExp(filtro);
            var res = patt.test(str);

            var filtro2 = document.getElementById('nome2').value;
            filtro2 = filtro2.toUpperCase();

            if(filtro2 != ''){
                var patt2 = new RegExp(filtro2);
                var res2 = patt2.test(str);
            }
            else {
                res2 = true;
            }

            var pattotal = new RegExp(strtotal);
            var restotal = pattotal.test(str);

            if((!restotal) && (res && res2)) {
                //soma campos
                //para cada total, preciso testar se a campanha pertence a ele, e somar na variavel total corresp

                //TOTAL MOBILE
                var pattotais = new RegExp(str_mobile);
                var restotais = pattotais.test(str);

                if(restotais) {
                    //console.log('mobile');
                    receita_total_mobile += receita;
                    custo_total_mobile += custo;
                    ordens_total_mobile += ordens;
                    budget_total_mobile += budget;
                   // console.log(receita_total_mobile);
                }else {//TOTAL DESKTOP
                  //  console.log('desktop');
                    receita_total_desktop += receita;
                    custo_total_desktop += custo;
                    ordens_total_desktop += ordens;
                    budget_total_desktop += budget;
                }

                //TOTAL SLIMCAPS
                pattotais = new RegExp(str_slim);
                restotais = pattotais.test(str);
                if(restotais) {
                   // console.log('slimcaps');
                    receita_total_slimcaps += receita;
                    custo_total_slimcaps += custo;
                    ordens_total_slimcaps += ordens;
                    budget_total_slimcaps += budget;
                }

                //TOTAL haircaps
                pattotais = new RegExp(str_hair);
                restotais = pattotais.test(str);
                if(restotais) {
                  //  console.log('haircaps');
                    receita_total_haircaps += receita;
                    custo_total_haircaps += custo;
                    ordens_total_haircaps += ordens;
                    budget_total_haircaps += budget;
                }


                //TOTAL BEAUTY
                pattotais = new RegExp(str_beauty);
                restotais = pattotais.test(str);
                if(restotais) {
                   // console.log('beauty');
                    receita_total_beauty += receita;
                    custo_total_beauty += custo;
                    ordens_total_beauty += ordens;
                    budget_total_beauty += budget;
                }

                //TOTAL PLAT
                pattotais = new RegExp(str_plat);
                restotais = pattotais.test(str);
                if(restotais) {
                    //console.log('plat');
                    receita_total_platinum += receita;
                    custo_total_platinum += custo;
                    ordens_total_platinum += ordens;
                    budget_total_platinum += budget;
                }

                //TOTAL GERAL
                receita_total_geral += receita;
                custo_total_geral += custo;
                ordens_total_geral += ordens;
                budget_total_geral += budget;


            }
            else if(restotal){
                //seta campos

                //TOTAL MOBILE
                pattotais = new RegExp(str_mobile);
                restotais = pattotais.test(str);

                if(restotais) {

                    receita_total_mobile_str = receita_total_mobile.toFixed(2).toString().replace(".", ",");
                    custo_total_mobile_str   = custo_total_mobile.toFixed(2).toString().replace(".", ",");
                    ordens_total_mobile_str  = ordens_total_mobile.toFixed(0).toString().replace(".", ",");
                    budget_total_mobile_str  = budget_total_mobile.toFixed(0).toString().replace(".", ",");
                    costrev_total_mobile     = custo_total_mobile/receita_total_mobile;
                    costrev_total_mobile_str  = costrev_total_mobile.toFixed(2).toString().replace(".", ",");


                    row.find('.receita').html(receita_total_mobile_str);
                    row.find('.custo').html(custo_total_mobile_str);
                    row.find('.ordens').html(ordens_total_mobile_str);
                    row.find('.budget').html(budget_total_mobile_str);
                    row.find('.costrev').html(costrev_total_mobile_str);
                }
                else{//TOTAL DESKTOP
                    receita_total_desktop_str = receita_total_desktop.toFixed(2).toString().replace(".", ",");
                    custo_total_desktop_str   = custo_total_desktop.toFixed(2).toString().replace(".", ",");
                    ordens_total_desktop_str  = ordens_total_desktop.toFixed(0).toString().replace(".", ",");
                    budget_total_desktop_str  = budget_total_desktop.toFixed(0).toString().replace(".", ",");
                    costrev_total_desktop     = custo_total_desktop/receita_total_desktop;
                    costrev_total_desktop_str = costrev_total_desktop.toFixed(2).toString().replace(".", ",");

                    row.find('.receita').html(receita_total_desktop_str);
                    row.find('.custo').html(custo_total_desktop_str);
                    row.find('.ordens').html(ordens_total_desktop_str);
                    row.find('.budget').html(budget_total_desktop_str);
                    row.find('.costrev').html(costrev_total_desktop_str);
                }

                //TOTAL SLIMCAPS
                pattotais = new RegExp(str_slim);
                restotais = pattotais.test(str);
                if(restotais) {
                    receita_total_slimcaps_str = receita_total_slimcaps.toFixed(2).toString().replace(".", ",");
                    custo_total_slimcaps_str   = custo_total_slimcaps.toFixed(2).toString().replace(".", ",");
                    ordens_total_slimcaps_str  = ordens_total_slimcaps.toFixed(0).toString().replace(".", ",");
                    budget_total_slimcaps_str  = budget_total_slimcaps.toFixed(0).toString().replace(".", ",");
                    costrev_total_slimcaps     = custo_total_slimcaps/receita_total_slimcaps;
                    costrev_total_slimcaps_str  = costrev_total_slimcaps.toFixed(2).toString().replace(".", ",");

                    row.find('.receita').html(receita_total_slimcaps_str);
                    row.find('.custo').html(custo_total_slimcaps_str);
                    row.find('.ordens').html(ordens_total_slimcaps_str);
                    row.find('.budget').html(budget_total_slimcaps_str);
                    row.find('.costrev').html(costrev_total_slimcaps_str);
                }

                //TOTAL haircaps
                pattotais = new RegExp(str_hair);
                restotais = pattotais.test(str);
                if(restotais) {
                    receita_total_haircaps_str  = receita_total_haircaps.toFixed(2).toString().replace(".", ",");
                    custo_total_haircaps_str    = custo_total_haircaps.toFixed(2).toString().replace(".", ",");
                    ordens_total_haircaps_str   = ordens_total_haircaps.toFixed(0).toString().replace(".", ",");
                    budget_total_haircaps_str   = budget_total_haircaps.toFixed(0).toString().replace(".", ",");
                    costrev_total_haircaps      = custo_total_haircaps/receita_total_haircaps;
                    costrev_total_haircaps_str  = costrev_total_haircaps.toFixed(2).toString().replace(".", ",");

                    row.find('.receita').html(receita_total_haircaps_str);
                    row.find('.custo').html(custo_total_haircaps_str);
                    row.find('.ordens').html(ordens_total_haircaps_str);
                    row.find('.budget').html(budget_total_haircaps_str);
                    row.find('.costrev').html(costrev_total_haircaps_str);
                }


                //TOTAL BEAUTY
                pattotais = new RegExp(str_beauty);
                restotais = pattotais.test(str);
                if(restotais) {
                    receita_total_beauty_str = receita_total_beauty.toFixed(2).toString().replace(".", ",");
                    custo_total_beauty_str   = custo_total_beauty.toFixed(2).toString().replace(".", ",");
                    ordens_total_beauty_str  = ordens_total_beauty.toFixed(0).toString().replace(".", ",");
                    budget_total_beauty_str  = budget_total_beauty.toFixed(0).toString().replace(".", ",");
                    costrev_total_beauty      = custo_total_beauty/receita_total_beauty;
                    costrev_total_beauty_str  = costrev_total_beauty.toFixed(2).toString().replace(".", ",");


                    row.find('.receita').html(receita_total_beauty_str);
                    row.find('.custo').html(custo_total_beauty_str);
                    row.find('.ordens').html(ordens_total_beauty_str);
                    row.find('.budget').html(budget_total_beauty_str);
                    row.find('.costrev').html(costrev_total_beauty_str);
                }

                //TOTAL PLAT
                pattotais = new RegExp(str_plat);
                restotais = pattotais.test(str);
                if(restotais) {
                    receita_total_platinum_str = receita_total_platinum.toFixed(2).toString().replace(".", ",");
                    custo_total_platinum_str   = custo_total_platinum.toFixed(2).toString().replace(".", ",");
                    ordens_total_platinum_str  = ordens_total_platinum.toFixed(0).toString().replace(".", ",");
                    budget_total_platinum_str  = budget_total_platinum.toFixed(0).toString().replace(".", ",");
                    costrev_total_platinum      = custo_total_platinum/receita_total_platinum;
                    costrev_total_platinum_str  = costrev_total_platinum.toFixed(2).toString().replace(".", ",");


                    row.find('.receita').html(receita_total_platinum_str);
                    row.find('.custo').html(custo_total_platinum_str);
                    row.find('.ordens').html(ordens_total_platinum_str);
                    row.find('.budget').html(budget_total_platinum_str);
                    row.find('.costrev').html(costrev_total_platinum_str);
                }

                //TOTAL GERAL
                pattotais = new RegExp("GERAL");
                restotais = pattotais.test(str);
                if(restotais) {
                    receita_total_geral_str = receita_total_geral.toFixed(2).toString().replace(".", ",");
                    custo_total_geral_str = custo_total_geral.toFixed(2).toString().replace(".", ",");
                    ordens_total_geral_str = ordens_total_geral.toFixed(0).toString().replace(".", ",");
                    budget_total_geral_str = budget_total_geral.toFixed(0).toString().replace(".", ",");
                    costrev_total_geral      = custo_total_geral/receita_total_geral;
                    costrev_total_geral_str  = costrev_total_geral.toFixed(2).toString().replace(".", ",");

                    row.find('.receita').html(receita_total_geral_str);
                    row.find('.custo').html(custo_total_geral_str);
                    row.find('.ordens').html(ordens_total_geral_str);
                    row.find('.budget').html(budget_total_geral_str);
                    row.find('.costrev').html(costrev_total_geral_str);
                }
            }

            if(!((res && res2) || restotal)){
               row.hide();
            }

            //console.log(row.data('value'))
            //console.log(document.getElementById('nome').value);
        });
        $('#ModalSearch').modal('hide');
        return false;
    });

    $('#selectkpis').on('change', function(){

        var data = $(this).val();


        window.location.href = '/rightnow?conversaonow&type=marcas&kpi='+data;

    });
    $('#selectmarcas').on('change', function(){

        var data = $(this).val();


        window.location.href = '/rightnow?conversaonow&type=kpis&marca='+data;

    });
});