<?php
include '../../../connection.php';
@$data = json_decode(file_get_contents("php://input"));
@$x=count($data);
if($x > 0) {
    $id  = $data->_id;
    $pro_id  = $data->pro_id;
    $qty  = $data->s_qty;

     $query = "DELETE FROM ans_sale WHERE _id='$id'";
    if (mysqli_query($con, $query)) {
         $_sql($con, "UPDATE ans_branch_stocks SET qty=qty+'$qty ' WHERE pro_id='$pro_id' AND branch_id='$_state_branch'");
            echo 200;
    } else {
        echo 400;
    }
}
mysqli_close($con);
?>