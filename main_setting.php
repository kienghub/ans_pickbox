<?php

$in_app_agent=false;
if ((strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/') == false)) {
    $in_app_agent=true;
}
if($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.company.app") {
   $in_app_agent=true;
}


$scale='1';
if($in_app_agent){
	$scale='1';
}


$site_logo_url='<link rel="shortcut icon" href="ans_admin/images/ans_logo_new.jpg">';
$site_title='Anousith Express';
$site_tel='030 xxxx';

$site_viewport=' <meta name="viewport" content="width=device-width, initial-scale=' . $scale . ', shrink-to-fit=no">';

/*
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}*/


/*
$protocol = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
if (substr($_SERVER['HTTP_HOST'], 0, 4) !== 'www.') {
    header('Location: '.$protocol.'www.'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']);
    exit;
}
*/


/*
if ($_SERVER['HTTPS'] == "on") {
if(!isset($_GET['appid'])){
    $url = "http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
} 
*/

$same_day_img='images/same_day.png';
$next_day_img='images/next_day.png';


$pickup_price=5000;
$packageID_near_item=2;
$packageID_middle_item=3;
$packageID_middle_item_staff_key=4;
$packageID_far_item=14;


$android_app=false;
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
if(stripos($ua,'android') !== false) {
    if(stripos($ua,'build') !== false) { 
        $android_app=true;
    }
}


######### STATE ##############
$id_state=intval($_COOKIE['state_id']);

?>