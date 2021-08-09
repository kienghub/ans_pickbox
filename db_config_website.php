<?php

date_default_timezone_set('Asia/Bangkok');
$sub_folder=false;

##################################
$db = 'ekkasith_ans_main_db';
$db_company='ekkasith_ans_company_db';
$user = 'root';
$passwd = '12345';
$host = 'localhost';
####################################
$tbl_job_specialization_la='job_specialization_lao';
$tbl_job_specialization_en='job_specialization';

$tbl_resume_profile='resume_profile';
$tbl_resume_profile_info='resume_profile_info';
$tbl_resume_profile_address='resume_profile_address';
$tbl_resume_profile_study='resume_profile_study';
$tbl_resume_profile_languages='resume_profile_languages';
$tbl_resume_profile_work='resume_profile_work';
$tbl_resume_profile_recruitment='resume_profile_recruitment';
$tbl_resume_profile_recruitment_log='resume_profile_recruitment_log';
$tbl_company_recruitment='company_recruitment';
$tbl_company_recruitment_log='company_recruitment_log';
$tbl_company_recruitment_permission='company_recruitment_permission';
$tbl_resume_profile_interview_tracking='resume_profile_interview_tracking';
$tbl_institution_information='institution_information';

$tbl_resume_profile_request_list='resume_profile_request_list';

$tbl_admin_users='admin_user';
$tbl_profile_work_list='profile_work_list';
$tbl_company_support_list='company_support_list';
$tbl_salary_list='salary_list';
$tbl_languages_list='languages_list';
$tbl_work_location_list='work_location_list';
$tbl_job_list='job_exp_list';
$tbl_job_position='job_position';
$tbl_job_posted='job_posted';
$tbl_our_partner='our_partner';
$tbl_our_partner_es='our_partner_es';
$tbl_link_out_counter='link_out_counter';
$tbl_company_snapshot='company_snapshot';
$tbl_company_information='company_information';
$tbl_company_industry='company_industry';
$tbl_job_specialization='job_specialization';
$tbl_member_user='member_user';
$tbl_position_level='position_level';
$tbl_nationality_list='nationality_list';
$tbl_member_user_email_confirm_log='member_user_email_confirm_log';
$tbl_job_posted_applied='job_posted_applied';

$tbl_member_user_browser_log='member_user_browser_log';

$tbl_member_user_employer='member_user_employer';
$tbl_member_user_employer_file_upload='member_user_employer_file_upload';
$tbl_member_user_employer_job_posted='member_user_employer_job_posted';
$tbl_member_user_employer_link_posted='member_user_employer_link_posted';
$tbl_member_user_employer_profile_view='member_user_employer_profile_view';
$tbl_database_update_log='database_update_log';
$tbl_user_notification='user_notification';

$tbl_recruitment_tracking_log='recruitment_tracking_log';
$tbl_ans_shipper_work_status='ans_shipper_work_status';
####################################
//$connect = mysql_connect($host, $user, $passwd);
$connect = mysqli_connect($host, $user, $passwd, $db);
//mysql_select_db($db,$connect);
mysqli_query($connect, "SET NAMES UTF8");
#################################

$tbl_study_class_list_lao='study_class_list_lao';
$tbl_profile_study_list_lao='study_major_list_lao';
$tbl_district_list_lao='district_list_lao';
$tbl_state_list_lao='state_list_lao';
$tbl_relationship_list_lao='relationship_list_lao';

$tbl_study_class_list_english='study_class_list_english';
$tbl_profile_study_list_english='study_major_list_english';
$tbl_district_list_english='district_list_english';
$tbl_state_list_english='state_list_english';
$tbl_relationship_list_english='relationship_list_english';


$images_dir_url='http://localhost/tor/';

####################### NEW DATABSE ########################3
$tbl_profile_info='profile_info';
$tbl_project_info='project_info';
$tbl_project_content='project_content';
$tbl_sv_type='sv_type';
$tbl_product_trading='product_trading';
$tbl_trade_customer='trade_customer';
$tbl_shop_info='shop_info';
$tbl_currency_list='currency_update';

$tbl_ans_items='ans_items';
$tbl_ans_shipper='ans_shipper';
$tbl_ans_consolidatelist='ans_consolidatelist';
$tbl_ans_consolidateitems='ans_consolidateitems';
$tbl_ans_item_sent_history='ans_item_sent_history';
$tbl_ans_item_receive_history='ans_item_receive_history';
$tbl_ans_price_data='ans_price_data';
$tbl_ans_call_pickup='ans_call_pickup';
$tbl_ans_call_pickup_express='ans_call_pickup_express';
$tbl_ans_transfer_item='ans_transfer_item';
$tbl_ans_charge_balance='ans_charge_balance';
$tbl_ans_item_update_history='ans_item_update_history';
$tbl_ans_shipper_route_order_number='ans_shipper_route_order_number';
$tbl_ans_route_keyword='ans_route_keyword';
$tbl_ans_route_automatic_settings='ans_route_automatic_settings';
$tbl_ans_shop_item='ans_shop_item';
$tbl_ans_shop_category='ans_shop_category';
$tbl_ans_payroll_cutoff='ans_payroll_cutoff';
$tbl_ans_cod_desopit='ans_cod_desopit';
$tbl_ans_cod_balance_check='ans_cod_balance_check';
$tbl_ans_shop_item_view='ans_shop_item_view';
$tbl_ans_cod_desopit_easy_speed='ans_cod_desopit_easy_speed';
$tbl_ans_shipper_performance='ans_shipper_performance';
$tbl_ans_promotion_coupon='ans_promotion_coupon';
$tbl_ans_easy_speed_food_menu_category='ans_easy_speed_food_menu_category';
$tbl_ans_easy_speed_food_menu_item='ans_easy_speed_food_menu_item';
$tbl_ans_easy_speed_food_restaurant='ans_easy_speed_food_restaurant';
$tbl_ans_route_keyword_easy_speed='ans_route_keyword_easy_speed';
$tbl_ans_items_photos='ans_items_photos';
$tbl_ans_route_group='ans_route_group';
$tbl_ans_shipper_route_setting='ans_shipper_route_setting';
$tbl_ans_route_group_auto_set='ans_route_group_auto_set';
$tbl_ans_item_sent_signature='ans_item_sent_signature';
$tbl_ans_easy_speed_food_menucartitem='ans_easy_speed_food_menucartitem';
$tbl_ans_item_barcode='ans_item_barcode';
$tbl_ans_shipper_performance_log='ans_shipper_performance_log';
$tbl_ans_easy_speed_food_consolidatelist='ans_easy_speed_food_consolidatelist';
$tbl_ans_easy_speed_food_menu_consolidate='ans_easy_speed_food_menu_consolidate';
$tbl_ans_promotion_stamp='ans_promotion_stamp';
$tbl_ans_route_keyword_map='ans_route_keyword_map';
$tbl_ans_shipper_realtime_latlng='ans_shipper_realtime_latlng';
$tbl_ans_items_route_printed='ans_items_route_printed';
$tbl_ans_easy_speed_food_type='ans_easy_speed_food_type';
$tbl_ans_items_identity='ans_items_identity';
$tbl_ans_items_discount='ans_items_discount';
$tbl_ans_easy_speed_food_menu_recommend='ans_easy_speed_food_menu_recommend';
$tbl_ans_easy_speed_food_delivery_duration='ans_easy_speed_food_delivery_duration';
$tbl_ans_easy_speed_food_menu_item_submenu='ans_easy_speed_food_menu_item_submenu';
$tbl_ans_easy_speed_app_id='ans_easy_speed_app_id';
$tbl_ans_easy_speed_map_distance_history='ans_easy_speed_map_distance_history';
$tbl_ans_cod_desopit_easy_speed_balance='ans_cod_desopit_easy_speed_balance';
$tbl_ans_easy_speed_food_restaurant_branch='ans_easy_speed_food_restaurant_branch';
$tbl_ans_easy_speed_food_restaurant_switch_off='ans_easy_speed_food_restaurant_switch_off';
$tbl_ans_items_img='ans_items_img';
$tbl_ans_call_pickup_express_notification='ans_call_pickup_express_notification';
$tbl_ans_easy_speed_food_restaurant_commission_history='ans_easy_speed_food_restaurant_commission_history';
$tbl_ans_easy_speed_food_restaurant_bill_item_list='ans_easy_speed_food_restaurant_bill_item_list';
$tbl_ans_easy_speed_food_restaurant_bill_summary='ans_easy_speed_food_restaurant_bill_summary';
$tbl_ans_easy_speed_food_restaurant_order_history='ans_easy_speed_food_restaurant_order_history';
$tbl_ans_easy_speed_shipper_salary_record='ans_easy_speed_shipper_salary_record';
$es_shipper_salary_per_km=2000;
$es_shipper_salary_min=10000;
$es_shipper_salary_km_min=8;
$tbl_ans_payroll_salary_base='ans_payroll_salary_base';
$tbl_ans_payroll_salary_summary='ans_payroll_salary_summary';
$tbl_ans_payroll_staff_position='ans_payroll_staff_position';
$tbl_ans_easy_speed_bill_transfer='ans_easy_speed_bill_transfer';
$tbl_ans_easy_speed_cod_summary='ans_easy_speed_cod_summary';
$tbl_ans_easy_speed_sending_show='ans_easy_speed_sending_show';
$tbl_ans_easy_speed_order_accept_log='ans_easy_speed_order_accept_log';
$tbl_ans_easy_speed_item_auto_set='ans_easy_speed_item_auto_set';
$tbl_ans_easy_speed_shipper_review='ans_easy_speed_shipper_review';
$tbl_ans_payroll_summary_check='ans_payroll_summary_check';
$tbl_ans_call_pickup_express_transfer_bill='ans_call_pickup_express_transfer_bill';
$tbl_ans_call_pickup_item_list='ans_call_pickup_item_list';
$tbl_ans_payroll_staff_position_level='ans_payroll_staff_position_level';
$tbl_ans_cod_summary='ans_cod_summary';
$tbl_ans_cod_other_transfer='ans_cod_other_transfer';
$tbl_ans_item_shipper_sent='ans_item_shipper_sent';
$tbl_ans_call_pickup_express_buything_map='ans_call_pickup_express_buything_map';
$tbl_ans_easy_speed_shop_restaurant='ans_easy_speed_shop_restaurant';
$tbl_ans_easy_speed_shop_menu_category='ans_easy_speed_shop_menu_category';
$tbl_ans_easy_speed_shop_menu_item='ans_easy_speed_shop_menu_item';
$tbl_ans_easy_speed_shop_restaurant='ans_easy_speed_shop_restaurant';
$tbl_ans_easy_speed_shop_menucartitem='ans_easy_speed_shop_menucartitem';
$tbl_ans_easy_speed_shop_consolidatelist='ans_easy_speed_shop_consolidatelist';
$tbl_ans_easy_speed_shop_menu_consolidate='ans_easy_speed_shop_menu_consolidate';
$tbl_ans_easy_speed_shop_type='ans_easy_speed_shop_type';
$tbl_ans_easy_speed_shop_menu_recommend='ans_easy_speed_shop_menu_recommend';
$tbl_ans_easy_speed_shop_delivery_duration='ans_easy_speed_shop_delivery_duration';
$tbl_ans_easy_speed_shop_menu_item_submenu='ans_easy_speed_shop_menu_item_submenu';
$tbl_ans_easy_speed_shop_restaurant_branch='ans_easy_speed_shop_restaurant_branch';
$tbl_ans_easy_speed_shop_restaurant_switch_off='ans_easy_speed_shop_restaurant_switch_off';
$tbl_ans_easy_speed_shop_restaurant_commission_history='ans_easy_speed_shop_restaurant_commission_history';
$tbl_ans_easy_speed_shop_restaurant_bill_item_list='ans_easy_speed_shop_restaurant_bill_item_list';
$tbl_ans_easy_speed_shop_restaurant_bill_summary='ans_easy_speed_shop_restaurant_bill_summary';
$tbl_ans_easy_speed_shop_restaurant_order_history='ans_easy_speed_shop_restaurant_order_history';
$tbl_ans_easy_speed_shop_restaurant_promotion='ans_easy_speed_shop_restaurant_promotion';
$tbl_ans_call_pickup_express_food='ans_call_pickup_express_food';

################################################################################
$tbl_ans_asset_management_type='ans_asset_management_type';
$tbl_ans_asset_management_sub_type='ans_asset_management_sub_type';
$tbl_ans_asset_management_current_asset='ans_asset_management_current_asset';
$tbl_ans_asset_management_transaction_log='ans_asset_management_transaction_log';
$tbl_ans_asset_management_summary='ans_asset_management_summary';
$tbl_ans_asset_management_summary_asset_list='ans_asset_management_summary_asset_list';

$tbl_ans_easy_speed_shipper_express_salary='ans_easy_speed_shipper_express_salary';

$tbl_ans_easy_speed_food_zone_map='ans_easy_speed_food_zone_map';
$tbl_ans_easy_speed_food_zone_village='ans_easy_speed_food_zone_village';
$tbl_ans_easy_speed_food_shipper_current_zone='ans_easy_speed_food_shipper_current_zone';


$tbl_ans_easy_speed_app_food_restaurant_arrangement='ans_easy_speed_app_food_restaurant_arrangement';
$tbl_ans_easy_speed_app_food_restaurant_arrangement_order='ans_easy_speed_app_food_restaurant_arrangement_order';
$tbl_ans_easy_speed_app_food_customer_location='ans_easy_speed_app_food_customer_location';


$tbl_ans_payroll_leave_log='ans_payroll_leave_log';

$tbl_ans_shipper_route_record='ans_shipper_route_record';

$tbl_ans_items_transfer_log='ans_items_transfer_log';
$tbl_ans_easy_speed_cod_consolidateslist='ans_easy_speed_cod_consolidateslist';
$tbl_ans_easy_speed_cod_consolidates_item='ans_easy_speed_cod_consolidates_item';
$tbl_ans_notification='ans_notification';

$tbl_ans_cod_summary_transfer_history='ans_cod_summary_transfer_history';

$tbl_ans_items_customer_pickup='ans_items_customer_pickup';
$tbl_ans_payroll_salary_shipper_order_summary='ans_payroll_salary_shipper_order_summary';
$tbl_ans_items_customer_summary_month='ans_items_customer_summary_month';
$tbl_ans_customer_feedback='ans_customer_feedback';
$tbl_ans_accounting_pay='ans_accounting_pay';
$tbl_ans_accounting_pay_sub='ans_accounting_pay_sub';

$tbl_ans_consolidatelist_group_summary='ans_consolidatelist_group_summary';
$tbl_ans_consolidatelist_group_bill_list='ans_consolidatelist_group_bill_list';
$tbl_ans_cod_balance_log='ans_cod_balance_log';
$tbl_ans_accounting_extra_expense='ans_accounting_extra_expense';
$tbl_ans_payroll_work_time_sheet='ans_payroll_work_time_sheet';
$tbl_ans_accounting_receive='ans_accounting_receive';
$tbl_ans_accounting_receive_sub='ans_accounting_receive_sub';
$tbl_office_state_branches='office_state_branches';
$tbl_ans_cod_transfer_file_upload='ans_cod_transfer_file_upload';
$tbl_ans_cod_easy_speed_balance_log='ans_cod_easy_speed_balance_log';

$tbl_ans_b2c_profile_info='ans_b2c_profile_info';
$tbl_ans_b2c_order_summary='ans_b2c_order_summary';
$tbl_ans_b2c_order_list_summary='ans_b2c_order_list_summary';

$currency_global='THB';
$last_char_global='<sub style="font-size: 12px">g</sub>';

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
##################################################################################
## ANOUSITH EXPRESS - NEXT DAY SERVICES

# weight || width at tbl_ans_price_data
$tbl_ans_item_next_day='ans_item_next_day';
$tbl_ans_item_next_day_status='ans_item_next_day_status';
$tbl_ans_next_day_district_list='ans_next_day_district_list';
$tbl_ans_call_pickup_next_day='ans_call_pickup_next_day';
$tbl_ans_cod_desopit_next_day='ans_cod_desopit_next_day';
$tbl_ans_cod_balance_log_next_day='ans_cod_balance_log_next_day';
$tbl_ans_call_pickup_item_list_next_day='ans_call_pickup_item_list_next_day';
$tbl_ans_accounting_extra_expense_next_day='ans_accounting_extra_expense_next_day';

$tbl_ans_cod_next_day_register='ans_cod_next_day_register';
$tbl_ans_cod_balance_log_easy_speed='ans_cod_balance_log_easy_speed';
$tbl_ans_call_pickup_prepaid='ans_call_pickup_prepaid';
################################################################################

$tbl_ans_real_time_auto_set_item='ans_real_time_auto_set_item';
$tbl_ans_items_next_day_pickup_detail='ans_items_next_day_pickup_detail';
$tbl_ans_items_route_id='ans_items_route_id';
$tbl_office_branches_photo='office_branches_photo';
$tbl_ans_items_customer_pickup_contact='ans_items_customer_pickup_contact';
$tbl_ans_items_count_cache='ans_items_count_cache';
$tbl_ans_village_name_by_state='ans_village_name_by_state';
$tbl_ans_district_name_by_state='ans_district_name_by_state';
$tbl_ans_village_name_by_district='ans_village_name_by_district';
$tbl_ans_destination_branch_record='ans_destination_branch_record';
$tbl_ans_items_one_pay='ans_items_one_pay';
$tbl_ans_items_remove_request='ans_items_remove_request';
$tbl_ans_cod_ibank_statement_record='ans_cod_ibank_statement_record';
$tbl_ans_items_next_day_deliver_log='ans_items_next_day_deliver_log';
$tbl_ans_items_next_day_deliver_log_summary='ans_items_next_day_deliver_log_summary';
?>