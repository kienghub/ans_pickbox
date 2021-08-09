<?php 
$_query_statistic_for_sam_day=$_sql($main_db,"SELECT
	ans_item_next_day.*, 
	ans_items.itemName, 
	ans_items.packageID, 
	ans_items.original_branch_id, 
	ans_items.branch_id, 
	ans_items.consolidate_id, 
	ans_items.id_profile,
	ans_items.receiveDate,
	ans_items.trackingNumber
     
FROM ans_item_next_day 
LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_item_next_day.status_id=3");
?>

<?php 
$_query_statistic_sended=$_sql($main_db,"SELECT
	ans_item_next_day.*, 
	ans_items.itemName, 
	ans_items.packageID, 
	ans_items.original_branch_id, 
	ans_items.branch_id, 
	ans_items.consolidate_id, 
	ans_items.id_profile,
     ans_items.sendingDate,
	ans_items.sendDate,
     ans_items.receiverName,
     ans_items.receiverPhone,
     ans_items.receiverAddress,
	ans_items.trackingNumber
     
FROM ans_item_next_day 
LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_item_next_day.status_id=5");
?>