<?php 
include ('../../../connection.php');
$info = json_decode(file_get_contents("php://input"));
@$x=count($info);
if ($x > 0) {
    @$cate_title = $_setString($con, $info->cate_title);
// INSERT DATA

    $_select_max_id_for_add_id=$_sql($con,"SELECT cate_id FROM ans_category_of_sale WHERE cate_id=(SELECT MAX(cate_id)FROM ans_category_of_sale)");
    $result=$_assoc($_select_max_id_for_add_id);
    $max_number=$result['cate_id'];
    if($max_number==""){
        $id_number=1;
    }else{ 
        $id_number=$max_number+1;
    }

    $data = "'$id_number','$cate_title','$_timestamp','$_user_fname','$_state_branch'";
    $_queryCategory = $_sql($con, "SELECT cate_title,branch_id FROM ans_category_of_sale WHERE cate_title='$cate_title' AND branch_id='$_state_branch'");
    $_catch = $_count($_queryCategory);

    if ($_catch > 0) {
        echo "DATA_READY_EXIT";
    } else {
        $_createCategory = $_sql($con, "INSERT INTO ans_category_of_sale VALUE($data)");
        if ($_createCategory) {
            echo 200;
        } else {
            echo 400;
        }
    } 
}
mysqli_close($con);
?>