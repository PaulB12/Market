<?php
/*
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
*/
$page = "index";
require('backend/header.php');
$logged_in_content = "
            <div class='col-xs-24 inner-body'>
                <div class='myListings'>
                    <h4 class='col-xs-16 listingsTitle'>My sell listings <small>(2)</small></h4>
                    <div class='col-xs-4'></div>
                    <div class='col-xs-2 sellButton2'>
                        <a href='history.php'>Transactions</a>
                    </div>
                    <div class='col-xs-2 sellButton'>
                        <a href='inventory.php'>Sell an item</a>
                    </div>
                </div>
                <div class='col-xs-24 listingsTable'>
                    <table class='table table-hover table-responsive'>
                        <thead>
                            <tr>
                                <th class='col-xs-10'>ITEM</th>
                                <th class='col-xs-4 center'>LISTED ON</th>
                                <th class='col-xs-4 center'>PRICE</th>
                                <th class='col-xs-6 center'>ACTION</th>
                            <tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class='link' data-href='listing.php?id='><img class='img' src='http://via.placeholder.com/48x48'><strong class='float-top'>&nbsp;BMW i8</strong><p class='float-below'>&nbsp;Vehicles</p></td>
                                <td class='center small link' data-href='listing.php?id='>Dec 26th</td>
                                <td class='center small link' data-href='listing.php?id='>$4,000,000</td>
                                <td class='center small'><a href='#'>Remove</href></td>
                            </tr>
                            <tr>
                                <td class='link' data-href='listing.php?id='><img class='img' src='http://via.placeholder.com/48x48'><strong class='float-top'>&nbsp;Lamborghini Reventon</strong><p class='float-below'>&nbsp;Vehicles</p></td>
                                <td class='center small link' data-href='listing.php?id='>Dec 27th</td>
                                <td class='center small link' data-href='listing.php?id='>$10,000,000</td>
                                <td class='center small'><a href='#'>Remove</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class='col-xs-18 marketActivity'>
                    <div class='col-xs-24 header'>
                        <h3 class='header-title center-only'>Popular Market Activity</h3>
                    </div>
                    <div class='col-xs-24 marketActivityTable'>
                        <table class='table table-responsive'>
                            <thead>
                                <tr>
                                    <th class='col-xs-10'>ITEM</th>
                                    <th class='col-xs-4 center'>QUANTITY</th>
                                    <th class='col-xs-4 center'>PRICE</th>
                                <tr>
                            </thead>
                            <tbody>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                        <strong>&nbsp;Fish</strong>
                                        <p>&nbsp;Food</p>
                                    </td>
                                    <td class='center small'>
                                        2232
                                    </td>
                                    <td class='center small'>
                                        <span>Starting at:</span>
                                        <br>
                                        <span>$225</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                        <strong>&nbsp;BMW i8</strong>
                                        <p>&nbsp;Vehicles</p>
                                    </td>
                                    <td class='center small'>
                                        100
                                    </td>
                                    <td class='center small'>
                                        <span>Starting at:</span>
                                        <br>
                                        <span>$1,000,000</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                        <strong>&nbsp;Lamborghini Reventon</strong>
                                        <p>&nbsp;Vehicles</p>
                                    </td>
                                    <td class='center small'>
                                        21
                                    </td>
                                    <td class='center small'>
                                        <span>Starting at:</span>
                                        <br>
                                        <span>$10,000,000</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                        <strong>&nbsp;Tides Truck</strong>
                                        <p>&nbsp;Vehicles</p>
                                    </td>
                                    <td class='center small'>
                                        19
                                    </td>
                                    <td class='center small'>
                                        <span>Starting at:</span>
                                        <br>
                                        <span>$100,000</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                        <strong>&nbsp;Gold Fish</strong>
                                        <p>&nbsp;Food</p>
                                    </td>
                                    <td class='center small'>18</td>
                                    <td class='center small'>
                                        <span>Starting at:</span>
                                        <br>
                                        <span>$1,000</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class='col-xs-1'></div>
                </div>
";

$logged_out_content = "
            <div class='col-xs-24 inner-body'>
                <div class='col-xs-18 marketActivity'>
                    <div class='col-xs-24 header'>
                        <h3 class='header-title center-only'>Popular Market Activity</h3>
                    </div>
                    <div class='col-xs-24 marketActivityTable'>
                        <table class='table table-responsive'>
                            <thead>
                                <tr>
                                    <th class='col-xs-10'>ITEM</th>
                                    <th class='col-xs-4 center'>QUANTITY</th>
                                    <th class='col-xs-4 center'>PRICE</th>
                                <tr>
                            </thead>
                            <tbody>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                        <strong>&nbsp;Fish</strong>
                                        <p>&nbsp;Food</p>
                                    </td>
                                    <td class='center small'>
                                        2232
                                    </td>
                                    <td class='center small'>
                                        <span>Starting at:</span>
                                        <br>
                                        <span>$225</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                        <strong>&nbsp;BMW i8</strong>
                                        <p>&nbsp;Vehicles</p>
                                    </td>
                                    <td class='center small'>
                                        100
                                    </td>
                                    <td class='center small'>
                                        <span>Starting at:</span>
                                        <br>
                                        <span>$1,000,000</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                        <strong>&nbsp;Lamborghini Reventon</strong>
                                        <p>&nbsp;Vehicles</p>
                                    </td>
                                    <td class='center small'>
                                        21
                                    </td>
                                    <td class='center small'>
                                        <span>Starting at:</span>
                                        <br>
                                        <span>$10,000,000</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                        <strong>&nbsp;Tides Truck</strong>
                                        <p>&nbsp;Vehicles</p>
                                    </td>
                                    <td class='center small'>
                                        19
                                    </td>
                                    <td class='center small'>
                                        <span>Starting at:</span>
                                        <br>
                                        <span>$100,000</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                        <strong>&nbsp;Gold Fish</strong>
                                        <p>&nbsp;Food</p>
                                    </td>
                                    <td class='center small'>18</td>
                                    <td class='center small'>
                                        <span>Starting at:</span>
                                        <br>
                                        <span>$1,000</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class='col-xs-1'></div>
                </div>
";
if(!isset($_SESSION['steamid'])) {
    echo $logged_out_content;
} else {
    echo $logged_in_content;
}
require('backend/footer.php');
?>
