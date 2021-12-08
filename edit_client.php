<?php
include("includes/db.php"); 

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

$get_client = mysqli_query($con, "SELECT * FROM `panel-users` where `userID` =".$_SESSION['userID']."");
$get_client = mysqli_fetch_array($get_client);

$username = $get_client[2];
$_SESSION['userID'] = $get_client[2];

$clients_result = mysqli_query($con, "SELECT * FROM `module-settings`");

while($clients_row2 = mysqli_fetch_array($clients_result))
{
    $web_site_name = "".$clients_row2['Username']."";
}

$userLvl = $get_client[4];
$profilePicture = $get_client[3];
$rank_status;
if ($userLvl == 3)
{
	$rank_status = "Administrator";
}
else
{
	$rank_status = "Seller";
}

if(isset($_GET['userID']))
{
    $id = $_GET['userID'];

    $GetInfo = mysqli_query($con, "SELECT * FROM `authed-clients` WHERE `Username` = '$id' LIMIT 1");
    $clientinfo = mysqli_fetch_array($GetInfo);
    $client_cpuk = $clientinfo['CPUKey'];
    $client_expire = $clientinfo['ExpireDate'];
    $client_enabled = $clientinfo['Enabled'];
    $client_banned = $clientinfo['BannedUser'];
    $client_DaysLeft = $clientinfo['DaysLeft'];
    $client_KvIndex = $clientinfo['KvIndex'];
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $client_new_cpuk = $_POST['clientCPUKeyVal'];
    $client_new_days = $_POST['reserveDaysVal'];
    $client_new_DaysLeft = $_POST['alldaysVal'];
    $client_KvIndex = $_POST['nokvidVal'];
    $client_deleteVal = $_POST['deleteVal'];
    

	if ($userLvl != 3)
	{
		if (isset($_POST['enabledVal']) && isset($_POST['bannedVal']))
		{
			$save_client = mysqli_query($con, "UPDATE `authed-clients` SET `CPUKey`='".$client_cpuk."', `ExpireDate`='".$client_new_days."', `Enabled`='1', `BannedUser`='1', `KvIndex`='".$client_KvIndex."' WHERE `Username` = '".$_GET['userID']."'");
            $save_client = mysqli_query($con, "UPDATE `authed-clients` SET `DaysLeft`='".$client_new_DaysLeft."'  WHERE `Username` = '".$_GET['userID']."'");
        }
		else if (!isset($_POST['enabledVal']) && isset($_POST['bannedVal']))
		{
			$save_client = mysqli_query($con, "UPDATE `authed-clients` SET `CPUKey`='".$client_cpuk."', `ExpireDate`='".$client_new_days."', `Enabled`='0', `BannedUser`='1', `KvIndex`='".$client_KvIndex."' WHERE `Username` = '".$_GET['userID']."'");
            $save_client = mysqli_query($con, "UPDATE `authed-clients` SET `DaysLeft`='".$client_new_DaysLeft."'  WHERE `Username` = '".$_GET['userID']."'");
        }
		else if (isset($_POST['enabledVal']) && !isset($_POST['bannedVal']))
		{
			$save_client = mysqli_query($con, "UPDATE `authed-clients` SET `CPUKey`='".$client_cpuk."', `ExpireDate`='".$client_new_days."', `Enabled`='1', `BannedUser`='0', `KvIndex`='".$client_KvIndex."' WHERE `Username` = '".$_GET['userID']."'");
            
            $save_client = mysqli_query($con, "UPDATE `authed-clients` SET `DaysLeft`='".$client_new_DaysLeft."'  WHERE `Username` = '".$_GET['userID']."'");
        }
        else if(isset($_POST['deleteVal'])) 
        {

            $save_client = mysqli_query($con, "DELETE FROM `auth-clients` WHERE `CPUKey` = '".$_GET['userID']."'");
       
        }
		else
		{
			$save_client = mysqli_query($con, "UPDATE `authed-clients` SET `CPUKey`='".$client_cpuk."', `ExpireDate`='".$client_new_days."', `Enabled`='0', `BannedUser`='0', `KvIndex`='".$client_KvIndex."' WHERE `Username` = '".$_GET['userID']."'");
            $save_client = mysqli_query($con, "UPDATE `authed-clients` SET `DaysLeft`='".$client_new_DaysLeft."'  WHERE `Username` = '".$_GET['userID']."'");
        }
	}
	else
	{
		if (isset($_POST['enabledVal']) && isset($_POST['bannedVal']))
		{
			$save_client = mysqli_query($con, "UPDATE `authed-clients` SET `CPUKey`='".$client_new_cpuk."', `ExpireDate`='".$client_new_days."', `Enabled`='1', `BannedUser`='1', `KvIndex`='".$client_KvIndex."' WHERE `Username` = '".$_GET['userID']."'");
            $save_client = mysqli_query($con, "UPDATE `authed-clients` SET `DaysLeft`='".$client_new_DaysLeft."'  WHERE `Username` = '".$_GET['userID']."'");
        }
		else if (!isset($_POST['enabledVal']) && isset($_POST['bannedVal']))
		{
			$save_client = mysqli_query($con, "UPDATE `authed-clients` SET `CPUKey`='".$client_new_cpuk."', `ExpireDate`='".$client_new_days."', `Enabled`='0', `BannedUser`='1',  `KvIndex`='".$client_KvIndex."' WHERE `Username` = '".$_GET['userID']."'");
            $save_client = mysqli_query($con, "UPDATE `authed-clients` SET `DaysLeft`='".$client_new_DaysLeft."'  WHERE `Username` = '".$_GET['userID']."'");
        }
		else if (isset($_POST['enabledVal']) && !isset($_POST['bannedVal']))
		{
			$save_client = mysqli_query($con, "UPDATE `authed-clients` SET `CPUKey`='".$client_new_cpuk."', `ExpireDate`='".$client_new_days."', `Enabled`='1', `BannedUser`='0', `KvIndex`='".$client_KvIndex."' WHERE `Username` = '".$_GET['userID']."'");
            $save_client = mysqli_query($con, "UPDATE `authed-clients` SET `DaysLeft`='".$client_new_DaysLeft."'  WHERE `Username` = '".$_GET['userID']."'");
        }
        else if(isset($_POST['deleteVal'])) 
        {

            $save_client = mysqli_query($con, "DELETE FROM `auth-clients` WHERE `Username` = '".$_GET['userID']."'");
        }
		else
		{
            $save_client = mysqli_query($con, "UPDATE `authed-clients` SET `DaysLeft`='".$client_new_DaysLeft."'  WHERE `Username` = '".$_GET['userID']."'");
			$save_client = mysqli_query($con, "UPDATE `authed-clients` SET `CPUKey`='".$client_new_cpuk."', `ExpireDate`='".$client_new_days."', `Enabled`='0', `BannedUser`='0', `KvIndex`='".$client_KvIndex."' WHERE `Username` = '".$_GET['userID']."'");
		}
	}

	if ($save_client)
	{

        header("location: manage_clients.php");
        
	}
	else
	{

        header("location: manage_clients.php");
       
	}
}


?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $web_site_name; ?></title>
        <link href="vendors\bower_components\animate.css\animate.min.css" rel="stylesheet">
        <link href="vendors\bower_components\material-design-iconic-font\dist\css\material-design-iconic-font.min.css" rel="stylesheet">
        <link href="vendors\bower_components\malihu-custom-scrollbar-plugin\jquery.mCustomScrollbar.min.css" rel="stylesheet">
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


                <li class="top-menu__alerts" data-mae-action="block-open" data-mae-target="#notifications" data-toggle="tab" data-target="#notifications__messages">
                    <a href=""><i class="zmdi zmdi-notifications"></i></a>
                </li>
                <li class="top-menu__profile dropdown">
                    <a data-toggle="dropdown" href="">
                        <img src="<?php echo $profilePicture; ?>" alt="">
                    </a>

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
                        <li><a href="index.php"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="navigation__active">
                            <a href="manage_clients.php"><i class="zmdi zmdi-view-list"></i> Manage Clients</a>
                            <a href="manage_tokens.php"><i class="zmdi zmdi-view-list"></i> Manage Tokens</a></li>
                            <li><a href="manage_server.php"><i class="zmdi zmdi-view-list"></i> Server Settings</a></li>
                        </li>
                    </ul>
                </div>
            </aside>
        
            <section id="content">
                <div class="card">
                    <div class="card__header">
                        <h2>Edit Client <small>Edit selected clients database information.
                        </small></h2>
                    </div>

                    <div class="card__body">
                    <form class="" action="" method="POST" id="login">
                            <div class="form-group">
                            <label>Client CPUKey</label>
                                <input type="text" class="form-control" name="clientCPUKeyVal" value="<?php echo $client_cpuk?>">
                                <i class="form-group__bar"></i>
                            </div>
                            
                            <div class="form-group">
                            <label>Time Left</label>
                                <input type="text" class="form-control" name="reserveDaysVal" value="<?php echo $client_expire?>">
                                <i class="form-group__bar"></i>
                            </div>

                            <div class="form-group">
                            <label>Reserve Days</label>
                                <input type="text" class="form-control" name="alldaysVal" value="<?php echo $client_DaysLeft?>">
                                <i class="form-group__bar"></i>
                            </div>

                            <div class="form-group">
                            <label>NoKV ID</label>
                                <input type="text" class="form-control" name="nokvidVal" value="<?php echo $client_KvIndex?>">
                                <i class="form-group__bar"></i>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" <?php if($client_enabled == '1') { echo 'checked=""'; } else if ($client_enabled == '0') { } { } ?> name="enabledVal">
                                    Enabled?
                                    <i class="input-helper"></i>
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" <?php if($client_banned == '1') { echo 'checked=""'; } else if ($client_banned == '0') { } { } ?> name="bannedVal">
                                    Banned?
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                                                                                    
                            <br>
                            <button type="submit" class="btn btn-default"><i name="add"></i> Update Client</button>
                        </form>
                    </div>
                </div>
            </section>

            <footer id="footer">
                Copyright &copy; 2020 <?php echo $web_site_name; ?>

                <ul class="footer__menu">
                    <li><a href="">Edit Client</a></li>
                </ul>
            </footer>

        </section>

        <script src="vendors\bower_components\jquery\dist\jquery.min.js"></script>
        <script src="vendors\bower_components\bootstrap\dist\js\bootstrap.min.js"></script>
        <script src="vendors\bower_components\malihu-custom-scrollbar-plugin\jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="vendors\bower_components\remarkable-bootstrap-notify\dist\bootstrap-notify.min.js"></script>
        <script src="vendors\bower_components\autosize\dist\autosize.min.js"></script>
        <script src="demo\js\misc.js"></script>
        <script src="js\app.min.js"></script>
    </body>
</html>