<?php
include '../../../connection.php';
$output = array();
$cate_id=$_GET['cate_id'];
$query  =mysqli_query($con,"SELECT*FROM ans_production_of_sale WHERE cate_id='$cate_id' ORDER BY pro_id DESC");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
mysqli_close($con);
?>