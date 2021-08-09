<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
     <?php include('../../connection.php') ?>
     <style>
     .select2-container {
          z-index: 100000;
     }

     .card {
          -webkit-box-shadow: 3px 3px 5px -2px rgba(0, 0, 0, 0.54);
          -moz-box-shadow: 3px 3px 5px -2px rgba(0, 0, 0, 0.54);
          box-shadow: 3px 3px 5px -2px rgba(0, 0, 0, 0.54);
     }
     </style>
</head>

<body ng-app="app" ng-controller="receive_of_sale"
     ng-init="_callMainData();summary();st_date='<?php echo $subDate ?>';end_date='<?php echo $_today ?>';user_holder='<?php echo $_user_fname.' '.$_user_lname ?>';rec_date='<?php echo $_today ?>'">
     <!-- Page wrapper start -->
     <div class="page-wrapper ">
          <?php include('../../components/layout/side-bar.php') ?>
          <!-- Page content start  -->
          <div class="page-content">
               <?php include('../../components/layout/heading.php') ?>
               <!-- Page header start -->
               <div class="page-header">
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item" onclick="window.location='../home/'">ໜ້າຫຼັກ
                         </li>
                         <li class="breadcrumb-item active">ຈັດການລາຍການເຄື່ອງທີ່ນຳເຂົ້າ</li>
                    </ol>
                    <ul class="app-actions">

                    </ul>
               </div>
               <!-- Page header end -->
               <div class="main-container">
                    <?php 
                    include('../../connection.php');
                    //? get total of today
                    $fetch_data_of_today=mysqli_query($con,"SELECT sum(rec_qty)as total FROM ans_receive_of_sale WHERE rec_date='$_today'");
                    $fetch_result_today=mysqli_fetch_assoc($fetch_data_of_today);
                    //? get total of month
                    $fetch_data_of_month=mysqli_query($con,"SELECT sum(rec_qty)as total FROM ans_receive_of_sale WHERE rec_date like'_____$_month%'");
                    $fetch_result_month=mysqli_fetch_assoc($fetch_data_of_month);
                    //? get total of all
                    $fetch_data_of_all=mysqli_query($con,"SELECT sum(rec_qty)as total FROM ans_receive_of_sale");
                    $fetch_result_all=mysqli_fetch_assoc($fetch_data_of_all);

                    ?>
                    <div class="row">
                         <div class="col-12">
                              <div class="row p-3">
                                   <div class="col-md-4">
                                        <div class="card">
                                             <div class="card-header bg-primary">
                                                  <h4 class="text-white">
                                                       <i class="icon-playlist_add"></i>
                                                       ເຄື່ອງເຂົ້າສາງມື້ນີ້
                                                  </h4>
                                             </div>
                                             <div class="card-body text-center">
                                                  <h3><?php echo @number_format($fetch_result_today['total'])?> ອັນ</h3>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="card">
                                             <div class="card-header bg-primary">
                                                  <h4 class="text-white">
                                                       <i class="icon-playlist_add"></i>
                                                       ເຄື່ອງເຂົ້າສາງເດືອນນີ້
                                                  </h4>
                                             </div>
                                             <div class="card-body text-center">
                                                  <h3><?php echo @number_format($fetch_result_month['total'])?> ອັນ</h3>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="card">
                                             <div class="card-header bg-primary">
                                                  <h4 class="text-white">
                                                       <i class="icon-playlist_add"></i>
                                                       ເຄື່ອງເຂົ້າສາງທັງໝົດ
                                                  </h4>
                                             </div>
                                             <div class="card-body text-center">
                                                  <h3><?php echo @number_format($fetch_result_all['total'])?> ອັນ</h3>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <?php
                                   include('../../connection.php');
                                   $userName=$_permission['first_name'].' '.$_permission['last_name'];
                                   $st_date=@$_GET['st_date'];
                                   $end_date=@$_GET['end_date'];
                                   
                                   if(@$_GET['st_date'] && @$_GET['end_date']){
                                        $params="AND rec_date BETWEEN '$st_date' AND '$end_date'";
                                   }else{
                                        $params="AND rec_date BETWEEN '$subDate' AND '$_today'";
                                   }
                                   $callSummaryForReceive=$_sql($con,"SELECT sum(rec_qty) AS recTotal FROM ans_receive_of_sale WHERE rec_createdBy='$userName' $params");
                                   $receive=$_assoc($callSummaryForReceive);

                                   $callSummaryForReceivePrice=$_sql($con,"SELECT sum(rec_qty*rec_sprice) AS sprice FROM ans_receive_of_sale WHERE rec_createdBy='$userName' $params");
                                   $recPrice=$_assoc($callSummaryForReceivePrice);
                                   mysqli_close($con);
                                   ?>
                              <div class="table-container p-4" style="margin-top:-90px">
                                   <div class="t-header">
                                        <div class="row" style="margin-top:80px">
                                             <div class="col-md-3">
                                                  <label for="">ແຕ່ວັນທີ</label>
                                                  <input type="date" class="form-control" ng-model='st_date'
                                                       id="st_date" value={{st_date}}>
                                             </div>
                                             <div class="col-md-3">
                                                  <label for="">ເຖິງວັນທີ</label>
                                                  <input type="date" class="form-control" ng-model="end_date"
                                                       id="end_date" value={{end_date}}>
                                             </div>
                                             <div class="col-md-2 pt-4">
                                                  <a href="#" onclick="onSearch()" class="btn btn-primary mt-2">
                                                       <i class="icon-search"></i> ຄົ້ນຫາ
                                                  </a>
                                             </div>
                                             <div class="col-md-4 pt-4 text-right">
                                                  <a href="#" onclick="_print()" class="btn btn-secondary mt-2">
                                                       <i class="icon-print"></i> ພິມລາຍງານ
                                                  </a>
                                             </div>
                                        </div>
                                        <div class="table-responsive mt-4">
                                             <table id="data_table" class="table table-striped table-hover table-sm">
                                                  <thead>
                                                       <tr>
                                                            <th class=" text-center" width='50px'>#</th>
                                                            <th style="text-align:center">ເລກກຳກັບເຄື່ອງ</th>
                                                            <th style="text-align:center">ລາຍການເຄື່ອງ</th>
                                                            <th style="text-align:center">ຫົວໜວ່ຍ</th>
                                                            <th style="text-align:center">ຂະໜາດ</th>
                                                            <th style="text-align:center">ຈຳນວນ</th>
                                                            <th style="text-align:center">ມູນຄ່າ</th>
                                                            <th style="text-align:center">ເປັນເງິນ</th>
                                                            <th style="text-align:center">ວັນທີ່ນຳເຂົ້າ</th>
                                                            <th style="text-align:center">ຜູ້ນຳເຂົ້າ</th>
                                                            <th style="text-align:center"></th>
                                                       </tr>
                                                       <thead>
                                                       <tbody>
                                                            <?php
                                                       include('../../connection.php');
                                                       $i=1;
                                                       $st_date=@$_GET['st_date'];
                                                       $end_date=@$_GET['end_date'];
                                                       if(@$_GET['st_date'] && @$_GET['end_date']){
                                                            $params="AND rec_date BETWEEN '$st_date' AND '$end_date'";
                                                       }else{
                                                            
                                                           $params="AND rec_date BETWEEN '$subDate' AND '$_today'";
                                                       }

                                                       $payList=mysqli_query($con,"SELECT*FROM ans_receive_of_sale 
                                                       LEFT JOIN ans_production_of_sale ON ans_receive_of_sale.pro_id = ans_production_of_sale.pro_id WHERE rec_createdBy='$userName' $params");
                                                       foreach ($payList as $key) { ?>
                                                            <tr>
                                                                 <td style="text-align:center"><?php echo $i ?></td>
                                                                 <td style="text-align:center">
                                                                      <?php echo $key['pro_number']?></td>
                                                                 <td><?php echo $key['pro_title']?></td>
                                                                 <td><?php echo $key['pro_unit']?></td>
                                                                 <td><?php echo $key['pro_size']?></td>
                                                                 <td style="text-align:right">
                                                                      <?php echo number_format($key['rec_qty'])?> </td>
                                                                 <td style="text-align:right">
                                                                      <?php echo number_format($key['rec_sprice'])?>
                                                                 </td>
                                                                 <td style="text-align:right">
                                                                      <?php echo number_format($key['rec_sprice']*$key['rec_qty'])?>
                                                                 </td>
                                                                 <td style="text-align:center">
                                                                      <?php echo $key['rec_date']?>
                                                                 </td>
                                                                 <td><?php echo $key['rec_createdBy']?> </td>
                                                                 <td>
                                                                      <button type="button"
                                                                           ng-click="_onDelete('<?php echo $key['_id'] ?>','<?php echo $key['rec_qty'] ?>','<?php echo $key['pro_id'] ?>')"
                                                                           class="btn btn-outline-danger btn-sm">
                                                                           <i class="icon-trash"></i>
                                                                      </button>
                                                                 </td>
                                                            </tr>
                                                            <?php $i++;} ?>
                                                       </tbody>
                                             </table>
                                        </div>
                                   </div>
                                   <!-- Row end -->
                              </div>
                              <!-- Main container end -->
                         </div>
                         <!-- Page content end -->
                         <?php include('../../components/lib/script.php') ?>
                         <script src="./app.js"></script>
                         <script>
                         function _print() {
                              var st_date = moment($('#st_date').val()).format("YYYY-MM-DD")
                              var end_date = moment($('#end_date').val()).format("YYYY-MM-DD")
                              window.open('print.php?st_date=' + st_date + '&end_date=' + end_date, '_blank')

                         }

                         function onSearch() {
                              var st_date = moment($('#st_date').val()).format("YYYY-MM-DD")
                              var end_date = moment($('#end_date').val()).format("YYYY-MM-DD")
                              window.location = 'report.php?st_date=' + st_date + '&end_date=' + end_date

                         }

                         $("#stock_of_sale_icon,#stock_of_sale_text,#report_receive").addClass(
                              "text-white"
                         );
                         </script>
</body>

</html>