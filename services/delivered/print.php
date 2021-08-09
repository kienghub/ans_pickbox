<!doctype html>
<html lang="en">

<head>
     <link href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
     <!-- Required meta tags -->
     <style>
     body {
          padding: 20px;
          padding-left: 5px;
          background-color: #ffff;
          font-family: "Phetsarath OT";
     }

     #table {
          margin: 20px;
          border-collapse: collapse;
          border-spacing: 0;
          width: 100%;
     }

     td,
     .thead {
          border: 1px inset black;
          padding: 5px;
     }

     .btn {
          padding: 10px;
          background-color: #ced4da;
          border-radius: 4px;
          border: 1px solid #ced4da;
          border-collapse: collapse;
          border-spacing: 0;
          font-size: 16px;
     }

     @media print {
          body {
               margin: 0px;
               padding: 0px;
          }
     }

     h5 {
          color: #BC243C !important;
     }

     .confirm-button-ok {
          background-color: #BC243C !important;
          color: white !important;
     }
     </style>
</head>
<?php 
     include('../../connection.php');

     $_SESSION['st_date']=$_GET['st_date'];
     $_SESSION['end_date']=$_GET['end_date'];

     $st_date=$_GET['st_date']=$_SESSION['st_date'];
     $end_date=$_GET['end_date']=$_SESSION['end_date'];
     $state=$_SESSION['state']=$_GET['state'];

     $callSummarySaleQty=$_sql($con,"SELECT sum(s_qty) AS sale_qty FROM ans_sale where s_status=1 AND branch_id='$_state_branch' AND s_date BETWEEN '$st_date' AND '$end_date'");
     $sale_qty=$_assoc($callSummarySaleQty);

     $callSummaryPrice=$_sql($con,"SELECT sum(s_qty*sprice) AS price FROM ans_sale where s_status=1 AND branch_id='$_state_branch' AND s_date BETWEEN '$st_date' AND '$end_date'");
     $_price=$_assoc($callSummaryPrice);
    mysqli_close($con) 
?>

<body ng-app="app" ng-controller="print_delivered" ng-init="
     st_date='<?php echo $st_date ?>';
     end_date='<?php echo $end_date ?>'">
     <!-- Page header end -->
     <div class="main-container">
          <button type="button" style="float:right;margin-bottom:5px; margin-left:30px" onclick="printThis('layout')"
               class="btn btn-success mt-2">
               <i class="fa fa-print"></i>
               ພິມລາຍງານ
          </button>
          <button type="button" style="float:right;margin-bottom:5px" ng-click="_onApproved()"
               class="btn btn-success mt-2">
               <i class="fa fa-check"></i>
               ຢືນຢັນການສົ່ງມອບ
          </button>
          <div id="layout">
               <table width="100%" style="text-align:left;margin-left:20px">
                    <tr>
                         <th colspan="2">
                              <center>
                                   <h3 style="color:black!important">
                                        ລາຍການທີ່ຂາຍໄດ້
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
               </table><br>
               <table id="table" style="margin:1px;">
                    <thead>
                         <tr style="background-color:#c92a2a;color:white">
                              <th style="text-align:center" class="thead" width='50px'>#</th>
                              <th style="text-align:center" class="thead">ເລກກຳກັບເຄື່ອງ</th>
                              <th style="text-align:center" class="thead">ລາຍການເຄື່ອງ</th>
                              <th style="text-align:center" class="thead">ຫົວໜ່ວຍ</th>
                              <th style="text-align:center" class="thead">ຂະໜາດ</th>
                              <th style="text-align:center" class="thead">ຈຳນວນ</th>
                              <th style="text-align:center" class="thead">ລາຄາ</th>
                              <th style="text-align:center" class="thead">ເປັນມູນຄ່າ</th>
                              <th style="text-align:center" class="thead">ຜູ້ຂາຍ</th>
                              <th style="text-align:center" class="thead">ວັນທີ່ຂາຍ</th>
                         </tr>
                         <thead>
                         <tbody>
                              <?php
                              include('../../connection.php');
                              $sql=mysqli_query($con,"SELECT SUM(s_qty)as qtyTotal FROM ans_sale WHERE s_status=1 AND s_date BETWEEN '$st_date' AND '$end_date' AND branch_id='$_state_branch'");
                              $subTotal=$_assoc($sql);
                              $sumAllPrice=mysqli_query($con,"SELECT SUM(s_qty*sprice)AS priceTotal FROM ans_sale  WHERE s_status=1 AND s_date BETWEEN '$st_date' AND '$end_date' AND branch_id='$_state_branch'");
                              $sumTotal=$_assoc($sumAllPrice);

                              function sumQty($x){
                                   include('../../connection.php');
                                   global $st_date;
                                   global $end_date;
                                   $sql=mysqli_query($con,"SELECT SUM(s_qty)AS qtyTotal FROM ans_sale WHERE s_status=1 AND s_date BETWEEN '$st_date' AND '$end_date' AND s_date='$x' AND branch_id='$_state_branch'");
                                   $res=$_assoc($sql);
                                   echo number_format($res['qtyTotal']);
                                   mysqli_close($con);
                              }
                              function sumPrice($x){
                                   include('../../connection.php');
                                   global $st_date;
                                   global $end_date;
                                   $sql=mysqli_query($con,"SELECT SUM(s_qty*sprice)AS priceTotal FROM ans_sale WHERE s_status=1 AND s_date BETWEEN '$st_date' AND '$end_date' AND ans_sale.s_date='$x' AND branch_id='$_state_branch'");
                                   $res=$_assoc($sql);
                                   echo number_format($res['priceTotal']);
                                   mysqli_close($con);
                              }

                              $x=1;
                              $_branch=mysqli_query($con,"SELECT * FROM ans_sale WHERE s_status=1 AND s_date BETWEEN '$st_date' AND '$end_date'  AND branch_id='$_state_branch' GROUP BY s_date ORDER BY s_date DESC");
                              foreach ($_branch as $key) { ?>
                              <tr style="background-color:#ffe3e3">
                                   <td colspan="10">ວັນທີ <?php echo $key['s_date'] ?> </td>
                              </tr>
                              <?php
                         $i=1;
                         $s_date=$key['s_date'];

                         $_Result=mysqli_query($con,"SELECT*FROM ans_sale
                                   LEFT JOIN ans_production_of_sale ON ans_sale.pro_id = ans_production_of_sale.pro_id
                                   WHERE s_status=1 AND ans_sale.s_date='$s_date' AND s_date BETWEEN '$st_date' AND '$end_date' AND ans_sale.branch_id='$_state_branch' ORDER BY ans_sale.s_date DESC");
                         foreach ($_Result as $res) { ?>
                              <tr>
                                   <td style="text-align:right"><?php echo $i ?> </td>
                                   <td style="text-align:center">
                                        <?php echo $res['pro_number']?>
                                   </td>
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
                              <tr style="background-color:#dee2e6;font-weight:bold">
                                   <td colspan="7"></td>
                                   <td colspan="2" style="text-align:right">ຈຳນວນຂາຍທັງໝົດ</td>
                                   <td style="text-align:right"><?php sumQty($s_date) ?> ອັນ
                                   </td>
                              </tr>
                              <tr style="background-color:#dee2e6;font-weight:bold">
                                   <td colspan="7"></td>
                                   <td colspan="2" style="text-align:right">ເປັນມູນຄ່າ</td>
                                   <td style="text-align:right"><?php sumPrice($s_date) ?> ກີບ
                                   </td>
                              </tr>
                              <?php $x++; } ?>
                              <tr style="background-color:#dee2e6;font-weight:bold">
                                   <td colspan="8" style="text-align:right">
                                        ສະຫຼຸບລວມທັງໝົດທຸກສາຂາ
                                   </td>
                                   <td colspan="2" style="text-align:right">
                                        <?php echo number_format($subTotal['qtyTotal'])?> ອັນ
                                   </td>
                              </tr>
                              <tr style="background-color:#dee2e6;font-weight:bold">
                                   <td colspan="8" style="text-align:right">
                                        ລວມເປັນມູນຄ່າໝົດທຸກສາຂາ
                                   </td>
                                   <td colspan="2" style="text-align:right">
                                        <?php echo number_format($sumTotal['priceTotal'])?> ກີບ
                                   </td>
                              </tr>
                         </tbody>
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
          </div>
          <!-- Row end -->
     </div>
     <!-- Main container end -->
     </div>

     <!-- Page wrapper end -->
     <?php 
     include('../../components/lib/script.php');
      ?>
     <script src="app.js"></script>
     <script>
     function printThis(data) {
          var printContents = document.getElementById(data).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
     }

     $("#stock_of_sale_icon,#stock_of_sale_text,#report_delivered").addClass("text-white");
     </script>
</body>

</html>