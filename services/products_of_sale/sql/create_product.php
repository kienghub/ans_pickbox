<?php 
include ('../../../connection.php');
   @$cate_id = $_setString($con, $_POST['cate_id']);
   @$pro_title = $_setString($con, $_POST['pro_title']);
   @$pro_unit = $_setString($con, $_POST['pro_unit']);
   @$pro_size = $_setString($con, $_POST['pro_size']);
   @$pro_detail = $_setString($con, $_POST['pro_detail']);

    $file_img    = $_FILES['pro_img']['name'];
    $tmp_dir    = $_FILES['pro_img']['tmp_name'];
    $upload_dir = '../../../img/';// upload directory
    
        $id=$_POST['pro_id'];
        $_callGameDataResult=$_sql($con,"SELECT*FROM ans_production_of_sale where pro_id='$id'");
        $rows=$_assoc($_callGameDataResult);

        @$fileExt  = strtolower(pathinfo($file_img, PATHINFO_EXTENSION));
    if ($file_img == "") {$img = $rows['pro_img'];} else {
        @$img = rand(100000, 1000000).".".$fileExt;
    }
    
    $_select_max_id_for_add_id=$_sql($con,"SELECT pro_id FROM ans_production_of_sale WHERE pro_id=(SELECT MAX(pro_id)FROM ans_production_of_sale)");
    $result=$_assoc($_select_max_id_for_add_id);
    $max_number=$result['pro_id'];
    if($max_number==""){
        $id_number=1;
        $pro_number=$_gen_id+$id_number;
    }else{ 
        $id_number=$max_number+1;
        $pro_number=$_gen_id+$id_number;
    }
    if(!trim($_POST['cate_id'])){
        echo "PRO_CATE_ID_INVALID";
    }
    else if(!trim($_POST['pro_title'])){
        echo "PRO_TITLE_INVALID";
    }
    else if(!trim($_POST['pro_unit'])){
        echo "PRO_UNIT_INVALID";
    } else if(!trim($_POST['pro_id'])){
        
    $data = "'$id_number','$pro_number','$cate_id','$pro_title','$pro_unit','$pro_size','true','$pro_detail','$img','$_timestamp','$_user_fname','$_state_branch'";
    $_queryProduction = $_sql($con, "SELECT * FROM ans_production_of_sale WHERE pro_number='$pro_number' AND cate_id='$cate_id' AND pro_title='$pro_title' AND pro_unit='$pro_unit'");
    $_catch = $_count($_queryProduction);
    
    if ($_catch > 0) {
        echo "DATA_READY_EXIT";
    } else {
        $_createCategory = $_sql($con, "INSERT INTO ans_production_of_sale VALUE($data)");
        if ($_createCategory) {
            move_uploaded_file($tmp_dir, $upload_dir.$img);
            echo 200;
        } else {
            echo 400;
        }
    } 
    }else{
    $id=$_POST['pro_id'];
    $_newData = "cate_id='$cate_id',pro_title='$pro_title',pro_number='$pro_number',pro_unit='$pro_unit',pro_size='$pro_size',pro_detail='$pro_detail',pro_img='$img',pro_createdAt='$_timestamp',pro_createdBy='$_user_fname',branch_id='$_state_branch'";
    $_updateCategory = $_sql($con, "UPDATE ans_production_of_sale SET $_newData WHERE pro_id='$id'");
    if ($_updateCategory) {
        @unlink($tmp_dir, $upload_dir.$rows['pro_img']);
        @move_uploaded_file($tmp_dir, $upload_dir.$img);
        echo 200;
    } else {
        echo 400;
    }
}
mysqli_close($con);
?>