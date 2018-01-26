<?php

if (empty($_SESSION['steam_uptodate']) or empty($_SESSION['steam_personaname'])) {
	require 'SteamConfig.php';
	$url = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamauth['apikey']."&steamids=".$_SESSION['steamid']);
	$content = json_decode($url, true);
	$_SESSION['steam_steamid'] = $content['response']['players'][0]['steamid'];
	$_SESSION['steam_communityvisibilitystate'] = $content['response']['players'][0]['communityvisibilitystate'];
	$_SESSION['steam_profilestate'] = $content['response']['players'][0]['profilestate'];
	$_SESSION['steam_personaname'] = $content['response']['players'][0]['personaname'];
	$_SESSION['steam_lastlogoff'] = $content['response']['players'][0]['lastlogoff'];
	$_SESSION['steam_profileurl'] = $content['response']['players'][0]['profileurl'];
	$_SESSION['steam_avatar'] = $content['response']['players'][0]['avatar'];
	$_SESSION['steam_avatarmedium'] = $content['response']['players'][0]['avatarmedium'];
	$_SESSION['steam_avatarfull'] = $content['response']['players'][0]['avatarfull'];
	$_SESSION['steam_personastate'] = $content['response']['players'][0]['personastate'];
	if (isset($content['response']['players'][0]['realname'])) {
		   $_SESSION['steam_realname'] = $content['response']['players'][0]['realname'];
	   } else {
		   $_SESSION['steam_realname'] = "Real name not given";
	}
	$_SESSION['steam_primaryclanid'] = $content['response']['players'][0]['primaryclanid'];
	$_SESSION['steam_timecreated'] = $content['response']['players'][0]['timecreated'];
	$_SESSION['steam_uptodate'] = time();
}

$steamprofile['steamid'] = $_SESSION['steam_steamid'];
$steamprofile['communityvisibilitystate'] = $_SESSION['steam_communityvisibilitystate'];
$steamprofile['profilestate'] = $_SESSION['steam_profilestate'];
$steamprofile['personaname'] = $_SESSION['steam_personaname'];
$steamprofile['lastlogoff'] = $_SESSION['steam_lastlogoff'];
$steamprofile['profileurl'] = $_SESSION['steam_profileurl'];
$steamprofile['avatar'] = $_SESSION['steam_avatar'];
$steamprofile['avatarmedium'] = $_SESSION['steam_avatarmedium'];
$steamprofile['avatarfull'] = $_SESSION['steam_avatarfull'];
$steamprofile['personastate'] = $_SESSION['steam_personastate'];
$steamprofile['realname'] = $_SESSION['steam_realname'];
$steamprofile['primaryclanid'] = $_SESSION['steam_primaryclanid'];
$steamprofile['timecreated'] = $_SESSION['steam_timecreated'];
$steamprofile['uptodate'] = $_SESSION['steam_uptodate'];

//These two needs to be combined later on. Just quick fixes as of now.
$SteamName = $steamprofile['personaname'];
$SteamName = htmlspecialchars($SteamName);

$userSteamID = $steamprofile["steamid"];
$userSteamID = mysqli_real_escape_string($con,$userSteamID);
$userSearch = "SELECT * FROM users WHERE SteamID64 = $userSteamID";
$userResult = mysqli_query($con,$userSearch);
if(mysqli_num_rows($userResult) == 1) {
    while($user=mysqli_fetch_array($userResult,MYSQLI_ASSOC)) {
        $UserID = $user["UserID"];
        $UserSteamID = $user["SteamID"];

        $userMoney = $user["MoneyDeposited"];
        $userFMoney = money_format('%.2n', $userMoney);
        $access = $user["Access"];
        if($access == 9) { header('location: https://ecse.limelightgaming.net/banned.php'); }
        if($access == 4) {
            $Admin = 1;
            $AdminUserID = $UserID;
        } else {
            $Admin = 0;
        }
    }
    $SignedIn = 1;
} else {
    $SignedIn = 0;
    $SteamName = $steamprofile['personaname'];
    $SteamName = htmlspecialchars($SteamName);

    $userSteamID = $steamprofile["steamid"];
    $userSteamID = mysqli_real_escape_string($con,$userSteamID);

    require("assets/scripts/register.php");
}


// Version 3.2
?>
