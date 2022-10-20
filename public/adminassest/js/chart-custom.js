
(function($){
    "user strict";

    var ctx = document.getElementById('stat-chart-1').getContext('2d');
    ctx.canvas.height = 430;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'Jun'],
            datasets: [{
                label: '# Monthly site visitors',
                data: [500, 750, 550, 850, 750, 1020],
                backgroundColor: [
                    'rgba(20, 171, 239, 1)'
                ],
                pointBorderColor: [
                    'white',
                    'white',
                    'white',
                    'white',
                    'white',
                    'white'
                ],
                borderColor: [
                    'transparent'
                ],
                borderWidth: 3,
                backgroundColor: 'rgba(20, 171, 239, 0.35)',
                pointRadius: 5,
                pointHoverRadius: 5
                
            }]
        },
        options: {
            maintainAspectRatio: false,
            elements: {
                line: {
                    tension: 0 // disables bezier curves
                }
            },
            scales: {
                xAxes: [{
                    gridLines: { color: "transparent" }
                }],
                yAxes: [{
                    gridLines: { color: "rgba(0, 0, 0, 0.15)" },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });


    var ctx = document.getElementById('stat-chart-2').getContext('2d');
    ctx.canvas.height = 150;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'Jun'],
            datasets: [{
                label: '# Monthly site visitors',
                data: [500, 750, 550, 850, 750, 1020],
                backgroundColor: [
                    'rgba(20, 171, 239, 1)'
                ],
                pointBackgroundColor: [
                    'rgba(231, 80, 90, 1)',
                    'rgba(231, 80, 90, 1)',
                    'rgba(231, 80, 90, 1)',
                    'rgba(231, 80, 90, 1)',
                    'rgba(231, 80, 90, 1)',
                    'rgba(231, 80, 90, 1)'
                ],
                pointBorderColor: [
                    'rgba(231, 80, 90, 0.75)',
                    'rgba(231, 80, 90, 0.75)',
                    'rgba(231, 80, 90, 0.75)',
                    'rgba(231, 80, 90, 0.75)',
                    'rgba(231, 80, 90, 0.75)',
                    'rgba(231, 80, 90, 0.75)'
                ],
                borderColor: [
                    'rgba(231, 80, 90, 0.75)'
                ],
                borderWidth: 3,
                pointBorderWidth: 3,
                backgroundColor: 'rgba(231, 80, 90, 0.15)',
                pointRadius: 4,
                pointHoverRadius: 4
                
            }]
        },
        options: {
            elements: {
                line: {
                    tension: 0 // disables bezier curves
                }
            },
            scales: {
                xAxes: [{
                    gridLines: { color: "transparent" }
                }],
                yAxes: [{
                    gridLines: { color: "rgba(0, 0, 0, 0.15)" },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

})(jQuery);