<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("location: index.php");
    exit;
}
 

require_once "config.php";
 

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Kérlek írd be a jelszót.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "A jelszó minimum 6 karaktert kell tartalmazzon.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
   
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Kérlek írd be a jelszót ismét.";
        echo $_POST["confirm_password"];
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Jelszavak nem egyeznek.";
        }
    }
        
 
    if(empty($new_password_err) && empty($confirm_password_err)){

        $sql = "UPDATE users SET password = ?, salt = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
   
            mysqli_stmt_bind_param($stmt, "ssi", $param_password, $salt, $param_id);
            $username=$_SESSION["username"];
 
            $salt="\$5\$rounds=5000\$" . "lockedpass" . $username . "\$";
            $param_password = crypt($new_password, $salt); 
            $param_id = $_SESSION["id"];
            
   
            if(mysqli_stmt_execute($stmt)){

                session_destroy();
                header("location: index.php");
                exit();
            } else{
                echo "Valami nincs rendben, próbáld újra késöbb.";
            }


            mysqli_stmt_close($stmt);
        }
    }
    

    mysqli_close($link);
}
?>
 
 <!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Új jelszó</title>
    
    <link rel="icon" type="image/x-icon" href="img/dungeon.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/templatemo-style.css"> 
    <link rel="stylesheet" href="css/stylesheet.css" type="text/css" charset="utf-8" />
    <style>
        body{ font: 14px sans-serif;text-align: center; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
<div class="row">
    <div class="col-lg-12">
        <header class="text-center tm-site-header">
            <img src="img/dungeon.png" alt="Image" class="rounded-circle tm-img-timeline">
            <br>
            <h1 class="pl-2 tm-site-title" style="font-family:'manaspaceregular'">DungeonGame</h1>
    </div>
</div>
    <div class="pl-4 tm-site-title">
        <h2>Új jelszó</h2>
        <p>Töltsd ki hogy új jelszót állíthass be magadnak!</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>Új jelszó</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Jelszó megerősítése</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Új jelszó">
                <a class="btn btn-link ml-2" href="welcome.php">Vissza</a>
            </div>
        </form>
    </div>    
</body>
</html>