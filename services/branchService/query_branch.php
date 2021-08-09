<option>ເລືອກສາຂາ...</option>
<?php 
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
include('../../connection.php');
session_start();
$_SESSION['pro_id']=$_GET['id'];

$query_state_branch  =$_sql($con,"SELECT*FROM office_state_branches WHERE id_state='".$_SESSION['pro_id']."'");
$res=$_assoc($query_state_branch);
$_SESSION['provinceName']=$res['provinceName'];

$query_office_branch_for_province  =$_sql($con,"SELECT*FROM office_branches WHERE provinceID='".$_SESSION['pro_id']."'");
mysqli_close($con);
foreach ($query_office_branch_for_province as $key) {?>
<option value="<?php echo $key['id_branch']?>"><?php echo $key['branch_name']?></option>
<?php } ?>