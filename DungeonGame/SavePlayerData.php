<?php

    $con=mysqli_connect('192.168.31.20:8080','root','','demo');

    if (mysqli_connect_errno())
    {
        echo "0: Connection failed";
        exit();
    }

    $id=$_POST["id"];
    $health=$_POST["health"];
    $pesos=$_POST["pesos"];
    $experience=$_POST["experience"];
    $weaponLevel=$_POST["weaponlevel"];
    $playedTime=$_POST["playedtime"];
    $lastScene=$_POST["lastscene"];
    $gameQuality=$_POST["gamequality"];
    $musicVolume=$_POST["musicvolume"];
    echo gettype($lastScene),$lastScene;
    $sql="UPDATE `playerdata` SET 
    `Health` = '$health', 
    `Pesos` = '$pesos',
    `Experience` = '$experience',
    `WeaponLevel` = '$weaponLevel',
    `PlayedTime` = '$playedTime',
    `LastScene` = '$lastScene',
    `GameQuality` = '$gameQuality',
    `MusicVolume` = '$musicVolume'
     WHERE ID = $id";

    if ($con->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $con->error;
      }
?>