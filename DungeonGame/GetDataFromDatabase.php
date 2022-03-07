<?php
    $con=mysqli_connect('localhost','root','','demo');

    if (mysqli_connect_errno())
    {
        echo "Error no connection";
        exit();
    }
    $id=$_POST["id"];
    $sql="SELECT Health,Pesos,Experience,WeaponLevel,PlayedTime,LastScene,GameQuality,MusicVolume FROM playerdata WHERE ID=$id";

    $result=$con->query($sql);

    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            echo $row["Health"],"-",$row["Pesos"],"-",$row["Experience"],"-",$row["WeaponLevel"],"-",$row["PlayedTime"],"-",$row["LastScene"],"-",$row["GameQuality"],"-",$row["MusicVolume"];
        }
    }else{
        echo "Error uploading data";
    }


?>