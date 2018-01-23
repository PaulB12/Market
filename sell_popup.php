<html>
    <head>
        <title>LimeLight - Market</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/market/assets/bootstrap/css/bootstrap.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/market/assets/bootstrap/css/bootstrap-theme.min.css">

        <!-- Google Font's -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

        <!-- Chart JS file -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="/market/assets/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/market/assets/css/sell_popup.css">
        <link rel="stylesheet" href="/market/assets/css/template.css">
    </head>
    <body>
        <br><br>
        <div class="modal-box">
            <div class="modal-header">
                <h4>List an item for sale</h4>
            </div>
            <div class="modal-content">
                <div class="modal-inner-content">
                    <div class="modal-inner-main">
                        <img class="modal-image" src="http://via.placeholder.com/128x128" height=128 width=128>
                        <h3 class="item-title">&nbsp;Goldfish</h3>
                        <div class="item-description">Studies indicate that more than 41 goldfish are flushed down the toilet everyday.<br>They ended up in the lake, and now they're in your inventory.</div>
                    </div>
                    <hr>
                    <div class="modal-inner-main-sec-wrapper">
                        <div class="modal-inner-main-sec">
                            <div class="graph-title">
                                Average Sale Price
                            </div>
                            <div style="max-height:250px; max-width: 100%">
                                <canvas id="modal-graph" width="1000" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="modal-inner-main-sec2-wrapper">
                        <div class="modal-inner-main2-sec">
                            <div class="sellText">
                                Quantity: <input type="number" min="1" step="1" value="1" class="quantity">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You recieve: $<input type="number" min="0.1" step="0.1" value="0.00" class="sellerRecieve">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buyer pays: $<input type="number" min="0.1" step="0.1" value="0.00" class="sellerRecieve">
                            </div>
                            <span class="button">Sell this item</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </body>
    <script>
    var ctx = document.getElementById('modal-graph').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        options: {
            global: {
                responsive: true,
                maintainAspectRatio: false
            }
        },
        data: {
            labels: ['01', '02', '03', '05', '06', '09'],
            datasets: [{
                label: 'Test 01',
                data: [1, 2, 3, 6]
            },
            {
                label: 'Test 03',
                data: [3, 2, 5, 10, 23, 21]
            },
            {
                label: 'Test 02',
                data: [3, 9, 5, 5, 6, 29]
            }
        ]}
    });
    </script>
</html>
