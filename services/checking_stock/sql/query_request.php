<?php
include '../../../connection.php';
$output = array();
$id=$_GET['id'];
$query  =mysqli_query($con,"SELECT*FROM ans_requirements
    LEFT JOIN ans_production_of_sale
    ON ans_requirements.pro_id = ans_production_of_sale.pro_id
    WHERE req_status='REQUESTING' AND ans_requirements.branch_id='$id' ORDER BY ans_requirements._id DESC");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
mysqli_close($con);
?>