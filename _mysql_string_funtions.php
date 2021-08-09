<?php 


function villageNameToPackagePriceNew($address){
global $tbl_ans_route_keyword;
global $connect;
global $tbl_sv_type;
global $tbl_ans_items;
global $packageID_near_item;
global $packageID_middle_item;
global $packageID_far_item;
	
// check address to update price
$packageID=$packageID_middle_item;
$addressResult=mysqli_query($connect, "SELECT farDistance,nearDistance,specialPriceID,specialPriceForStaff FROM $tbl_ans_route_keyword WHERE route_id IN (SELECT id_list FROM $tbl_sv_type) AND keyword='" . $address . "'");
$addressRows=mysqli_fetch_array($addressResult);
if($addressRows['farDistance'] == 1){
	$packageID=$packageID_far_item;
}
if($addressRows['nearDistance'] == 1){
	$packageID=$packageID_near_item;
}
if($addressRows['specialPriceID'] > 0){
	$packageID=$addressRows['specialPriceID'];
}

return $packageID;
}


function villageNameToPackagePrice($address){
global $tbl_ans_route_keyword;
global $connect;
global $tbl_sv_type;
global $tbl_ans_items;
	
// check address to update price
$packageID=11;
$addressResult=mysqli_query($connect, "SELECT farDistance,nearDistance,specialPriceID,specialPriceForStaff FROM $tbl_ans_route_keyword WHERE route_id IN (SELECT id_list FROM $tbl_sv_type) AND keyword='" . $address . "'");
$addressRows=mysqli_fetch_array($addressResult);
if($addressRows['farDistance'] == 1){
	$packageID=14;
}
if($addressRows['nearDistance'] == 1){
	$packageID=1;
}
if($addressRows['specialPriceID'] > 0){
	$packageID=$addressRows['specialPriceID'];
}

return $packageID;
}



function getIDCVMySQLSearchString($id_cv){
global $tbl_study_class_list_english;
global $tbl_profile_study_list_english;
global $tbl_resume_profile;
global $tbl_member_user;
global $tbl_resume_profile_info;
global $tbl_resume_profile_study;
global $tbl_resume_profile_work;
global $tbl_database_update_log;

$start_mysql=" WHERE r.id_cv LIKE '%" . $id_cv . "%'";


return "SELECT r.id_cv,r.img_small,r_p.first_name,r_p.last_name,r_p.mobile,r_p.email, m.email_confirm, m.id_user as user_id,r.time_added,d.updated_time as db_time,
					(SELECT title FROM $tbl_study_class_list_english WHERE id_list=r_s.degree) as user_degree,
					(SELECT title FROM $tbl_profile_study_list_english WHERE id_list=r_s.school_major) as user_major, 
					MAX(r_w.work_position), MAX(r_w.company_name), MAX(r_w.work_salary) as current_salary, 
					(SELECT title FROM $tbl_profile_study_list_english WHERE id_list=r_s.school_major) as user_major 
					FROM $tbl_resume_profile as r 
					LEFT JOIN $tbl_member_user as m ON (m.id_cv=r.id_cv) 
					LEFT JOIN $tbl_resume_profile_info as r_p ON (r_p.id_cv=r.id_cv) 
					LEFT JOIN $tbl_resume_profile_study as r_s ON (r_s.id_cv=r.id_cv) 
					LEFT JOIN $tbl_database_update_log AS d ON (d.type = CONCAT('user_update:', r.id_cv)) 
					LEFT JOIN $tbl_resume_profile_work as r_w ON (r_w.id_cv=r.id_cv)$start_mysql Group by r.id_cv Order by r.id_cv Desc LIMIT 20";
}

function validMySQL($var) {
$var=stripslashes($var);
$var=htmlentities($var);
$var=strip_tags($var);
return $var;
}

function getCVMySQLSearchString($limit, $offset, $start_from){
global $tbl_study_class_list_english;
global $tbl_profile_study_list_english;
global $tbl_resume_profile;
global $tbl_member_user;
global $tbl_resume_profile_info;
global $tbl_resume_profile_study;
global $tbl_resume_profile_work;
global $tbl_database_update_log;

$start_mysql='';
if($start_from > 0){
$start_mysql=' WHERE r.id_cv <= ' . $start_from;
}

return "SELECT r.cv_link, r.id_cv,r.img_small,r_p.first_name,r_p.last_name,r_p.mobile,r_p.email, m.email_confirm, m.id_user as user_id,r.time_added,d.updated_time as db_time,
					(SELECT title FROM $tbl_study_class_list_english WHERE id_list=r_s.degree) as user_degree,
					(SELECT title FROM $tbl_profile_study_list_english WHERE id_list=r_s.school_major) as user_major, 
					r_w.work_position, r_w.company_name, MAX(r_w.work_salary) as current_salary, 
					(SELECT title FROM $tbl_profile_study_list_english WHERE id_list=r_s.school_major) as user_major 
					FROM $tbl_resume_profile as r 
					LEFT JOIN $tbl_member_user as m ON (m.id_cv=r.id_cv) 
					LEFT JOIN $tbl_resume_profile_info as r_p ON (r_p.id_cv=r.id_cv) 
					LEFT JOIN $tbl_resume_profile_study as r_s ON (r_s.id_cv=r.id_cv) 
					LEFT JOIN $tbl_database_update_log AS d ON (d.type = CONCAT('user_update:', r.id_cv)) 
					LEFT JOIN $tbl_resume_profile_work as r_w ON (r_w.id_cv=r.id_cv)$start_mysql Group by r.id_cv Order by r.id_cv Desc LIMIT " . intval($limit) . " OFFSET " . intval($offset);
}

function getUSERMySQLSearchString($limit, $offset, $start_from){
global $tbl_study_class_list_english;
global $tbl_profile_study_list_english;
global $tbl_resume_profile;
global $tbl_member_user;
global $tbl_resume_profile_info;
global $tbl_resume_profile_study;
global $tbl_resume_profile_work;
global $tbl_database_update_log;
global $tbl_member_user_browser_log;

$start_mysql='';
if($start_from > 0){
$start_mysql=' WHERE r.id_cv <= ' . $start_from;
}


return "SELECT * FROM $tbl_member_user as m LEFT JOIN $tbl_member_user_browser_log as log ON (log.id_user=m.id_user) WHERE m.id_cv=0 Order by m.id_user Desc";
}
?>