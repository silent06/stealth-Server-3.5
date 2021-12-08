<?php
include("includes/db.php"); 

$get_clients = mysqli_query($con, "SELECT COUNT(0) FROM `authed-clients`");
$get_clients = mysqli_fetch_array($get_clients);
$get_clients = $get_clients[0];

$get_tokens = mysqli_query($con, "SELECT COUNT(0) FROM `server-tokens`");
$get_tokens = mysqli_fetch_array($get_tokens);
$get_tokens = $get_tokens[0];

$get_online = mysqli_query($con, "SELECT COUNT(0) FROM `authed-clients` WHERE `ExpireDate` > now() - INTERVAL 1.5 MINUTE;");
$get_online = mysqli_fetch_array($get_online);
$get_online = $get_online[0];

/*$get_cod4 = mysqli_query($con, "SELECT COUNT(0) FROM authed-clients WHERE `ExpireDate` = '> now() - INTERVAL 1.5 MINUTE' AND TitleID = '415607E6';");
$get_cod4 = mysqli_fetch_array($get_cod4);
$get_cod4 = $get_cod4[0];

$get_waw = mysqli_query($con, "SELECT COUNT(0) FROM authed-clients WHERE `ExpireDate` = '> now() - INTERVAL 1.5 MINUTE' AND TitleID = '4156081C';");
$get_waw = mysqli_fetch_array($get_waw);
$get_waw = $get_waw[0];

$get_mw2 = mysqli_query($con, "SELECT COUNT(0) FROM authed-clients WHERE `ExpireDate` = '> now() - INTERVAL 1.5 MINUTE' AND TitleID = '41560817';");
$get_mw2 = mysqli_fetch_array($get_mw2);
$get_mw2 = $get_mw2[0];

$get_mw3 = mysqli_query($con, "SELECT COUNT(0) FROM authed-clients WHERE `ExpireDate` = '> now() - INTERVAL 1.5 MINUTE' AND TitleID = '415608CB';");
$get_mw3 = mysqli_fetch_array($get_mw3);
$get_mw3 = $get_mw3[0];

$get_bo1 = mysqli_query($con, "SELECT COUNT(0) FROM authed-clients WHERE `ExpireDate` = '> now() - INTERVAL 1.5 MINUTE' AND TitleID = '41560855';");
$get_bo1 = mysqli_fetch_array($get_bo1);
$get_bo1 = $get_bo1[0];

$get_bo2 = mysqli_query($con, "SELECT COUNT(0) FROM authed-clients WHERE `ExpireDate` = '> now() - INTERVAL 1.5 MINUTE' AND TitleID = '415608C3';");
$get_bo2 = mysqli_fetch_array($get_bo2);
$get_bo2 = $get_bo2[0];

$get_bo3 = mysqli_query($con, "SELECT COUNT(0) FROM authed-clients WHERE `ExpireDate` = '> now() - INTERVAL 1.5 MINUTE' AND TitleID = '4156091D';");
$get_bo3 = mysqli_fetch_array($get_bo3);
$get_bo3 = $get_bo3[0];
*/
//$get_ghosts = mysqli_query($con, "SELECT COUNT(0) FROM authed-clients WHERE `ExpireDate` = '> now() - INTERVAL 1.5 MINUTE' AND TitleID = '415608FC';");
//$get_ghosts = mysqli_fetch_array($get_ghosts);
//$get_ghosts = $get_ghosts[0];

//$get_aw = mysqli_query($con, "SELECT COUNT(0) FROM authed-clients WHERE `ExpireDate` = '> now() - INTERVAL 1.5 MINUTE' AND TitleID = '41560914';");
//$get_aw = mysqli_fetch_array($get_aw);
//$get_aw = $get_aw[0];

if(!isset($_SESSION))
{
    session_start();
}

if( !isset( $_SESSION['email'] ) || time() - $_SESSION['login_time'] > 300000) {
    unset($_SESSION['login']);
    unset($_SESSION['email']);
    session_destroy();
    header("Location: login.php");
}

else 
{

    //Record our time value to the session login_time
    $_SESSION['login_time'] = time();
}
if(!isset($_SESSION['login']) || $_SESSION['login'] !== true) 
{
    unset($_SESSION['login']);
    unset($_SESSION['email']);
    session_destroy();
    header('Location: login.php');
}

//$get_client = mysqli_query($con, "SELECT * FROM `panel-users` where `userID` =".$_SESSION['userID']."");
//$get_client = mysqli_fetch_array($get_client);

//$username = $get_client[2];
//$_SESSION['userID'] = $get_client[2];

$clients_result = mysqli_query($con, "SELECT * FROM `module-settings`");

while($clients_row2 = mysqli_fetch_array($clients_result))
{
    $web_site_name = "Stealth Backend";
}

//$userLvl = $get_client[4];
$userLvl = 3;
//$profilePicture = $get_client[3];
$rank_status;
if ($userLvl == 3)
{
	$rank_status = "Administrator";
}
else
{
	$rank_status = "Seller";
}

?>
<html lang="en">
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $web_site_name; ?></title>
        <link href="vendors\bower_components\animate.css\animate.min.css" rel="stylesheet">
        <link href="vendors\bower_components\material-design-iconic-font\dist\css\material-design-iconic-font.min.css" rel="stylesheet">
        <link href="vendors\bower_components\malihu-custom-scrollbar-plugin\jquery.mCustomScrollbar.min.css" rel="stylesheet">
        <link href="vendors\bower_components\fullcalendar\dist\fullcalendar.min.css" rel="stylesheet">
        <link href="css\app-1.min.css" rel="stylesheet">
        <script src="js\page-loader.min.js"></script>
    <script src='/google_analytics_auto.js'></script></head>

    <body>
        <!-- Page Loader -->
        <div id="page-loader">
            <div class="preloader preloader--xl preloader--light">
                <svg viewbox="25 25 50 50">
                    <circle cx="50" cy="50" r="20"></circle>
                </svg>
            </div>
        </div>

        <!-- Header -->
        <header id="header">
            <div class="logo">
                <a href="index.php" class="hidden-xs">
                    <?php echo $web_site_name; ?>
                    <small>Leading Stealth</small>
                </a>
                <i class="logo__trigger zmdi zmdi-menu" data-mae-action="block-open" data-mae-target="#navigation"></i>
            </div>

            <ul class="top-menu">
                <li class="top-menu__trigger hidden-lg hidden-md">
                    <a href=""><i class="zmdi zmdi-search"></i></a>
                </li>
				
            </ul>

            <ul class="top-menu__profile dropdown">
				<li>
					<a href="./logout.php">
						<font color="CB50E9">
					    Sign out
				        </font>
				    </a>
				</li>
			</ul>
        </header>

        <section id="main">
            <aside id="notifications">
                <ul class="tab-nav tab-nav--justified tab-nav--icon">
                    <li><a class="user-alert__messages" href="#notifications__messages" data-toggle="tab"><i class="zmdi zmdi-email"></i></a></li>
                    <li><a class="user-alert__notifications" href="#notifications__updates" data-toggle="tab"><i class="zmdi zmdi-notifications"></i></a></li>
                    <li><a class="user-alert__tasks" href="#notifications__tasks" data-toggle="tab"><i class="zmdi zmdi-playlist-plus"></i></a></li>
                </ul>
            </aside>

            <aside id="navigation">
                <div class="navigation__header">
                    <i class="zmdi zmdi-long-arrow-left" data-mae-action="block-close"></i>
                </div>

                <div class="navigation__toggles">
                    <a href="" class="active" data-mae-action="block-open" data-mae-target="#notifications" data-toggle="tab" data-target="#notifications__messages">
                        <i class="zmdi zmdi-email"></i>
                    </a>
                    <a href="" data-mae-action="block-open" data-mae-target="#notifications" data-toggle="tab" data-target="#notifications__updates">
                        <i class="zmdi zmdi-notifications"></i>
                    </a>
                    <a href="" data-mae-action="block-open" data-mae-target="#notifications" data-toggle="tab" data-target="#notifications__tasks">
                        <i class="zmdi zmdi-playlist-plus"></i>
                    </a>
                </div>

                <div class="navigation__menu c-overflow">
                    <ul>
                        <li class="navigation__active">
                            <a href="index.php"><i class="zmdi zmdi-home"></i> Dashboard</a>
                        </li>
                        <li><a href="manage_clients.php"><i class="zmdi zmdi-view-list"></i> Manage Clients</a></li>
                        <li><a href="manage_tokens.php"><i class="zmdi zmdi-view-list"></i> Manage Tokens</a></li>
                        <li><a href="manage_server.php"><i class="zmdi zmdi-view-list"></i> Server Settings</a></li>
                    </ul>
                </div>
            </aside>

            <section id="content">
                <div id="content__grid" data-columns="">
                    <div class="card widget-analytic">
                        <div class="card__header">
                            <h2>Consoles <small>Amount of existing consoles.</small></h2>
                            <div class="actions">
                                <div class="dropdown">
                                    <a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="manage_clients.php">Manage Clients</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card__body">
                            <div class="widget-analytic__info">
                                <i class="zmdi zmdi-caret-up-circle"></i>
                                <h2><?php echo $get_clients; ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="card widget-analytic">
                        <div class="card__header">
                            <h2>Tokens <small>Amount of existing tokens.</small></h2>
                            <div class="actions">
                                <div class="dropdown">
                                    <a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="manage_tokens.php">Manage Tokens</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card__body">
                            <div class="widget-analytic__info">
                                <i class="zmdi zmdi-caret-up-circle"></i>
                                <h2><?php echo $get_tokens; ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="card widget-analytic">
                        <div class="card__header">
                            <h2>Online Consoles <small>Amount of online consoles.</small></h2>
                            <div class="actions">
                                <div class="dropdown">
                                    <a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="manage_clients.php">Manage Clients</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card__body">
                            <div class="widget-analytic__info">
                                <i class="zmdi zmdi-caret-down-circle"></i>
                                <h2><?php echo $get_online; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer id="footer">
                Copyright &copy; 2020 <?php echo $web_site_name; ?>

                <ul class="footer__menu">
                    <li><a href="">Dashboard</a></li>
                </ul>
            </footer>

        </section>
        <script src="vendors\bower_components\jquery\dist\jquery.min.js"></script>
        <script src="vendors\bower_components\bootstrap\dist\js\bootstrap.min.js"></script>
        <script src="vendors\bower_components\malihu-custom-scrollbar-plugin\jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="vendors\bower_components\remarkable-bootstrap-notify\dist\bootstrap-notify.min.js"></script>
        <script src="vendors\bower_components\moment\min\moment.min.js"></script>
        <script src="vendors\bower_components\fullcalendar\dist\fullcalendar.min.js"></script>
        <script src="vendors\bower_components\simpleWeather\jquery.simpleWeather.min.js"></script>
        <script src="vendors\bower_components\salvattore\dist\salvattore.min.js"></script>
        <script src="vendors\bower_components\flot\jquery.flot.js"></script>
        <script src="vendors\bower_components\flot\jquery.flot.resize.js"></script>
        <script src="vendors\bower_components\flot.curvedlines\curvedLines.js"></script>
        <script src="vendors\jquery.sparkline\jquery.sparkline.min.js"></script>
        <script src="vendors\bower_components\jquery.easy-pie-chart\dist\jquery.easypiechart.min.js"></script>
        <script src="demo\js\flot-charts\curved-line.js"></script>
        <script src="demo\js\flot-charts\line.js"></script>
        <script src="demo\js\easy-pie-charts.js"></script>
        <script src="demo\js\misc.js"></script>
        <script src="demo\js\sparkline-charts.js"></script>
        <script src="demo\js\calendar.js"></script>
        <script src="js\app.min.js"></script>
    </body>
</html>
