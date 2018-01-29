<?php
    require("backend/steamauth/steamauth.php");
    $steam = "";
    if(!isset($_SESSION['steamid'])) {
        $steam .= "<div style='float: right; margin-top: -70px;'>
            <a href='?login'><img src='http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_01.png'></a>
            </div>
        ";
    } else {
        $steam .= "<div style='float: right; margin-top: -70px; margin-right: 50px;'>
                    <a href='?logout'><h4 style='color: white; text-decoration: underline;'>Logout</h4></a>
            </div>
        ";
    }

    $filepath = "/market/";
    if(!isset($page)) {
        $page = "";
    }
    if($page == "index") {
        $categories = true;
        $logged_in = false;
        $additional = "<link rel='stylesheet' href='{$filepath}assets/css/index.css'>";
    }
    if($page == "inventory") {
        $categories = false;
        $logged_in = true;
        $additional = "
        <!-- Chart JS file -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>

        <!-- Sweet Alert file -->
        <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>

        <!-- Market CSS Files !-->
        <link rel='stylesheet' href='{$filepath}assets/css/inventory.css'>
        <link rel='stylesheet' href='{$filepath}assets/css/template.css'>
        <link rel='stylesheet' href='{$filepath}assets/css/sell-modal.css'>
        <link rel='stylesheet' href='{$filepath}assets/css/ajax-loader.css'>
        ";
    }
    if($page == "listing") {
        $categories = false;
        $logged_in = false;
        $additional = "
        <!-- Chart JS file -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>

        <!-- Sweet Alert file -->
        <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>

        <!-- Market CSS Files !-->
        <link rel='stylesheet' href='{$filepath}assets/css/listing.css'>
        <link rel='stylesheet' href='{$filepath}assets/css/buy-modal.css'>
        <link rel='stylesheet' href='{$filepath}assets/css/sell-modal.css'>
        <link rel='stylesheet' href='{$filepath}assets/css/ajax-loader.css'>";

    }
    if($page == "history") {
        $categories = true;
        $logged_in = true;
        $additional = "
            <link rel='stylesheet' href='/market/assets/css/history.css'>
        ";
    }
    if($page == "search") {
        $categories = true;
        $logged_in = false;
        $additional = "<link rel='stylesheet' href='/market/assets/css/search.css'>";
    }
    if(!isset($categories)) {
        $categories = false;
    }
    if($categories) {
        $category = ["Cards","Clothing","Food","Government Vehicles","Ingredients","Misc.","Mixtures","Packaging","Vehicle Supplies","Vehicles"];
        if((!isset($_GET["category"]) || (!is_numeric($_GET["category"])) || ($_GET["category"] <= 0) || (5 * $_GET["category"]) >= (count($category)))) {
                $counter = 0;
        } else {
            $counter = $_GET["category"];
        }
    }
    if($logged_in) {
        if(!isset($_SESSION['steamid'])) {
            header("location: {$filepath}");
        }
    }
    $html = "<html>
    <head>
        <title>LimeLight - Market</title>
        <!-- JQuery -->
        <script src='https://code.jquery.com/jquery-3.3.1.min.js' integrity='sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=' crossorigin='anonymous'></script>

        <!-- Latest compiled and minified CSS -->
        <link rel='stylesheet' href='{$filepath}assets/bootstrap/css/bootstrap.css'>

        <!-- Optional theme -->
        <link rel='stylesheet' href='{$filepath}assets/bootstrap/css/bootstrap-theme.min.css'>

        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

        <!-- Latest compiled and minified JavaScript -->
        <script src='{$filepath}assets/bootstrap/js/bootstrap.min.js'></script>
        {$additional}
        <link rel='stylesheet' href='{$filepath}assets/css/template.css'>
    </head>
    <body>
        <div class='container-fluid page'>
            <div class='col-xs-24'>
                &nbsp;
            </div>
            <div class='col-xs-24 header'>
                <a href='{$filepath}'>
                    <h1 class='header-title'>Community Market</h1>
                    <p class='header-text'>Buy and sell in-game items with other LimeLight community members.</p>
                </a>
                ".$steam."
            </div>";
    echo $html;
?>
