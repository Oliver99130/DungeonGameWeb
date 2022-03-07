<?php

require_once "config.php";
 

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty(trim($_POST["username"]))){
        $username_err = "Kérlek írd be a felhasználóneved.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Min 6 karakter csak betűk és számok és aláhúzás.";
    }elseif(strlen(trim($_POST["username"])) < 6){
        $username_err = "A felhasználónév minimum 6 karaktert kell tartalmazzon.";
    } 
    else{

        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
 
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            

            $param_username = trim($_POST["username"]);
            

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Ez a felhasználónév már foglalt.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Valami nincs rendben, próbáld újra késöbb.";
            }


            mysqli_stmt_close($stmt);
        }
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Kérlek írd be a jelszavad.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Jelszó minimum 6 akrakter hosszú kell legyen.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Kérlek erősítsd meg a jelszavad.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Jelszavak nem egyeznek.";
        }
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        

        $sql = "INSERT INTO users (username, password,salt) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $salt);

            $param_username = $username;
            $salt="\$5\$rounds=5000\$" . "lockedpass" . $username . "\$";
            $param_password = crypt($password, $salt);
            

            if(mysqli_stmt_execute($stmt)){

                header("location: index.php");
            } else{
                echo "Valami nincs rendben, próbáld újra késöbb.";
            }

  
            mysqli_stmt_close($stmt);
        }
    }
    $sql = "INSERT INTO playerdata(ID) SELECT MAX(ID) FROM users";
    $result=mysqli_query($link,$sql);

    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>

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
            <h1 class="pl-4 tm-site-title" style="font-family:'manaspaceregular'">DungeonGame</h1>
    </div>
</div>
    <div class="pl-4 tm-site-title">
        <h2>Bejelentkezés</h2>
        <p>Töltsd ki az adatokat</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Felhasználónév</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                <p>Min 6 karakter csak betűk és számok és aláhúzás</p>
            </div>    
            <div class="form-group">
                <label>Jelszó</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                <p>Min 6 akrakter</p>
            </div>
            <div class="form-group">
                <label>Jelszó mégegyszer</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Regisztrálás">
                <input type="reset" class="btn btn-secondary ml-2" value="Törlés">
            </div>
            <p>Van már fiókod? <a href="index.php">bejelentkezés itt</a>.</p>
        </form>
    </div>    
</body>
</html>