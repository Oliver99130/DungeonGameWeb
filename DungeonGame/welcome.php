<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
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
    <h1 class="my-5">Üdözöllek  <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>a Dungeonban.</h1>
    </div>
                    
                    <button> <a href="img/heal.png" download="proposed_file_name">Letöltés</a> </button>
                    <p>
        <a href="reset-password.php" class="btn btn-warning">új jelszó</a>
        <a href="logout.php" class="btn btn-danger ml-3">Kijelentkezés</a>
    </p>
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