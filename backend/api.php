<?php
    require("marketClass2.php");
    if(isset($_POST["api_type"])) {
        $market_api = new marketClass();
        $api_type = $_POST["api_type"];
        if($api_type == "sell_listing") {
            if((isset($_POST["api_steam_id"])) && (isset($_POST["api_qty"])) && (isset($_POST["api_key"])) && (isset($_POST["api_price"])) && (isset($_POST["api_item_id"]))) {
                if($_POST["api_key"] == '8piTolwqIC3ipWom') {
                    $market_api->createSellListingFromAPI($_POST["api_steam_id"],$_POST["api_qty"],$_POST["api_qty"],$_POST["api_price"]);
                }
            }
        }
    }
?>
