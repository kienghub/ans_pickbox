  <html>
  <header>
       <link rel="icon" href="../../img/logo_next_day.png" />
       <title>Print</title>
       <style>
       #table {
            margin: 20px;
            border-collapse: collapse;
            border-spacing: 0;
       }
       td {
            border: 1px inset black;
            padding: 5px;
       }
       </style>
  </header>

  <body onload="printThis('invoice')" style="padding:20px" id="invoice">
       <?php 
          include('../../connection.php');
          if($_GET['start_date']=="" & $_GET['end_date']==""){
               $params="";
               $title="ທັງໝົດ";
          }else{
               $st_date=$_GET['start_date'];
               $end_date=$_GET['end_date'];
               $time1=date('d-m-Y', $st_date);
               $time2=date('d-m-Y', $end_date);
               $title="<br>ແຕ່ວັນທີ $time1 ເຖິງ $time2";
               $params="AND ans_items.receiveDate BETWEEN '$st_date' AND '$end_date'";
          }
     // SUM QTY RECEIVE
     $sum_statistic_for_next_day=$_sql($main_db,"SELECT count(id_list) as rec_qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_items.isSummary=0 $params");
     $sumRecQty=$_assoc($sum_statistic_for_next_day);

     // SUM PRICE RECEIVE
     $sum_price_statistic_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as rec_price FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_items.isSummary=0 $params");
     $sumRecPrice=$_assoc($sum_price_statistic_for_next_day);

     // SUM WEIGHT RECEIVE
     $sum_weight_statistic_for_sam_day=$_sql($main_db,"SELECT sum(ans_item_next_day.weight) as weight FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_items.isSummary=0 $params");
     $sumRecWeight=$_assoc($sum_weight_statistic_for_sam_day);
     
     $sum_qty_for_next_day2=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.charge_on_shop=1 AND ans_items.status_id=3 AND ans_items.isSummary=0 $params");
     $countRecQty2=$_assoc($sum_qty_for_next_day2);

     $sum_packagePrice_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.charge_on_shop=0 AND ans_items.status_id=3 AND ans_items.isSummary=0 $params");
     $sumRecPackagePrice=$_assoc($sum_packagePrice_for_next_day);

     $sum_packagePrice_for_next_day2=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.charge_on_shop=1 AND ans_items.status_id=3 AND ans_items.isSummary=0 $params");
     $sumRecPackagePrice2=$_assoc($sum_packagePrice_for_next_day2);
     mysqli_close($main_db);
     
     function _countFromProvince($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_item_next_day.destinationStateID='$x' AND ans_items.isSummary=0 $params");
          $res=$_assoc($query);
          echo number_format($res['qty']);
          mysqli_close($main_db);
     }
    
     
     function _sumPriceFromProvince($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_item_next_day.destinationStateID='$x' AND ans_items.isSummary=0 $params");
          $res=$_assoc($query);
          echo number_format($res['packagePrice']);
          mysqli_close($main_db);
     }

      function _sumWeightForProvince($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT sum(ans_item_next_day.weight) as weight FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_item_next_day.destinationStateID='$x' AND ans_items.isSummary=0 $params");
          $res=$_assoc($query);
          echo number_format($res['weight']);
          mysqli_close($main_db);
     }

      function _sumWeightForBranch($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT sum(ans_item_next_day.weight) as weight FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_items.original_branch_id='$x' AND ans_items.isSummary=0 $params");
          $res=$_assoc($query);
          echo number_format($res['weight']);
          mysqli_close($main_db);
     }

     function _percentFromProvince($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_item_next_day.destinationStateID='$x' AND ans_items.isSummary=0 $params");
          $res=$_assoc($query);
          $total=$res['qty'];
          echo number_format($total);
          mysqli_close($main_db);
     }

        function _countFromBranch($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_items.original_branch_id='$x' AND ans_items.isSummary=0 $params");
          $res=$_assoc($query);
          echo number_format($res['qty']);
          mysqli_close($main_db);
     }
           function _percentFromBranch($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_items.original_branch_id='$x' AND ans_items.isSummary=0 $params");
          $res=$_assoc($query);
          echo number_format($res['qty']);
          mysqli_close($main_db);
     }
           function _priceFromBranch($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_items.original_branch_id='$x' AND ans_items.isSummary=0 $params");
          $res=$_assoc($query);
          echo number_format($res['packagePrice']);
          mysqli_close($main_db);
     }
          function qty_charge_on_shop0($x){
          include('../../connection.php');
          global $params;
          $sum_qty_for_next_day=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.charge_on_shop=0 AND ans_items.status_id=3 AND ans_item_next_day.destinationStateID='$x' AND ans_items.isSummary=0 $params");
           $countRecQty=$_assoc($sum_qty_for_next_day);
          echo number_format($countRecQty['qty']);
          mysqli_close($main_db);
     }
          function price_charge_on_shop0($x){
          include('../../connection.php');
          global $params;
          $sum_price_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.charge_on_shop=0 AND ans_items.status_id=3 AND ans_item_next_day.destinationStateID='$x' AND ans_items.isSummary=0 $params");
           $countRecPrice=$_assoc($sum_price_for_next_day);
          echo number_format($countRecPrice['packagePrice']);
          mysqli_close($main_db);
     }
      function qty_charge_on_shop1($x){
          include('../../connection.php');
          global $params;
          $sum_qty_for_next_day=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.charge_on_shop=1 AND ans_items.status_id=3 AND ans_item_next_day.destinationStateID='$x' AND ans_items.isSummary=0 $params");
           $countRecQty=$_assoc($sum_qty_for_next_day);
          echo number_format($countRecQty['qty']);
          mysqli_close($main_db);
     }
          function price_charge_on_shop1($x){
          include('../../connection.php');
          global $params;
          $sum_price_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.charge_on_shop=1 AND ans_items.status_id=3 AND ans_item_next_day.destinationStateID='$x' AND ans_items.isSummary=0 $params");
           $countRecPrice=$_assoc($sum_price_for_next_day);
          echo number_format($countRecPrice['packagePrice']);
          mysqli_close($main_db);
     }

       function branch_qty_charge_on_shop0($x){
          include('../../connection.php');
          global $params;
          $sum_qty_for_next_day=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.charge_on_shop=0 AND ans_items.status_id=3 AND ans_items.original_branch_id='$x' AND ans_items.isSummary=0 $params");
           $countRecQty=$_assoc($sum_qty_for_next_day);
          echo number_format($countRecQty['qty']);
          mysqli_close($main_db);
     }
          function branch_price_charge_on_shop0($x){
          include('../../connection.php');
          global $params;
          $sum_price_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.charge_on_shop=0 AND ans_items.status_id=3 AND ans_items.original_branch_id='$x' AND ans_items.isSummary=0 $params");
           $countRecPrice=$_assoc($sum_price_for_next_day);
          echo number_format($countRecPrice['packagePrice']);
          mysqli_close($main_db);
     }

       function branch_qty_charge_on_shop1($x){
          include('../../connection.php');
          global $params;
          $sum_qty_for_next_day=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.charge_on_shop=1 AND ans_items.status_id=3 AND ans_items.original_branch_id='$x' AND ans_items.isSummary=0 $params");
           $countRecQty=$_assoc($sum_qty_for_next_day);
          echo number_format($countRecQty['qty']);
          mysqli_close($main_db);
     }
          function branch_price_charge_on_shop1($x){
          include('../../connection.php');
          global $params;
          $sum_price_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.charge_on_shop=1 AND ans_items.status_id=3 AND ans_items.original_branch_id='$x' AND ans_items.isSummary=0 $params");
           $countRecPrice=$_assoc($sum_price_for_next_day);
          echo number_format($countRecPrice['packagePrice']);
          mysqli_close($main_db);
     }

       function _renderBranchName($x){
          include('../../connection.php');
          $query=mysqli_query($main_db,"SELECT branch_name FROM office_branches WHERE id_branch='$x'");
          $res=$_assoc($query);
          echo $res['branch_name'];
          mysqli_close($main_db);
     }

?>
       <!-- Page header end -->
       <br>
       <table width="100%" style="text-align:left;margin-left:30px">
            <tr>
                 <th colspan="2">
                      <center>
                           <h3 style="color:black!important">ລາຍງານຄ່າບໍລິການພັດສະດຸທີ່ສົ່ງສຳເລັດ<?php echo $title ?>
                           </h3>
                      </center>
                 </th>
            </tr>
            <tr>
                 <th width="50%">
                      <img src="../../img/logo_next_day.png" width="150px">
                 </th>
                 <th width="50%" style="text-align:right;">
                      ວັນທີ: <?php echo $_today ?> &nbsp;&nbsp;
                 </th>
            </tr>
            <tr>
                 <th width="50%">
                      ບໍລິສັດ ອານູສິດ ໂລຈິສຕິກ ຈໍາກັດ
                 </th>
            </tr>
            <tr>
                 <th width="50%">
                      ບ້ານ ໂພນສະຫວ່າງ, ເມືອງ ຈັນທະບູລີ, ນະຄອນຫຼວງວຽງຈັນ
                 </th>
            </tr>
       </table>

       <ul>
            <li class="p-2">
                 ຈ່າຍຄ່າບໍລິການຕົ້ນທາງ
                 <?php echo number_format($countRecQty['qty'])?>
                 ອັນ / ມູນຄ່າ
                 <?php echo number_format($sumRecPackagePrice['packagePrice'])?>
                 ກີບ
            </li>
            <li class="p-2">
                 ຈ່າຍຄ່າບໍລິການປາຍທາງ
                 <?php echo number_format($countRecQty2['qty'])?>
                 ອັນ / ມູນຄ່າ
                 <?php echo number_format($sumRecPackagePrice2['packagePrice'])?>
                 ກີບ
            </li>
            <li class="p-2">
                 ສະຫຼຸບຄ່າບໍລິການປາຍທາງແລ້ວ
                 <?php echo number_format($countRecQty2['qty'])?>
                 ອັນ / ມູນຄ່າ
                 <?php echo number_format($sumRecPackagePrice2['packagePrice'])?>
                 ກີບ
            </li>
            <li class="p-2">
                 ຍັງບໍ່ສະຫຼຸບຄ່າບໍລິການປາຍທາງ
                 <?php echo number_format($countRecQty2['qty'])?>
                 ອັນ / ມູນຄ່າ
                 <?php echo number_format($sumRecPackagePrice2['packagePrice'])?>
                 ກີບ
            </li>
       </ul>

       <hr>
       <h3 align="center"><u>ລາຍລະອຽດທັງໝົດ</u></h3>
       <h3># ພາກເໜືອ</h3>
       <table width="100%" id="table">
            <tr>
                 <td width="70px" align="center">#</td>
                 <td>ຊື່ແຂວງ</td>
                 <td>ຈ່າຍຄ່າບໍລິການຕົ້ນທາງ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຈ່າຍຄ່າບໍລິການປາຍທາງ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ສະຫຼຸບຄ່າບໍລິການແລ້ວ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຍັງບໍ່ສະຫຼຸບຄ່າບໍລິການ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
            </tr>
            <?php 
            include('../../connection.php');
               $i=1;
               $variable  =mysqli_query($main_db,"SELECT count(id_list) AS qty ,sum(packagePrice)as amount,provinceName,provinceCode FROM office_state_branches
               LEFT JOIN ans_item_next_day ON ans_item_next_day.destinationStateID=office_state_branches.id_state
               LEFT JOIN ans_items on ans_items.id_item = ans_item_next_day.item_id WHERE office_state_branches.id_state IN (13,14,15,16,17,19,21,22) GROUP BY destinationStateID ORDER BY qty DESC");
               mysqli_close($main_db);
               foreach ($variable as $key) {?>
            <tr>
                 <td align="center"><?php echo $i ?></td>
                 <td> <?php echo $key['provinceName']?></td>
                 <td style="text-align:right"> <?php _countFromProvince($key['id_state'])?></td>
                 <td style="text-align:right"> <?php _sumPriceFromProvince($key['id_state'])?></td>
                 <td style="text-align:right"> <?php qty_charge_on_shop0($key['id_state'])?></td>
                 <td style="text-align:right"> <?php price_charge_on_shop0($key['id_state'])?></td>
                 <td style="text-align:right"> <?php _sumWeightForProvince($key['id_state'])?></td>
                 <td style="text-align:right"> <?php qty_charge_on_shop1($key['id_state'])?></td>
                 <td style="text-align:right"> <?php price_charge_on_shop1($key['id_state'])?></td>
                 <td style="text-align:right"> <?php price_charge_on_shop1($key['id_state'])?></td>
            </tr>
            <?php 
          include('../../connection.php');
          $x=1;
          $pro_id=$key['id_state'];
          $query_branch_in_state =mysqli_query($main_db,"SELECT count(id_list) as total,original_branch_id FROM ans_item_next_day 
          LEFT JOIN ans_items ON ans_items.id_item=ans_item_next_day.item_id WHERE ans_item_next_day.destinationStateID='$pro_id'
          GROUP BY original_branch_id ORDER BY total DESC");
          mysqli_close($main_db);
          foreach ($query_branch_in_state as $for) {?>
            <tr>
                 <td></td>
                 <td style="padding-left:40px"><?php echo $x ?>. <?php _renderBranchName($for['original_branch_id'])?>

                 </td>
                 <td style="text-align:right"><?php _countFromBranch($for['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php _priceFromBranch($for['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_qty_charge_on_shop0($for['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_price_charge_on_shop0($for['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php _sumWeightForBranch($for['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_qty_charge_on_shop1($for['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_price_charge_on_shop1($for['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_price_charge_on_shop1($for['original_branch_id']) ?></td>
            </tr>
            <?php $x++; } $i++;}?>
       </table>
       <h3># ພາກກາງ</h3>
       <table width="100%" id="table">
            <tr>
                 <td width="70px" align="center">#</td>
                 <td>ຊື່ແຂວງ</td>
                 <td>ຈ່າຍຄ່າບໍລິການຕົ້ນທາງ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຈ່າຍຄ່າບໍລິການປາຍທາງ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ສະຫຼຸບຄ່າບໍລິການແລ້ວ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຍັງບໍ່ສະຫຼຸບຄ່າບໍລິການ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
            </tr>
            <?php 
            include('../../connection.php');
               $i=1;
               $query_for_state  =mysqli_query($main_db,"SELECT count(id_list) AS qty ,sum(packagePrice)as amount,provinceName,provinceCode,id_state FROM office_state_branches
               LEFT JOIN ans_item_next_day ON ans_item_next_day.destinationStateID=office_state_branches.id_state
               LEFT JOIN ans_items on ans_items.id_item = ans_item_next_day.item_id WHERE office_state_branches.id_state IN (1,8,9,18,23) GROUP BY destinationStateID ORDER BY qty DESC");
               mysqli_close($main_db);
               foreach ($query_for_state as $state) {?>
            <tr>
                 <td align="center"><?php echo $i ?></td>
                 <td> <?php echo $state['provinceName']?></td>
                 <td style="text-align:right"> <?php _countFromProvince($state['id_state'])?></td>
                 <td style="text-align:right"> <?php _sumPriceFromProvince($state['id_state'])?></td>
                 <td style="text-align:right"> <?php qty_charge_on_shop0($state['id_state'])?></td>
                 <td style="text-align:right"> <?php price_charge_on_shop0($state['id_state'])?></td>
                 <td style="text-align:right"> <?php _sumWeightForProvince($state['id_state'])?></td>
                 <td style="text-align:right"> <?php qty_charge_on_shop1($state['id_state'])?></td>
                 <td style="text-align:right"> <?php price_charge_on_shop1($state['id_state'])?></td>
                 <td style="text-align:right"> <?php price_charge_on_shop1($state['id_state'])?></td>
            </tr>
            <?php 
          include('../../connection.php');
          $x=1;
          $pro_id=$state['id_state'];
          $query_branch_in_state =mysqli_query($main_db,"SELECT count(id_list) as total,original_branch_id FROM ans_item_next_day 
          LEFT JOIN ans_items ON ans_items.id_item=ans_item_next_day.item_id WHERE ans_item_next_day.destinationStateID='$pro_id'
          GROUP BY original_branch_id ORDER BY total DESC ");
          mysqli_close($con);
          foreach ($query_branch_in_state as $result) {?>
            <tr>
                 <td> <?php echo $result['original_branch_id'] ?></td>
                 <td style="padding-left:40px"><?php echo $x ?>.
                      <?php _renderBranchName($result['original_branch_id'])?></td>
                 <td style="text-align:right"><?php _countFromBranch($result['id_branch']) ?></td>
                 <td style="text-align:right"><?php _priceFromBranch($result['id_branch']) ?></td>
                 <td style="text-align:right"><?php branch_qty_charge_on_shop0($result['id_branch']) ?></td>
                 <td style="text-align:right"><?php branch_price_charge_on_shop0($result['id_branch']) ?></td>
                 <td style="text-align:right"><?php _sumWeightForBranch($result['id_branch']) ?></td>
                 <td style="text-align:right"><?php branch_qty_charge_on_shop1($result['id_branch']) ?></td>
                 <td style="text-align:right"><?php branch_price_charge_on_shop1($result['id_branch']) ?></td>
                 <td style="text-align:right"><?php branch_price_charge_on_shop1($result['id_branch']) ?></td>
            </tr>
            <?php $x++; } $i++;}?>
       </table>
       <h3># ພາກໃຕ້</h3>
       <table width="100%" id="table">
            <tr>
                 <td width="70px" align="center">#</td>
                 <td>ຊື່ແຂວງ</td>
                 <td>ຈ່າຍຄ່າບໍລິການຕົ້ນທາງ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຈ່າຍຄ່າບໍລິການປາຍທາງ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ສະຫຼຸບຄ່າບໍລິການແລ້ວ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຍັງບໍ່ສະຫຼຸບຄ່າບໍລິການ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
            </tr>
            <?php 
            include('../../connection.php');
               $i=1;
               $query_for_state  =mysqli_query($main_db,"SELECT count(id_list) AS qty ,sum(packagePrice)as amount,provinceName,provinceCode,id_state FROM office_state_branches
               LEFT JOIN ans_item_next_day ON ans_item_next_day.destinationStateID=office_state_branches.id_state
               LEFT JOIN ans_items on ans_items.id_item = ans_item_next_day.item_id WHERE office_state_branches.id_state IN (3,5,10,11,12) GROUP BY destinationStateID ORDER BY qty DESC");
               mysqli_close($main_db);
               foreach ($query_for_state as $state) {?>
            <tr>
                 <td align="center"><?php echo $i ?></td>
                 <td> <?php echo $state['provinceName']?></td>
                 <td style="text-align:right"> <?php _countFromProvince($state['id_state'])?></td>
                 <td style="text-align:right"> <?php _sumPriceFromProvince($state['id_state'])?></td>
                 <td style="text-align:right"> <?php qty_charge_on_shop0($state['id_state'])?></td>
                 <td style="text-align:right"> <?php price_charge_on_shop0($state['id_state'])?></td>
                 <td style="text-align:right"> <?php _sumWeightForProvince($state['id_state'])?></td>
                 <td style="text-align:right"> <?php qty_charge_on_shop1($state['id_state'])?></td>
                 <td style="text-align:right"> <?php price_charge_on_shop1($state['id_state'])?></td>
                 <td style="text-align:right"> <?php price_charge_on_shop1($state['id_state'])?></td>
            </tr>
            <?php 
          include('../../connection.php');
          $x=1;
          $proId=$state['id_state'];
          $query_branch_in_state =mysqli_query($main_db,"SELECT count(id_list) as total,original_branch_id FROM ans_item_next_day 
          LEFT JOIN ans_items ON ans_items.id_item=ans_item_next_day.item_id WHERE ans_item_next_day.destinationStateID='$proId'
          GROUP BY original_branch_id ORDER BY total DESC");
          mysqli_close($con);
          foreach ($query_branch_in_state as $resultset) {?>
            <tr>
                 <td></td>
                 <td style="padding-left:40px"><?php echo $x ?>.
                      <?php _renderBranchName($resultset['original_branch_id'])?>
                 </td>
                 <td style="text-align:right"><?php _countFromBranch($resultset['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php _priceFromBranch($resultset['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_qty_charge_on_shop0($resultset['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_price_charge_on_shop0($resultset['original_branch_id']) ?>
                 </td>
                 <td style="text-align:right"><?php _sumWeightForBranch($resultset['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_qty_charge_on_shop1($resultset['original_branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_price_charge_on_shop1($resultset['original_branch_id']) ?>
                 <td style="text-align:right"><?php branch_price_charge_on_shop1($resultset['original_branch_id']) ?>
                 </td>
            </tr>
            <?php $x++; } $i++;}?>
       </table>
       <table width="100%" style="text-align:center;margin-top:15px;border:none!important">
            <tr>
                 <th width="50%">
                      ບັນຊີສາງ
                 </th>
                 <th width="50%">
                      ຜູ້ອຳນວຍການ
                 </th>
            </tr>
       </table>
       <!-- Main container end -->
       </div>
       <script>
       function printThis(data) {
            var printContents = document.getElementById(data).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            setTimeout(function() {
                 this.close();
            }, 1000);
            window.print();
            document.body.innerHTML = originalContents;
       }
       </script>
  </body>

  </html>