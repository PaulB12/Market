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

    public function insertIntoListing($item,$qty,$steamid)
    {
        $
        $cols    = "";
        $vals    = "";
        $this->database->insert("{$this->databaseTable->remote_table}", $cols, $vals);
    }

    public function checkForBuyOrders($item,$price) {
        if(is_numeric($price) && ($price > 0) && ($price < 100000000)) {
            if($this->api->checkIfItemExistsInGame($item)) {
                $item = $this->database->sanatize($item);
                $select = $this->database->select("*","{$this->databaseTable->listings_table}","WHERE `{$this->databaseTable->listings_item_id}` = '$item' AND `{$this->databaseTable->listings_price}` >= $price AND `{$this->databaseTable->listings_type}` = 'buy' ORDER BY {$this->databaseTable->listings_price} DESC");
                if(mysqli_num_rows($select) >= 1) {
                    $qty = 0;
                    $idArray = array();
                    $qtyArray = array();
                    while($row=mysqli_fetch_assoc($select)) {
                        $qty = $qty + $row["{$this->databaseTable->listings_qty}"];
                        array_push($idArray,$row["{$this->databaseTable->listings_id}"]);
                        array_push($qtyArray,$row["{$this->databaseTable->listings_qty}"]);
                    }
                    $response['qty'] = $qty;
                    $response['status'] = true;
                    $response['itemArray'] = $idArray;
                    $response['qtyArray'] = $qtyArray;
                } else {
                    $response['status'] = false;
                }
            } else {
                $response['status'] = false;
            }
        } else {
            $response['status'] = false;
        }
        return $response;
    }

    public function grabInfoOnItem($itemid) {
        $itemid = $this->database->sanatize($itemid);
        $result = $this->database->select("{$this->databaseTable->item_values_name}", "{$this->databaseTable->item_values_table}", "WHERE `{$this->databaseTable->item_values_uniqueID}` = '$itemid'");
        if(mysqli_num_rows($result) == 1) {
            $result = mysqli_fetch_assoc($result);
            return $result["{$this->databaseTable->item_values_name}"];
        }
    }

    public function completeBuyOrder($id,$qty,$sellerID,$sellID) {
        if(is_numeric($id) && (is_numeric($qty)) && ($qty > 0)) {
            $select = $this->database->select("*","{$this->databaseTable->listings_table}","WHERE `{$this->databaseTable->listings_id}` = $id AND `{$this->databaseTable->listings_status}` = 0");
            if(mysqli_num_rows($select) == 1) {
                $sellerSelec = $this->database->select("{$this->databaseTable->listings_status}","{$this->databaseTable->listings_table}","WHERE `{$this->databaseTable->listings_id}` = $sellID AND `{$this->databaseTable->listings_status}` = 0");
                if(mysqli_num_rows($sellerSelec) == 1) {
                    $result = mysqli_fetch_assoc($select);

                    $buyerID = $result["{$this->databaseTable->listings_steamid}"];
                    $itemid = $result["{$this->databaseTable->listings_item_id}"];
                    $price = $result["{$this->databaseTable->listings_price}"];

                    $itemname = $this->grabInfoOnItem($itemid);

                    $bqty = $result["{$this->databaseTable->listings_qty}"];
                    $message = "Market House | You bought {$bqty} {$itemname}('s) for {$price}!";
                    if(($result["{$this->databaseTable->listings_qty}"] - $qty) == 0) {

                        $this->api->addItemToPlayer($itemid, $result["{$this->databaseTable->listings_qty}"], $buyerID, $message);
                        $this->database->update("{$this->databaseTable->listings_status}", "{$this->databaseTable->listings_table}", "1", "WHERE `{$this->databaseTable->listings_id}` = $id");

                        $sellerResult = $this->database->select("{$this->databaseTable->listings_qty}","{$this->databaseTable->listings_table}","WHERE `{$this->databaseTable->listings_id}` = $sellID AND `{$this->databaseTable->listings_status}` = 0");
                        $sellerResult = mysqli_fetch_assoc($sellerResult);
                        $qtyLeft = $sellerResult["{$this->databaseTable->listings_qty}"];
                        $qtySell = $qtyLeft - $qty;
                        if(($qtyLeft - $qty) == 0) {
                            $this->database->update("{$this->databaseTable->listings_status}", "{$this->databaseTable->listings_table}", "1", "WHERE `{$this->databaseTable->listings_id}` = $sellID");
                        } else {
                            $qtySell = $qtyLeft - $qty;
                            $this->database->update("{$this->databaseTable->listings_qty}", "{$this->databaseTable->listings_table}", "$qtySell", "WHERE `{$this->databaseTable->listings_id}` = $id");
                        }
                    } else if(($result["{$this->databaseTable->listings_qty}"] - $qty) >= 1) {

                        $updateQty = $result["{$this->databaseTable->listings_qty}"] - $qty;
                        $this->api->addItemToPlayer($itemid, $qty, $buyerID, $message);
                        $this->database->update("{$this->databaseTable->listings_qty}", "{$this->databaseTable->listings_table}", "'$updateQty'", "WHERE `{$this->databaseTable->listings_id}` = $id AND `{$this->databaseTable->listings_status}` = 0");

                        $sellerResult = $this->database->select("*","{$this->databaseTable->listings_table}","WHERE `{$this->databaseTable->listings_id}` = $sellID");
                        $sellerResult = mysqli_fetch_assoc($sellerResult);
                        $qtyLeft = $sellerResult["{$this->databaseTable->listings_qty}"];
                        $qtySell = $qtyLeft - $qty;
                        if(($qtyLeft - $qty) == 0) {
                            $this->database->update("{$this->databaseTable->listings_status}", "{$this->databaseTable->listings_table}", "1", "WHERE `{$this->databaseTable->listings_id}` = $sellID");
                        } else {
                            $qtySell = $qtyLeft - $qty;
                            $this->database->update("{$this->databaseTable->listings_qty}", "{$this->databaseTable->listings_table}", "$qtySell", "WHERE `{$this->databaseTable->listings_id}` = $id");
                        }
                        $sellerOwed = $qtySell * $sellerResult["{$this->databaseTable->price}"];
                        $message = "Market House | You sold {$qtySell} {$itemanme}('s') for {$sellerOwed}!";
                        $this->api->giveUserMoney($sellerID,$sellerOwed,$message);
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function listItem($steamid,$item,$qty,$price)
    {
        if(is_numeric($qty) && ($qty > 0) && ($price > 0) && ($this->steamIDChecker())) {
            if($this->api->checkIfItemExistsInGame($item)) {
                $result = $this->api->checkIfItemExistsForPlayer($item,$qty,$steamid);
                if($result['status'] == 1) {
                    $item = $this->database->sanatize($item);
                    $time = now();
                    $cols    = "{$this->databaseTable->listings_steamid},{$this->databaseTable->listings_item_id},{$this->databaseTable->listings_qty},{$this->databaseTable->listings_price},{$this->databaseTable->listings_type},{$this->databaseTable->status},{$this->databaseTable->listings_time_created}";
                    $vals    = "'{$steamid}','$item',$price,'sell',0,'$time'";
                    $insert_id = $this->database->insert("{$this->databaseTable->listings_table}", $cols, $vals);
                    if(is_numeric($insert_id)) {
                        $message = "Market House | {$qty} ".$result['ItemName']."('s) was taken from your inventory.";
                        if($this->api->removeItemFromPlayer($item,$qty,$steamid,$message)) {
                            $buyOrders = $this->checkForBuyOrders($item,$price);
                            if($response['status']) {
                                $itemsLeft = $qty;
                                $counter = 0;
                                foreach($response['itemArray'] as $id) {
                                    if($itemsLeft > 0) {
                                        $avalQty = $response['qtyArray'][$counter];
                                        if($avalQty > $itemsLeft) {
                                            $buyQty = $avalQty - $itemsLeft;
                                        } else {
                                            $buyQty = $avalQty;
                                        }
                                        $select = $this->database->select("*","{$this->databaseTable->listings_table}","WHERE `{$this->databaseTable->listings_id}` = $id");
                                            if(mysqli_num_rows($select) == 1) {
                                                $this->completeBuyOrder($id,$buyQty,$steamid,$insert_id);
                                            }
                                        }
                                    }
                                    $counter++;
                                }
                            } else {
                                $response_array['status'] = 'success';
                                $response_array['message'] = 'order_placed';
                            }
                        } else {
                            //Update status to 2
                        }
                    } else {
                        $response_array['status'] = 'success';
                        $response_array['message'] = 'custom';
                        $response_array['text'] = 'Contact a developer, error inserting into database. Function: listItem';
                    }
                } else {
                    $response_array['status'] = 'success';
                    $response_array['message'] = 'custom';
                    $response_array['text'] = 'The item you wish to sell is not in the item database, contact a developer';
                }
            } else {
                $response_array['status'] = 'success';
                $response_array['message'] = 'custom';
                $response_array['text'] = 'The quantity you entered was not numeric or your steamID was invalid!';
            }
            echo json_encode($response_array);
        }
    }

$market_api = new marketClass();
var_dump($market_api->completeBuyOrder(2,1,"STEAM_0:0:81010017",1));

?>
