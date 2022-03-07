<?php

    $con=mysqli_connect('localhost','root','','demo');

    if (mysqli_connect_errno())
    {
        echo "1: Connection failed";
        exit();
    }

    $username=$_POST["name"];
    $password=$_POST["password1"];

    $namecheckquery="SELECT id,username, password,salt FROM users WHERE username='".$username."';";

    $namecheck=mysqli_query($con,$namecheckquery) or die("2: Name check failed");
    if(mysqli_num_rows($namecheck)!=1){
        echo "5: Either no user with this name.";
        exit();
    }

    $existinginfo=mysqli_fetch_assoc($namecheck);
    $salt=$existinginfo["salt"];
    $hash=$existinginfo["password"];
    $playerID=$existinginfo["id"];

    $loginhash = crypt($password,$salt);
    if($hash!=$loginhash){
        echo "6: Incorrect password!";
        exit();
    }

    echo "0/",$playerID;

?>