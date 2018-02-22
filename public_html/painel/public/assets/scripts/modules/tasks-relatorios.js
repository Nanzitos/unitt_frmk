$(document).ready(function(){

    var token   = $('meta[name="csrf-token"]').attr('content');

    $.blockUI();


    $.ajax({
       headers:{'X-CSRF-TOKEN':token},
       url:'/tasks-graficos',
       data:{"a":"a"},
       method:'GET',
       dataType:'json'
    }).done(function(ret) {

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        $.each(ret, function(key,val){

          var key = [];
              key.push(['x',val.info[0],val.info[1]]);

          $.each(val.data, function(mes,mesVal){
            key.push(['M'+mes,mesVal.A,mesVal.B]);
          });

          // Set a callback to run when the Google Visualization API is loaded.
          google.charts.setOnLoadCallback(drawChart);

          function drawChart(){

            // Create and populate the data table.
            var data = google.visualization.arrayToDataTable(key);

            // Create and draw the visualization.
            new google.visualization.LineChart(document.getElementById(val.info[2])).
              draw(data, {vAxes:[
                {title: val.info[0], titleTextStyle: {color: '#FF0000'}, maxValue: 5000}, // Left axis
                {title: val.info[1], titleTextStyle: {color: '#FF0000'}, maxValue: 5000} // Right axis
              ],series:[
                          {targetAxisIndex:1},
                          {targetAxisIndex:0}
              ],} );

          }

        }); 

        $.unblockUI();

    });

});