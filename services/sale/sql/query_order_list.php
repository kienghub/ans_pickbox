<?php
include '../../../connection.php';
$data=array();

$callBillNo=$_sql($con,"SELECT bill_no FROM ans_bills where bill_id=(select max(bill_id)from ans_bills)");
$bill=$_assoc($callBillNo);

$call_orderList=$_sql($con,"SELECT
          ans_sale.*, 
          ans_production_of_sale.pro_id,
          ans_production_of_sale.pro_title,
          ans_production_of_sale.pro_size
     FROM
     ans_sale LEFT JOIN ans_production_of_sale
     ON ans_sale.pro_id = ans_production_of_sale.pro_id WHERE ans_sale.branch_id='$_state_branch' AND s_status=1 AND bill_no='".$bill['bill_no']."'");
foreach ($call_orderList as $key) {
    $data[]=$key;
}
echo json_encode($data);
echo ";";

$countOrderList=$_sql($con,"SELECT sum(sprice*s_qty)as total FROM ans_sale  WHERE branch_id='$_state_branch' AND s_status=1 AND bill_no='".$bill['bill_no']."'");
$result=$_assoc($countOrderList);
echo $result['total'];

?>