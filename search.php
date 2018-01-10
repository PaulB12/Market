<?php
    $category = ["Cards","Clothing","Food","Government Vehicles","Ingredients","Misc.","Mixtures","Packaging","Vehicle Supplies","Vehicles"];
    if(isset($_GET["category"])) {
        if(((!is_numeric($_GET["category"])) || ($_GET["category"] <= 0) || ($_GET["category"]) >= (count($category)))) {
                $counter = 0;
        } else {
            $counter = $_GET["category"];
        }
    }
    if(isset($_GET["query"])) {
        if(is_numeric($_GET["query"])) {
            $searchString = "";
        } else {
            $searchString = $_GET["query"];
        }
    }
    if(isset($counter)) {
        if(isset($searchString)) {
            $resultString = "Showing results for - Category: {$category[$counter]} | Search: {$searchString}";
        } else {
            $resultString = "Showing results for - Category: {$category[$counter]}";
        }
    }
    if(isset($searchString) && !isset($counter)) {
        $resultString = "Showing results for - Search: {$searchString}";
    }
?>
<html>
    <head>
        <title>LimeLight - Market</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/market/assets/bootstrap/css/bootstrap.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/market/assets/bootstrap/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="/market/assets/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/market/assets/css/search.css">
        <link rel="stylesheet" href="/market/assets/css/template.css">
    </head>
    <body>
        <div class="container-fluid">
            <div class="col-xs-24">
                &nbsp;
            </div>
            <div class="col-xs-24 header">
                <h1 class="header-title">Community Market</h1>
                <p class="header-text">Buy and sell in-game items with other LimeLight community members.</p>
            </div>
            <div class="col-xs-24">
                <div class="col-xs-2"></div>
                <div class="col-xs-13 resultsTable">
                    <h3 class="resultHeader"><?php echo $resultString; ?></h3>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th class="col-xs-10">ITEM</th>
                                <th class="col-xs-4 center">QUANTITY</th>
                                <th class="col-xs-4 center">PRICE</th>
                            <tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="small">
                                    <img class="img" src="http://via.placeholder.com/64x64" width="64" height="64">
                                    <strong>Fish</strong>
                                    <p class="fix">&nbsp;Food</p>
                                </td>
                                <td class="center small">
                                    2232
                                </td>
                                <td class="center small">
                                    <p>Starting at:</p>
                                    <p>$225</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="small">
                                    <img class="img" src="http://via.placeholder.com/64x64" width="64" height="64">
                                    <strong>BMW i8</strong>
                                    <p class="fix">&nbsp;Vehicles</p>
                                </td>
                                <td class="center small">
                                    100
                                </td>
                                <td class="center small">
                                    <p>Starting at:</p>
                                    <p>$1,000,000</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="small">
                                    <img class="img" src="http://via.placeholder.com/64x64" width="64" height="64">
                                    <strong>Lamborghini Reventon</strong>
                                    <p class="fix">&nbsp;Vehicles</p>
                                </td>
                                <td class="center small">
                                    21
                                </td>
                                <td class="center small">
                                    <p>Starting at:</p>
                                    <p>$10,000,000</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="small">
                                    <img class="img" src="http://via.placeholder.com/64x64" width="64" height="64">
                                    <strong>Tides Truck</strong>
                                    <p class="fix">&nbsp;Vehicles</p>
                                </td>
                                <td class="center small">
                                    19
                                </td>
                                <td class="center small">
                                    <p>Starting at:</p>
                                    <p>$100,000</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="small">
                                    <img class="img" src="http://via.placeholder.com/64x64" width="64" height="64">
                                    <strong>Gold Fish</strong>
                                    <p class="fix">&nbsp;Food</p>
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
</div>
