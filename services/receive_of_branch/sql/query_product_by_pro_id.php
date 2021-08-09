<?php
include '../../../connection.php';
echo $id=$_GET['pro_id'];
$query  =mysqli_query($con,"SELECT*FROM
	ans_production_of_sale WHERE pro_id='$id'");
   $res=$_assoc($query);
   echo $res['pro_number'];
   echo ",";
   echo $res['pro_title'];
   echo ",";
   echo $res['pro_unit'];
   echo ",";
   echo $res['pro_size'];
   mysqli_close($con);
?>