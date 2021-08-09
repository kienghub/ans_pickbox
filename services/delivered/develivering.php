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

     $callSummarySaleQty=$_sql($con,"SELECT sum(s_qty) AS sale_qty FROM ans_sale where s_status=2 AND branch_id='$_state_branch' AND s_date BETWEEN '$st_date' AND '$end_date'");
     $sale_qty=$_assoc($callSummarySaleQty);

     $callSummaryPrice=$_sql($con,"SELECT sum(s_qty*sprice) AS price FROM ans_sale where s_status=2 AND branch_id='$_state_branch' AND s_date BETWEEN '$st_date' AND '$end_date'");
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
                         <li class="breadcrumb-item active">ລາຍການສົ່ງມອບການຂາຍທັງໝົດ</li>
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
                                                       href="./?st_date=<?php echo $st_date ?> & end_date=<?php echo $end_date?>">ລາຍການທີ່ຍັງບໍ່ທັນສົ່ງມອບ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link active"
                                                       href="./develivering.php?st_date=<?php echo $st_date ?> & end_date=<?php echo $end_date?>">ລາຍການທີ່ກຳລັງສົ່ງມອບ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link"
                                                       href="./develivered.php?st_date=<?php echo $st_date ?> & end_date=<?php echo $end_date?>">ລາຍການສົ່ງທີ່ສົ່ງມອບແລ້ວ</a>
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
                                                       $sql=mysqli_query($con,"SELECT SUM(s_qty)as qtyTotal FROM ans_sale WHERE s_status=2 AND s_date BETWEEN '$st_date' AND '$end_date' AND branch_id='$_state_branch'");
                                                       $subTotal=$_assoc($sql);
                                                       $sumAllPrice=mysqli_query($con,"SELECT SUM(s_qty*sprice)AS priceTotal FROM ans_sale  WHERE s_status=2 AND s_date BETWEEN '$st_date' AND '$end_date' AND branch_id='$_state_branch'");
                                                       $sumTotal=$_assoc($sumAllPrice);

                                                       function sumQty($x){
                                                            include('../../connection.php');
                                                            global $st_date;
                                                            global $end_date;
                                                            $sql=mysqli_query($con,"SELECT SUM(s_qty)AS qtyTotal FROM ans_sale WHERE s_status=2 AND s_date BETWEEN '$st_date' AND '$end_date' AND s_date='$x' AND branch_id='$_state_branch'");
                                                            $res=$_assoc($sql);
                                                            echo number_format($res['qtyTotal']);
                                                            mysqli_close($con);
                                                       }
                                                       function sumPrice($x){
                                                            include('../../connection.php');
                                                            global $st_date;
                                                            global $end_date;
                                                            $sql=mysqli_query($con,"SELECT SUM(s_qty*sprice)AS priceTotal FROM ans_sale WHERE s_status=2 AND s_date BETWEEN '$st_date' AND '$end_date' AND ans_sale.s_date='$x' AND branch_id='$_state_branch'");
                                                            $res=$_assoc($sql);
                                                            echo number_format($res['priceTotal']);
                                                            mysqli_close($con);
                                                       }

                                                       $x=1;
                                                       $_branch=mysqli_query($con,"SELECT * FROM ans_sale WHERE s_status=2 AND s_date BETWEEN '$st_date' AND '$end_date'  AND branch_id='$_state_branch' GROUP BY s_date ORDER BY s_date DESC");
                                                       foreach ($_branch as $key) { ?>
                                                       <tr style="background-color:#d3ffce">
                                                            <td colspan="5">ວັນທີ <?php echo $key['s_date'] ?> </td>
                                                            <td colspan="5"><?php loading_icon()?> ລໍຖ້າອານຸມັດ... </td>
                                                       </tr>
                                                       <?php
                                                            $i=1;
                                                            $s_date=$key['s_date'];

                                                            $_Result=mysqli_query($con,"SELECT*FROM ans_sale
                                                                      LEFT JOIN ans_production_of_sale ON ans_sale.pro_id = ans_production_of_sale.pro_id
                                                                      WHERE s_status=2 AND ans_sale.s_date='$s_date' AND s_date BETWEEN '$st_date' AND '$end_date' AND ans_sale.branch_id='$_state_branch' ORDER BY ans_sale.s_date DESC");
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
                                                       <?php $i++;} ?>
                                                       <tr style="background-color:#f1f1f1f1;font-weight:bold">
                                                            <td colspan="7"></td>
                                                            <td colspan="2" style="text-align:right">ຈຳນວນຂາຍທັງໝົດ</td>
                                                            <td style="text-align:right"><?php sumQty($s_date) ?> ອັນ
                                                            </td>
                                                       </tr>
                                                       <tr style="background-color:#f1f1f1f1;font-weight:bold">
                                                            <td colspan="7"></td>
                                                            <td colspan="2" style="text-align:right">ເປັນມູນຄ່າ</td>
                                                            <td style="text-align:right"><?php sumPrice($s_date) ?> ກີບ
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
          window.location = "./?st_date=" + st_date + "&end_date=" + end_date
     }


     $("#stock_of_sale_icon,#stock_of_sale_text,#report_delivered").addClass("text-white");
     </script>
</body>

</html>