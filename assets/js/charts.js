const ctx = document.getElementById('myChart');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Item 1', 'Item 2', 'Item 3'],
        datasets: [
            {
                type: 'line',
                label: 'Line Number One',
                data: [10, 20, 30],
            },
            {
                type: 'line',
                label: 'Line Number Two',
                data: [10, 20, 30],
            }
        ]
    }
});

