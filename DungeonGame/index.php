<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="Hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Project</title>

    <!-- load CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css"> 
    <link rel="stylesheet" href="css/stylesheet.css" type="text/css" charset="utf-8" />
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <header class="text-center tm-site-header">
                    <img src="img/dungeon.png" alt="Image" class="rounded-circle tm-img-timeline">
                    <br>
                    <h1 class="pl-4 tm-site-title" style="font-family:'manaspaceregular'">DungeonGame</h1>
                    <div class="tm-welcome-text">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
                    <p class=" tm-welcome-text">A játék letötéséhez regisztrálj:<a href="register.php">Itt!</a>
                </header>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-lg-12">
                <div class="tm-video-container">
                    <video id="tm-welcome-video" class="tm-welcome-video" autoplay="" loop="" muted="">
                        <source src="videos/video.mp4" type="video/mp4"> Your browser does not support the video tag.
                        </video>
                        <div id="tm-video-loader"></div>
                        <div id="tm-video-text-overlay" class="tm-video-text-overlay d-none">
                            <h1>
                                <div id="rotate" class="tm-video-text">
                                    <div>This is timeless</div>
                                    <div>We are invincible</div>
                                    <div>Quite unbeatable</div>
                                    <div>and indestructible</div>
                                </div>
                            </h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    -->
        <div class="container tm-container-2">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="tm-welcome-text">DungeonGame gyors talpaló:</h2>
                </div>
            </div>
            <div class="row tm-section-mb">
                <div class="col-lg-12">
                    <div class=" tm-timeline-item">
                        <div class="tm-timeline-item-inner">
                            <img src="img/kep.png" alt="Image" class="rounded-circle tm-img-timeline">
                            <div class="tm-timeline-connector">
                                <p class="mb-0">&nbsp;</p>
                            </div>
                            <div class="tm-timeline-description-wrap">
                                <div class="tm-bg-dark tm-timeline-description">
                                    <h3 class="tm-text-green tm-font-400">Alap karaktered</h3>
                                    <p>W/A/S/D-vel tudsz mozogni és a Space gombbal tudsz támadni.</p>
                                </div>
                            </div>
                        </div>

                        <div class="tm-timeline-connector-vertical"></div>
                    </div>

                    <div class="tm-timeline-item">
                        <div class="tm-timeline-item-inner">
                            <img src="img/heal.png" alt="Image" class="rounded-circle tm-img-timeline">
                            <div class="tm-timeline-connector">
                                <p class="mb-0">&nbsp;</p>
                            </div>
                            <div class="tm-timeline-description-wrap">
                                <div class="tm-bg-dark-light tm-timeline-description">
                                    <h3 class="tm-text-cyan tm-font-400">Életerő visszatöltési pontok</h3>
                                    <p>Ezeknél a kutaknál visszanyerheted az életerődet.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tm-timeline-connector-vertical"></div>
                    </div>

                    <div class="tm-timeline-item">
                        <div class="tm-timeline-item-inner">
                            <img src="img/lada.png" alt="Image" class="rounded-circle tm-img-timeline">
                            <div class="tm-timeline-connector">
                                <p class="mb-0">&nbsp;</p>
                            </div>
                            <div class="tm-timeline-description-wrap">
                                <div class="tm-bg-dark tm-timeline-description">
                                    <h3 class="tm-text-yellow tm-font-400">Láda</h3>
                                    <p>Ládából kaphatsz aranyat ezzel jobb tárgyakat vehetsz.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tm-timeline-connector-vertical"></div>
                    </div>

                    <div class="tm-timeline-item">
                        <div class="tm-timeline-item-inner">
                            <img src="img/portal.png" alt="Image" class="rounded-circle tm-img-timeline">
                            <div class="tm-timeline-connector">
                                <p class="mb-0">&nbsp;</p>
                            </div>
                            <div class="tm-timeline-description-wrap">
                                <div class="tm-bg-dark tm-timeline-description">
                                    <h3 class="tm-text-green tm-font-400">Portál</h3>
                                    <p>A portál segítségével juthatsz el más területekre.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tm-timeline-connector-vertical"></div>
                    </div>
                    
                    <div class="tm-timeline-item">
                        <div class="tm-timeline-item-inner">
                            <img src="img/enemy.png" alt="Image" class="rounded-circle tm-img-timeline">
                            <div class="tm-timeline-connector">
                                <p class="mb-0">&nbsp;</p>
                            </div>
                            <div class="tm-timeline-description-wrap">
                                <div class="tm-bg-dark tm-timeline-description">
                                    <h3 class= "tm-font-400" style="color: red;">Ellenség</h3>
                                    <p>Az utadat veszélyes szörnyek álljál de érdemes megküzdeni velük mert így tapasztalati ponthoz juthatsz.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tm-timeline-connector-vertical"></div>
                    </div>

                    <div class="tm-timeline-item">
                        <div class="tm-timeline-item-inner">
                            <img src="img/tabla.png" alt="Image" class="rounded-circle tm-img-timeline">
                            <div class="tm-timeline-connector">
                                <p class="mb-0">&nbsp;</p>
                            </div>
                            <div class="tm-timeline-description-wrap">
                                <div class="tm-bg-dark-light tm-timeline-description">
                                    <h3 class="tm-text-orange tm-font-400">Mentési pont</h3>
                                    <p>A táblához érve eltudod menteni az állas pontod.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--  row -->
            <hr>
            <div class="row tm-section-mb tm-section-mt">
                <div class="col-lg-4 col-md-4 col-sm-12 pr-lg-5 mb-md-0 mb-4">
                    <h3 class="mt-2 mb-3 tm-text-gray">Nunc dictum consequat</h3>
                    <p>Integer imperdiet aliquet lobortis. In in metus risus. Pellentesque pulvinar venenatis dui id rutrum. In
                    pharetra neque et eleifend venenatis.</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 pr-lg-5 mb-md-0 mb-4">
                    <h3 class="mt-2 mb-3 tm-text-gray">Morbi ultrices tellus</h3>
                    <p>Integer imperdiet aliquet lobortis. In in metus risus. Pellentesque pulvinar venenatis dui id rutrum. In
                    pharetra neque et eleifend venenatis.</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <h3 class="mt-2 mb-3 tm-text-gray">Suspendisse dolor tortor</h3>
                    <p>Integer imperdiet aliquet lobortis. In in metus risus. Pellentesque pulvinar venenatis dui id rutrum. In
                    pharetra neque et eleifend venenatis.</p>
                </div>
            </div>
        <hr>
        <!-- Footer -->
        <footer class="row mt-5 mb-5">
            <div class="col-lg-12">
                <p class="text-center tm-text-gray tm-copyright-text mb-0">Copyright &copy;
                    <span class="tm-current-year">2018</span> Your Company Name 
                    
                </p>
            </div>
        </footer>
    </div>
    <!-- .container -->

    <script src="js/jquery.min.js"></script>
    <!-- <script src="js/jquery-3.2.1.slim.min.js"></script> -->
    <script src="js/templatemo-script.js"></script>

</body>
</html>