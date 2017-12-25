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
        $sqlQuery = "SELECT {$this->databaseTable->players_Money} FROM {$this->databaseTable->players_table}";
        $result = $this->database->select($sqlQuery);
        if(mysqli_num_rows($result) == 1) {
            $result = mysqli_fetch_assoc($result);
            return($result["{$this->databaseTable->players_Money}"]);
        } else {
            return false;
        }
    }
}
?>
