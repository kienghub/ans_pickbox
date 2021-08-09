<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
     <style>
     .w-2 {
          width: 20px;
     }
     </style>
</head>
<?php 

function rectTotal($x){
     global $con;
     global $_assoc;
     global $_state_branch;
     $sql=mysqli_query($con,"SELECT SUM(req_qty)as total From ans_requirements where pro_id='$x' AND branch_id='$_state_branch'");
     $result=$_assoc($sql);
     echo number_format($result['total']);
}
function payTotal($x){
     global $con;
     global $_assoc;
     global $_state_branch;

     $sql=mysqli_query($con,"SELECT SUM(req_qty)as total From ans_requirements where pro_id='$x' AND branch_id='$_state_branch'");
     $result=$_assoc($sql);
     
     $sqls=mysqli_query($con,"SELECT qty From ans_branch_stocks where pro_id='$x' AND branch_id='$_state_branch'");
     $results=$_assoc($sqls);
     echo number_format($result['total']-$results['qty']);
}

function subTotal($x){
     global $con;
     global $_assoc;
     global $_state_branch;
     $sql=mysqli_query($con,"SELECT qty From ans_branch_stocks where pro_id='$x' AND branch_id='$_state_branch'");
     $result=$_assoc($sql);
     echo number_format($result['qty']);
}

               
     $getReceive=mysqli_query($con,"SELECT SUM(req_qty)AS qtyTotal FROM ans_requirements WHERE  branch_id='$_state_branch'");
     $receive=$_assoc($getReceive);

     $getTotal=mysqli_query($con,"SELECT qty From ans_branch_stocks where branch_id='$_state_branch'");
     $total=$_assoc($getTotal);
                                        
?>

<body ng-app="app" ng-controller="report_stock_of_sale"
     ng-init="_callProduct();_callCategory();cate_id='';pro_size='';_callSize()">
     <!-- Page wrapper start -->
     <div class="page-wrapper">
          <?php include('../../components/layout/side-bar.php') ?>
          <!-- Page content start  -->
          <div class="page-content">
               <?php include_once('../../components/layout/heading.php') ?>
               <div class="page-header">
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item">ລາຍງານເຄື່ອງໃນສາງ</li>
                    </ol>

                    <ul class="app-actions">
                         <div class="w-2"></div>
                         <button type="button" onclick="window.open('print.php','_blank')" target="_blank"
                              class="btn btn-secondary">
                              <i class="icon-print"></i>
                              ພິມລາຍງານ
                         </button>
                    </ul>
               </div>
               <!-- Main container start -->
               <div class="main-container">
                    <div class="blog p-3">
                         <div class="row">
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                   <h3 class="mb-3">
                                        <u>ລາຍງານລາຍລະອຽດສາງເຄື່ອງຂາຍ</u>
                                   </h3>
                              </div>
                              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                   <h5>
                                        <u>ຂາຍດືອນນີ້</u>
                                   </h5>
                                   <ul>
                                        <li>ຈຳນວນຂາຍອອກ</li>
                                        <li>0</li>
                                   </ul>
                              </div>
                              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                   <h5>
                                        <u>ຂາຍມື້ນີ້</u>
                                   </h5>
                                   <ul>
                                        <li>0</li>
                                   </ul>
                              </div>
                         </div>
                         <hr>
                         <table id="data" class="table table-striped table-hover table-sm">
                              <thead>
                                   <tr style="background-color:#c92a2a;color:white">
                                        <th style="text-align:center" width='50px'>#</th>
                                        <th style="text-align:center">ເລກກຳກັບເຄື່ອງ</th>
                                        <th style="text-align:center">ລາຍການເຄື່ອງ</th>
                                        <th style="text-align:center">ຫົວໜ່ວຍ</th>
                                        <th style="text-align:center">ຂະໜາດ</th>
                                        <th style="text-align:center">ຈຳນວນຮັບເຂົ້າ</th>
                                        <th style="text-align:center">ຈຳນວນເບີກອອກ</th>
                                        <th style="text-align:center">ຈຳນວນຄົງເຫຼືອ</th>
                                   </tr>
                                   <thead>
                                   <tbody>
                                        <?php
                                        include('../../connection.php');

                                        $i=1;
                                        $_Result=mysqli_query($con,"SELECT*FROM ans_branch_stocks
                                                  LEFT JOIN ans_production_of_sale
                                                  ON ans_branch_stocks.pro_id = ans_production_of_sale.pro_id
                                                  WHERE ans_branch_stocks.branch_id='$_state_branch' GROUP BY ans_branch_stocks.pro_id  ORDER BY ans_branch_stocks._id DESC");
                                        foreach ($_Result as $res) { ?>
                                        <tr id="row">
                                             <td style="text-align:right"><?php echo $i ?> </td>
                                             <td style="text-align:center">
                                                  <?php echo $res['pro_number']?></td>
                                             <td><?php echo $res['pro_title']?></td>
                                             <td><?php echo $res['pro_unit']?></td>
                                             <td><?php echo $res['pro_size']?></td>
                                             <td style="text-align:right">
                                                  <?php rectTotal($res['pro_id'])?>
                                             </td>
                                             <td style="text-align:right">
                                                  <?php payTotal($res['pro_id'])?>
                                             </td>
                                             <td style="text-align:right">
                                                  <?php subTotal($res['pro_id'])?>
                                             </td>
                                        </tr>
                                        <?php $i++;} ?>
                                        <tr style="background-color:#ffe3e3;font-weight:bold">
                                             <td colspan="5"></td>
                                             <td colspan="2" style="text-align:right">ຈຳນວນຮັບເຂົ້າທັງໝົດ</td>
                                             <td style="text-align:right">
                                                  <?php echo number_format($receive['qtyTotal']); ?>
                                                  ອັນ
                                             </td>
                                        </tr>
                                        <tr style="background-color:#ffe3e3;font-weight:bold">
                                             <td colspan="5"></td>
                                             <td colspan="2" style="text-align:right">ຈຳນວນເບີກທັງໝົດ</td>
                                             <td style="text-align:right">
                                                  <?php echo number_format($receive['qtyTotal']-$total['qty']); ?>
                                                  ອັນ
                                             </td>
                                        </tr>
                                        <tr style="background-color:#ffe3e3;font-weight:bold">
                                             <td colspan="5"></td>
                                             <td colspan="2" style="text-align:right">ຈຳນວນຄົງເຫຼືອທັງໝົດ</td>
                                             <td style="text-align:right">
                                                  <?php echo number_format($total['qty']); ?> ອັນ
                                             </td>
                                        </tr>
                                   </tbody>
                         </table>
                    </div>
               </div>
          </div>
          <!-- Page wrapper end -->
          <?php include('../../components/lib/script.php') ?>
          <script src="./app.js"></script>
          <script>
          $('#report_stock_of_sale,#stock_of_sale_icon,#stock_of_sale_text').addClass('text-white')
          </script>
</body>

</html>