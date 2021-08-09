<?php 
session_start();
$_SESSION['pro_id']=$_GET['id'];
if($_SESSION['pro_id']=$_GET['id']){
     echo 200;
}else{
     echo 400;
}
?>