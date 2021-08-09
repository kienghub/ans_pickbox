<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@session_start();

// $host_name='localhost';
// $user_name= 'ekkasith_admin';
// $password= '4^Acu5A1Gp^x';
// $db_name= 'ekkasith_ans_main_db';

$con = mysqli_connect('localhost','root', '', 'pickbox');
// $main_db = mysqli_connect('localhost','root', '', 'ans_main_db');

// @$remoteDB = mysqli_connect('45.91.135.193','ekkasith_webdev', '%{Z)!04&Sxjl', 'ekkasith_ans_company_db');

@mysqli_query($remote_db, "SET NAMES UTF8");
@mysqli_query($con, "SET NAMES UTF8");

$db_main_web = 'ekkasith_ans_main_db';
$db_company_web ='ekkasith_ans_company_db';
$db_stock ='ans_stock_db';

@$_user_id=$_SESSION['id'];
@$_state_branch=$_SESSION['branch_id'];

// QUICK FUNCTION
date_default_timezone_set("Asia/Bangkok");
@$_timestamp = date("Y-m-d H:i:s");
@$_todayformatAT = date("Y-M-d-D");
@$_time = date("H:i");
@$_gen_id = date("ymddh");
@$_today = date("Y-m-d");

$date = DateTime::createFromFormat('Y-m-d',$_today);
$date->modify('-7 days');
$subDate= $date->format('Y-m-d'); //2010-04-13

@$_year = date("Y");
@$_year_ = date("Y")+1;
@$_month = date("m");
@$_week_day=date('D');
@$_auto_gen_id =rand(100,1000);
@$_model_number=($_gen_id.$_auto_gen_id);
@$_auto_id = md5($_timestamp.$_auto_gen_id);
@$_day = date("d");

@$_CODE = md5($_timestamp.$_auto_gen_id);
@$_setString = "mysqli_real_escape_string";
@$_sql = "mysqli_query";
@$_array = "mysqli_fetch_array";
@$_assoc = "mysqli_fetch_assoc";
@$_count = "mysqli_num_rows";

$call_branch_data=$_sql($con,"SELECT*FROM office_branches WHERE id_branch='$_state_branch'");
$result=$_assoc($call_branch_data);
$_provinceID=$result['provinceID'];
// CHECK PERMISSION FOR USERS
$_position_for_check_permission=$_sql($con,"SELECT*FROM member_user WHERE id_user='$_user_id'");
$_permission=$_assoc($_position_for_check_permission);

$permission=$_permission['position'];
$permission_id=$_permission['id_user'];
$profile=$_permission['profile_picture'];

@$_user_fname=$_permission['first_name'];
@$_user_lname=$_permission['last_name'];
@$_phone_number=$_permission['phone_number'];
?>