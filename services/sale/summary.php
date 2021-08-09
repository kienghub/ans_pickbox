<?php
include('../../../connection.php');
@$st_date=$_GET['st_date'];
@$end_date=$_GET['end_date'];
$curdate=$_today;
if($_GET['st_date']=="" | $_GET['end_date']==""){
    $params="AND pay_date BETWEEN '$subDate' AND '$curdate'";
}else{
    $params="AND pay_date BETWEEN '$st_date' AND '$end_date'";
}
$call_date_for_sum=$_sql($con,"SELECT sum(pay_qty) AS total  FROM ans_paylist WHERE  branch_id='$_state_branch' $params");
$res=$_assoc($call_date_for_sum);
echo $res['total'];
mysqli_close($con);
?>