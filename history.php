<?php
    $category = ["Cards","Clothing","Food","Government Vehicles","Ingredients","Misc.","Mixtures","Packaging","Vehicle Supplies","Vehicles"];
    if((!isset($_GET["category"]) || (!is_numeric($_GET["category"])) || ($_GET["category"] <= 0) || (5 * $_GET["category"]) >= (count($category)))) {
            $counter = 0;
    } else {
        $counter = $_GET["category"];
    }
?>
<html>
    <head>
        <title>LimeLight - Market</title>
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/market/assets/bootstrap/css/bootstrap.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/market/assets/bootstrap/css/bootstrap-theme.min.css">

        <!-- Google Font's -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

        <!-- Latest compiled and minified JavaScript -->
        <script src="/market/assets/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/market/assets/css/history.css">
        <link rel="stylesheet" href="/market/assets/css/template.css">
    </head>
    <body>
        <div class="container-fluid page">
            <div class="col-xs-24">
                &nbsp;
            </div>

            <div class="col-xs-24 header">
                <a href="/market/">
                    <h1 class="header-title">Community Market</h1>
                    <p class="header-text">Buy and sell in-game items with other LimeLight community members.</p>
                </a>
            </div>
            <div class="col-xs-24 inner-body">
                <div class="myListings">
                    <h4 class="col-xs-16 listingsTitle">&nbsp;</h4>
                    <div class="col-xs-4"></div>
                    <div class="col-xs-2 sellButton2">
                        <a href="history.php">Transactions</a>
                    </div>
                    <div class="col-xs-2 sellButton">
                        <a href="inventory.php">Sell an item</a>
                    </div>
                </div>
                <div class="col-xs-24 marketActivity">
                    <div class="col-xs-24 header">
                        <h3 class="header-title center-only">Previous Transactions</h3>
                    </div>
                    <div class="col-xs-24 marketActivityTable">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th class="col-xs-4">ITEM</th>
                                    <th class="col-xs-4 center">CREATED ON</th>
                                    <th class="col-xs-4 center">MODIFIED</th>
                                    <th class="col-xs-4 center">3RD PARTY</th>
                                    <th class="col-xs-4 center">PRICE</th>
                                <tr>
                            </thead>
                            <tbody>
                                <tr class="link" data-href='listing.php?id='>
                                    <td class="small">
                                        <img class="img" src="http://via.placeholder.com/64x64" width="48" height="48">
                                        <strong class="below">Dodge Charger Interceptor</strong><br>
                                        <span class="below">Government Vehicles</span>
                                    </td>
                                    <td class="center small">
                                        22nd Jan
                                    </td>
                                    <td class="center small">
                                        <span class="center">23rd Jan</span>
                                    </td>
                                    <td class="small">
                                        <img class="img" src="http://cdn.edgecast.steamstatic.com/steamcommunity/public/images/avatars/d2/d274add4a07cbf04b0ec938e4904f43688c41d6a.jpg" width="48" height="48">
                                        <span class="history-info">Seller:</span>
                                        <br>
                                        <span class="history-info">Nightmare</span>
                                    </td>
                                    <td class="center small">
                                        <span class="center">$2,500,000</span>
                                    </td>
                                </tr>
                                <tr class="link" data-href='listing.php?id='>
                                    <td class="small">
                                        <img class="img" src="http://via.placeholder.com/64x64" width="48" height="48">
                                        <strong class="below">Tides Truck</strong><br>
                                        <span class="below">Vehicles</span>
                                    </td>
                                    <td class="center small">
                                        21st Jan
                                    </td>
                                    <td class="center small">
                                        <span class="center"></span>
                                    </td>
                                    <td class="center small">
                                        <span class="center">Listing Created</span>
                                    </td>
                                    <td class="center small">
                                        <span class="center">$120,000</span>
                                    </td>
                                </tr>
                                <tr class="link" data-href='listing.php?id='>
                                    <td class="small">
                                        <img class="img" src="http://via.placeholder.com/64x64" width="48" height="48">
                                        <strong class="below">Gold Fish</strong><br>
                                        <span class="below">Food</span>
                                    </td>
                                    <td class="center small">
                                        20th Jan
                                    </td>
                                    <td class="center small">
                                        <span class="center">22nd Jan</span>
                                    </td>
                                    <td class="small">
                                        <img class="img" src="http://cdn.edgecast.steamstatic.com/steamcommunity/public/images/avatars/d2/d274add4a07cbf04b0ec938e4904f43688c41d6a.jpg" width="48" height="48">
                                        <span class="history-info">Buyer:</span>
                                        <br>
                                        <span class="history-info">Nightmare</span>
                                    </td>
                                    <td class="center small">
                                        <span class="center">$500</span>
                                    </td>
                                </tr>
                                <tr class="link" data-href='listing.php?id='>
                                    <td class="small">
                                        <img class="img" src="http://via.placeholder.com/64x64" width="48" height="48">
                                        <strong class="below">Fish</strong><br>
                                        <span class="below">Food</span>
                                    </td>
                                    <td class="center small">
                                        20th Jan
                                    </td>
                                    <td class="center small">
                                        <span class="center">22nd Jan</span>
                                    </td>
                                    <td class="small">
                                        <img class="img" src="http://cdn.edgecast.steamstatic.com/steamcommunity/public/images/avatars/d2/d274add4a07cbf04b0ec938e4904f43688c41d6a.jpg" width="48" height="48">
                                        <span class="history-info">Buyer:</span>
                                        <br>
                                        <span class="history-info">Nightmare</span>
                                    </td>
                                    <td class="center small">
                                        <span class="center">$200</span>
                                    </td>
                                </tr>
                                <tr class="link" data-href='listing.php?id='>
                                    <td class="small">
                                        <img class="img" src="http://via.placeholder.com/64x64" width="48" height="48">
                                        <strong class="below">Lamborghini Reventon</strong><br>
                                        <span class="below">Vehicles</span>
                                    </td>
                                    <td class="center small">
                                        19th Jan
                                    </td>
                                    <td class="center small">
                                        <span class="center"></span>
                                    </td>
                                    <td class="small center">
                                        <span class="history-info">Listing Created</span>
                                    </td>
                                    <td class="center small">
                                        <span class="center">$2,500,000</span>
                                    </td>
                                </tr>
                                <tr class="link" data-href='listing.php?id='>
                                    <td class="small">
                                        <img class="img" src="http://via.placeholder.com/64x64" width="48" height="48">
                                        <strong class="below">BMW i8</strong><br>
                                        <span class="below">Vehicles</span>
                                    </td>
                                    <td class="center small">
                                        19th Jan
                                    </td>
                                    <td class="center small">
                                        <span class="center"></span>
                                    </td>
                                    <td class="small center">
                                        <span class="history-info">Listing Created</span>
                                    </td>
                                    <td class="center small">
                                        <span class="center">$2,500,000</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-24">
                        <span class="results">Showing results: 1-10 of 106 results</span>
                        <span class="pagination">
                            <span class="disabled" href="#">❮</span>
                            <span class="disabled" href="#">1</span>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">❯</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="assets/js/index.js"></script>
</html>
