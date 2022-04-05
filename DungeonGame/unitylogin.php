<?php

    require_once "config.php";

    $username=$_POST["name"];
    $password=$_POST["password1"];

    $namecheckquery="SELECT id,username, password,salt FROM users WHERE username='".$username."';";

    $namecheck=mysqli_query($link,$namecheckquery) or die("2: Name check failed");
    if(mysqli_num_rows($namecheck)!=1){
        echo "5: Nem létezik ilyen felhasználó!";
        exit();
    }

    $existinginfo=mysqli_fetch_assoc($namecheck);
    $salt=$existinginfo["salt"];
    $hash=$existinginfo["password"];
    $playerID=$existinginfo["id"];

    $loginhash = crypt($password,$salt);
    if($hash!=$loginhash){
        echo "6: Hibás jelszó!";
        exit();
    }

    echo "0/",$playerID;

?>