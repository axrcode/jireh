var estados = [];
var totales = [];

$(document).ready(function(){
    $.ajax({
        url: '/admin/dashboard/pedidos/estados',
        method: 'POST',
        data: {
            id: 1,
            _token: $('input[name="_token"]').val()
        }
    }).done(function(res){
        var datos = JSON.parse(res);

        for (var i=0; i<datos.length; i++) {
            estados.push(datos[i].estado);
            totales.push(datos[i].total);
        }

        generarGrafica();
    });
})

function generarGrafica() {

    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
        labels: estados,
        datasets: [
            {
                data: totales,
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
        ]
    }

    var donutOptions = {
        maintainAspectRatio : false,
        responsive : true,
    }

    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })
}
