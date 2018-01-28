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

    public function create_log($steamid,$type,$input) {
        if($this->steamIDChecker($steamid) && strlen($type) <= 10) {
            $type = $this->database->sanatize($type);
            $insert = "";
            foreach($input as $key => $value) {
                $insert .= $key.":".$value."; ";
            }
            $insert = $this->database->sanatize($insert);
            $time = date("Y-m-d H:i:s");

            $cols    = "{$this->databaseTable->log_steamid},{$this->databaseTable->log_type},{$this->databaseTable->log_json_log},{$this->databaseTable->log_time_created}";
            $vals    = "'$steamid','$type','$insert','$time'";
            $this->database->insert("{$this->databaseTable->log_table}", $cols, $vals);
        }
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

    public function createSellListingFromAPI($steamid,$qty,$item_id,$price) {
        if(($this->steamIDChecker($steamid)) && is_numeric($qty) && is_numeric($price) && $qty > 0 && $price > 0) {
            $item_id = $this->database->sanatize($item_id);

            $time = date("Y-m-d H:i:s");

            $cols    = "{$this->databaseTable->listings_steamid},{$this->databaseTable->listings_item_id},{$this->databaseTable->listings_qty},{$this->databaseTable->listings_price},{$this->databaseTable->listings_type},{$this->databaseTable->listings_status},{$this->databaseTable->listings_time_created}";
            $vals    = "'$steamid','$item_id','$qty','$price','sell','0','$time'";
            $this->database->insert("{$this->databaseTable->listings_table}", $cols, $vals);

            $log_response['type'] = 'sell_api';
            $log_response['qty'] = $qty;
            $log_response['price'] = $price;
            $log_response['item_id'] = $item_id;

            $this->create_log($steamid,"lua_callback",$log_response);
        }
    }

    public function createBuyListing($steamid,$item_id,$qty,$price) {
        //Sanatize input
        $item_id = $this->database->sanatize($item_id);
        //Verify vars
        if(($this->steamIDChecker($steamid)) && (is_numeric($qty)) && (is_numeric($price)) && ($price > 0) && ($qty > 0)) {
            //Work total cost
            $totalCost = $price * $qty;
            if($this->checkIfUserCanAfford($steamid,$totalCost)) {
                //User can afford
                $time    = date("Y-m-d H:i:s");
                $cols    = "{$this->databaseTable->listings_steamid},{$this->databaseTable->listings_item_id},{$this->databaseTable->listings_qty},{$this->databaseTable->listings_price},{$this->databaseTable->listings_type},{$this->databaseTable->listings_status},{$this->databaseTable->listings_time_created}";
                $vals    = "'$steamid','$item_id','$qty','$price','buy','0','$time'";
                $this->database->insert("{$this->databaseTable->listings_table}", $cols, $vals);

                $this->checkBuyOrders($item_id);

                $log_response['type'] = 'web_buy_listing';
                $log_response['qty'] = $qty;
                $log_response['price'] = $price;
                $log_response['item_id'] = $item_id;

                $this->create_log($steamid,"new_buy",$log_response);

                $response_array['status'] = 1;
                $response_array['message'] = 'Successfull! The buy listing was created.';
            } else {
                //User can't afford.
                $response_array['status'] = 0;
                $response_array['message'] = 'You cannot afford this buy listing.';
            }
        } else {
            $response_array['status'] = 0;
            $response_array['message'] = 'Invalid input parameters.';
        }
        return $response_array;
    }

    public function createSellListing($steamID,$item_id,$qty,$price) {
        //Vars are safe
        $item_id = $this->database->sanatize($item_id);
        if(($this->steamIDChecker($steamID)) && (is_numeric($qty)) && (is_numeric($price)) && ($price > 0) && ($qty > 0)) {
            //Check if user has the item.
            if($this->api->checkIfItemExistsForPlayer($item_id, $qty, $steamID)['status'] == 1) {
                $item_name = $this->grabInfoOnItem($item_id);
                $message = "Market House | You created a sell listing for {$qty} {$item_name}('s) for {$price} each.";
                $this->api->removeItemFromPlayer($item_id, $qty, $steamID, $message, "sell_listing@{$price}");
                if($this->api->checkIfPlayerIsOnline($steamID)) {
                    //User is online. Let Lua callback do the work.
                    $response_array['status'] = 1;
                    $response_array['message'] = "Your sell listing has been placed.";

                    $log_response['type'] = 'lua_sell_listing';
                    $log_response['qty'] = $qty;
                    $log_response['price'] = $price;
                    $log_response['item_id'] = $item_id;


                    $this->create_log($steamid,"new_sell",$log_response);
                } else {
                    //Inserted into listings_table
                    $time    = date("Y-m-d H:i:s");
                    $cols    = "{$this->databaseTable->listings_steamid},{$this->databaseTable->listings_item_id},{$this->databaseTable->listings_qty},{$this->databaseTable->listings_price},{$this->databaseTable->listings_type},{$this->databaseTable->listings_status},{$this->databaseTable->listings_time_created}";
                    $vals    = "'$steamID','$item_id','$qty','$price','sell','0','$time'";
                    $this->database->insert("{$this->databaseTable->listings_table}", $cols, $vals);
                    //Run buy orders.
                    $this->checkBuyOrders($item_id);

                    $log_response['type'] = 'web_sell_listing';
                    $log_response['qty'] = $qty;
                    $log_response['price'] = $price;
                    $log_response['item_id'] = $item_id;


                    $this->create_log($steamid,"new_sell",$log_response);

                    $response_array['status'] = 1;
                    $response_array['message'] = "Your sell listing has been placed.";
                }
            } else {
                //Return error
                $response_array['status'] = 0;
                $response_array['message'] = 'You do not enough of this item!';
            }
        } else {
            //Return error
            $response_array['status'] = 0;
            $response_array['message'] = 'Invalid input parameters.';
        }
        return $response_array;
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
                        //Set up the buy and sell messages in case user is online
                        $buyMessage = "Market House | You bought {$sellQty} {$item_name}('s) for $sellPrice!";
                        $sellMessage = "Market House | You sold {$sellQty} {$item_name}('s) for $sellPrice!";
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
                            $this->api->addItemToPlayer($itemid, $sellQty, $buyerSteam, $buyMessage);
                            $this->api->giveUserMoney($sellerSteam, $sellPrice, $sellMessage);

                            $log_response['type'] = 'web_sell_transaction';
                            $log_response['qty'] = $sellQty; //Total amount
                            $log_response['price'] = $price; //Price each
                            $log_response['item_id'] = $item_id; //Item id
                            $log_response['buyerSteam'] = $buyerSteam; //Buyers SteamID
                            $log_response['amt_bought'] = $sellQty; //Amount buyer bought


                            $this->create_log($steamid,"sell_tran",$log_response);

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
                            $this->api->addItemToPlayer($itemid, $sellQty, $buyerSteam, $buyMessage);
                            $this->api->giveUserMoney($sellerSteam, $sellPrice, $sellMessage);

                            $buy_log_response['type'] = 'web_buy_transaction';
                            $buy_log_response['qty'] = $amount_to_buy; //Amount in total to buy
                            $buy_log_response['price'] = $price; //Price per each
                            $buy_log_response['item_id'] = $item_id;
                            $buy_log_response['sellerSteam'] = $sellerSteam;
                            $buy_log_response['amt_sold'] = ($sellQty - ($sellQty - $itemsLeft));
                            $buy_log_response['sell_id'] = $sellID; //Sell ID
                            $buy_log_response['buy_id'] = $buyid; //Buy ID

                            $this->create_log($steamid,"buy_tran",$buy_log_response);


                            $log_response['type'] = 'web_sell_transaction';
                            $log_response['qty'] = $sellQty; //Total amount
                            $log_response['price'] = $price; //Price each
                            $log_response['item_id'] = $item_id; //Item id
                            $log_response['buyerSteam'] = $buyerSteam; //Buyers SteamID
                            $log_response['amt_bought'] = $amount_to_buy; //Amount buyer bought
                            $log_response['sell_id'] = $sellID; //Sell ID
                            $log_response['buy_id'] = $buyid; //Buy ID

                            $this->create_log($steamid,"sell_tran",$log_response);

                        }
                        if((($itemsLeft - $sellQty)==0) || (($sellQty - $itemsLeft)==0)) {
                            //Update the buy order's status. It's complete.
                            $this->database->update("{$this->databaseTable->listings_status}","{$this->databaseTable->listings_table}",1,"WHERE `{$this->databaseTable->listings_id}` = $buyid");
                        }
                        $itemsLeft = $itemsLeft - $amount_to_buy; //Update the temp var to track how many is left to buy
                    } else {
                        //Update the buy order's status. It's complete.
                        $this->database->update("{$this->databaseTable->listings_status}","{$this->databaseTable->listings_table}",1,"WHERE `{$this->databaseTable->listings_id}` = $buyid");
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
                    $this->database->update("{$this->databaseTable->listings_status}","{$this->databaseTable->listings_table}", "2", "WHERE `{$this->databaseTable->listings_id}` = $buy_id");
                }
            }
        }
    }
}
$market_api = new marketClass();
//$market_api->checkBuyOrders("blackpowder");
//var_dump($market_api->createSellListing("STEAM_0:0:81010017","ambulance_e350",4,5000));
//$market_api->createBuyListing("STEAM_0:0:81010017","ambulance_e350",6,5500);
?>
