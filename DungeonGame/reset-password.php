<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
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
        $confirm_password_err = $_POST["confirm_password"];
        echo $_POST["confirm_password"];
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Jelszavak nem egyeznek.";
        }
    }
        
 
    if(empty($new_password_err) && empty($confirm_password_err)){

        $sql = "UPDATE users SET password = ? salt = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
   
            mysqli_stmt_bind_param($stmt, "sis", $param_password, $param_id,$salt);
            
 
            $salt="\$5\$rounds=5000\$" . "lockedpass" . $username . "\$";
            $param_password = crypt($password, $salt); 
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>