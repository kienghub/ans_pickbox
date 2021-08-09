<?php
include('../../../connection.php');
@$st_date=$_GET['st_date'];
@$end_date=$_GET['end_date'];
$curdate=$_today;
if($_GET['st_date']=="" | $_GET['end_date']==""){
    $params="AND rec_date BETWEEN '$subDate' AND '$curdate'";
}else{
    $params="AND rec_date BETWEEN '$st_date' AND '$end_date'";
}
$call_date_for_sum=$_sql($con,"SELECT sum(rec_qty) AS total,sum(rec_qty*rec_bprice)AS pv, sum(rec_qty*rec_sprice)AS fv FROM ans_receive_of_sale WHERE  branch_id='$_state_branch' $params");
$res=$_assoc($call_date_for_sum);
echo $res['total'];
echo ",";
echo $res['fv'];
mysqli_close($con);
?>