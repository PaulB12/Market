<?php
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
if(!isset($searchString) && !isset($counter)) {
    $resultString = "No search specified!";
}
?>
