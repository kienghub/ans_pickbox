<?php

##########################
# COOKIE FUNCTION
##########################
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
setcookie("id",$_GET['id'],time()+ (10 * 365 * 24 * 60 * 60));
setcookie("work_session",$_GET['work_session'],time()+ (10 * 365 * 24 * 60 * 60));
setcookie("branch_id",$_GET['branch_id'],time()+ (10 * 365 * 24 * 60 * 60));

function position_title($id_position){
global $tbl_company_member_position;
global $connect;

$result=mysqli_query($connect,  "SELECT title FROM $tbl_company_member_position WHERE id_list=$id_position");
$rows=mysqli_fetch_array($result);

return $rows['title'];
}

function checkUserPermEdit($id_user, $perm){
global $tbl_company_member_permission;
global $connect;
$result=mysqli_query($connect,  "SELECT page FROM $tbl_company_member_permission WHERE id_user=$id_user");
while($rows=mysqli_fetch_array($result)){
	if($rows['page'] == $perm){
		return true;
	}
}

return false;
}

function getMemberUserPerm($id_user){
global $tbl_company_member_permission;
global $connect;

$position_array=Array('0');
$result=mysqli_query($connect,  "SELECT page FROM $tbl_company_member_permission WHERE id_user=$id_user");
while($rows=mysqli_fetch_array($result)){
	array_push($position_array, trim($rows['page']));
}

return $position_array;
}

function getMemberUserInfoAdmin($id_user){
global $tbl_company_member_user;
global $connect;
global $db_main_web;
global $db_company_web;

$result=mysqli_query($connect,  "SELECT *,s.position_id as pst_id,m.cv_id as id_cv FROM $db_company_web.$tbl_company_member_user as m LEFT JOIN $db_company_web.office_branches as o ON (o.id_branch=m.branch_id) 
LEFT JOIN $db_main_web.ans_payroll_salary_base as s ON (s.id_staff=m.id_user) WHERE m.id_user=$id_user");
$rows=mysqli_fetch_array($result);

return $rows;
}

function setCookieToUser($user_id){
// Setcookie by encode
global $tbl_company_member_user;
global $connect;

$password=null;
$result = mysqli_query($connect,  "SELECT password FROM $tbl_company_member_user WHERE id_user=" . intval($user_id) . " LIMIT 1");
$rows=mysqli_fetch_array($result);
if(mysqli_num_rows($result) > 0){
$password = $rows['password'];
}

$cookie_rand = base64_encode(md5(base64_encode(md5(sha1(base64_encode(md5($password)))))));

setcookie("id",$user_id,time()+ (10 * 365 * 24 * 60 * 60)); // Expire 1 Hour
setcookie("work_session",$cookie_rand, time()+ (10 * 365 * 24 * 60 * 60)); // Expire 1 Hour
return $cookie_rand;
}

function setCookieToProfileShop($user_id){
// Setcookie by encode
global $tbl_profile_info;
global $connect;

$password=null;
$result = mysqli_query($connect,  "SELECT password FROM $tbl_profile_info WHERE id_list=" . intval($user_id) . " LIMIT 1");
$rows=mysqli_fetch_array($result);
if(mysqli_num_rows($result) > 0){
$password = $rows['password'];
}

$cookie_rand = base64_encode(md5(base64_encode(md5(sha1(base64_encode(md5($password)))))));

setcookie("id_profile",$user_id,time()+ (10 * 365 * 24 * 60 * 60)); // Expire 1 Hour
setcookie("shop_session",$cookie_rand, time()+ 28800 + 3600); // Expire 1 Hour
return $cookie_rand;
}

function checkCookie($user_id, $session){
// Check Cookie by session
global $tbl_company_member_user;
global $connect;

$password=null;
$result = mysqli_query($connect,  "SELECT password FROM $tbl_company_member_user WHERE id_user=" . intval($user_id) . " LIMIT 1");
$rows=mysqli_fetch_array($result);
if(mysqli_num_rows($result) > 0){
$password = $rows['password'];
}

if($password==null){
return false;
}

$cookie_rand = base64_encode(md5(base64_encode(md5(sha1(base64_encode(md5($password)))))));

if($cookie_rand == $session){
return true;
}
return false;
}

$log_in_user=false;
if(checkCookie(intval($_COOKIE['id']), $_COOKIE['work_session'])){
	$log_in_user=true;
}

$session_login=false;
if(isset($_COOKIE['id']) AND strlen($_COOKIE['id']) > 0 AND strlen($_COOKIE['work_session']) == 0){
	$session_login=true;
}

?>