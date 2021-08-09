<option value="">ເລືອກສາຂາ...</option>
<?php
include '../../../connection.php';
$id=$_GET['id'];
$query  =mysqli_query($con,"SELECT * FROM office_branches WHERE provinceID='$id'");
    while ($row = mysqli_fetch_array($query)) {?>
<option value="<?php echo $row['id_branch']?>"><?php echo $row['branch_name']?></option>
<?php }
mysqli_close($remote_db);
?>