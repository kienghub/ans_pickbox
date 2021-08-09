<option value="">ເລືອກສາຂາ...</option>
<?php
include('../../../connection.php');
$id=$_GET['pro_id'];
$query  =$_sql($con,"SELECT*FROM office_branches WHERE provinceID='$id'");
foreach ($query  as $key) { ?> <option value="<?php echo $key['id_branch'] ?>">
     <?php echo $key['branch_name'] ?>
</option>
<?php }?>
<option value="">ທັງໝົດ</option>