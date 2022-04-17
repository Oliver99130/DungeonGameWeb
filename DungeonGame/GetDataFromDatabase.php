<?php
    require_once "config.php";
    $id=$_POST["id"];
    $sql="SELECT Health,Pesos,Experience,WeaponLevel,PlayedTime,LastScene,GameQuality,MusicVolume,skinID,killedEnemy,deaths FROM playerdata WHERE UserId=$id";

    $result=$link->query($sql);

    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            echo $row["Health"],"-",$row["Pesos"],"-",$row["Experience"],"-",$row["WeaponLevel"],"-",$row["PlayedTime"],"-",$row["LastScene"],"-",$row["GameQuality"],"-",$row["MusicVolume"],"-",$row["skinID"],"-",$row["killedEnemy"],"-",$row["deaths"];
        }
    }else{
        echo "Error uploading data";
    }


?>