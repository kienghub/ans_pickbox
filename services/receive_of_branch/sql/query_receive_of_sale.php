<?php
include '../../../connection.php';
$output = array();
echo $st_date=$_GET['st_date'];
echo $end_date=$_GET['end_date'];
echo $curdate=$_today;
if($_GET['st_date']=="" | $_GET['end_date']==""){
    $params="AND rec_date BETWEEN '$subDate' AND '$curdate'";
}else{
    $params="AND rec_date BETWEEN '$st_date' AND '$end_date'";
}
$query  =mysqli_query($con,"SELECT*FROM ans_receive_of_sale 
LEFT JOIN ans_production_of_sale on ans_receive_of_sale.pro_id=ans_production_of_sale.pro_id WHERE ans_receive_of_sale.branch_id='$_state_branch' $params ORDER BY _id DESC");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
mysqli_close($con);
?>