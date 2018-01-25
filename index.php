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
        <link rel="stylesheet" href="/market/assets/css/index.css">
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
                    <h4 class="col-xs-16 listingsTitle">My sell listings <small>(2)</small></h4>
                    <div class="col-xs-3"></div>
                    <div class="col-xs-2 sellButton">
                        <a href="inventory.php">Sell an item</a>
                    </div>
                </div>
                <div class="col-xs-24 listingsTable">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th class="col-xs-10">ITEM</th>
                                <th class="col-xs-4 center">LISTED ON</th>
                                <th class="col-xs-4 center">PRICE</th>
                                <th class="col-xs-6 center">ACTION</th>
                            <tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="link" data-href='listing.php?id='><img class="img" src="http://via.placeholder.com/48x48"><strong class="float-top">&nbsp;BMW i8</strong><p class="float-below">&nbsp;Vehicles</p></td>
                                <td class="center small link" data-href='listing.php?id='>Dec 26th</td>
                                <td class="center small link" data-href='listing.php?id='>$4,000,000</td>
                                <td class="center small"><a href="#">Remove</href></td>
                            </tr>
                            <tr>
                                <td class="link" data-href='listing.php?id='><img class="img" src="http://via.placeholder.com/48x48"><strong class="float-top">&nbsp;Lamborghini Reventon</strong><p class="float-below">&nbsp;Vehicles</p></td>
                                <td class="center small link" data-href='listing.php?id='>Dec 27th</td>
                                <td class="center small link" data-href='listing.php?id='>$10,000,000</td>
                                <td class="center small"><a href="#">Remove</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-18 marketActivity">
                    <div class="col-xs-24 header">
                        <h3 class="header-title center-only">Popular Market Activity</h3>
                    </div>
                    <div class="col-xs-24 marketActivityTable">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th class="col-xs-10">ITEM</th>
                                    <th class="col-xs-4 center">QUANTITY</th>
                                    <th class="col-xs-4 center">PRICE</th>
                                <tr>
                            </thead>
                            <tbody>
                                <tr class="link" data-href='listing.php?id='>
                                    <td class="small">
                                        <img class="img" src="http://via.placeholder.com/64x64" width="64" height="64">
                                        <strong>&nbsp;Fish</strong>
                                        <p>&nbsp;Food</p>
                                    </td>
                                    <td class="center small">
                                        2232
                                    </td>
                                    <td class="center small">
                                        <p>Starting at:</p>
                                        <p>$225</p>
                                    </td>
                                </tr>
                                <tr class="link" data-href='listing.php?id='>
                                    <td class="small">
                                        <img class="img" src="http://via.placeholder.com/64x64" width="64" height="64">
                                        <strong>&nbsp;BMW i8</strong>
                                        <p>&nbsp;Vehicles</p>
                                    </td>
                                    <td class="center small">
                                        100
                                    </td>
                                    <td class="center small">
                                        <p>Starting at:</p>
                                        <p>$1,000,000</p>
                                    </td>
                                </tr>
                                <tr class="link" data-href='listing.php?id='>
                                    <td class="small">
                                        <img class="img" src="http://via.placeholder.com/64x64" width="64" height="64">
                                        <strong>&nbsp;Lamborghini Reventon</strong>
                                        <p>&nbsp;Vehicles</p>
                                    </td>
                                    <td class="center small">
                                        21
                                    </td>
                                    <td class="center small">
                                        <p>Starting at:</p>
                                        <p>$10,000,000</p>
                                    </td>
                                </tr>
                                <tr class="link" data-href='listing.php?id='>
                                    <td class="small">
                                        <img class="img" src="http://via.placeholder.com/64x64" width="64" height="64">
                                        <strong>&nbsp;Tides Truck</strong>
                                        <p>&nbsp;Vehicles</p>
                                    </td>
                                    <td class="center small">
                                        19
                                    </td>
                                    <td class="center small">
                                        <p>Starting at:</p>
                                        <p>$100,000</p>
                                    </td>
                                </tr>
                                <tr class="link" data-href='listing.php?id='>
                                    <td class="small">
                                        <img class="img" src="http://via.placeholder.com/64x64" width="64" height="64">
                                        <strong>&nbsp;Gold Fish</strong>
                                        <p>&nbsp;Food</p>
                                    </td>
                                    <td class="center small">18</td>
                                    <td class="center small">
                                        <p>Starting at:</p>
                                        <p>$1,000</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-1"></div>
                </div>
                <div class="col-xs-6 searchActivity">
                    <div class="col-xs-24">
                        <h3 class="searchTitle">Find Items</h3>
                        <p class="searchText">Looking for a specific item?</p>
                    </div>
                    <div class="searchBox col-xs-24">
                        <form method="get" action="search.php">
                            <div class="input-group">
                                <input type="text" class="search-query form-control searchBar" placeholder="Search" id='query' name='query' />
                                <span class="input-group-btn blackButton">
                                    <button class="btn blackButton" type="submit" style="height: 33px; top:0px;">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="searchByCategory col-xs-24">
                        <p class="categorySearch">Browse by category:</p>
                        <div class="categoryTable">
                            <?php
                                $max = count($category);
                                for($i = 0; $i < $max; $i++) {
                                    echo "
                                    <a href='/market/search.php?category={$i}'>
                                        <div class='categoryRow'>{$category[$i]}</div>
                                    </a>";
                                }
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="assets/js/index.js"></script>
</html>
