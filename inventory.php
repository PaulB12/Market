<?php
    $page = "inventory";
    require("backend/header.php");
 ?>
        <div class='sell-modal-box'>
            <div class='sell-modal-header'>
                <h4>List an item for sale<span class='sell-close' style='float: right;'>&times;</span></h4>
            </div>
            <div class='sell-modal-content'>
                <div class='sell-modal-inner-content'>
                    <div class='sell-modal-inner-main'>
                        <img class='sell-modal-image' src='http://via.placeholder.com/128x128' height=128 width=128>
                        <div class='item-description-sell-modal'><strong>Goldfish<br>Studies indicate that more than 41 goldfish are flushed down the toilet everyday.<br>They ended up in the lake, and now they're in your inventory.</div>
                    </div>
                    <hr>
                    <div class='sell-modal-inner-main-sec-wrapper'>
                        <div class='sell-modal-inner-main-sec'>
                            <div class='graph-title'>
                                Average Sale Price
                            </div>
                            <div style='max-height:250px; max-width: 100%'>
                                <canvas id='sell-modal-graph' width='1000' height='250'></canvas>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class='sell-modal-inner-main-sec2-wrapper'>
                        <div class='sell-modal-inner-main2-sec'>
                            <div class='sellText'>
                                Quantity: <input type='number' min='1' step='1' value='1' data-number-to-fixed='2' data-number-stepfactor='100' class='quantity'>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You recieve: $
                                <input type='text' value='10,000.00' data-number-to-fixed='2' data-number-stepfactor='100' class='sellerRecieve' id='sellerRecieve'>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buyer pays: $
                                <input type='text' value='10,200.00' class='buyerPays' id='buyerPays'>
                            </div>
                            <span class='button-sell-modal' onclick='sellItem(2)'>Sell this item</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class='col-xs-24 inventory-main'>
                <div class='col-xs-1'></div>
                <div class='col-xs-14 inventory-body'>
                    <div class='inventory-table'>
                        <section>
                            <div><img class='img selected' src='https://i.imgur.com/dS5I3uj.jpg'><span class='itemid'>1</span></div>
                            <div><img class='img' src='https://i.imgur.com/dS5I3uj.jpg'><span class='itemid'>9</span></div>
                            <div><img class='img' src='https://i.imgur.com/dS5I3uj.jpg'><span class='itemid'>5</span></div>
                            <div><img class='img' src='https://i.imgur.com/dS5I3uj.jpg'><span class='itemid'>3</span></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </section>
                    </div>
                </div>
                <div class='col-xs-8 inventory-description'>
                    <div class='inventory-desc-image'>
                        <img class='inv-img' src='https://i.imgur.com/dS5I3uj.jpg'>
                    </div>
                    <br>
                    <div class='inventory-desc-title'>
                        Dodge Charger Interceptor
                    </div>
                    <br><strong class='desc'>Description:</strong>
                    <span class='item-header'>Category > Government Vehicles > Dodge Charger Interceptor</span>
                    <div class='inventory-desc-description'>
                        This police interceptor is specially designed to chase down the performance cars that have caused hell for regular beat officers in Rockford.<br>While it can carry quite a few passengers, it performs best at low weights, which is why it can barely (carry? it isn't there for some reason) any police gear.<br>It'd be foolish to take this to raid a compound, but excels at chasing down fleeing criminals.
                    </div>
                    <br>
                    <div class='inventory-desc-info'>
                        <strong>Category: </strong><span class='category'>Government Vehicles</span>
                        <br><br>
                        <strong><a class='searchLink' href='/market/listing.php?id='>Search on the community market</a></strong>
                        <br>
                        <span class='price'>Starting price: $1.00</span>
                        <br>
                        <br>
                        <span class='button' id='sellBtn' onclick='sellModal(1)'>Sell</span>
                    </div>
                </div>
<?php require("backend/footer.php"); ?>
