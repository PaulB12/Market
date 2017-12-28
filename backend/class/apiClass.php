<?php
//Make a log class for this.
require("databaseClass.php");

require("databaseTable.php");

class web_to_server
{
    public $database;

    public $databaseTable;

    public function __construct()
    {
        $this->database      = new databaseConnection();
        $this->databaseTable = new databaseTable();
    }

    public function fetchCurrentMoney($steamid)
    {
        $steamid = $this->database->sanatize($steamid);
        if ($this->checkIfUserExists($steamid)) {
            $result = $this->database->select("{$this->databaseTable->players_Money}", "{$this->databaseTable->players_table}", "WHERE `{$this->databaseTable->players_steamid}` = '$steamid'");
            if (mysqli_num_rows($result) == 1) {
                $result               = mysqli_fetch_assoc($result);
                $response['callback'] = $result["{$this->databaseTable->players_Money}"];
                $response['status']   = 1;
                return $response;
            } else {
                $response['message'] = "It seems that your money is bugged, contact a developer.";
                $response['status']  = 0;
                return $response;
            }
        } else {
            $response['message'] = "It seems that you have not joint our server, join us at http://limelightgaming.net";
            $response['status']  = 0;
            return $response;
        }
    }

    public function checkIfUserExists($steamid)
    {
        $steamid = $this->database->sanatize($steamid);
        $result  = $this->database->select("1", "{$this->databaseTable->players_table}", "WHERE `{$this->databaseTable->players_steamid}` = '$steamid'");
        if (mysqli_num_rows($result) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function fetchPlayersInventory($steamid)
    {
        $steamid = $this->database->sanatize($steamid);
        if ($this->checkIfUserExists($steamid)) {
            $result = $this->database->select("{$this->databaseTable->players_Inventory}", "{$this->databaseTable->players_table}", "WHERE `{$this->databaseTable->players_steamid}` = '$steamid'");
            if (mysqli_num_rows($result) == 1) {
                $result               = mysqli_fetch_assoc($result);
                $response['callback'] = $result["{$this->databaseTable->players_Inventory}"];
                $response['status']   = 1;
                return $response;
            } else {
                $response['message'] = "Your inventory does not exist in the database, contact a developer.";
                $response['status']  = 0;
                return $response;
            }
        } else {
            $response['message'] = "It seems that you have not joint our server, join us at https://limelightgaming.net";
            $response['status']  = 0;
            return $response;
        }
    }

    public function checkIfItemExistsForPlayer($item_id, $amount, $steamid)
    {
        $item_id = $this->database->sanatize($item_id);
        $steamid = $this->database->sanatize($steamid);
        if ($this->checkIfUserExists($steamid)) {
            if (is_numeric($amount) && ($amount > 0)) {
                $playersInventory = $this->fetchPlayersInventory($steamid);
                if ($playersInventory['status'] == 1) {
                    $found = false;
                    $inv   = $playersInventory['callback'];
                    foreach (explode(";", $inv) as $itemElement) {
                        $itemElement = trim($itemElement);
                        if (strpos($itemElement, ": ") !== false) {
                            list($item, $amt) = explode(": ", $itemElement);
                            if ($item == $item_id) {
                                if ($amt >= $amount) {
                                    $result = $this->database->select("*", "{$this->databaseTable->item_values_table}", "WHERE `{$this->databaseTable->item_values_uniqueID}` = '$item_id'");
                                    if (mysqli_num_rows($result) == 1) {
                                        $row                         = mysqli_fetch_assoc($result);
                                        $response['ItemName']        = $row["{$this->databaseTable->item_values_name}"];
                                        $response['ItemID']          = $item_id;
                                        $response['ItemDescription'] = $row["{$this->databaseTable->item_values_description}"];
                                        $response['ItemValue']       = $row["{$this->databaseTable->item_values_value}"];
                                        $response['status']          = 1;
                                        $found                       = true;
                                        return $response;
                                    } else {
                                        $response['message'] = "There was an error in connecting with the item database, please contact a web developer";
                                        $response['status']  = 0;
                                        echo json_encode($response);
                                        die();
                                    }
                                } else {
                                    $response['message'] = "You do not have enough of this item, in future I recommend you do not try to exploit either.";
                                    $response['status']  = 0;
                                    return $response;
                                }
                            }
                        }
                    }
                    if ($found == false) {
                        $response['message'] = "You do not own this item, in future I recommend you do not try to exploit either.";
                        $response['status']  = 0;
                        return $response;
                    }
                } else {
                    $response['message'] = "There was an error in fetching your inventory, contact a developer.";
                    $response['status']  = 0;
                    return $response;
                }
            } else {
                $response['message'] = "The amount you enter is not valid! Check the amount and try again!";
                $response['status']  = 0;
                return $response;
            }
        } else {
            $response['message'] = "It seems that you have not joint our server, join us at https://limelightgaming.net";
            $response['status']  = 0;
            return $response;
        }
    }

    public function checkIfPlayerIsOnline($steamid)
    {
        $steamid = $this->database->sanatize($steamid);
        $result  = $this->database->select("{$this->databaseTable->players_online}", "{$this->databaseTable->players_table}", "WHERE `{$this->databaseTable->players_steamid}` = '$steamid'");
        if (mysqli_num_rows($result) == 1) {
            $result = mysqli_fetch_assoc($result);
            if ($result["{$this->databaseTable->players_online}"] == 1) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return -1;
        }
    }

    public function insertIntoRemote($type, $server, $name, $steamid, $value1, $value2, $webhook)
    {
        $type    = $this->database->sanatize($type);
        $server  = $this->database->sanatize($server);
        $name    = $this->database->sanatize($name);
        $steamid = $this->database->sanatize($steamid);
        $value1  = $this->database->sanatize($value1);
        $value2  = $this->database->sanatize($value2);
        $webhook = $this->database->sanatize($webhook);
        $cols    = "{$this->databaseTable->remote_type},{$this->databaseTable->remote_server},{$this->databaseTable->remote_name},{$this->databaseTable->remote_steamid},{$this->databaseTable->remote_value1},{$this->databaseTable->remote_value2},{$this->databaseTable->remote_webhook}";
        $vals    = "'$type','$server','$name','$steamid','$value1','$value2','$webhook'";
        $this->database->insert("{$this->databaseTable->remote_table}", $cols, $vals);
    }

    public function checkIfItemExistsInGame($item_id)
    {
        $item_id = $this->database->sanatize($item_id);
        $result  = $this->database->select("1", "{$this->databaseTable->item_values_table}", "WHERE `{$this->databaseTable->item_values_uniqueID}` = '$item_id'");
        if (mysqli_num_rows($result) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function removeItemFromPlayer($item_id, $amount, $steamid, $message)
    {
        if ((is_numeric($amount)) && ($amount > 0)) {
            $steamid      = $this->database->sanatize($steamid);
            $item_id      = $this->database->sanatize($item_id);
            $message      = $this->database->sanatize($message);
            $message      = str_replace(",", "", $message);
            $itemResponse = $this->checkIfItemExistsForPlayer($item_id, $amount, $steamid);
            if ($itemResponse['status'] == 1) {
                $Online = $this->checkIfPlayerIsOnline($steamid);
                if ($Online == 1) {
                    $val1 = $item_id . "," . $steamid;
                    $this->insertIntoRemote("item_take", "v4b1", "", "$steamid", "$item_id", "$amount", "");
                } elseif ($Online == 0) {
                    $playersInventory = $this->fetchPlayersInventory($steamid);
                    if ($playersInventory['status'] == 1) {
                        $inv    = $playersInventory['callback'];
                        $newInv = ""; //ItemID:amount,
                        foreach (explode(";", $inv) as $itemElement) {
                            $itemElement = trim($itemElement);
                            if (strpos($itemElement, ": ") !== false) {
                                list($item, $amt) = explode(": ", $itemElement);
                                if ($item == $item_id) {
                                    $amt = $amt - $amount;
                                    if ($amt > 0) {
                                        $newInv .= "$item: $amt; ";
                                    }
                                } else {
                                    $newInv .= "$item: $amt; ";
                                }
                            }
                        }
                    } else {
                        $response['message'] = "There was an error in fetching your inventory, contact a developer.";
                        $response['status']  = 0;
                        return $response;
                    }
                    //Update Inventory.
                    $this->database->update("{$this->databaseTable->players_Inventory}", "{$this->databaseTable->players_table}", "'$newInv'", "WHERE `{$this->databaseTable->players_steamid}` = '$steamid'");
                    $response['status'] = 1;
                    return $response;
                } else {
                    $response['message'] = "It seems that you have not joint our server, join us at http://limelightgaming.net";
                    $response['status']  = 0;
                    return $response;
                }
            } else {
                return ($itemResponse);
            }
        } else {
            $response['message'] = "The amount you entered is not valid! Check the amount and try again!";
            $response['status']  = 0;
            return $response;
        }
    }
    public function addItemToPlayer($item_id, $amount, $steamid, $message)
    {
        if (is_numeric($amount) && ($amount > 0)) {
            $item_id = $this->database->sanatize($item_id);
            $message = $this->database->sanatize($message);
            $steamid = $this->database->sanatize($steamid);
            if ($this->checkIfItemExistsInGame($item_id)) {
                $Online = $this->checkIfPlayerIsOnline($steamid);
                if ($Online == 1) {
                    $val1 = $item_id . "," . $message;
                    $this->insertIntoRemote("market_give", "v4b1", "", "$steamid", "$val1", "$amount", "");
                    $response['status'] = 1;
                    return $response;
                } elseif ($Online == 0) {
                    $playersInventory = $this->fetchPlayersInventory($steamid);
                    if ($playersInventory['status'] == 1) {
                        $inv    = $playersInventory['callback'];
                        $newInv = ""; //ItemID:amount,
                        $found  = false;
                        foreach (explode(";", $inv) as $itemElement) {
                            $itemElement = trim($itemElement);
                            if (strpos($itemElement, ": ") !== false) {
                                list($item, $amt) = explode(": ", $itemElement);
                                if ($item == $item_id) {
                                    $amt = $amt + $amount;
                                    if ($amt > 0) {
                                        $newInv .= "$item: $amt; ";
                                        $found              = true;
                                        $response['status'] = 1;
                                    }
                                } else {
                                    $newInv .= "$item: $amt; ";
                                }
                            }
                        }
                        return $response;
                    } else {
                        $response['message'] = "There was an error in fetching your inventory, contact a developer.";
                        $response['status']  = 0;
                        return $response;
                    }
                    if ($found == false) {
                        $newInv .= "$item: $amt; ";
                    }
                    //Update Inventory.
                    $this->database->update("{$this->databaseTable->players_Inventory}", "{$this->databaseTable->players_table}", "'$newInv'", "WHERE `{$this->databaseTable->players_steamid}` = '$steamid'");
                    $response['status'] = 1;
                    return $response;
                } else {
                    $response['message'] = "It seems that you have not joint our server, join us at http://limelightgaming.net";
                    $response['status']  = 0;
                    return $response;
                }
            } else {
                $response['message'] = "Contact a developer, the item does not exist in the game.";
                $response['status']  = 0;
                return $response;
            }
        } else {
            $response['message'] = "The amount you entered is not valid! Check the amount and try again!";
            $response['status']  = 0;
            return $response;
        }

    }

    public function updateUserMoneyOffline($steamid, $newbalance)
    {
        if (is_numeric($newbalance) && ($newbalance > 0)) {
            $this->database->update("{$this->databaseTable->players_Money}", "{$this->databaseTable->players_table}", "'$newbalance'", "WHERE `{$this->databaseTable->players_steamid}` = '$steamid'");
            $response['status'] = 1;
            return $response;
        } else {
            $response['message'] = "There was an error in updating your money, contact a developer";
            $response['status']  = 0;
            return $response;
        }
    }

    public function giveUserMoney($steamid, $amount, $message)
    {
        if (is_numeric($amount) && ($amount > 0)) {
            $steamid = $this->database->sanatize($steamid);
            $message = $this->database->sanatize($message);
            $Online  = $this->checkIfPlayerIsOnline();
            if ($Online == 1) {
                $this->insertIntoRemote("money_give", "v4b1", "", "$steamid", $amount, "$message", "");
                $response['status'] = 1;
                return $response;
            } elseif ($Online == 0) {
                $moneyResponse = $this->fetchCurrentMoney($steamid);
                $money = $moneyResponse['callback'];
                $money = $money + $amount;
                $MonetaryResponse = $this->updateUserMoneyOffline($steamid, $money);
                if ($MonetaryResponse['status'] == 1) {
                    $response['message'] = "Successfully deposited money into your in-game wallet!";
                    $response['status']  = 1;
                    return $response;
                } else {
                    $response['message'] = "Failed to deposit money into your in-game wallet, contact a developer";
                    $response['status']  = 0;
                    return $response;
                }
            } else {
                $response['message'] = "It seems that you have not joint our server, join us at http://limelightgaming.net";
                $response['status']  = 0;
                return $response;
            }
        }
    }

    public function takeUserMoney($steamid, $amount, $message)
    {
        if (is_numeric($amount) && ($amount > 0)) {
            $steamid = $this->database->sanatize($steamid);
            $message = $this->database->sanatize($message);
            $Online  = $this->checkIfPlayerIsOnline();
            if ($Online == 1) {
                $this->insertIntoRemote("money_take", "v4b1", "", "$steamid", $amount, "$message", "");
                $response['status'] = 1;
                return $response;
            } elseif ($Online == 0) {
                $moneyResponse = $this->fetchCurrentMoney($steamid);
                $money = $moneyResponse['callback'];
                $money = $money - $amount;
                if ($money > 0) {
                    $MonetaryResponse = $this->updateUserMoneyOffline($steamid, $money);
                    if ($MonetaryResponse['status'] == 1) {
                        $response['message'] = "Successfully taken money from your in-game wallet!";
                        $response['status']  = 1;
                        return $response;
                    } else {
                        $response['message'] = "Failed to withdraw money from your in-game wallet, contact a developer";
                        $response['status']  = 0;
                        return $response;
                    }
                } else {
                    $response['message'] = "Do not try to exploit, or you will be banned.";
                    $resonse['status']   = 0;
                    return $response;
                }
            } else {
                $response['message'] = "It seems that you have not joint our server, join us at http://limelightgaming.net";
                $response['status']  = 0;
                return $response;
            }
        }
    }

}
//
?>
