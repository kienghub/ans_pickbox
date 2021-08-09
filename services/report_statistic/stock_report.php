<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
     <?php include('./sql/index.php') ?>
     <?php _active('.statistic') ?>
     <?php sub_active('.report_stock') ?>

     <style>
     #sublist {
          cursor: pointer;
     }

     @media print {
          tr td {

               padding: 3px;
               font-size: 14px;
          }
     }

     .accordion-container,
     .accordion-header {
          border-bottom: none !important;
     }
     </style>
</head>

<body ng-app="app" ng-controller="report" ng-init="_callStateBranch()">
     <!-- Page wrapper start -->
     <div class="page-wrapper">
          <?php include('../../components/layout/side-bar.php') ?>
          <!-- Page content start  -->
          <div class="page-content">
               <?php include('../../components/layout/heading.php') ?>
               <!-- Page header start -->
               <div class="page-header">
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item" onclick="window.location='#'">ໝວດສະຖິຕິພັດສະດຸ</li>
                         <li class="breadcrumb-item active">ລາຍງານພັດສະດຸທີ່ຄ້າງສາງ</li>
                    </ol>
                    <ul class="app-actions">
                         <li>
                              <a href="#" id="reportrange">
                                   <?php echo $_todayformatAT ?> <div id="MyClockDisplay" class="clock"
                                        onload="showTime()">
                                   </div>
                              </a>
                         </li>
                         <li data-toggle="tooltip" data-placement="left" title="ກັບຄືນ">
                              <a href="" onclick="window.history.go(-1)">
                                   <i class="icon-forward"></i>
                              </a>
                         </li>
                    </ul>
               </div>
               <?php 
               include('../../connection.php');
               $st_date=strtotime($_GET['start_date']);
               $end_date=strtotime($_GET['end_date']);
          if($_GET['start_date']=="" & $_GET['end_date']==""){
               $params="";
               $print="";
          }else{
               $params="AND ans_items.receiveDate BETWEEN '$st_date' AND '$end_date'";
               $print="?start_date=$st_date&end_date=$end_date";
          }
               // SUM QTY RECEIVE
               $sum_statistic_for_next_day=$_sql($main_db,"SELECT count(id_list) as rec_qty FROM ans_item_next_day 
                                                  LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_item_next_day.status_id=3 $params");
               $sumRecQty=$_assoc($sum_statistic_for_next_day);

               // SUM PRICE RECEIVE
               $sum_price_statistic_for_next_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as rec_price FROM ans_item_next_day 
                                                  LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_item_next_day.status_id=3 $params");
               $sumRecPrice=$_assoc($sum_price_statistic_for_next_day);

                // SUM QTY RECEIVE
               $sum_statistic_for_same_day=$_sql($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                                  LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_item_next_day.status_id=5 $params");
               $sumRecQtySameday=$_assoc($sum_statistic_for_same_day);
                // SUM PRICE RECEIVE
               $sum_price_for_same_day=$_sql($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                                                 LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_item_next_day.status_id=5 $params");
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

// FUNCTION
     function _countFromProvince($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_item_next_day.destinationStateID='$x' $params");
          $res=$_assoc($query);
          echo @number_format($res['qty']);
          mysqli_close($main_db);
     }
     
     function _sumPriceFromProvince($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_item_next_day.destinationStateID='$x' $params");
          $res=$_assoc($query);
          echo @number_format($res['packagePrice']);
          mysqli_close($main_db);
     }

     function _percentFromProvince($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_item_next_day.destinationStateID='$x' $params");
          $res=$_assoc($query);
          $total=$res['qty'];
          echo @number_format($total);
          mysqli_close($main_db);
     }

        function _countFromBranch($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_items.original_branch_id='$x' $params");
          $res=$_assoc($query);
          echo @number_format($res['qty']);
          mysqli_close($main_db);
     }
           function _percentFromBranch($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT count(id_list) as qty FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_items.original_branch_id='$x' $params");
          $res=$_assoc($query);
          echo @number_format($res['qty']);
          mysqli_close($main_db);
     }
           function _priceFromBranch($x){
          include('../../connection.php');
          global $params;
          $query=mysqli_query($main_db,"SELECT sum(ans_item_next_day.packagePrice) as packagePrice FROM ans_item_next_day 
                                        LEFT JOIN ans_items ON ans_items.id_item = ans_item_next_day.item_id WHERE ans_items.branch_id !=ans_items.original_branch_id AND ans_items.original_branch_id='$x' $params");
          $res=$_assoc($query);
          echo @number_format($res['packagePrice']);
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
               <div class="main-container">
                    <div class="row">
                         <div class="col-md-12">
                              <div class="blog p-4">
                                   <div class="col-md-12 p-4">
                                        <div class="date_search">
                                             <div class="row">
                                                  <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 mt-2">
                                                       <a href="./stock_report.php"
                                                            class="btn btn-primary mt-4">ທັງໝົດ</a>
                                                  </div>

                                                  <div class="col-md-2">
                                                       <label for="">ວັນທີ</label>
                                                       <input type="date" class="form-control" id="start_date"
                                                            onchange="_searchDate()"
                                                            value="<?php if($_GET['start_date']==""){ echo $_today;}else{ echo $_GET['start_date'];} ?>">
                                                  </div>
                                                  <div class="col-md-2">
                                                       <label for="">ເຖິງວັນທີ</label>
                                                       <input type="date" class="form-control" id="end_date"
                                                            onchange="_searchDate()"
                                                            value="<?php if($_GET['end_date']==""){ echo $_today;}else{ echo $_GET['end_date'];} ?>">
                                                  </div>
                                                  <div class="col-md-5"></div>
                                                  <div class="col-md-2">
                                                       <label for=""></label>
                                                       <a href="./print_stock.php<?php echo $print ?>" target="_blank"
                                                            class="btn btn-block btn-secondary btn-lg mt-2">
                                                            <h6 class="text-white"> <i class="icon-print"></i> ພິມລາຍງານ
                                                            </h6>
                                                       </a>
                                                  </div>
                                             </div>
                                        </div>
                                        <br>
                                   </div>
                                   <div class="row gutters">
                                        <div class="col-7 p-4">
                                             <ul>
                                                  <li class="p-2">
                                                       ເຄື່ອງເຂົ້າສາງທັງໝົດ
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
                                        </div>
                                        <div class="col-5">
                                             <div class="card">
                                                  <div class="card-header">
                                                       <div class="card-title"></div>
                                                  </div>
                                                  <div class="card-body">
                                                       <div id="basic-pie-graph"></div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <h3 class="text-center"><u>ລາຍງານພັດສະດຸຄ້າງສາງ</u></h3>
                                   <ul class="p-4">
                                        <li>
                                             <h4><i class="icon-location_city"></i> ພາກເໜືອ</h4>
                                             <ul>
                                                  <li class="pl-4">
                                                       <?php include('../../connection.php');
                                                       $i=1;
                                                       $variable  =mysqli_query($main_db,"SELECT count(id_list) AS qty ,sum(packagePrice)as amount,provinceName,provinceCode,id_state FROM office_state_branches
                                                       LEFT JOIN ans_item_next_day ON ans_item_next_day.destinationStateID=office_state_branches.id_state
                                                       LEFT JOIN ans_items on ans_items.id_item = ans_item_next_day.item_id WHERE office_state_branches.id_state IN (13,14,15,16,17,19,21,22) GROUP BY destinationStateID ORDER BY qty DESC");
                                                       mysqli_close($main_db);
                                                       foreach ($variable as $key) {?>
                                                       <div class="accordion toggle-icons" id="toggleIcons">
                                                            <div class="accordion-container mt-3">
                                                                 <div class="accordion-header" id="toggleIconsOne">
                                                                      <a href="#" class="" data-toggle="collapse"
                                                                           data-target="#<?php echo $key['provinceCode']?>"
                                                                           aria-expanded="true"
                                                                           aria-controls="toggleIconsCollapseOne">
                                                                           <div class="agent-details">
                                                                                <div class="top-agents-container"
                                                                                     id="main">
                                                                                     <div class="top-agent"
                                                                                          id="sublist">
                                                                                          <div class="agent-details">
                                                                                               <h5>
                                                                                                    <i
                                                                                                         class="icon-pin_drop"></i>
                                                                                                    <?php echo $key['provinceName']?>
                                                                                               </h5>
                                                                                               <div class="agent-score">
                                                                                                    <div
                                                                                                         class="row points">
                                                                                                         <div
                                                                                                              class="col-3 ml-5">
                                                                                                         </div>
                                                                                                         <div
                                                                                                              class="col-4 text-center">
                                                                                                              <?php _percentFromProvince($key['id_state']) ?>%
                                                                                                         </div>
                                                                                                         <div
                                                                                                              class="col-4 text-right pr-5">
                                                                                                              <?php _countFromProvince($key['id_state'])?>
                                                                                                              ອັນ /
                                                                                                              ມູນຄ່າ
                                                                                                              <?php _sumPriceFromProvince($key['id_state'])?>
                                                                                                              ກີບ
                                                                                                         </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                         class="progress">
                                                                                                         <div class="progress-bar bg-primary"
                                                                                                              role="progressbar"
                                                                                                              style="width:<?php _percentFromProvince($key['id_state']) ?>%"
                                                                                                              aria-valuenow="100"
                                                                                                              aria-valuemin="0"
                                                                                                              aria-valuemax="100">
                                                                                                         </div>
                                                                                                    </div>

                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                      </a>
                                                                 </div>
                                                                 <div id="<?php echo $key['provinceCode']?>"
                                                                      class="collapse" aria-labelledby="toggleIconsOne"
                                                                      data-parent="#toggleIcons">
                                                                      <div class="accordion-body">
                                                                           <div class="top-agents-container" id="main">
                                                                                <?php 
                                                                                include('../../connection.php');
                                                                                $pro_id=$key['id_state'];
                                                                                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
                                                                                $query_branch_in_state  =mysqli_query($main_db,"SELECT count(id_list) as total,branch_id FROM ans_item_next_day 
                                                                                LEFT JOIN ans_items ON ans_items.id_item=ans_item_next_day.item_id WHERE ans_item_next_day.destinationStateID='$pro_id'
                                                                                GROUP BY branch_id ORDER BY total DESC");
                                                                                mysqli_close($main_db);
                                                                                foreach ($query_branch_in_state as $res) {?>
                                                                                <div class="top-agent" id="sublist">
                                                                                     <div class="agent-details">
                                                                                          <h5><?php _renderBranchName($res['branch_id'])?>
                                                                                          </h5>
                                                                                          <div class="agent-score">
                                                                                               <div class="progress">
                                                                                                    <div class="progress-bar bg-success"
                                                                                                         role="progressbar"
                                                                                                         style="width:<?php _percentFromBranch($res['branch_id']) ?>%"
                                                                                                         aria-valuenow="100"
                                                                                                         aria-valuemin="0"
                                                                                                         aria-valuemax="100">
                                                                                                    </div>
                                                                                               </div>
                                                                                               <div class="points">
                                                                                                    <div class="left">
                                                                                                         ຈຳນວນເຄື່ອງຄ້າງສາງທັງໝົດ
                                                                                                         <?php _countFromBranch($res['branch_id'])?>
                                                                                                         ອັນ
                                                                                                    </div>
                                                                                                    <div class="left">
                                                                                                         ມູນຄ່າ
                                                                                                         <?php _priceFromBranch($res['branch_id'])?>
                                                                                                         ກີບ
                                                                                                    </div>
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                                <?php } ?>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <?php $i++; } ?>
                                                  </li>
                                             </ul>
                                        </li>
                                        <li>
                                             <h4 class="mt-4">
                                                  <i class="icon-location_city"></i> ພາກກາງ
                                             </h4>
                                             <ul>
                                                  <li class="pl-4">
                                                       <?php include('../../connection.php');
                                                       $i=1;
                                                       $variable2  =mysqli_query($main_db,"SELECT count(id_list) AS qty ,sum(packagePrice)as amount,provinceName,provinceCode,id_state FROM office_state_branches
                                                       LEFT JOIN ans_item_next_day ON ans_item_next_day.destinationStateID=office_state_branches.id_state
                                                       LEFT JOIN ans_items on ans_items.id_item = ans_item_next_day.item_id WHERE office_state_branches.id_state IN (1,8,9,18,23) GROUP BY destinationStateID ORDER BY qty DESC");
                                                       mysqli_close($main_db);
                                                       foreach ($variable2 as $pro) {?>
                                                       <div class="accordion toggle-icons" id="toggleIcons">
                                                            <div class="accordion-container mt-3">
                                                                 <div class="accordion-header" id="toggleIconsOne">
                                                                      <a href="#" class="" data-toggle="collapse"
                                                                           data-target="#<?php echo $pro['provinceCode']?>"
                                                                           aria-expanded="true"
                                                                           aria-controls="toggleIconsCollapseOne">
                                                                           <div class="agent-details">
                                                                                <div class="top-agents-container"
                                                                                     id="main">
                                                                                     <div class="top-agent"
                                                                                          id="sublist">
                                                                                          <div class="agent-details">
                                                                                               <h5>
                                                                                                    <i
                                                                                                         class="icon-pin_drop"></i>
                                                                                                    <?php echo $pro['provinceName']?>
                                                                                               </h5>
                                                                                               <div class="agent-score">
                                                                                                    <div
                                                                                                         class="row points">
                                                                                                         <div
                                                                                                              class="col-3 ml-5">
                                                                                                         </div>
                                                                                                         <div
                                                                                                              class="col-4 text-center">
                                                                                                              <?php _percentFromProvince($pro['id_state']) ?>
                                                                                                              %
                                                                                                         </div>
                                                                                                         <div
                                                                                                              class="col-4 text-right pr-5">
                                                                                                              <?php _countFromProvince($pro['id_state'])?>
                                                                                                              ອັນ /
                                                                                                              ມູນຄ່າ
                                                                                                              <?php _sumPriceFromProvince($pro['id_state'])?>
                                                                                                              ກີບ
                                                                                                         </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                         class="progress">
                                                                                                         <div class="progress-bar bg-primary"
                                                                                                              role="progressbar"
                                                                                                              style="width:<?php _percentFromProvince($pro['id_state']) ?>%"
                                                                                                              aria-valuenow="100"
                                                                                                              aria-valuemin="0"
                                                                                                              aria-valuemax="100">
                                                                                                         </div>
                                                                                                    </div>

                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                      </a>
                                                                 </div>
                                                                 <div id="<?php echo $pro['provinceCode']?>"
                                                                      class="collapse" aria-labelledby="toggleIconsOne"
                                                                      data-parent="#toggleIcons">
                                                                      <div class="accordion-body">
                                                                           <div class="top-agents-container" id="main">
                                                                                <?php 
                                                                                include('../../connection.php');
                                                                                $pro_id=$pro['id_state'];
                                                                                if($pro['id_state']==""){
                                                                                     $proId="";
                                                                                }else{
                                                                                     $proId="WHERE ans_item_next_day.destinationStateID='$pro_id'";
                                                                                };
                                                                                $query_branch_in_state  =mysqli_query($main_db,"SELECT count(id_list) as total,branch_id FROM ans_item_next_day 
                                                                                LEFT JOIN ans_items ON ans_items.id_item=ans_item_next_day.item_id $proId
                                                                                GROUP BY branch_id ORDER BY total DESC");
                                                                                mysqli_close($main_db);
                                                                                foreach ($query_branch_in_state as $res) {?>
                                                                                <div class="top-agent" id="sublist">
                                                                                     <div class="agent-details">
                                                                                          <h5><?php _renderBranchName($res['branch_id'])?>
                                                                                          </h5>
                                                                                          <div class="agent-score">
                                                                                               <div class="progress">
                                                                                                    <div class="progress-bar bg-success"
                                                                                                         role="progressbar"
                                                                                                         style="width: <?php _percentFromBranch($res['branch_id']) ?>%"
                                                                                                         aria-valuenow="100"
                                                                                                         aria-valuemin="0"
                                                                                                         aria-valuemax="100">
                                                                                                    </div>
                                                                                               </div>
                                                                                               <div class="points">
                                                                                                    <div class="left">
                                                                                                         ຈຳນວນເຄື່ອງຄ້າງສາງທັງໝົດ
                                                                                                         <?php _countFromBranch($res['branch_id'])?>
                                                                                                         ອັນ
                                                                                                    </div>
                                                                                                    <div class="left">
                                                                                                         ມູນຄ່າ
                                                                                                         <?php _priceFromBranch($res['branch_id'])?>
                                                                                                         ກີບ
                                                                                                    </div>
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                                <?php } ?>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <?php $i++; } ?>
                                                  </li>
                                             </ul>
                                        </li>

                                        <li>
                                             <h4 class="mt-4"><i class="icon-location_city"></i> ພາກໃຕ້</h4>
                                             <ul>
                                                  <li class="pl-4">
                                                       <?php include('../../connection.php');
                                                       $i=1;
                                                       $variable3  =mysqli_query($main_db,"SELECT count(id_list) AS qty ,sum(packagePrice)as amount,provinceName,provinceCode,id_state FROM office_state_branches
                                                       LEFT JOIN ans_item_next_day ON ans_item_next_day.destinationStateID=office_state_branches.id_state
                                                       LEFT JOIN ans_items on ans_items.id_item = ans_item_next_day.item_id WHERE office_state_branches.id_state IN (3,5,10,11,12) GROUP BY destinationStateID ORDER BY qty DESC");
                                                       mysqli_close($main_db);
                                                       foreach ($variable3 as $state) {?>
                                                       <div class="accordion toggle-icons" id="toggleIcons">
                                                            <div class="accordion-container mt-3">
                                                                 <div class="accordion-header" id="toggleIconsOne">
                                                                      <a href="#" class="" data-toggle="collapse"
                                                                           data-target="#<?php echo $state['provinceCode']?>"
                                                                           aria-expanded="true"
                                                                           aria-controls="toggleIconsCollapseOne">
                                                                           <div class="agent-details">
                                                                                <div class="top-agents-container"
                                                                                     id="main">
                                                                                     <div class="top-agent"
                                                                                          id="sublist">
                                                                                          <div class="agent-details">
                                                                                               <h5>
                                                                                                    <i
                                                                                                         class="icon-pin_drop"></i>
                                                                                                    <?php echo $state['provinceName']?>
                                                                                               </h5>
                                                                                               <div class="agent-score">
                                                                                                    <div
                                                                                                         class="row points">
                                                                                                         <div
                                                                                                              class="col-3 ml-5">
                                                                                                         </div>
                                                                                                         <div
                                                                                                              class="col-4 text-center">
                                                                                                              <?php _percentFromProvince($state['id_state']) ?>%
                                                                                                         </div>
                                                                                                         <div
                                                                                                              class="col-4 text-right pr-5">
                                                                                                              <?php _countFromProvince($state['id_state'])?>
                                                                                                              ອັນ
                                                                                                              / ມູນຄ່າ
                                                                                                              <?php _sumPriceFromProvince($state['id_state'])?>
                                                                                                              ກີບ
                                                                                                         </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                         class="progress">
                                                                                                         <div class="progress-bar bg-primary"
                                                                                                              role="progressbar"
                                                                                                              style="width: <?php _percentFromProvince($state['id_state']) ?>%"
                                                                                                              aria-valuenow="100"
                                                                                                              aria-valuemin="0"
                                                                                                              aria-valuemax="100">
                                                                                                         </div>
                                                                                                    </div>

                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                      </a>
                                                                 </div>
                                                                 <div id="<?php echo $state['provinceCode']?>"
                                                                      class="collapse" aria-labelledby="toggleIconsOne"
                                                                      data-parent="#toggleIcons">
                                                                      <div class="accordion-body">
                                                                           <div class="top-agents-container" id="main">
                                                                                <?php 
                                                                                include('../../connection.php');
                                                                                $province_id=$state['id_state'];
                                                                                $query_branch_in_state  =mysqli_query($main_db,"SELECT count(id_list) as total,branch_id FROM ans_item_next_day 
                                                                                LEFT JOIN ans_items ON ans_items.id_item=ans_item_next_day.item_id WHERE ans_item_next_day.destinationStateID='$province_id'
                                                                                GROUP BY branch_id ORDER BY total DESC");
                                                                                 mysqli_close($main_db);
                                                                                foreach ($query_branch_in_state as $res) {?>
                                                                                <div class="top-agent" id="sublist">
                                                                                     <div class="agent-details">
                                                                                          <h5><?php _renderBranchName($res['branch_id'])?>
                                                                                          </h5>
                                                                                          <div class="agent-score">
                                                                                               <div class="progress">
                                                                                                    <div class="progress-bar bg-success"
                                                                                                         role="progressbar"
                                                                                                         style="width: <?php _percentFromBranch($res['branch_id'])?>%"
                                                                                                         aria-valuenow="100"
                                                                                                         aria-valuemin="0"
                                                                                                         aria-valuemax="100">
                                                                                                    </div>
                                                                                               </div>
                                                                                               <div class="points">
                                                                                                    <div class="left">
                                                                                                         ຈຳນວນເຄື່ອງຄ້າງສາງທັງໝົດ
                                                                                                         <?php _countFromBranch($res['branch_id'])?>
                                                                                                         ອັນ
                                                                                                    </div>
                                                                                                    <div class="left">
                                                                                                         ມູນຄ່າ
                                                                                                         <?php _priceFromBranch($res['branch_id'])?>
                                                                                                         ກີບ
                                                                                                    </div>
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                                <?php } ?>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <?php $i++; } ?>
                                                  </li>
                                             </ul>
                                        </li>
                                   </ul>
                              </div>
                         </div>
                    </div>
                    <!-- Row end -->
               </div>
               <!-- Main container end -->
          </div>
          <!-- Page content end -->
          <?php include('../../components/lib/script.php') ?>
          <script src="app.js"></script>
          <script>
          var options = {
               chart: {
                    width: 400,
                    type: "pie"
               },
               labels: [
                    "ຈຳນວນນຳເຂົ້າທັງມົດ",
                    "ຈຳນວນສົ່ງອອກທັງມົດ",
                    "ຈຳນວນຄ້າງສາງທັງໝົດ"
               ],
               series: [
                    <?php echo $sumRecQty['rec_qty']?>,
                    <?php echo $sumRecQtySameday['qty']?>,
                    <?php echo $sumTotalQty['qty']?>
               ],
               responsive: [{
                    breakpoint: 480,
                    options: {
                         chart: {
                              width: 200
                         },
                         legend: {
                              position: "bottom"
                         }
                    }
               }],
               stroke: {
                    width: 0
               },
               colors: ["#aa0000", "#fcc419", "#37b24d", "#ff3333", "#ff7777"]
          };
          var chart = new ApexCharts(document.querySelector("#basic-pie-graph"), options);
          chart.render();
          </script>




</body>

</html>