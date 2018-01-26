<?php
    $page = "index";
    $filepath = "/market/";
    if(!isset($page)) {
        $page = "";
    }
    if($page == "index") {
        $categories = true;
        $additional = "<link rel='stylesheet' href='/market/assets/css/index.css'>";
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
            </div>";
    echo $html;
?>
