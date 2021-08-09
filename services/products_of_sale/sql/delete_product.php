<?php
include '../../../connection.php';
@$data = json_decode(file_get_contents("php://input"));
@$x=count($data);
if($x > 0) {
    $id  = $data->pro_id;
     $query = "DELETE FROM ans_production_of_sale WHERE pro_id='$id'";
    if (mysqli_query($con, $query)) {
        echo 200;
    } else {
        echo 400;
    }
}
mysqli_close($con);
?>