<?php
include '../../../connection.php';
@$data = json_decode(file_get_contents("php://input"));
@$x=count($data);
if($x > 0) {
    $id  = $data->id;
    $pro_id  = $data->pro_id;
    $qty  = $data->qty;
     $query = "DELETE FROM ans_receive_of_sale WHERE _id='$id'";
    if (mysqli_query($con, $query)) {
        $_sql($con, "UPDATE ans_stock_of_sale SET st_qty=st_qty-'$qty' WHERE pro_id='$pro_id'");
        $_sql($con, "UPDATE ans_branch_stocks SET qty=qty-'$rec_qty' WHERE pro_id='$pro_id' AND branch_id='$_state_branch'");
        echo 200;
    } else {
        echo 400;
    }
}
mysqli_close($con);
?>