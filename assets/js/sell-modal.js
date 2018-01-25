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
function sellModal(item_id) {
    sellmodal.style.display = "block";
    $.ajax({
        type: 'POST',
        url: 'test.php',
        data: {
            itemid: item_id,
        },
        success: function(response) {
            if(response.status == 'success') {
                var text = "<strong>"+response.item_name+"<br>"+response.description+"</strong>";
                $('.item-description-sell-modal').html(text);
                $('.sell-modal-image').attr('src',response.img);
                $('.quantity').val(response.qty);
                $('.quantity').attr('max',response.qty);
            }
            else if(response.status == 'error') {
                console.log('Invalid ItemID');
            }
            else {
                console.log('AJAX Request failed, contact a developer');
            }
        }
    });
}
window.onclick = function(event) {
    if (event.target == sellmodal) {
        sellmodal.style.display = "none";
    }
}

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
