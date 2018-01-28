<?php
require("databaseTable.php");
require("databaseClass.php");
require("apiClass.php");
class marketClass {
    public $database;
    public $api;
    public $databaseTable;

    public function __construct()
    {
        $this->database      = new databaseConnection();
        $this->databaseTable = new databaseTable();
        $this->api = new web_to_server();
    }

    public function steamIDChecker($steamid) {
        if(preg_match("/^STEAM_[0-5]:[01]:\d+$/",$steamid)) {
            return true;
        } else {
            return false;
        }
    }

    public function grabInfoOnItem($itemid) {
        //Sanatize item_id
        $itemid = $this->database->sanatize($itemid);
        //Grab item_name from database
        $result = $this->database->select("{$this->databaseTable->item_values_name}", "{$this->databaseTable->item_values_table}", "WHERE `{$this->databaseTable->item_values_uniqueID}` = '$itemid'");
        //If there was a row
        if(mysqli_num_rows($result) == 1) {
            //Return item name
            $result = mysqli_fetch_assoc($result);
            return $result["{$this->databaseTable->item_values_name}"];
        }
    }

    public function checkIfUserCanAfford($steam_id,$amt) {
        //If vars are valid
        if(($this->steamIDChecker($steam_id)) && is_numeric($amt) && ($amt > 0)) {
            //If wallet is bigger than cost
            if($this->api->fetchCurrentMoney($steam_id)['callback'] >= $amt) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function CompleteSellOrders($itemid,$qty,$price,$buyerSteam,$buyid) {
        //Check if variables are safe
        if(is_numeric($qty) && (is_numeric($price)) && ($price > 0) && ($qty > 0)) {
            //Sanatize str input
            $itemid = $this->database->sanatize($itemid);
            //assign temp var to keep track
            $itemsLeft = $qty;
            //Select all sell listings with correct item id and price
            $sellSelect = $this->database->select("*","{$this->databaseTable->listings_table}","WHERE `{$this->databaseTable->listings_type}` = 'sell' AND `{$this->databaseTable->listings_status}` = 0 AND `{$this->databaseTable->listings_item_id}` = '$itemid' AND `{$this->databaseTable->listings_price}` <= $price ORDER BY {$this->databaseTable->listings_price}");
            //Loop through rows
            if(mysqli_num_rows($sellSelect) >= 1) {
                while($row=mysqli_fetch_assoc($sellSelect)) {
                    //Assign db variables
                    $sellQty = $row["{$this->databaseTable->listings_qty}"];
                    $sellerSteam = $row["{$this->databaseTable->listings_steamid}"];
                    $sellID = $row["{$this->databaseTable->listings_id}"];
                    $sellPrice = $row["{$this->databaseTable->listings_price}"];
                    //If the buy order still has quantity left that needs to be completed
                    if($itemsLeft > 0) {
                        //Grab item name from item id
                        $item_name = $this->grabInfoOnItem($itemid);
                        //Total cost
                        $sellPrice = $sellPrice * $sellQty;
                        //Set up the buy message in case user is online
                        $message = "Market House | You bought {$sellQty} {$item_name}('s) for $sellPrice!";
                        //If the quantity of the buy order is bigger than the amount avaliable for the sell order
                        if(($itemsLeft - $sellQty) >= 0) {
                            //Assign temp vars
                            $amount_to_buy = $sellQty;
                            $amount_to_update = 0;
                            //Amount to change the buy order to
                            $buy_order_amount_to_update = $itemsLeft - $sellQty;

                            //Edit the sell listing
                            $this->database->update("{$this->databaseTable->listings_qty}", "{$this->databaseTable->listings_table}", "0", "WHERE `{$this->databaseTable->listings_id}` = $sellID");
                            $this->database->update("{$this->databaseTable->listings_status}","{$this->databaseTable->listings_table}", "1", "WHERE `{$this->databaseTable->listings_id}` = $sellID");

                            //Edit the buy listings
                            $this->database->update("{$this->databaseTable->listings_qty}","{$this->databaseTable->listings_table}","$buy_order_amount_to_update","WHERE `{$this->databaseTable->listings_id}` = $buyid");

                            //Now transfer items & money.
                            $this->api->addItemToPlayer($itemid, $sellQty, $buyerSteam, $message);
                            $this->api->giveUserMoney($sellerSteam, $sellPrice, $message);

                        }
                        else if(($sellQty - $itemsLeft) > 0) {
                            //Selling Quantity is bigger than wanted Quantity

                            //Assign temp vars
                            $amount_to_update = ($sellQty - $itemsLeft);
                            $amount_to_buy = $itemsLeft;
                            //Update sell listing
                            $this->database->update("{$this->databaseTable->listings_qty}", "{$this->databaseTable->listings_table}", "$amount_to_update", "WHERE `{$this->databaseTable->listings_id}` = $sellID");
                            //Update buy listing
                            $this->database->update("{$this->databaseTable->listings_qty}","{$this->databaseTable->listings_table}","0","WHERE `{$this->databaseTable->listings_id}` = $buyid");
                            $this->database->update("{$this->databaseTable->listings_status}","{$this->databaseTable->listings_table}","1","WHERE `{$this->databaseTable->listings_id}` = $buyid");
                            //Now transfer items & money.
                            $this->api->addItemToPlayer($itemid, $sellQty, $buyerSteam, $message);
                            $this->api->giveUserMoney($sellerSteam, $sellPrice, $message);

                        }
                        $itemsLeft = $itemsLeft - $amount_to_buy; //Update the temp var to track how many is left to buy
                    }
                } return true; //Successfull buy order
            } else {
                return false; //Failure
            }
        } else {
            return false; //Failure
        }
    }

    public function checkBuyOrders($itemid) {
        //Sanatize input
        $itemid = $this->database->sanatize($itemid);
        //Select all buy orders with correct itemid.
        $select = $this->database->select("*","{$this->databaseTable->listings_table}","WHERE `{$this->databaseTable->listings_type}` = 'buy' AND `{$this->databaseTable->listings_status}` = 0 AND `{$this->databaseTable->listings_item_id}` = '$itemid'");
        //Loop through rows.
        if(mysqli_num_rows($select) >= 1) {
            while($row=mysqli_fetch_assoc($select)) {
                //Assign variables
                $price = $row["{$this->databaseTable->listings_price}"];
                $qty = $row["{$this->databaseTable->listings_qty}"];
                $buy_id = $row["{$this->databaseTable->listings_id}"];
                $buyerSteam = $row["{$this->databaseTable->listings_steamid}"];
                //Total cost
                $cost = $price * $qty;
                //Check if user can afford it
                if($this->checkIfuserCanAfford($buyerSteam,$cost)) {
                    $this->CompleteSellOrders($itemid,$qty,$price,$buyerSteam,$buy_id);
                } else {
                    //Remove the buy order.
                    $this->database->update("{$this->databaseTable->listings_status}","{$this->databaseTable->listings_table}", "1", "WHERE `{$this->databaseTable->listings_id}` = $buy_id");
                }
            }
        }
    }

    public function checkSellOrders($itemid) {

    }
}
$market_api = new marketClass();
$market_api->checkBuyOrders("blackpowder");
?>
