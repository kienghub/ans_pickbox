<?php

date_default_timezone_set('Asia/Bangkok');
$sub_folder=false;

##################################
$db = 'ans_stock';
$user = '12345';
$passwd = '12345';
$host = 'localhost';
####################################
$tbl_company_member_user='member_user';
$tbl_company_member_position='member_position';
$tbl_company_member_permission='member_permission';
$tbl_company_timeline='company_timeline';
$tbl_company_document='company_document';
####################################
$connect= mysqli_connect($host, $user, $passwd, $db);
mysqli_query($connect, "SET NAMES UTF8");
#################################
	
	
$website_path='';
$website_url='ans_admin/';
$website_back_url='ans_admin/';

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

$db_main_web = 'ekkasith_ans_main_db';
$db_company_web ='ekkasith_ans_company_db';
?>