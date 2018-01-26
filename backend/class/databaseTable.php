<?php
class databaseTable {

    //item listings table
    public $listings_table = "item_listings";
    public $listings_id = "id";
    public $listings_steamid = "steamid";
    public $listings_item_id = "item_id";
    public $listings_qty = "qty";
    public $listings_price = "price";
    public $listings_type = "type";
    public $listings_status = "status";
    public $listings_time_created = "time_created";
    public $listings_last_modified = "last_modified";

    //Log table
    public $log_table = "log_table";
    public $log_id = "id";
    public $log_steamid = "steamid";
    public $log_type = "type";
    public $log_json_log = "json_log";

    //Remote table
    public $remote_table = "remote";
    public $remote_type = "type";
    public $remote_server = "server";
    public $remote_name = "name";
    public $remote_steamid = "steamid";
    public $remote_value1 = "value1";
    public $remote_value2 = "value2";
    public $remote_webhook = "webhook";
    public $remote_done = "done";
    public $remote_time = "time";

    //Players Table
    public $players_table = "players";
    public $players_steamid = "_SteamID";
    public $players_Inventory = "_Inventory";
    public $players_Money = "_Money";
    public $players_online = "_Online";

    //Item_values table
    public $item_values_table = "item_values";
    public $item_values_name = "_Name";
    public $item_values_value = "_Value";
    public $item_values_description = "_Description";
    public $item_values_uniqueID = "_UniqueID";

    //Bans table
    public $ban_table = "bans";
    public $ban_time = "TIMESTAMPDIFF(SECOND, NOW(), unban_time) as timeleft";
    public $ban_steamid = "steamid";

}
?>
