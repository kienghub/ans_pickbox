<?php
include '../../../connection.php';
$output = array();
$query  =mysqli_query($con,"SELECT*FROM ans_pricing LEFT JOIN ans_production_of_sale ON ans_pricing.pro_id=ans_production_of_sale.pro_id ORDER BY _id DESC");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
mysqli_close($con);
?>