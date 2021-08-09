<?php
include '../../connection.php';
if($permission==1 || $permission==4 && $permission_id!=501){
$_newData=$_sql($con,"SELECT count(*)as total FROM ans_requirements WHERE req_status='REQUESTING' GROUP BY branch_id");
$length=mysqli_fetch_assoc($_newData);
echo $length['total'];
// echo ",";
// $callSummarySaleQty=$_sql($con,"SELECT count(*) AS total FROM ans_sale where s_status=2");
// $sale_qty=$_assoc($callSummarySaleQty);
// echo $sale_qty['total'];

}else if($permission==2 && $permission_id==570 || $permission==2 && $permission_id==104||$permission==2 && $permission_id==382||$permission==4 && $permission_id==501){
$_newData=$_sql($con,"SELECT count(*)as total FROM ans_requirements WHERE req_status='REQUESTING' GROUP BY branch_id");
$length=mysqli_fetch_assoc($_newData);
echo $length['total'];

}else{

  $callLength=$_sql($con,"SELECT count(*) total FROM ans_requirements WHERE req_status='APPROVED' AND branch_id='$_state_branch'");  
$length=mysqli_fetch_assoc($callLength);
echo $length['total'];   

}
mysqli_close($con);
?>