<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
</head>
<?php 
     include('../../connection.php');
     $callSummaryForReceive=$_sql($con,"SELECT sum(rec_qty) AS recTotal FROM ans_receive_of_sale");
     $receive=$_assoc($callSummaryForReceive);

     $callSummaryForPaylist=$_sql($con,"SELECT sum(req_qty) AS payTotal FROM ans_requirements WHERE req_status='DONE'");
     $res=$_assoc($callSummaryForPaylist);
    mysqli_close($con) 
?>

<body ng-app="app" ng-controller="report_stock_of_sale"
     ng-init="_callStocks('<?php echo $_today ?>','<?php echo $_today ?>');_summary('<?php echo $_today ?>','<?php echo $_today ?>');st_date='<?php echo $_today ?>';end_date='<?php echo $_today ?>'">
     <!-- Page wrapper start -->
     <div class="page-wrapper">
          <?php include('../../components/layout/side-bar.php') ?>
          <!-- Page content start  -->
          <div class="page-content">
               <?php include('../../components/layout/heading.php') ?>
               <!-- Page header start -->
               <div class="page-header">
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item" onclick="window.location='../home/'">ໜ້າຫຼັກ</li>
                         <li class="breadcrumb-item active">ລາຍງານເຄື່ອງຂາຍໃນສາງໃຫຍ່</li>
                    </ol>

                    <ul class="app-actions">

                    </ul>
               </div>
               <!-- Page header end -->
               <div class="main-container">

                    <div class="row">
                         <div class="col-12">
                              <!-- Row start -->
                              <div class="table-container p-4">

                                   <div class="t-header mb-4">
                                        <ul class="nav nav-tabs">
                                             <li class="nav-item">
                                                  <a class="nav-link active" href="#">ເຄື່ອງໃນສາງໃຫຍ່ທັງໝົດ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link" href="../receive_of_sale/">ເອົາເຄື່ອງເຂົ້າສາງ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link"
                                                       href="../../services/products_of_sale/">ຈັດການຂໍ້ມູນເຄື່ອງ</a>
                                             </li>
                                        </ul>
                                   </div>
                                   <div class="row">
                                        <div class="col-md-7">
                                             <ul>
                                                  <li class="mb-3">
                                                       ຈຳນວນຮັບເຂົ້າ
                                                       <span><?php echo number_format($receive['recTotal'])?></span> ອັນ
                                                  </li>
                                                  <li class="mb-3">
                                                       ຈຳນວນເບີກອອກ
                                                       <span><?php echo number_format($res['payTotal'])?></span>
                                                       ອັນ
                                                  </li>
                                                  <li class="mb-3">
                                                       ຈຳນວນຄົງເຫຼືອ
                                                       <span><?php echo number_format($receive['recTotal']-$res['payTotal'])?></span>
                                                       ອັນ
                                                  </li>
                                             </ul>
                                        </div>
                                        <div class="col-md-3">
                                             <button type="button" ng-click="reportAll('ລາຍງານລາຍລະອຽດການເບີກເຄື່ອງທັງໝົດ','paylist_details.php?state=<?php echo $_GET['state'] ?>
                                                       &st_date=<?php echo $subDate ?>
                                                       &end_date=<?php echo $_today ?>',100,100)"
                                                  class="btn btn-primary mt-2">
                                                  <i class="icon-pie-chart"></i>
                                                  ລາຍລະອຽດການເບີກທັງໝົດ
                                             </button>
                                        </div>
                                        <div class="col-md-2">
                                             <a href="#" onclick="_print()" class="btn btn-secondary mt-2">
                                                  <i class="icon-print"></i> ພິມລາຍງານ
                                             </a>
                                        </div>
                                   </div>
                                   <div class="table-responsive mt-3">
                                        <table id="data_table" style="font-size:16px!important"
                                             class="table table-striped table-hover table-sm">
                                             <thead>
                                                  <tr>
                                                       <th class="text-center wrap-text" width='60px'>#</th>
                                                       <th class="text-center wrap-text">ເລກກຳກັບເຄື່ອງ</th>
                                                       <th class="text-center wrap-text">ລາຍການເຄື່ອງ</th>
                                                       <th class="text-center wrap-text">ຫົວໜ່ວຍ</th>
                                                       <th class="text-center wrap-text">ຂະໜາດ</th>
                                                       <th class="text-center wrap-text">ຈຳນວນຮັບເຂົ້າ</th>
                                                       <th class="text-center wrap-text">ຈຳນວນເບີກອອກ</th>
                                                       <th class="text-center wrap-text">ຈຳນວນຄົງເຫຼືອ</th>
                                                  </tr>
                                                  <thead>
                                                  <tbody>
                                                       <?php 
                                                       include('../../connection.php');
                                                       function rectTotal($x){
                                                            global $con;
                                                            global $_assoc;
                                                            $sql=mysqli_query($con,"SELECT SUM(rec_qty)as total From ans_receive_of_sale where pro_id='$x'");
                                                            $result=$_assoc($sql);
                                                            echo number_format($result['total']);
                                                       }
                                                       function payTotal($x){
                                                            global $con;
                                                            global $_assoc;
                                                            $sql=mysqli_query($con,"SELECT sum(req_qty) AS payTotal FROM ans_requirements WHERE req_status='DONE' AND pro_id='$x'");
                                                            $result=$_assoc($sql);
                                                            echo number_format($result['total']);
                                                       }
                                                       $i=1;
                                                       $query=mysqli_query($con,"SELECT*FROM ans_stock_of_sale LEFT JOIN ans_production_of_sale ON ans_stock_of_sale.pro_id=ans_production_of_sale.pro_id GROUP BY ans_stock_of_sale.pro_id");
                                                       foreach ($query as $key ) {?>
                                                       <tr id="row">
                                                            <td style="text-align:center"><?php echo $i ?></td>
                                                            <td style="text-align:center">
                                                                 <?php echo $key['pro_number']?>
                                                            </td>
                                                            <td><?php echo $key['pro_title']?></td>
                                                            <td><?php echo $key['pro_unit']?></td>
                                                            <td><?php echo $key['pro_size']?></td>
                                                            <td style="text-align:right">
                                                                 <?php rectTotal($key['pro_id'])?>
                                                            </td>
                                                            <td style="text-align:right">
                                                                 <?php echo number_format($key['pay_qty']);?></td>
                                                            <td style="text-align:right">
                                                                 <?php echo number_format($key['st_qty']);?>
                                                            </td>
                                                       </tr>
                                                       <?php $i++;} ?>
                                                  </tbody>
                                        </table>

                                   </div>
                              </div>
                              <!-- Row end -->
                         </div>
                    </div>
               </div>
               <!-- Row end -->
          </div>
          <!-- Main container end -->
     </div>

     <!-- Page wrapper end -->
     <?php 
     include('../../components/lib/script.php');
      ?>
     <script src="./app.js"></script>
     <script>
     function _print() {
          var st_date = moment($('#st_date').val()).format("YYYY-MM-DD")
          var end_date = moment($('#end_date').val()).format("YYYY-MM-DD")
          window.open('print.php', '_blank')

     }
     $("#stock_center_icon,#stock_center_text,#stock_center").addClass("text-white");
     </script>
</body>

</html>