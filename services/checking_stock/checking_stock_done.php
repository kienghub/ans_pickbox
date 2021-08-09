<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
</head>
<?php 
     include('../../connection.php');
     $_SESSION['st_date']=$_GET['st_date'];
     $_SESSION['end_date']=$_GET['end_date'];

     $st_date=$_GET['st_date']=$_SESSION['st_date'];
     $end_date=$_GET['end_date']=$_SESSION['end_date'];
     $state=$_SESSION['state']=$_GET['state'];

     $callSummarySaleQty=$_sql($con,"SELECT sum(s_qty) AS sale_qty FROM ans_sale WHERE s_status=0 AND s_date BETWEEN '$st_date' AND '$end_date'");
     $sale_qty=$_assoc($callSummarySaleQty);

     $callSummaryPrice=$_sql($con,"SELECT sum(s_qty*sprice) AS price FROM ans_sale WHERE s_status=0 AND s_date BETWEEN '$st_date' AND '$end_date'");
     $_price=$_assoc($callSummaryPrice);
    mysqli_close($con) 
?>

<body ng-app="app" ng-controller="delivered" ng-init="
     st_date='<?php echo $st_date ?>';
     end_date='<?php echo $end_date ?>'">
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
                         <li class="breadcrumb-item active">ກວດສອບເຄື່ອງໃນສາງ</li>
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
                                                  <a class="nav-link"
                                                       href="./checking_request.php">ກວດສອບການຂໍເບີກເຄື່ອງ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link"
                                                       href="./checking_stock_of_sale.php">ກວດສອບການສົ່ງມອບການຂາຍ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link"
                                                       href="./checking_done.php?st_date=<?php echo $subDate ?>&end_date=<?php echo $_today ?>">ກວດສອບການເບີກສຳເລັດ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link active" href="#">ກວດສອບການສົ່ງມອບສຳເລັດ</a>
                                             </li>
                                        </ul>
                                   </div>
                                   <div class="row">
                                        <div class="col-md-4">
                                             <ul>
                                                  <li class="mb-3">
                                                       ຈຳນວນຂາຍອອກ
                                                       <span><?php echo number_format($sale_qty['sale_qty'])?></span>
                                                       ອັນ
                                                  </li>

                                                  <li class="mb-3">
                                                       ລວມຈຳນວນເງິນທີ່ຂາຍໄດ້
                                                       <span><?php echo number_format($_price['price'])?></span>
                                                       ກີບ
                                                  </li>
                                             </ul>
                                        </div>

                                        <div class="col-md-2">
                                             <label for="">ແຕ່ວັນທີ</label>
                                             <input type="text" data-toggle="datepicker" class="form-control"
                                                  id='st_date' ng-model="st_date" value={{st_date}}>
                                        </div>
                                        <div class="col-md-2">
                                             <label for="">ເຖິງວັນທີ</label>
                                             <input type="text" data-toggle="datepicker" class="form-control"
                                                  id="end_date" ng-model="end_date" value={{end_date}}>
                                        </div>
                                        <div class="col-md-2 pt-4">
                                             <label for=""></label>
                                             <a href="#" onclick="onSearch()" class="btn btn-primary mt-2">
                                                  <i class="icon-search"></i> ຄົ້ນຫາ
                                             </a>
                                        </div>
                                   </div>
                                   <div class="table-responsive mt-3">
                                        <table id="data" class="table table-striped table-hover table-sm">
                                             <thead>
                                                  <tr style="background-color:#c92a2a;color:white">
                                                       <th style="text-align:center" width='50px'>#</th>
                                                       <th style="text-align:center">ເລກກຳກັບເຄື່ອງ</th>
                                                       <th style="text-align:center">ລາຍການເຄື່ອງ</th>
                                                       <th style="text-align:center">ຫົວໜ່ວຍ</th>
                                                       <th style="text-align:center">ຂະໜາດ</th>
                                                       <th style="text-align:center">ຈຳນວນ</th>
                                                       <th style="text-align:center">ລາຄາ</th>
                                                       <th style="text-align:center">ເປັນມູນຄ່າ</th>
                                                       <th style="text-align:center">ຜູ້ຂາຍ</th>
                                                       <th style="text-align:center">ວັນທີ່ຂາຍ</th>
                                                  </tr>
                                                  <thead>
                                                  <tbody>
                                                       <?php
                                                       include('../../connection.php');
                                                       $sql=mysqli_query($con,"SELECT SUM(s_qty)as qtyTotal FROM ans_sale WHERE s_status=0  AND s_date BETWEEN '$st_date' AND '$end_date'");
                                                       $subTotal=$_assoc($sql);
                                                       $sumAllPrice=mysqli_query($con,"SELECT SUM(s_qty*sprice)AS priceTotal FROM ans_sale  WHERE s_status=0  AND s_date BETWEEN '$st_date' AND '$end_date'");
                                                       $sumTotal=$_assoc($sumAllPrice);

                                                       function sumQty($x){
                                                            include('../../connection.php');
                                                            global $st_date;
                                                            global $end_date;
                                                            $sql=mysqli_query($con,"SELECT SUM(s_qty)AS qtyTotal FROM ans_sale WHERE s_status=0 AND branch_id='$x' AND s_date BETWEEN '$st_date' AND '$end_date'");
                                                            $res=$_assoc($sql);
                                                            echo number_format($res['qtyTotal']);
                                                            mysqli_close($con);
                                                       }
                                                       function sumPrice($x){
                                                            global $st_date;
                                                            global $end_date;
                                                            include('../../connection.php');
                                                            $sql=mysqli_query($con,"SELECT SUM(s_qty*sprice)AS priceTotal FROM ans_sale WHERE s_status=0 AND ans_sale.branch_id='$x' AND s_date BETWEEN '$st_date' AND '$end_date'");
                                                            $res=$_assoc($sql);
                                                            echo number_format($res['priceTotal']);
                                                            mysqli_close($con);
                                                       }

                                                       $x=1;
                                                       $_branch=mysqli_query($con,"SELECT * FROM ans_sale WHERE s_status=0  AND s_date BETWEEN '$st_date' AND '$end_date' GROUP BY branch_id ORDER BY s_date DESC");
                                                       foreach ($_branch as $key) { ?>
                                                       <tr style="background-color:#ffe3e3">
                                                            <td colspan="9">
                                                                 <h5># <?php renderBranch($key['branch_id'])?></h5>
                                                            </td>
                                                            <td colspan="1" class="text-right">
                                                                 <strong class="text-success"> <i
                                                                           class="icon-check"></i>
                                                                      ຢືນຢັນສຳເລັດແລ້ວ</strong>
                                                            </td>
                                                       </tr>
                                                       <?php
                                                       $branch_id=$key['branch_id'];
                                                        $groupByDate=mysqli_query($con,"SELECT * FROM ans_sale WHERE s_status=0  AND s_date BETWEEN '$st_date' AND '$end_date' AND branch_id='$branch_id' GROUP BY s_date ORDER BY s_date DESC");
                                                       foreach ($groupByDate as $_today) { ?>
                                                       <tr style="background-color:#ffe3e3">
                                                            <td colspan="9">
                                                                 <strong>ວັນທີ: <?php echo $_today['s_date']?></strong>
                                                            </td>
                                                            <td colspan="1" class="text-right">

                                                            </td>
                                                       </tr>
                                                       <?php
                                                            $i=1;
                                                            $s_date=$_today['s_date'];
                                                           

                                                            $_Result=mysqli_query($con,"SELECT*FROM ans_sale
                                                                      LEFT JOIN ans_production_of_sale ON ans_sale.pro_id = ans_production_of_sale.pro_id
                                                                      WHERE s_status=0 AND ans_sale.branch_id='$branch_id' AND s_date='$s_date' ORDER BY ans_sale.s_date DESC");
                                                            foreach ($_Result as $res) { ?>
                                                       <tr id="row">
                                                            <td style="text-align:right"><?php echo $i ?> </td>
                                                            <td style="text-align:center">
                                                                 <?php echo $res['pro_number']?></td>
                                                            <td><?php echo $res['pro_title']?></td>
                                                            <td><?php echo $res['pro_unit']?></td>
                                                            <td><?php echo $res['pro_size']?></td>
                                                            <td style="text-align:right">
                                                                 <?php echo number_format($res['s_qty'])?>
                                                            </td>
                                                            <td style="text-align:right">
                                                                 <?php echo number_format($res['sprice'])?>
                                                            </td>
                                                            <td style="text-align:right">
                                                                 <?php echo number_format($res['s_qty']*$res['sprice'])?>
                                                            </td>
                                                            <td style="text-align:center">
                                                                 <?php echo $res['s_createdBy']?>
                                                            </td>
                                                            <td style="text-align:center">
                                                                 <?php echo $res['s_createdAt']?>
                                                            </td>
                                                       </tr>
                                                       <?php $i++;} } ?>
                                                       <tr style="background-color:#f1f1f1f1;font-weight:bold">
                                                            <td colspan="7"></td>
                                                            <td colspan="2" style="text-align:right">ຈຳນວນຂາຍທັງໝົດ</td>
                                                            <td style="text-align:right"><?php sumQty($branch_id) ?> ອັນ
                                                            </td>
                                                       </tr>
                                                       <tr style="background-color:#f1f1f1f1;font-weight:bold">
                                                            <td colspan="7"></td>
                                                            <td colspan="2" style="text-align:right">ເປັນມູນຄ່າ</td>
                                                            <td style="text-align:right"><?php sumPrice($branch_id) ?>
                                                                 ກີບ
                                                            </td>
                                                       </tr>
                                                       <?php $x++; } ?>
                                                       <tr style="background-color:#ccc;font-weight:bold">
                                                            <td colspan="8" style="text-align:right">
                                                                 ສະຫຼຸບລວມທັງໝົດທຸກສາຂາ
                                                            </td>
                                                            <td colspan="2" style="text-align:right">
                                                                 <?php echo number_format($subTotal['qtyTotal'])?> ອັນ
                                                            </td>
                                                       </tr>
                                                       <tr style="background-color:#ccc;font-weight:bold">
                                                            <td colspan="8" style="text-align:right">
                                                                 ລວມເປັນມູນຄ່າໝົດທຸກສາຂາ
                                                            </td>
                                                            <td colspan="2" style="text-align:right">
                                                                 <?php echo number_format($sumTotal['priceTotal'])?> ກີບ
                                                            </td>
                                                       </tr>
                                                  </tbody>
                                        </table>
                                   </div>
                              </div>
                              <!-- Row end -->
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
          function onSearch() {
               var st_date = moment($('#st_date').val()).format("YYYY-MM-DD")
               var end_date = moment($('#end_date').val()).format("YYYY-MM-DD")
               window.location = "./checking_stock_done.php?st_date=" + st_date + "&end_date=" + end_date
          }
          $("#checking_icon,#checking_text,#checking_of_sale").addClass("text-white");
          </script>
</body>

</html>