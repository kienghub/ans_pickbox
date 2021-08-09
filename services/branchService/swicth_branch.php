<?php 
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
session_start();
if($_SESSION['branch_id']=$_POST['branchID']){
     echo 200;
}else{
     echo 400;
}
?>