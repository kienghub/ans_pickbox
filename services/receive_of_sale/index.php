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
                         <li>
                              <button type="button" ng-click="_onAdd('ເພີ່ມເຄື່ອງເຂົ້າສາງ','./add_receive.php',900,510)"
                                   class="btn btn-primary btn-lg">
                                   <i class="icon-plus-circle"></i> ເອົາເຄື່ອງເຂົ້າສາງ </button>
                         </li>
                    </ul>
               </div>
               <!-- Page header end -->
               <div class="main-container">
                    <div class="row">
                         <div class="col-12">
                              <!-- Row start -->
                              <a href=""></a>
                              <div class="table-container p-4">
                                   <div class="t-header">
                                        <ul class="nav nav-tabs">
                                             <li class="nav-item">
                                                  <a class="nav-link"
                                                       href="../stocks_of_sale/">ເຄື່ອງໃນສາງໃຫຍ່ທັງໝົດ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link active" href="#">ເອົາເຄື່ອງເຂົ້າສາງ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link"
                                                       href="../../services/products_of_sale/">ຈັດການຂໍ້ມູນເຄື່ອງ</a>
                                             </li>
                                        </ul>
                                   </div>
                                   <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-2">
                                             <label for="">ແຕ່ວັນທີ</label>
                                             <input type="text" data-toggle="datepicker" class="form-control"
                                                  ng-model='st_date' id="st_date" value={{st_date}}>
                                        </div>
                                        <div class="col-md-2">
                                             <label for="">ເຖິງວັນທີ</label>
                                             <input type="text" data-toggle="datepicker" class="form-control"
                                                  ng-model="end_date" id="end_date" value={{end_date}}>
                                        </div>
                                        <div class="col-md-2 pt-4">
                                             <a href="#" onClick="onSearch()" class="btn btn-primary mt-2">
                                                  <i class="icon-search"></i> ຄົ້ນຫາ
                                             </a>
                                        </div>
                                        <div class="col-md-2 pt-4">
                                             <a href="#" onclick="_print()" class="btn btn-secondary mt-2">
                                                  <i class="icon-print"></i> ພິມລາຍງານ
                                             </a>
                                        </div>
                                        <div class="col-md-4">
                                             <?php 
                                             include('../../connection.php');
                                                       $st_date=@$_GET['st_date'];
                                                       $end_date=@$_GET['end_date'];
                                                       if(@$_GET['st_date'] && @$_GET['end_date']){
                                                            $params="WHERE rec_date BETWEEN '$st_date' AND '$end_date'";
                                                       }else{
                                                            $params="WHERE rec_date BETWEEN '$subDate' AND '$_today'";
                                                   }

                                                  $callSummaryForReceive=$_sql($con,"SELECT sum(rec_qty) AS recTotal FROM ans_receive_of_sale $params ");
                                                  $receive=$_assoc($callSummaryForReceive);

                                                  $callSummaryForReceivePrice=$_sql($con,"SELECT sum(rec_qty*rec_sprice) AS sprice FROM ans_receive_of_sale $params ");
                                                  $recPrice=$_assoc($callSummaryForReceivePrice);
                                                  mysqli_close($con);
                                             ?>
                                             <ul>
                                                  <li>ຈຳນວນເຄື່ອງທີ່ນຳເຂົ້າ:
                                                       <?php echo number_format($receive['recTotal']) ?> ອັນ
                                                  </li>
                                                  <li>ມູນຄ່າເຄື່ອງທີ່ນຳເຂົ້າ:
                                                       <?php echo number_format($recPrice['sprice'])?>
                                                       ກີບ
                                                  </li>
                                             </ul>
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
                                                       <th style="text-align:center">
                                                       </th>
                                                  </tr>
                                                  <thead>
                                                  <tbody>
                                                       <?php
                                                       include('../../connection.php');
                                                       
                                                       $i=1;
                                                       $payList=mysqli_query($con,"SELECT*FROM ans_receive_of_sale 
                                                       LEFT JOIN ans_production_of_sale ON ans_receive_of_sale.pro_id = ans_production_of_sale.pro_id $params");
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
                                                                 <?php echo number_format($key['rec_sprice'])?></td>
                                                            <td style="text-align:right">
                                                                 <?php echo number_format($key['rec_sprice']*$key['rec_qty'])?>
                                                            </td>
                                                            <td style="text-align:center"><?php echo $key['rec_date']?>
                                                            </td>
                                                            <td><?php echo $key['rec_createdBy']?></td>
                                                            <td style="width:90px!important;text-align:center">
                                                                 <div class="btn-group">
                                                                      <button type="button"
                                                                           ng-click="_onUpdate('ແກ້ໄຂຂໍ້ມູນ','./edit_receive.php?id=<?php echo $key['_id'] ?>',900,510)"
                                                                           class="btn btn-outline-success btn-sm">
                                                                           <i class="icon-edit"></i>
                                                                      </button>
                                                                      <button type="button"
                                                                           ng-click="_onDelete('<?php echo $key['_id'] ?>','<?php echo $key['rec_qty'] ?>','<?php echo $key['pro_id'] ?>')"
                                                                           class="btn btn-outline-danger btn-sm">
                                                                           <i class="icon-trash"></i>
                                                                      </button>
                                                                 </div>
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
                         window.location = './?st_date=' + st_date + '&end_date=' + end_date

                    }

                    $("#stock_of_sale_icon,#stock_of_sale_text,#receive_of_branch").addClass(
                         "text-white"
                    );
                    </script>
</body>

</html>