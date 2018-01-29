<?php
    $page = "history";
    require("backend/header.php");
?>
            <div class='col-xs-24 inner-body'>
                <div class='myListings'>
                    <h4 class='col-xs-16 listingsTitle'>&nbsp;</h4>
                    <div class='col-xs-4'></div>
                    <div class='col-xs-2 sellButton2'>
                        <a href='history.php'>Transactions</a>
                    </div>
                    <div class='col-xs-2 sellButton'>
                        <a href='inventory.php'>Sell an item</a>
                    </div>
                </div>
                <div class='col-xs-24 marketActivity'>
                    <div class='col-xs-24 header'>
                        <h3 class='header-title center-only'>Previous Transactions</h3>
                    </div>
                    <div class='col-xs-24 marketActivityTable'>
                        <table class='table table-responsive'>
                            <thead>
                                <tr>
                                    <th class='col-xs-4'>ITEM</th>
                                    <th class='col-xs-4 center'>CREATED ON</th>
                                    <th class='col-xs-4 center'>MODIFIED</th>
                                    <th class='col-xs-4 center'>3RD PARTY</th>
                                    <th class='col-xs-4 center'>PRICE</th>
                                <tr>
                            </thead>
                            <tbody>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='48' height='48'>
                                        <strong class='below'>Dodge Charger Interceptor</strong><br>
                                        <span class='below'>Government Vehicles</span>
                                    </td>
                                    <td class='center small'>
                                        22nd Jan
                                    </td>
                                    <td class='center small'>
                                        <span class='center'>23rd Jan</span>
                                    </td>
                                    <td class='small'>
                                        <img class='img' src='http://cdn.edgecast.steamstatic.com/steamcommunity/public/images/avatars/d2/d274add4a07cbf04b0ec938e4904f43688c41d6a.jpg' width='48' height='48'>
                                        <span class='history-info'>Seller:</span>
                                        <br>
                                        <span class='history-info'>Nightmare</span>
                                    </td>
                                    <td class='center small'>
                                        <span class='center'>$2,500,000</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='48' height='48'>
                                        <strong class='below'>Tides Truck</strong><br>
                                        <span class='below'>Vehicles</span>
                                    </td>
                                    <td class='center small'>
                                        21st Jan
                                    </td>
                                    <td class='center small'>
                                        <span class='center'></span>
                                    </td>
                                    <td class='center small'>
                                        <span class='center'>Listing Created</span>
                                    </td>
                                    <td class='center small'>
                                        <span class='center'>$120,000</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='48' height='48'>
                                        <strong class='below'>Gold Fish</strong><br>
                                        <span class='below'>Food</span>
                                    </td>
                                    <td class='center small'>
                                        20th Jan
                                    </td>
                                    <td class='center small'>
                                        <span class='center'>22nd Jan</span>
                                    </td>
                                    <td class='small'>
                                        <img class='img' src='http://cdn.edgecast.steamstatic.com/steamcommunity/public/images/avatars/d2/d274add4a07cbf04b0ec938e4904f43688c41d6a.jpg' width='48' height='48'>
                                        <span class='history-info'>Buyer:</span>
                                        <br>
                                        <span class='history-info'>Nightmare</span>
                                    </td>
                                    <td class='center small'>
                                        <span class='center'>$500</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='48' height='48'>
                                        <strong class='below'>Fish</strong><br>
                                        <span class='below'>Food</span>
                                    </td>
                                    <td class='center small'>
                                        20th Jan
                                    </td>
                                    <td class='center small'>
                                        <span class='center'>22nd Jan</span>
                                    </td>
                                    <td class='small'>
                                        <img class='img' src='http://cdn.edgecast.steamstatic.com/steamcommunity/public/images/avatars/d2/d274add4a07cbf04b0ec938e4904f43688c41d6a.jpg' width='48' height='48'>
                                        <span class='history-info'>Buyer:</span>
                                        <br>
                                        <span class='history-info'>Nightmare</span>
                                    </td>
                                    <td class='center small'>
                                        <span class='center'>$200</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='48' height='48'>
                                        <strong class='below'>Lamborghini Reventon</strong><br>
                                        <span class='below'>Vehicles</span>
                                    </td>
                                    <td class='center small'>
                                        19th Jan
                                    </td>
                                    <td class='center small'>
                                        <span class='center'></span>
                                    </td>
                                    <td class='small center'>
                                        <span class='history-info'>Listing Created</span>
                                    </td>
                                    <td class='center small'>
                                        <span class='center'>$2,500,000</span>
                                    </td>
                                </tr>
                                <tr class='link' data-href='listing.php?id='>
                                    <td class='small'>
                                        <img class='img' src='http://via.placeholder.com/64x64' width='48' height='48'>
                                        <strong class='below'>BMW i8</strong><br>
                                        <span class='below'>Vehicles</span>
                                    </td>
                                    <td class='center small'>
                                        19th Jan
                                    </td>
                                    <td class='center small'>
                                        <span class='center'></span>
                                    </td>
                                    <td class='small center'>
                                        <span class='history-info'>Listing Created</span>
                                    </td>
                                    <td class='center small'>
                                        <span class='center'>$2,500,000</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class='col-xs-24'>
                        <span class='results'>Showing results: 1-10 of 106 results</span>
                        <span class='pagination'>
                            <span class='disabled' href='#'>❮</span>
                            <span class='disabled' href='#'>1</span>
                            <a href='#'>2</a>
                            <a href='#'>3</a>
                            <a href='#'>4</a>
                            <a href='#'>5</a>
                            <a href='#'>❯</a>
                        </span>
                    </div>
                </div>
<?php require("backend/footer.php"); ?>
