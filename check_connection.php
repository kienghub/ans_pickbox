<?php 
// $host_name='localhost';
// $user_name= 'ekkasith_admin';
// $password= '4^Acu5A1Gp^x';
// $db_name= 'ekkasith_ans_main_db';

$con = mysqli_connect('localhost','root', '', 'ans_stock');
$main_db = mysqli_connect('localhost','root', '', 'ans_main_db');

if($con){
     echo "<script>alert('ANS_STOCK DB_connected')</script>";
}else{
echo "<script>alert('ANS_STOCK No Connect')</script>";
}

 if($main_db){
     echo "<script>alert('ANS_MAIN_DB connected')</script>";
 }else{
      echo "<script>alert('ANS_MAIN_DB No Connect')</script>";
 }
?>