<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>DungeonGame</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/templatemo-style.css"> 

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
    <h1 class="my-5 text-center tm-site-header">Üdvözöllek  <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> a Dungeonban.</h1>
    </div>
                </header>
            </div>
        </div>
        <?php
                require_once "config.php";

                $test1=$_SESSION['username'];
                $result2 = mysqli_query($link,"SELECT users.username AS username,
                playerdata.Health AS health,
                playerdata.PlayedTime AS PlayedTime,
                playerdata.Pesos AS pesos,
                playerdata.Experience AS experience,
                playerdata.skinID AS skin,
                playerdata.killedEnemy AS killedEnemys,
                playerdata.deaths AS deaths
                FROM users JOIN playerdata ON users.ID=playerdata.ID WHERE users.username='".$_SESSION['username']."';");
                
                while($test = mysqli_fetch_array($result2)){

                $health= $test['health'];
                
                $experience= $test['experience'];

                $playedtime= $test['PlayedTime'];

                $pesos= $test['pesos'];

                $skinid= $test['skin'];

                $killedenemys= $test['killedEnemys'];

                $deaths= $test['deaths'];
                };
                $playedtime = (float) str_replace(',', '.', $playedtime);
                $playedtime=gmdate('H:i:s', $playedtime);
                echo "<div class='container'>
                        <div class='row'>
                            <div class='col-sm-4'>
                                <img src='img/".$skinid."player.gif' alt='Image'>
                            </div>
                            <div class='col-sm-4'>
                                <h2>Karaktered statisztikái:</h2>
                                <ul>
                                <li><span>Elért tapasztalati pont:</span> ".$experience."</li>
                                <li><span>Megölt szörnyek:</span> ".$killedenemys."</li>
                                <li><span>Halálaid száma:</span> ".$deaths."</li>
                                <li><span>Jelenlegi aranyad:</span> ".$pesos."</li>
                                <li><span>Jelenlegi életerőd:</span> ".$health."</li>
                                <li><span>Játszott óráid száma:</span> ".$playedtime."</li>
                                </ul>
                            </div>
                            <div class='col-sm-4'>
                                <h2>Felhasználói opciók:</h2>
                                <div class='buttons'> 
                                    <a href='' class='btn btn-success btn-lg'></i> Letöltés<br> <small>Androidra, verzió 1.0</small></a>
                                    <a href='Installer/DungeonSetup.zip' class='btn btn-success btn-lg'></i> Letöltés<br> <small>Pc-re, verzió 1.0</small></a>
                                </div>
                                <br>
                                <p>
                                    <a href='reset-password.php' class='btn btn-warning ml-3'>új jelszó</a><br><br>
                                    <a href='logout.php' class='btn btn-danger ml-3'>Kijelentkezés</a>
                                </p>
                            </div>
                    </div>";
            ?>
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
            <h2 class="row justify-content-center">Az 5 legtapasztaltabb játékos a Dungeon-ben</h2>
            <div class="row justify-content-center">
                
                <header class="text-center tm-site-header">
                    
            <?php

                

                $result1 = mysqli_query($link,"SELECT users.username AS username,
                playerdata.PlayedTime AS PlayedTime,
                playerdata.Experience AS experience 
                FROM users JOIN playerdata ON users.ID=playerdata.ID WHERE playerdata.PlayedTime!=0 ORDER BY experience  DESC LIMIT 5;");

                echo "<table class='table table-responsive' border='1'>

                <tr>

                <th>Felhasználónév</th>

                <th>Játszott órák száma</th>

                <th>Megszerzett tapasztalat</th>

                </tr>";

                while($row = mysqli_fetch_array($result1))

                {
                $playedtime=$row['PlayedTime'];
                $playedtime = (float) str_replace(',', '.', $playedtime);
                $playedtime=gmdate('H:i:s', $playedtime);

                echo "<tr>";

                echo "<td>" . $row['username'] . "</td>";

                echo "<td>" . $playedtime . "</td>";

                echo "<td>" . $row['experience'] . "</td>";

                echo "</tr>";

                }

                echo "</table>";
                mysqli_close($link);

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