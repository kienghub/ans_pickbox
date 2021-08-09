<?php
include '../../../connection.php';
$output = array();
$query  =mysqli_query($con,"SELECT * FROM ans_category_of_sale ORDER BY cate_id DESC");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
mysqli_close($con);
?>