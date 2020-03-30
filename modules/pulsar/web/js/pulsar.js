
//----------------------------------------------------------------------------------------------------------------------
// Проголосовало сегодня
//----------------------------------------------------------------------------------------------------------------------
var donutChartCanvas = $('#voted').get(0).getContext('2d');
var donutData = {
    labels: [
        'Проголосовали',
        'Не проголосовали',
    ],
    datasets: [
        {
            data: [usersVotedCount, usersNotVotedCount],
            backgroundColor: ['#00a65a','#f56954'],
        }
    ]
};
var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
};
var donutChart = new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
});

//----------------------------------------------------------------------------------------------------------------------
// Здоровье сегодня
//----------------------------------------------------------------------------------------------------------------------
var donutChartCanvas = $('#health_today').get(0).getContext('2d');
var donutData = {
    labels: ['1','2','3','4','5'],
    datasets: [
        {
            data: healthData,
            backgroundColor: ['#f56954', '#f39c12', '#00c0ef', '#3c8dbc', '#00a65a'],
        }
    ]
};
var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
};
var donutChart = new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
});

//----------------------------------------------------------------------------------------------------------------------
// Настроение сегодня
//----------------------------------------------------------------------------------------------------------------------
var donutChartCanvas = $('#mood_today').get(0).getContext('2d');
var donutData = {
    labels: ['1','2','3','4','5'],
    datasets: [
        {
            data: moodData,
            backgroundColor: ['#f56954', '#f39c12', '#00c0ef', '#3c8dbc', '#00a65a'],
        }
    ]
};
var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
};
var donutChart = new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
});

//----------------------------------------------------------------------------------------------------------------------
// Работа сегодня
//----------------------------------------------------------------------------------------------------------------------
var donutChartCanvas = $('#job_today').get(0).getContext('2d');
var donutData = {
    labels: ['1','2','3','4','5'],
    datasets: [
        {
            data: jobData,
            backgroundColor: ['#f56954', '#f39c12', '#00c0ef', '#3c8dbc', '#00a65a'],
        }
    ]
};
var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
};
var donutChart = new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
});





var areaChartData = {
    labels: ['01.04.2020', '02.04.2020', '03.04.2020', '04.04.2020', '05.04.2020', '06.04.2020', '07.04.2020'],
    datasets: [
        {
            label: 'Здоровье',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    ]
}

var areaChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
        display: false
    },
    scales: {
        xAxes: [{
            gridLines: {
                display: false,
            }
        }],
        yAxes: [{
            gridLines: {
                display: false,
            }
        }]
    }
}

var lineChartCanvas = $('#health_2').get(0).getContext('2d')
var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
var lineChartData = jQuery.extend(true, {}, areaChartData)
lineChartData.datasets[0].fill = false;
lineChartOptions.datasetFill = false

var lineChart = new Chart(lineChartCanvas, {
    type: 'line',
    data: lineChartData,
    options: lineChartOptions
})