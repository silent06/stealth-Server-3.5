<?php
$NiceTry= "Nice Try";

function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";
    $AUTHD = 1;
    if (preg_match('/linux/i', $u_agent)) {
        $AUTHD = 0;
        $platform = 'linux';
       
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $AUTHD = 0;
        $platform = 'mac';
        
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        
        $AUTHD = 0;
        $platform = 'windows';
    }
   
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $AUTHD = 0;
        $bname = 'Internet Explorer';
        $ub = "MSIE";
       
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $AUTHD = 0;
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $AUTHD = 0;
        $bname = 'Google Chrome';
        $ub = "Chrome";
        $AUTHD = 0;
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $AUTHD = 0;
        $bname = 'Apple Safari';
        $ub = "Safari";
        $AUTHD = 0;
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $AUTHD = 0;
        $bname = 'Opera';
        $ub = "Opera";
        $AUTHD = 0;
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $AUTHD = 0;
        $bname = 'Netscape';
        $ub = "Netscape";
       
    }
   
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'platform'  => $platform,
        'AUTHD'  => $AUTHD
    );
}
$ua=getBrowser();
$yourbrowser= "Your browser: " . $ua['name'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
$Authedyes= " " . $ua['AUTHD'] . " ";
if ($Authedyes == 1)
{
    Sleep(1);
    $homepage = file_get_contents("http://root.silent.hosted.nfoservers.com/assets/xdk/exl-GamesMarketplace.xml"); 
    echo $homepage; 
}
else {
//print_r($yourbrowser);
//echo $Authedyes;
echo "Browser isnt supported";
}

?>