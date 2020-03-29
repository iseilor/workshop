<?php

use app\modules\pulsar\Module;
use kartik\icons\Icon;

$this->title = Icon::show('chart-bar') . Module::t('module', 'Pulsars Statistics');
$this->params['breadcrumbs'][] = [
    'label' => Icon::show('heartbeat') . Module::t('module', 'Pulsars'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;

use app\modules\pulsar\assets\PulsarAsset;

PulsarAsset::register($this);
?>

<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?=Icon::show('smile')?>Здоровье</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <h5>Текущий показатель сегодня: <span class="badge badge-success">4.5</span>
                    </h5>
                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <hr/>
                <div class="chart">
                    <h5>Подано данных сегодня: <span class="badge badge-warning">50%</span></h5>
                    <canvas id="donutChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

                </div>
                <hr/>
                <div class="chart">
                    <h5>Статистика за неделю:</h5>
                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <hr/>
                <div class="chart">
                    <h5>Статистика за месяц:</h5>
                    <canvas id="lineChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Обновить</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?=Icon::show('smile')?>Настроение</h3>
            </div>
            <div class="card-body">
                123
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Обновить</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?=Icon::show('desktop')?>Работа</h3>
            </div>
            <div class="card-body">
                123
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Обновить</button>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<< JS
$(function () {
            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
            var donutData = {
                labels: [
                    '1',
                    '2',
                    '3',
                    '4',
                    '5'
                ],
                datasets: [
                    {
                        data: [700, 500, 400, 600, 300],
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }
                ]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })
            
           
            // Вторая диаграма
            var donutChartCanvas = $('#donutChart2').get(0).getContext('2d');
            var donutData = {
                labels: [
                    'Проголосовали',
                    'Не проголосовали',
                   
                ],
                datasets: [
                    {
                        data: [50, 50],
                        backgroundColor: [ '#00a65a','#f56954'],
                    }
                ]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })
            
            
            
            
            
            
            var areaChartData = {
      labels  : ['01.04.2020', '02.04.2020', '03.04.2020', '04.04.2020', '05.04.2020', '06.04.2020', '07.04.2020'],
      datasets: [
        {
          label               : 'Здоровье',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        }
      ]
    }
    
     var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }
             //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })
    
     //--------------
    var lineChartCanvas = $('#lineChart2').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })
    
})
JS;

$this->registerJs($js, $position = yii\web\View::POS_READY, $key = null);
?>




