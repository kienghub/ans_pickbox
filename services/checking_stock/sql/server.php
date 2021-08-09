<?php
include '../../../connection.php';
if($_GET['request']=="approved"){
     $query = "UPDATE ans_sale SET s_status=0 WHERE s_status=2 AND branch_id='$_GET[branch_id]'";
        if (mysqli_query($con, $query)) {
                echo 200;
        } else {
            echo 400;
        }
    }
mysqli_close($con);
?>