<html>
    <head>
        <title>LimeLight - Market</title>
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/market/assets/bootstrap/css/bootstrap.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/market/assets/bootstrap/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="/market/assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- Google Font's -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

        <!-- Chart JS file -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

        <!-- Sweet Alert file -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- Market house css files -->
        <link rel="stylesheet" href="/market/assets/css/listing.css">
        <link rel="stylesheet" href="/market/assets/css/template.css">
        <link rel="stylesheet" href="/market/assets/css/buy-modal.css">
        <link rel="stylesheet" href="/market/assets/css/sell-modal.css">
        <link rel="stylesheet" href="/market/assets/css/ajax-loader.css">
    </head>
    <body>
        <div class="sell-modal-box">
            <div class="sell-modal-header">
                <h4>List an item for sale<span class="sell-close" style="float: right;">&times;</span></h4>
            </div>
            <div class="sell-modal-content">
                <div class="sell-modal-inner-content">
                    <div class="sell-modal-inner-main">
                        <img class="sell-modal-image" src="http://via.placeholder.com/128x128" height=128 width=128>
                        <div class="item-description-sell-modal"><strong>Goldfish<br>Studies indicate that more than 41 goldfish are flushed down the toilet everyday.<br>They ended up in the lake, and now they're in your inventory.</div>
                    </div>
                    <hr>
                    <div class="sell-modal-inner-main-sec-wrapper">
                        <div class="sell-modal-inner-main-sec">
                            <div class="graph-title">
                                Average Sale Price
                            </div>
                            <div style="max-height:250px; max-width: 100%">
                                <canvas id="sell-modal-graph" width="1000" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="sell-modal-inner-main-sec2-wrapper">
                        <div class="sell-modal-inner-main2-sec">
                            <div class="sellText">
                                Quantity: <input type="number" min="1" step="1" value="1" data-number-to-fixed="2" data-number-stepfactor="100" class="quantity">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You recieve: $
                                <input type="text" value="10,000.00" data-number-to-fixed="2" data-number-stepfactor="100" class="sellerRecieve" id="sellerRecieve">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buyer pays: $
                                <input type="text" value="10,200.00" class="buyerPays" id="buyerPays">
                            </div>
                            <span class="button-sell-modal" onclick="sellItem(2)">Sell this item</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="buy-modal-box">
            <div class="buy-modal-header">
                <h4>Buy an item<span class="buy-close" style="float: right;">&times;</span></h4>
            </div>
            <div class="buy-modal-content">
                <div class="buy-modal-inner-content">
                    <div class="buy-modal-inner-main">
                        <img class="buy-modal-image" src="http://via.placeholder.com/128x128" height=128 width=128>
                        <div class="item-description-buy-modal"><strong>Goldfish<br>Studies indicate that more than 41 goldfish are flushed down the toilet everyday.<br>They ended up in the lake, and now they're in your inventory.</div>
                    </div>
                    <hr>
                    <div class="buy-modal-inner-main-sec-wrapper">
                        <div class="buy-modal-inner-main-sec">
                            <div class="graph-title">
                                Average Sale Price
                            </div>
                            <div style="max-height:250px; max-width: 100%">
                                <canvas id="buy-modal-graph" width="1000" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="buy-modal-inner-main-sec2-wrapper">
                        <div class="buy-modal-inner-main2-sec">
                            <div class="sellText">
                                Quantity: <input type="number" min="1" step="1" value="1" data-number-to-fixed="2" data-number-stepfactor="100" class="bquantity">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You pay: $
                                <input type="text" value="1,000.00" data-number-to-fixed="2" data-number-stepfactor="100" class="buyPays" id="buyPays">
                            </div>
                            <span class="button-buy-modal" onclick="buyItem(2)">Buy this item</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-xs-24">
                &nbsp;
            </div>
            <div class="col-xs-24 header">
                <a href="/market/">
                    <h1 class="header-title">Community Market</h1>
                    <p class="header-text">Buy and sell in-game items with other LimeLight community members.</p>
                </a>
            </div>
            <div class="col-xs-24 main">
                <div class="col-xs-3"></div>
                <div class="col-xs-18 content">
                    <div class="inner-content">
                        <div class="image-holder">
                            <img src="https://i.imgur.com/dS5I3uj.jpg" width=360 height=360 class="image">
                        </div>
                        <div class="item-info">
                            <h2 class="item-header">Category > Food > Goldfish</h2>
                            <p class="item-description">
                                Studies indicate that more than 41 goldfish are flushed down the toilet everyday.<br>They ended up in the lake, and now they're in your inventory.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3"></div>
            </div>
            <div class="col-xs-24 main">
                <div class="col-xs-3"></div>
                <div class="col-xs-18 content">
                    <div class="col-xs-2"></div>
                    <div class="col-xs-8 sellBox">
                        <div class="sellHeader">
                            <div class="sellTitle">
                                <span class="strongWhite">18</span> for sale starting at <span class="strongWhite">$450</span>
                                <br>
                                <span class="button" id="buyBtn">Buy...</span>
                            </div>
                            <br>
                            <hr>
                            <div class="quantityTable">
                                <table class="table table-striped table-responsive no-border">
                                    <thead>
                                        <tr>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="row1">
                                            <td>$450</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>$460</td>
                                            <td>3</td>
                                        </tr>
                                        <tr class="row1">
                                            <td>$480</td>
                                            <td>6</td>
                                        </tr>
                                        <tr>
                                            <td>$490</td>
                                            <td>4</td>
                                        </tr>
                                        <tr class="row1">
                                            <td>$500</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>$510 or more</td>
                                            <td>2</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4"></div>
                    <div class="col-xs-8 buyBox">
                        <div class="buyHeader">
                            <div class="buyTitle">
                                <span class="strongWhite">32</span> requests to buy at <span class="strongWhite">$440</span> or lower
                                <br>
                                <span class="button" onclick="sellModal(2)">Sell...</span>
                            </div>
                            <br>
                            <hr>
                            <div class="quantityTable">
                                <table class="table table-striped no-border">
                                    <thead>
                                        <tr>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="row1">
                                            <td>$440</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>$430</td>
                                            <td>6</td>
                                        </tr>
                                        <tr class="row1">
                                            <td>$420</td>
                                            <td>4</td>
                                        </tr>
                                        <tr>
                                            <td>$410</td>
                                            <td>5</td>
                                        </tr>
                                        <tr class="row1">
                                            <td>$400</td>
                                            <td>10</td>
                                        </tr>
                                        <tr>
                                            <td>$390 or less</td>
                                            <td>5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2"></div>
                </div>
                <div class="col-xs-3"></div>
            </div>
            <div class="col-xs-24 sec-main">
                <div class="col-xs-3"></div>
                <div class="col-xs-18 moreContent">
                    <div class="col-xs-1"></div>
                    <div class="col-xs-22 activity">
                        <h2 class="activityHeader">Recent Activity</h2>

                        <div class="activityRow"><img class="activityImage" src="http://cdn.edgecast.steamstatic.com/steamcommunity/public/images/avatars/63/63f7b6d604fd42cbb780cd04815075ca9d1f786e.jpg" width=64 height=64>&nbsp; <span class="strongGreyText">[L²] PaulB</span><span class="activity">&nbsp;listed this item for sale for $480</span></div>
                        <div class="activityRow"><img class="activityImage" src="http://cdn.edgecast.steamstatic.com/steamcommunity/public/images/avatars/63/63f7b6d604fd42cbb780cd04815075ca9d1f786e.jpg" width=64 height=64>&nbsp; <span class="strongGreyText">[L²] PaulB</span><span class="activity">&nbsp;listed this item for sale for $450</span></div>
                        <div class="activityRow"><img class="activityImage" src="http://cdn.edgecast.steamstatic.com/steamcommunity/public/images/avatars/63/63f7b6d604fd42cbb780cd04815075ca9d1f786e.jpg" width=64 height=64>&nbsp; <span class="strongGreyText">[L²] PaulB</span><span class="activity">&nbsp;purchased this item from&nbsp;</span><img class="activityImage" src="http://cdn.edgecast.steamstatic.com/steamcommunity/public/images/avatars/63/63f7b6d604fd42cbb780cd04815075ca9d1f786e.jpg" width=64 height=64>&nbsp; <span class="strongGreyText">[L²] PaulB</span>&nbsp; for $430</div>
                        <br>
                        <hr>
                        <h2 class="activityHeader">Median Price</h2>
                        <canvas id="medianChart"></canvas>
                        <br>
                        <hr>
                        <h2 class="activityHeader">Buy/Sell Orders</h2>
                        <canvas id="orders"><canvas>
                    </div>
                    <div class="col-xs-1"></div>
                </div>
                <div class="col-xs-3"></div>
            </div>
        </div>
    </body>
    <script src="assets/js/buy-modal.js"></script>
    <script src="assets/js/sell-modal.js"></script>
    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/listing.js"></script>
</html>
