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
                                                  LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 $params");
               $sumRecQty=$_assoc($sum_statistic_for_next_day);

               // SUM PRICE RECEIVE
               $sum_price_statistic_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as rec_price FROM ans_item_next_day 
                                                  LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 $params");
               $sumRecPrice=$_assoc($sum_price_statistic_for_next_day);

                // SUM QTY RECEIVE
               $sum_statistic_for_same_day=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                                  LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=5 $params");
               $sumRecQtySameday=$_assoc($sum_statistic_for_same_day);
                // SUM PRICE RECEIVE
               $sum_price_for_same_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                                                 LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=5 $params");
               $sumPriceSameday=$_assoc($sum_price_for_same_day);

               // SUM TOTAL RECEIVE
               $sum_total_for_qty=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                                  LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id $params");
               $sumTotalQty=$_assoc($sum_total_for_qty);
               // SUM TOTAL PRICE
               $sum_total_for_price=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                                  LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id $params");
               $sumTotalPrice=$_assoc($sum_total_for_price);
          
               mysqli_close($main_db);
     
     function _countFromProvince($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_item_next_day.status_id=3 AND ans_item_next_day.destinationStateID='$x' $params");
          $res=$_assoc($query);
          echo number_format($res['qty']);
          mysqli_close($main_db);
     }
    
     
     function _sumPriceFromProvince($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_item_next_day.destinationStateID='$x' $params");
          $res=$_assoc($query);
          echo number_format($res['packagePrice']);
          mysqli_close($main_db);
     }


        function _countFromBranch($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_items.branch_id='$x' $params");
          $res=$_assoc($query);
          echo number_format($res['qty']);
          mysqli_close($main_db);
     }
           function _percentFromBranch($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_items.branch_id='$x' $params");
          $res=$_assoc($query);
          echo number_format($res['qty']);
          mysqli_close($main_db);
     }
           function _priceFromBranch($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=3 AND ans_items.branch_id='$x' $params");
          $res=$_assoc($query);
          echo number_format($res['packagePrice']);
          mysqli_close($main_db);
     }
          function qtyOnSameday($x){
          include('../../connection.php');
          global $params;
          $sum_qty_for_next_day=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.status_id=5 AND ans_item_next_day.destinationStateID='$x' $params");
           $countRecQty=$_assoc($sum_qty_for_next_day);
          echo number_format($countRecQty['qty']);
          mysqli_close($main_db);
     }
          function priceOnSameday($x){
          include('../../connection.php');
          global $params;
          $sum_price_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE  ans_items.status_id=5 AND ans_item_next_day.destinationStateID='$x' $params");
           $countRecPrice=$_assoc($sum_price_for_next_day);
          echo number_format($countRecPrice['packagePrice']);
          mysqli_close($main_db);
     }
      function qtyOnStock($x){
          include('../../connection.php');
          global $params;
          $sum_qty_for_next_day=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_item_next_day.destinationStateID='$x' $params");
           $countRecQty=$_assoc($sum_qty_for_next_day);
          echo number_format($countRecQty['qty']);
          mysqli_close($main_db);
     }
          function priceOnStock($x){
          include('../../connection.php');
          global $params;
          $sum_price_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_item_next_day.destinationStateID='$x' $params");
           $countRecPrice=$_assoc($sum_price_for_next_day);
          echo number_format($countRecPrice['packagePrice']);
          mysqli_close($main_db);
     }

       function branch_qtyOnSameday($x){
          include('../../connection.php');
          global $params;
          $sum_qty_for_next_day=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_items.branch_id='$x' $params");
           $countRecQty=$_assoc($sum_qty_for_next_day);
          echo number_format($countRecQty['qty']);
          mysqli_close($main_db);
     }
          function branch_priceOnSameday($x){
          include('../../connection.php');
          global $params;
          $sum_price_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_items.branch_id='$x' $params");
           $countRecPrice=$_assoc($sum_price_for_next_day);
          echo number_format($countRecPrice['packagePrice']);
          mysqli_close($main_db);
     }

       function branch_qtyOnStock($x){
          include('../../connection.php');
          global $params;
          $sum_qty_for_next_day=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_items.branch_id='$x' $params");
           $countRecQty=$_assoc($sum_qty_for_next_day);
          echo number_format($countRecQty['qty']);
          mysqli_close($main_db);
     }
          function branch_priceOnStock($x){
          include('../../connection.php');
          global $params;
          $sum_price_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_items.branch_id='$x' $params");
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
                           <h3 style="color:black!important">ລາຍງານພັດສະດຸຄ້າງສາງ<?php echo $title ?>
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
                 ເຄື່ອງຄ້າງສາງທັງໝົດ
                 <?php echo @number_format($sumRecQty['rec_qty'])?> ອັນ / ມູນຄ່າ
                 <?php echo @number_format($sumRecPrice['rec_price'])?> ກີບ
            </li>
            <li class="p-2">
                 ພັດສະດຸທີ່ສົ່ງສຳເລັດ
                 <?php echo number_format($sumRecQtySameday['qty'])?>
                 ອັນ / ມູນຄ່າ
                 <?php echo number_format($sumPriceSameday['packagePrice'])?>
                 ກີບ
            </li>
            <li class="p-2">
                 ພັດສະດຸຄ້າງສາງທັງໝົດ
                 <?php echo number_format($sumTotalQty['qty'])?>
                 ອັນ / ມູນຄ່າ
                 <?php echo number_format($sumTotalPrice['packagePrice'])?>
                 ກີບ
            </li>
       </ul>

       <hr>
       <h3 align="center"><u>ລາຍລະອຽດທັງໝົດ</u></h3>

       <h2># ພາກເໜືອ</h2>
       <table width="100%" id="table">
            <tr>
                 <td width="70px" align="center">#</td>
                 <td>ຊື່ແຂວງ</td>
                 <td>ຈຳນວນເຄື່ອງຮັບເຂົ້າ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຈຳນວນເຄື່ອງສົ່ງສຳເລັດ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຈຳນວນເຄື່ອງຄ້າງສາງ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
            </tr>
            <?php 
            include('../../connection.php');
               $i=1;
               $variable  =mysqli_query($main_db,"SELECT count(id_list) AS qty ,sum(packagePrice)as amount,provinceName,provinceCode,id_state FROM office_state_branches
               LEFT JOIN ans_item_next_day ON ans_item_next_day.destinationStateID=office_state_branches.id_state
               LEFT JOIN ans_items on ans_items.id_item = ans_item_next_day.item_id WHERE office_state_branches.id_state IN (13,14,15,16,17,19,21,22) GROUP BY destinationStateID ORDER BY qty DESC");
               mysqli_close($main_db);
               foreach ($variable as $key) {?>
            <tr>
                 <td align="center"><?php echo $i ?></td>
                 <td> <?php echo $key['provinceName']?></td>
                 <td style="text-align:right"> <?php _countFromProvince($key['id_state'])?></td>
                 <td style="text-align:right"> <?php _sumPriceFromProvince($key['id_state'])?></td>
                 <td style="text-align:right"> <?php qtyOnSameday($key['id_state'])?></td>
                 <td style="text-align:right"> <?php priceOnSameday($key['id_state'])?></td>
                 <td style="text-align:right"> <?php qtyOnStock($key['id_state'])?></td>
                 <td style="text-align:right"> <?php priceOnStock($key['id_state'])?></td>
            </tr>
            <?php 
          include('../../connection.php');
          $x=1;
          $pro_id=$state['id_state'];
          $query_branch_in_state =mysqli_query($main_db,"SELECT count(id_list) as total,branch_id FROM ans_item_next_day 
          LEFT JOIN ans_items ON ans_items.id_item=ans_item_next_day.item_id WHERE ans_item_next_day.destinationStateID='$pro_id'
          GROUP BY branch_id ORDER BY total DESC");
          mysqli_close($main_db);
          foreach ($query_branch_in_state as $for) {?>
            <tr>
                 <td></td>
                 <td style="padding-left:40px"><?php echo $x ?>. <?php _renderBranchName($for['branch_id'])?></td>
                 <td style="text-align:right"><?php _countFromBranch($for['branch_id']) ?></td>
                 <td style="text-align:right"><?php _priceFromBranch($for['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_qtyOnSameday($for['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_priceOnSameday($for['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_qtyOnStock($for['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_priceOnStock($for['branch_id']) ?></td>
            </tr>
            <?php $x++; } $i++;}?>
       </table>
       <h2># ພາກກາງ</h2>
       <table width="100%" id="table">
            <tr>
                 <td width="70px" align="center">#</td>
                 <td>ຊື່ແຂວງ</td>
                 <td>ຈຳນວນເຄື່ອງຮັບເຂົ້າ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຈຳນວນເຄື່ອງສົ່ງສຳເລັດ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຈຳນວນເຄື່ອງຄ້າງສາງ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
            </tr>
            <?php 
            include('../../connection.php');
               $i=1;
               $query_for_state  =mysqli_query($main_db,"SELECT count(id_list) AS qty ,sum(packagePrice)as amount,provinceName,provinceCode,id_state FROM office_state_branches
               LEFT JOIN ans_item_next_day ON ans_item_next_day.destinationStateID=office_state_branches.id_state
               LEFT JOIN ans_items on ans_items.id_item = ans_item_next_day.item_id WHERE office_state_branches.id_state in (1,8,9,18,23) GROUP BY destinationStateID ORDER BY qty DESC");
               mysqli_close($main_db);
               foreach ($query_for_state as $state) {?>
            <tr>
                 <td align="center"><?php echo $i ?></td>
                 <td> <?php echo $state['provinceName']?></td>
                 <td style="text-align:right"> <?php _countFromProvince($state['id_state'])?></td>
                 <td style="text-align:right"> <?php _sumPriceFromProvince($state['id_state'])?></td>
                 <td style="text-align:right"> <?php qtyOnSameday($state['id_state'])?></td>
                 <td style="text-align:right"> <?php priceOnSameday($state['id_state'])?></td>
                 <td style="text-align:right"> <?php qtyOnStock($state['id_state'])?></td>
                 <td style="text-align:right"> <?php priceOnStock($state['id_state'])?></td>
            </tr>
            <?php 
          include('../../connection.php');
          $x=1;
          $pro_id=$state['id_state'];
          $query_branch_in_state =mysqli_query($main_db,"SELECT count(id_list) as total,branch_id FROM ans_item_next_day 
          LEFT JOIN ans_items ON ans_items.id_item=ans_item_next_day.item_id WHERE ans_item_next_day.destinationStateID='$pro_id'
          GROUP BY branch_id ORDER BY total DESC");
          mysqli_close($con);
          foreach ($query_branch_in_state as $result) {?>
            <tr>
                 <td></td>
                 <td style="padding-left:40px"><?php echo $x ?>. <?php _renderBranchName($result['branch_id'])?></td>
                 <td style="text-align:right"><?php _countFromBranch($result['branch_id']) ?></td>
                 <td style="text-align:right"><?php _priceFromBranch($result['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_qtyOnSameday($result['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_priceOnSameday($result['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_qtyOnStock($result['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_priceOnStock($result['branch_id']) ?></td>
            </tr>
            <?php $x++; } $i++;}?>
       </table>
       <h2># ພາກໃຕ້</h2>
       <table width="100%" id="table">
            <tr>
                 <td width="70px" align="center">#</td>
                 <td>ຊື່ແຂວງ</td>
                 <td>ຈຳນວນເຄື່ອງຮັບເຂົ້າ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຈຳນວນເຄື່ອງສົ່ງສຳເລັດ(ອັນ)</td>
                 <td>ມູນຄ່າ(ກີບ)</td>
                 <td>ຈຳນວນເຄື່ອງຄ້າງສາງ(ອັນ)</td>
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
                 <td style="text-align:right"> <?php qtyOnSameday($state['id_state'])?></td>
                 <td style="text-align:right"> <?php priceOnSameday($state['id_state'])?></td>
                 <td style="text-align:right"> <?php qtyOnStock($state['id_state'])?></td>
                 <td style="text-align:right"> <?php priceOnStock($state['id_state'])?></td>
            </tr>
            <?php 
          include('../../connection.php');
          $x=1;
          $proId=$state['id_state'];
          $query_branch_in_state =mysqli_query($main_db,"SELECT count(id_list) as total,branch_id FROM ans_item_next_day 
          LEFT JOIN ans_items ON ans_items.id_item=ans_item_next_day.item_id WHERE ans_item_next_day.destinationStateID='$proId'
          GROUP BY branch_id ORDER BY total DESC");
          mysqli_close($con);
          foreach ($query_branch_in_state as $resultset) {?>
            <tr>
                 <td></td>
                 <td style="padding-left:40px"><?php echo $x ?>. <?php _renderBranchName($resultset['branch_id'])?></td>
                 <td style="text-align:right"><?php _countFromBranch($resultset['branch_id']) ?></td>
                 <td style="text-align:right"><?php _priceFromBranch($resultset['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_qtyOnSameday($resultset['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_priceOnSameday($resultset['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_qtyOnStock($resultset['branch_id']) ?></td>
                 <td style="text-align:right"><?php branch_priceOnStock($resultset['branch_id']) ?></td>
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