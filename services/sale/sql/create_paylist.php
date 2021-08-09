<?php 
include ('../../../connection.php');
$info = json_decode(file_get_contents("php://input"));
@$x=count($info);
if ($x > 0) {
   $pay_id = $_setString($con, $info->pay_id);
   $pro_id = $_setString($con, $info->pro_id);
   $pay_qty = filter_var($info->pay_qty,FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $total = filter_var($info->total,FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $old_qty = filter_var($info->old_qty,FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $pay_date = $_setString($con, $info->pay_date);
   $branch_id=$info->branch_id;
   
   $user_consumer = $_setString($con, $info->user_consumer);
   $user_provider = $_setString($con, $info->user_provider);
   $pay_note = $_setString($con, $info->pay_note);
   $btnName = $info->btnName;
   $userName=$_user_fname.' '.$_user_lname;
   
// CHECK FOR DUPLICATE
   $_queryProduction = $_sql($con, "SELECT * FROM ans_requirements WHERE pro_id='$pro_id' AND  req_qty='$pay_qty' AND req_date='$pay_date' AND branch_id='$pay_to_branch'");
   $_catch = $_count($_queryProduction);

   $_queryProduction_for_update_request = $_sql($con, "SELECT count(*)as total FROM ans_requirements WHERE pro_id='$pro_id' AND req_status='REQUESTING' AND branch_id='$_state_branch'");
   $_catch_request = mysqli_fetch_assoc($_queryProduction_for_update_request);

   $checkStocks = $_sql($con, "SELECT * FROM ans_branch_stocks WHERE pro_id='$pro_id' AND branch_id='$_state_branch'");
   $then = $_count($checkStocks);
   if($btnName=="ສົ່ງຄຳຂໍ"){
       if ($_catch > 0) {
           echo "DATA_READY_EXIT";
        }else if($_catch_request['total']>0){
            $_onApproved = $_sql($con, "UPDATE ans_requirements SET req_qty=req_qty+$pay_qty WHERE req_status='REQUESTING' AND branch_id='$_state_branch'");
            if ($_onApproved) {
                echo 200;  
            } else {
                echo 400;
            }
        }else{
            $data = "'$pro_id','$pay_qty','$pay_date','REQUESTING','$userName','$_state_branch'";
            $_createPaylist = $_sql($con, "INSERT INTO ans_requirements(pro_id,req_qty,req_date,req_status,req_user_consumer,branch_id)VALUE($data)");
            if ($_createPaylist) {
                if(strlen($then) > 0){
                    $_sql($con, "INSERT INTO ans_branch_stocks(pro_id,qty,branch_id)VALUE('$pro_id','0','$_state_branch')");
                    echo 200;
                }else{
                    echo 200;
                }
            } else {
                echo 400;
            }
        } 
        
    } else if($btnName=="ອານຸມັດ"){
            $branchID = $info->branchID;
            $_onApproved = $_sql($con, "UPDATE ans_requirements SET req_status='APPROVED',approv_date='$_today',req_user_provider='$userName' WHERE req_status='REQUESTING' AND branch_id='$branchID'");
        if ($_onApproved) {
          echo 200;  
        } else {
         echo 400;
     }
        
    }else if($btnName=="ຮັບເຄື່ອງ"){
        $reqID = $_setString($con, $info->req_id);
        $proID = $_setString($con, $info->pro_id);
        $reqQty = $_setString($con, $info->req_qty);
        $confirmed=$_sql($con, "UPDATE ans_stock_of_sale SET st_qty=st_qty-'$reqQty' WHERE pro_id='$proID'");
        if ($confirmed) {
            $_sql($con, "UPDATE ans_branch_stocks SET qty=qty+'$reqQty' WHERE pro_id='$proID' AND branch_id='$_state_branch'");
            $_sql($con, "UPDATE ans_requirements SET req_status='DONE' WHERE _id='$reqID'");
          echo 200;  
        } else {
            echo 400;
        }

    }
    else if($btnName=="onReject"){
        $_id = $_setString($con, $info->_id);
        $pro_ID= $_setString($con, $info->pro_id);
        $note= $_setString($con, $info->note);
        $onRejected=$_sql($con, "UPDATE ans_requirements SET req_status='REQUESTING',req_note='$note' WHERE _id='$_id'");
        if ($onRejected) {
          echo 200;  
        } else {
            echo 400;
        }

    }else if($btnName=="ແກ້ໄຂ"){
       $reqID = $_setString($con, $info->_id);
       $reqQty = $_setString($con, $info->req_qty);
       $_onUpdated = $_sql($con, "UPDATE ans_requirements SET req_qty='$reqQty' WHERE _id=' $reqID'");
        if ($_onUpdated) {
          echo 200;  
        } else {
            echo 400;
        }

    }else if($btnName=="ບັນທຶກການປ່ຽນແປງ"){
      $saleID = $_setString($con, $info->_id);
      $pro_ID = $_setString($con, $info->pro_id);
      $saleQty = $_setString($con, $info->s_qty);
      $oldQty = $_setString($con, $info->oldQty);
      
       $onChanged=$_sql($con, "UPDATE ans_branch_stocks SET qty=qty-'$oldQty' WHERE pro_id='$pro_ID' AND branch_id='$_state_branch'");
       if ($onChanged) {
            $_sql($con, "UPDATE ans_sale SET s_qty='$saleQty' WHERE _id='$saleID'");
            $_sql($con, "UPDATE ans_branch_stocks SET qty=qty+'$saleQty' WHERE pro_id='$pro_ID' AND branch_id='$_state_branch'");
          echo 200;  
        } else {
            echo 400;
        }

    }else if(isset($_GET['create_order'])){
        $bill_no = $_setString($con, $info->bill_no);
        $pro_ID = $_setString($con, $info->pro_id);
        $require_qty = $_setString($con, $info->req_qty);
        $rec_sprice = $_setString($con, $info->rec_sprice);
        $require_date = $_setString($con, $info->req_date);
        $require_note = $_setString($con, $info->req_note);

        $checkProduction = $_sql($con, "SELECT * FROM ans_sale WHERE pro_id='$pro_ID' AND bill_no='$bill_no' AND s_status=1 AND branch_id='$_state_branch'");
        $_catch = $_count($checkProduction);
        if($_catch>0){
            $updateOrder = $_sql($con, "UPDATE ans_sale SET s_qty=s_qty+'$require_qty', s_createdAt='$_timestamp' WHERE pro_id='$pro_ID' AND branch_id='$_state_branch'");
            if ($updateOrder) {
                $_sql($con, "UPDATE ans_branch_stocks SET qty=qty-'$require_qty' WHERE pro_id='$pro_ID' AND branch_id='$_state_branch'");
                    echo 200;
                }else{
                    echo 400;
                }
        }else{
            $_createPaylist = $_sql($con, "INSERT INTO ans_sale(pro_id,sprice,s_qty,s_date,s_status,s_note,branch_id,s_createdAt,s_createdBy,bill_no)
             VALUE('$pro_ID','$rec_sprice','$require_qty','$require_date','1','$require_note','$_state_branch','$_timestamp','$userName','$bill_no')");
            if ($_createPaylist) {
                $_sql($con, "UPDATE ans_branch_stocks SET qty=qty-'$require_qty' WHERE pro_id='$pro_ID' AND branch_id='$_state_branch'");
                    echo 200;
                }else{
                    echo 400;
                }
        }
      }else if(isset($_GET['removeItem'])){
        $_id = $_setString($con, $info->_id);
        $pro_id = $_setString($con, $info->pro_id);
        $qty = $_setString($con, $info->qty);
        $removed=mysqli_query($con,"DELETE FROM ans_sale WHERE _id='$_id' AND pro_id='$pro_id' AND branch_id='$_state_branch'");
        if($removed){
          $_sql($con, "UPDATE ans_branch_stocks SET qty=qty+'$qty' WHERE pro_id='$pro_id' AND branch_id='$_state_branch'");
          echo 200;  
        }else{
            echo 400;
        }
      }else if(isset($_GET['create_bill'])){
          $createBill=mysqli_query($con,"INSERT INTO ans_bills VALUES('$_auto_id','$_model_number',1,'$_state_branch')");
          if($createBill){
            $_sql($con, "UPDATE ans_sale SET s_status=0 WHERE bill_no='$info->bill_old' AND branch_id='$_state_branch'");
            echo 200;
        }else{
            echo 400;
        }
      } else{
          echo "Error";
      }
mysqli_close($con);
}
?>