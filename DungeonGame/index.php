<?php
session_start();
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 

require_once "config.php";
 

$username = $password = "";
$username_err = $password_err = $login_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty(trim($_POST["username"]))){
        $username_err = "Kérlek írd be a felhasználóneved.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Kérlek írd be a jelszavad.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty($username_err) && empty($password_err)){

        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            

            $param_username = $username;
            

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                

                if(mysqli_stmt_num_rows($stmt) == 1){                    

                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){

                            session_start();
                            

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            

                            header("location: welcome.php");
                        } else{

                            $login_err = "Helytelen felhasználónév vagy jelszó.";
                        }
                    }
                } else{

                    $login_err = "Helytelen felhasználónév vagy jelszó.";
                }
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
<html lang="Hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>DungeonGame</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">

    <link rel="stylesheet" href="css/bootstrap.min.css">

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
                            <h2>Bejelentkezés</h2>
                            <br>
                                <?php 
                                if(!empty($login_err)){
                                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                }        
                                ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Felhasználónév</label>
                                <div class="row">
                                    <div class="col-lg-5 mx-auto">
                                        <input  type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                    </div>
                                </div>
                        </div>    
                        <div class="form-group">
                            <label>Jelszó</label>
                                <div class="row">
                                    <div class="col-lg-5 mx-auto">
                                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                    </div>
                                </div>
                
                        </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>
                            </form>
                        </div>
                            <p class=" tm-welcome-text">A játék letötéséhez kérlek regisztrálj: <a href="register.php">Itt!</a>
                </header>
            </div>
        </div>
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
            <hr>
            <div class="row justify-content-center">
            <div class="col-auto">
                <header class="text-center tm-site-header">
            <?php

                $con = mysqli_connect("localhost","root","","demo");

                if (!$con)

                {

                die('Could not connect: ' . mysqli_connect_error());

                }

                $result = mysqli_query($con,"SELECT users.username AS username,
                playerdata.Health AS health,
                playerdata.PlayedTime AS PlayedTime,
                playerdata.Pesos AS pesos 
                FROM users JOIN playerdata ON users.ID=playerdata.ID WHERE playerdata.PlayedTime!=0");

                echo "<table class='table table-responsive' border='1'>

                <tr>

                <th>username</th>

                <th>Health</th>

                <th>PlayedTime</th>

                <th>Pesos</th>

                </tr>";

                while($row = mysqli_fetch_array($result))

                {

                echo "<tr>";

                echo "<td>" . $row['username'] . "</td>";

                echo "<td>" . $row['health'] . "</td>";

                echo "<td>" . $row['PlayedTime'],' másodperc' . "</td>";

                echo "<td>" . $row['pesos'] . "</td>";

                echo "</tr>";

                }

                echo "</table>";
                mysqli_close($con);

            ?>
            </div>
            </div>
            </div>
        <hr>
        <footer class="row mt-5 mb-5">
            <div class="col-lg-12">
                <p class="text-center tm-text-gray tm-copyright-text mb-0">Copyright &copy; 2022 Békefi Balázs, Szűcs Olivér, Mohácsi Erik</p>
            </div>
        </footer>
    </div>
</body>
</html>