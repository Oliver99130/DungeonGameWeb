<?php

    require_once "config.php";

    $id=$_POST["id"];
    $health=$_POST["health"];
    $pesos=$_POST["pesos"];
    $experience=$_POST["experience"];
    $weaponLevel=$_POST["weaponlevel"];
    $playedTime=$_POST["playedtime"];
    $lastScene=$_POST["lastscene"];
    $gameQuality=$_POST["gamequality"];
    $musicVolume=$_POST["musicvolume"];
    $skinID=$_POST["skinid"];
    $killedEnemyes=$_POST["killedenemyes"];
    $playerDeaths=$_POST["playerdeaths"];
    $sql="UPDATE `playerdata` SET 
    `Health` = '$health', 
    `Pesos` = '$pesos',
    `Experience` = '$experience',
    `WeaponLevel` = '$weaponLevel',
    `PlayedTime` = '$playedTime',
    `LastScene` = '$lastScene',
    `GameQuality` = '$gameQuality',
    `MusicVolume` = '$musicVolume',
    `skinID` = '$skinID',
    `killedEnemy` = '$killedEnemyes',
    `deaths` = '$playerDeaths'
     WHERE UserId = $id";

    if ($link->query($sql) === TRUE) {
        echo "0";
      } else {
        echo "Error updating record: " . $link->error;
      }
?>