$("#buyPays").keyup(function(event) {
    if (event.keyCode == 38) {
        var buyPays = $(this).val().replace(/,/g, "");
        var buyPays = parseFloat(buyPays) + 1000;
        var val = (buyPays.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        $(this).val(val);
        if (val < 0) {
            var val = 0;
        }
    }
    if (event.keyCode == 40) {
        var buyPays = $(this).val().replace(/,/g, "");
        var buyPays = parseFloat(buyPays) - 1000;
        var val = (buyPays.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        if (val < 0) {
            var val = 0;
        }
        $(this).val(val);
    }
});
$("#buyerPays").keyup(function(event) {
    if (event.keyCode == 38) {
        var buyerPays = $(this).val().replace(/,/g, "");
        var buyerPays = parseFloat(buyerPays) + 1000;
        var sellerRecieve = (buyerPays * 0.98).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        var val = (buyerPays.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        if (val < 0 || sellerRecieve < 0) {
            var val = 0;
            var sellerRecieve = 0;
        }
        $('#sellerRecieve').val(sellerRecieve);
        $(this).val(val);
    }
    if (event.keyCode == 40) {
        var buyerPays = $(this).val().replace(/,/g, "");
        var buyerPays = parseFloat(buyerPays) - 1000;
        var sellerRecieve = (buyerPays * 0.98).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        var val = (buyerPays.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        if (val < 0 || sellerRecieve < 0) {
            var val = 0;
            var sellerRecieve = 0;
        }
        $('#sellerRecieve').val(sellerRecieve);
        $(this).val(val);
    }
});
$("#sellerRecieve").keyup(function(event) {
    if (event.keyCode == 38) {
        var sellerRecieve = $(this).val().replace(/,/g, "");
        var sellerRecieve = parseFloat(sellerRecieve) + 1000;
        var buyerPays = (sellerRecieve * 1.02).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        var val = (sellerRecieve.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        if (val < 0 || buyerPays < 0) {
            var val = 0;
            var buyerPays = 0;
        }
        $('#buyerPays').val(buyerPays);
        $(this).val(val);
    }
    if (event.keyCode == 40) {
        var sellerRecieve = $(this).val().replace(/,/g, "");
        var sellerRecieve = parseFloat(sellerRecieve) - 1000;
        var buyerPays = (sellerRecieve * 1.02).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        var val = (sellerRecieve.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        if (val < 0 || buyerPays < 0) {
            var val = 0;
            var buyerPays = 0;
        }
        $('#buyerPays').val(buyerPays);
        $(this).val(val);
    }
});


var sellmodal = document.getElementsByClassName('sell-modal-box')[0];
var sellbutton = document.getElementById("sellBtn");
var sellspan = document.getElementsByClassName("sell-close")[0];
sellspan.onclick = function() {
    sellmodal.style.display = "none";
}
sellbutton.onclick = function() {
    sellmodal.style.display = "block";
}
window.onclick = function(event) {
    if (event.target == sellmodal) {
        sellmodal.style.display = "none";
    }
}

var buymodal = document.getElementsByClassName('buy-modal-box')[0];
var buybutton = document.getElementById("buyBtn");
var buyspan = document.getElementsByClassName("buy-close")[0];
buyspan.onclick = function() {
    buymodal.style.display = "none";
}
buybutton.onclick = function() {
    buymodal.style.display = "block";
}
window.onclick = function(event) {
    if (event.target == buymodal) {
        buymodal.style.display = "none";
    }
}

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

var ctx = document.getElementById('sell-modal-graph').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    options: {
        global: {
            responsive: true,
            maintainAspectRatio: false
        }
    },
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Sale Price $',
            data: [1000, 2000, 1500, 2000, 1500, 3000, 1000, 2000, 1500, 2000, 1500, 3000,]
        }
    ]}
});
var ctx = document.getElementById('buy-modal-graph').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    options: {
        global: {
            responsive: true,
            maintainAspectRatio: false
        }
    },
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Sale Price $',
            data: [1000, 2000, 1500, 2000, 1500, 3000, 1000, 2000, 1500, 2000, 1500, 3000,]
        }
    ]}
});
