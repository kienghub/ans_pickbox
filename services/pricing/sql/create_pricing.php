<?php 
include ('../../../connection.php');
$info = json_decode(file_get_contents("php://input"));
@$x=count($info);
if ($x > 0) {
   @$pro_id = $_setString($con, $info->pro_id);
   @$price_item = filter_var($info->price_item,FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $_userName=$_user_fname.' '.$_user_lname;
    $btnName = $info->btnName;
   // INSERT DATA
    if (!trim($info->_id)) {
    $data = "'$pro_id','$price_item','$_timestamp','$_userName'";
    $_queryBranch = $_sql($con, "SELECT pro_id,price_item,createdAt FROM ans_pricing WHERE pro_id='$pro_id' AND price_item='$price_item' AND createdAt='$_timestampP'");
    $_catch = $_count($_queryBranch);
    if ($_catch > 0) {
        echo "DATA_READY_EXIT";
    } else {
        $_createPricing = $_sql($con, "INSERT INTO ans_pricing(pro_id,price_item,createdAt,createdBy)VALUE($data)");
        if ($_createPricing) {
            echo 200;
        } else {
            echo 400;
        }
    } 
}else {
    $id = $info->_id;
    $_newData = "pro_id='$pro_id',price_item='$price_item',createdAt='$_timestamp',createdBy='$_userName'";
    $_updatePricing = $_sql($con, "UPDATE ans_pricing SET $_newData WHERE _id='$id'");
    if ($_updatePricing) {
        echo 200;
    } else {
        echo 400;
    }
}
}
mysqli_close($con);
?>