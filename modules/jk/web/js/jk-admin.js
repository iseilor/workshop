// Проценты ------------------------------------------------------------------------------------------------------------
var donutChartCanvas = $('#percents').get(0).getContext('2d');
var donutData = {
    labels: [
        'Одобрено',
        'НЕ одобрено',
    ],
    datasets: [
        {
            data: [percentY, percentN],
            backgroundColor: ['#00a65a','#f56954'],
        }
    ]
};
var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
        display: false
    }
};

var donutChart = new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
});

// Займа    ------------------------------------------------------------------------------------------------------------
var donutChartCanvas = $('#zaims').get(0).getContext('2d');
var donutData = {
    labels: [
        'Одобрено',
        'НЕ одобрено',
    ],
    datasets: [
        {
            data: [zaimY, zaimN],
            backgroundColor: ['#00a65a','#f56954'],
        }
    ]
};
var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
        display: false
    }
};
var donutChart = new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
});


// График заявки, сгруппированные по статусам --------------------------------------------------------------------------
var donutChartCanvas = $('#orders').get(0).getContext('2d');
var donutData = {
    labels: Object.values(statuses),
    datasets: [
        {
            data: Object.values(ordersGroupStatus),
            backgroundColor: Object.values(statusColors),
        }
    ]
};
var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
        display: false,
    }
};
var donutChart = new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
});

// График по отказам ---------------------------------------------------------------------------------------------------
var donutChartCanvas = $('#voted').get(0).getContext('2d');
var donutData = {
    labels: [
        'Заявки в работе',
        'Отказ по инициативе сотрудника',
    ],
    datasets: [
        {
            data: [orderCount-orderStopCount, orderStopCount],
            backgroundColor: ['#00a65a','#f56954'],
        }
    ]
};
var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
        display: false
    }
};
var donutChart = new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
});

// Отказы, сгруппированные по статусам --------------------------------------------------------------------------
var donutChartCanvas = $('#stopGroupStatus').get(0).getContext('2d');
var donutData = {
    labels: Object.values(statuses),
    datasets: [
        {
            data: Object.values(ordersStopGroupStatus),
            backgroundColor: Object.values(statusColors),
        }
    ]
};
var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
        display: false,
    }
};
var donutChart = new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
});