<?php 
include_once('../../../connection.php');
$array=array();
$call_product_details =$_sql($con,"SELECT * FROM ans_production_of_sale WHERE pro_id ='".$_GET['pro_id']."'");
$result=$_assoc($call_product_details);

$call_data_from_local=mysqli_query($con,"SELECT * FROM ans_pricing LEFT JOIN ans_production_of_sale on ans_production_of_sale.pro_id=ans_pricing.pro_id  WHERE  ans_pricing.createdAt=(select max(createdAt)from ans_pricing where pro_id ='".$_GET['pro_id']."') limit 1");
$res=$_assoc($call_data_from_local);
echo $res['price_item'];
echo ";";
echo json_encode($array[]=$result);
?>