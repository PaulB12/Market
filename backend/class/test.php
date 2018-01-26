<?php
    require("databaseClass.php");
    require("databaseTable.php");
    require("apiClass.php");
    $api = new web_to_server();
    echo $api->fetchCurrentMoney("STEAM_0:0:81010017")['callback'];
?>
