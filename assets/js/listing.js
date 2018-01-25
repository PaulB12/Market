var ctx = document.getElementById('medianChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: 'Price ($)',
            backgroundColor: 'rgba(0, 204, 147, 0.1)',
            borderColor: 'rgb(0, 204, 147)',
            data: [0, 10, 5, 2, 20, 30, 45],
        }]
    },

    // Configuration options go here
    options: {
        fill: false
    }
});

var ctx = document.getElementById('orders').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ["$0.04", "$0.10", "$0.15", "$0.20", "$0.25", "$0.30", "$0.32"],
        datasets: [{
            label: 'Buy Orders',
            data: [40, 25, 10, 0, 0, 0, 0],
            backgroundColor: 'rgba(102, 140, 255, 0.1)',
            borderColor: [
                'rgb(77, 121, 255)',
                'rgb(77, 121, 255)',
                'rgb(77, 121, 255)',
                'rgba(0, 0, 0, 0)',
                'rgba(0, 0, 0, 0)',
                'rgba(0, 0, 0, 0)',
                'rgba(0, 0, 0, 0)'
            ],
            borderWidth: 1
        },{
            label: 'Sell Orders',
            data: [0, 0, 0, 0, 20, 30, 55],
            backgroundColor: 'rgba(0, 204, 147, 0.1)',
            borderColor: [
                'rgba(0, 0, 0, 0)',
                'rgba(0, 0, 0, 0)',
                'rgba(0, 0, 0, 0)',
                'rgba(0, 0, 0, 0)',
                'rgb(0, 204, 147)',
                'rgb(0, 204, 147)',
                'rgb(0, 204, 147)'
            ],
            borderWidth: 1
        }]
    },

    // Configuration options go here
    options: {
        fill: false
    }
});
