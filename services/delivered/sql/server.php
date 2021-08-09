<?php
include '../../../connection.php';
if($_GET['request']=="update"){
     $query = "UPDATE ans_sale SET s_status=2 WHERE s_status=1 AND branch_id='$_state_branch'";
        if (mysqli_query($con, $query)) {
                echo 200;
        } else {
            echo 400;
        }
    }
mysqli_close($con);
?>