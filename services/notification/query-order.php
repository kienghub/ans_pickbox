<?php
include '../../connection.php';
$output = array();
$_newData=$_sql($con,"SELECT count(*) total FROM ans_requirements WHERE req_status='REQUESTING' group by branch_id");  
$res=mysqli_fetch_array($_newData);
@$count=count($res);

$callLength=$_sql($con,"SELECT count(*) total FROM ans_requirements WHERE req_status='APPROVED' AND branch_id='$_state_branch'");  
$length=mysqli_fetch_assoc($callLength);
mysqli_close($con);

?>
<?php if($res['total']>0){ ?>
<li class="customer-service call-center">
     <a href="../../services/checking_stock/checking_request.php">
          <div class="user-img away">
               <img src="../../img/bell.png" alt="User">
          </div>
          <div class="details" style="font-size:10px!important">
               <div class="noti-details">ມີການຂໍເບີກເຄື່ອງ 
                    <span><?php echo $count ?></span>
                     ລາຍການ</div>
          </div>
     </a>
</li>
<?php }else{echo "";} ?>
<?php if($length['total']>0){?>
<li class="admin">
     <a href="../../services/sale/">
          <div class="user-img away">
               <img src="../../img/bell.png" alt="User">
          </div>
          <div class="details" style="font-size:10px!important">
               <div class="noti-details">ທ່ານໄດ້ຮັບການອານຸມັດຄຳຂໍແລ້ວ</div>
          </div>
     </a>
</li>
<?php }else{echo "";} ?>