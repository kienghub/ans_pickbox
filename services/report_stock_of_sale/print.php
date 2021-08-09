<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <title>print</title>
     <style>
     body {
          padding: 25px;
          padding-left: 5px;
          background-color: #ffff;
          font-family: 'phetsarath OT';
     }

     #table {
          margin: 20px;
          border-collapse: collapse;
          border-spacing: 0;
     }

     td,
     .thead {
          border: 1px inset black;
          padding: 5px;
          font-weight: bold;
     }
     </style>
</head>
<?php 
include('../../connection.php');
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

<body onload="printThis('layout')" ng-app="app" ng-controller="stock" ng-init="_callStocks();_summary();">
     <!-- Page header end -->

     <div id="layout">
          <table width="100%" style="text-align:left;margin-left:20px">
               <tr>
                    <th colspan="2">
                         <center>
                              <h3 style="color:black!important">
                                   ລາຍງານເຄື່ອງໃນສາງທັງໝົດ(ເຄື່ອງໃຊ້)
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

          <table width="100%" id="table">
               <thead>
                    <tr style="background-color:#f1f1f1f1; font-weight:bold">
                         <th style="text-align:center" class="thead" width='50px'>#</th>
                         <th style="text-align:center" class="thead">ເລກກຳກັບເຄື່ອງ</th>
                         <th style="text-align:center" class="thead">ລາຍການເຄື່ອງ</th>
                         <th style="text-align:center" class="thead">ຫົວໜ່ວຍ</th>
                         <th style="text-align:center" class="thead">ຂະໜາດ</th>
                         <th style="text-align:center" class="thead">ຈຳນວນຮັບເຂົ້າ</th>
                         <th style="text-align:center" class="thead">ຈຳນວນເບີກອອກ</th>
                         <th style="text-align:center" class="thead">ຈຳນວນຄົງເຫຼືອ</th>
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
                         <tr>
                              <td style="text-align:center"><?php echo $i ?> </td>
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
                         <tr style="background-color:#fafafafa;font-weight:bold">
                              <td colspan="7" style="text-align:right">ຈຳນວນຮັບເຂົ້າທັງໝົດ</td>
                              <td style="text-align:right">
                                   <?php echo number_format($receive['qtyTotal']); ?>
                                   ອັນ
                              </td>
                         </tr>
                         <tr style="background-color:#fafafafa;font-weight:bold">
                              <td colspan="7" style="text-align:right">ຈຳນວນເບີກທັງໝົດ</td>
                              <td style="text-align:right">
                                   <?php echo number_format($receive['qtyTotal']-$total['qty']); ?> ອັນ
                              </td>
                         </tr>
                         <tr style="background-color:#fafafafa;font-weight:bold">
                              <td colspan="7" style="text-align:right">ຈຳນວນຄົງເຫຼືອທັງໝົດ</td>
                              <td style="text-align:right">
                                   <?php echo number_format($total['qty']); ?> ອັນ
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
     </div>
     <!-- Page wrapper end -->
     <?php 
     include('../../components/lib/script.php');
      ?>
     <script src="./app.js"></script>
     <script>
     function printThis(data) {
          setTimeout(() => {
               var printContents = document.getElementById(data).innerHTML;
               var originalContents = document.body.innerHTML;
               document.body.innerHTML = printContents;
               window.print();
               document.body.innerHTML = originalContents;
          }, 1100);
     }
     </script>
</body>

</html>