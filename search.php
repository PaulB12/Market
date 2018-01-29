<?php
    $page = "search";
    require("backend/header.php");
    require("backend/search.php");
 ?>
            <div class='col-xs-24'>
                <div class='col-xs-2'></div>
                <div class='col-xs-13 resultsTable'>
                    <h3 class='resultHeader'><?php echo $resultString; ?></h3>
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
                                    <strong>Fish</strong>
                                    <p class='fix'>&nbsp;Food</p>
                                </td>
                                <td class='center small'>
                                    2232
                                </td>
                                <td class='center small'>
                                    <p>Starting at:</p>
                                    <p>$225</p>
                                </td>
                            </tr>
                            <tr class='link' data-href='listing.php?id='>
                                <td class='small'>
                                    <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                    <strong>BMW i8</strong>
                                    <p class='fix'>&nbsp;Vehicles</p>
                                </td>
                                <td class='center small'>
                                    100
                                </td>
                                <td class='center small'>
                                    <p>Starting at:</p>
                                    <p>$1,000,000</p>
                                </td>
                            </tr>
                            <tr class='link' data-href='listing.php?id='>
                                <td class='small'>
                                    <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                    <strong>Lamborghini Reventon</strong>
                                    <p class='fix'>&nbsp;Vehicles</p>
                                </td>
                                <td class='center small'>
                                    21
                                </td>
                                <td class='center small'>
                                    <p>Starting at:</p>
                                    <p>$10,000,000</p>
                                </td>
                            </tr>
                            <tr class='link' data-href='listing.php?id='>
                                <td class='small'>
                                    <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                    <strong>Tides Truck</strong>
                                    <p class='fix'>&nbsp;Vehicles</p>
                                </td>
                                <td class='center small'>
                                    19
                                </td>
                                <td class='center small'>
                                    <p>Starting at:</p>
                                    <p>$100,000</p>
                                </td>
                            </tr>
                            <tr class='link' data-href='listing.php?id='>
                                <td class='small'>
                                    <img class='img' src='http://via.placeholder.com/64x64' width='64' height='64'>
                                    <strong>Gold Fish</strong>
                                    <p class='fix'>&nbsp;Food</p>
                                </td>
                                <td class='center small'>18</td>
                                <td class='center small'>
                                    <p>Starting at:</p>
                                    <p>$1,000</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
<?php require("backend/footer.php"); ?>
