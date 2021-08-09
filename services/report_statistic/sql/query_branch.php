<?php
include '../../../connection.php';
$output = array();
$branch_id=$_GET['branch_id'];
$query  =mysqli_query($con,"SELECT*FROM office_branches WHERE id_branch='$branch_id'");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $output[] = $row;
    }
    echo json_encode($output);
}