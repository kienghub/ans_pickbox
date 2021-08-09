<?php
include '../../../connection.php';
   $id=$_GET['pro_id'];
   $_checkStock = $_sql($con, "SELECT sum(qty) as total FROM ans_branch_stocks WHERE pro_id='$id'");
   $_result = $_assoc($_checkStock);
   echo $total=$_result['total'];
   mysqli_close($con);
?>