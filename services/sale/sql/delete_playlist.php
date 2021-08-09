<?php
include '../../../connection.php';
@$data = json_decode(file_get_contents("php://input"));
@$x=count($data);
if($x > 0) {
    $id  = $data->_id;
    $userName=$_user_fname.' '.$_user_lname;
     $query = "DELETE FROM ans_requirements WHERE _id='$id'";
    if (mysqli_query($con, $query)) {
            echo 200;
    } else {
        echo 400;
    }
}
mysqli_close($con);
?>