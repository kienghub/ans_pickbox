<option value="">ເລືອກລາຍການເຄື່ອງ...</option>
<?php
include '../../../connection.php';
$cate_id=$_GET['cate_id'];
$query  =mysqli_query($con,"SELECT * FROM ans_production_of_sale WHERE cate_id='$cate_id'");
    while ($row = mysqli_fetch_array($query)) {?>
<option value="<?php echo $row['pro_id']?>"><?php echo $row['pro_title'].' '.$row['pro_size']?></option>
<?php }
mysqli_close($con);
?>