<?php
class web_to_server {

    public $database;
    public $databaseTable;

    public function __construct() {
        $this->database->databaseConnection();
        $this->databaseTable->databaseTable();
    }

    public function fetchCurrentMoney($steamid) {
        $steamid = $this->database->sanatize($steamid);
        if($this->checkIfUserExists($steamid)) {
            $sqlQuery = "SELECT {$this->databaseTable->players_Money} FROM {$this->databaseTable->players_table} WHERE `{$this->databaseTable->players_steamid}` = '$steamid'";
            $result = $this->database->select($sqlQuery);
            if(mysqli_num_rows($result) == 1) {
                $result = mysqli_fetch_assoc($result);
                $response['callback'] = $result["{$this->databaseTable->players_Money}"];
                $response['status'] = 1;
            } else {
                $response['message'] = "It seems that your money is bugged, contact a developer.";
                $response['status'] = 0;
            }
        } else {
            $response['message'] = "It seems that you have not joint our server, join us at http://limelightgaming.net";
            $response['status'] = 0;
        }
        return $response;
    }

    public function checkIfUserExists($steamid) {
        $steamid = $this->database->sanatize($steamid);
        $sqlQuery = "SELECT 1 FROM {$this->databaseTable->players_table} WHERE `{$this->databaseTable->players_steamid}` = '$steamid'";
        $result = $this->database->select($sqlQuery);
        if(mysqli_num_rows($result) == 1){
            return true;
        } else {
            return false;
        }
    }

    public function fetchPlayersInventory($steamid) {
        $steamid = $this->database->sanatize($steamid);
        if($this->checkIfUserExists($steamid)) {
            $sqlQuery = "SELECT {$this->databaseTable->players_Inventory} FROM {$this->databaseTable->players_Inventory} WHERE `{$this->databaseTable->players_steamid}` = '$steamid'";
            $result = $this->database->select($sqlQuery);
            if(mysqli_num_rows($result) == 1) {
                $reuslt = mysqli_fetch_assoc($result);
                $response['callback'] = $result["{$this->databaseTable->players_Inventory}"];
                $response['status'] = 1;
            } else {
                $response['message'] = "Your inventory does not exist in the database, contact a developer.";
                $response['status'] = 0;
                echo json_encode($response);
                die();
            }
        } else {
            $response['message'] = "It seems that you have not joint our server, join us at https://limelightgaming.net";
            $response['status'] = 0;
            echo json_encode($response);
            die();
        }
        return $response;
    }

    public function checkIfItemExistsForPlayer($item_id,$amount,$steamid) {
        $steamid = $this->database->sanatize($steamid);
        if($this->checkIfUserExists($steamid)) {
            if(is_numeric($amount) && ($amount > 0)) {
                $playersInventory = $this->fetchPlayersInventory($steamid);
                if($playersInventory['status'] == 1) {
                    $inv = mysqli_fetch_array($playersInventory['callback'])[0];
                    foreach(explode(";",$inv) as $itemElement) {
                        $itemElement = trim($itemElement);
                        if(strpos($itemElement, ": ") !== false) {
                            list($item, $amt) = explode(": ", $itemElement);
                            $itemQuery = "SELECT * FROM {$this->databaseTable->item_values_table}";
                            $result = $this->database->select($itemQuery);
                            if(mysqli_num_rows($result) > 0) {
                                while($row=mysqli_fetch_assoc($result)) {
                                    $ItemID = $result["{$this->databaseTable->item_values_uniqueID}"];
                                    if($ItemID == $item_id) {
                                        if($amt >= $amount) {
                                            $response['ItemName'] = $result["{$this->databaseTable->item_values_name}"];
                                            $response['ItemID'] = $item_id;
                                            $response['ItemDescription'] = $result["{$this->databaseTable->item_values_description}"];
                                            $response['ItemValue'] = $result["{$this->databaseTable->item_values_value}"];
                                            $response['status'] = 1;
                                        } else {
                                            $response['message'] = "You do not have enough of this item, in future I recommend you do not try to exploit either.";
                                            $response['status'] = 0;
                                            echo json_encode($response);
                                            die();
                                        }
                                    }
                                }
                            } else {
                                $response['message'] = "There was an error connecting to the database, contact a developer.";
                                $response['status'] = 0;
                                echo json_encode($response);
                                die();
                            }

                        } else {
                            $response['message'] = "There was an error in fetching your inventory, contact a developer.";
                            $response['status'] = 0;
                            echo json_encode($response);
                            die();
                        }
                    }

                } else {
                    echo json_encode($response);
                    die();
                }
            } else {
                $response['message'] = "The amount you enter is not valid! Check the amount and try again!";
                $response['status'] = 0;
                echo json_encode($response);
                die();
            }
        } else {
            $response['message'] = "It seems that you have not joint our server, join us at https://limelightgaming.net";
            $response['status'] = 0;
            echo json_encode($response);
            die();
        }
        return $response;
    }

    public function checkIfPlayerIsOnline($steamid) {
        $steamid = $this->database->sanatize($steamid);
        $sqlQuery = "SELECT {$this->databaseTable->players_online} FROM {$this->databaseTable->players_table} WHERE `{$this->databaseTable->players_steamid}` = '$steamid'";
        $result = $this->database->select($sqlQuery);
        if(mysqli_num_rows($result) == 1) {
            $result = mysqli_fetch_assoc($result);
            if($result["{$this->databaseTable->players_online}"] == 1) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return -1;
        }
    }

    public function insertIntoRemote($type,$server,$name,$steamid,$value1,$value2,$webhook) {
        $type = $this->database->sanatize($type);
        $server = $this->database->sanatize($server);
        $name = $this->database->sanatize($name);
        $steamid = $this->database->sanatize($steamid);
        $value1 = $this->database->sanatize($value1);
        $value2 = $this->database->sanatize($value2);
        $webhook = $this->database->sanatize($webhook);
        $cols = "{$this->databaseTable->remote_type},{$this->databaseTable->remote_server},{$this->databaseTable->remote_name},{$this->databaseTable->remote_steamid},{$this->databaseTable->remote_value1},{$this->databaseTable->remote_value2},{$this->databaseTable->$remote_webhook}";
        $vals = "'$type','$server','$name','$steamid','$value1','$value2','$webhook'";
        $this->database->insert("{$this->databaseTable->remote_table}",$cols,$vals);
    }

    public function removeItemFromPlayer($item_id,$amount,$steamid) {
        if((is_numeric($amount)) && ($amount > 0)) {
            $steamid = $this->database->sanatize($steamid);
            $item_id = $this->database->sanatize($item_id);
            $itemResponse = $this->checkIfItemExistsForPlayer($item_id,$amount,$steamid);
            if($itemResponse['status'] == 1) {
                $Online = $this->checkIfPlayerIsOnline($steamid);
                if($Online == 1) {
                    //Query remote.
                    $this->insertIntoRemote("market_take","v4b1","","$steamid","$item_id","$amount","");
                }
                elseif($Online == 0) {
                    //We can edit his inventory from the db, or at least attempt to!
                }
                else {
                    $response['message'] = "There was a error in querying the database, please contact a developer.";
                    $response['status'] = 0;
                    echo json_encode($response);
                    die();
                }
            }
        } else {
            $response['message'] = "The amount you enter is not valid! Check the amount and try again!";
            $response['status'] = 0;
            echo json_encode($response);
            die();
        }
        return $response;
    }
}
?>
