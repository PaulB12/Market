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
