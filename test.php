<?php
    header('Content-Type: application/json');
    $response_array['status'] = 'success';
    $response_array['message'] = 'order_failed';
    echo json_encode($response_array);
?>
