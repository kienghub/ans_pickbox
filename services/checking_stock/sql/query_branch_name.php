<?php
include '../../../connection.php';
$output = array();
$id=$_GET['id'];
$query  =mysqli_query($con,"SELECT  branch_name FROM office_branches WHERE id_branch='$id'");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
mysqli_close($con);
?>