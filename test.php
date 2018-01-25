<?php
    header('Content-Type: application/json');
    $response_array['status'] = 'success';
    $response_array['img'] = 'https://i.imgur.com/dS5I3uj.jpg';
    $response_array['item_name'] = 'Lamboghini Reventon';
    $response_array['description'] = 'The Lamborghini Reventón (Spanish pronunciation: [reβenˈton]) is a mid-engine sports car that debuted at the 2007 Frankfurt Motor Show.<br>It was the most expensive Lamborghini road car until the Lamborghini Sesto Elemento was launched, costing two million dollars (~$1.5 million, or ~£840,000).';
    $response_array['category'] = 'Vehicles';
    $response_array['price'] = 'Starting price: $1,200,000.00';
    $response_array['marketLink'] = 'google.com';
    $response_array['qty'] = 100;
    $response_array['category_filepath'] = 'Category > Vehicles > Lamboghini Reventon';
    echo json_encode($response_array);
?>
