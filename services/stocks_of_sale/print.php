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
     $callSummaryForReceive=$_sql($con,"SELECT sum(rec_qty) AS recTotal FROM ans_receive_of_sale");
     $receive=$_assoc($callSummaryForReceive);

     $callSummaryForPaylist=$_sql($con,"SELECT sum(req_qty) AS payTotal FROM ans_requirements WHERE req_status='DONE'");
     $res=$_assoc($callSummaryForPaylist);
    mysqli_close($con) 
?>

<body onload="printThis('layout')" ng-app="app" ng-controller="stock" ng-init="_callStocks();_summary();">
     <!-- Page header end -->

     <div id="layout">
          <table width="100%" style="text-align:left;margin-left:20px">
               <tr>
                    <th colspan="2">
                         <center>
                              <h3 style="color:black!important">
                                   ລາຍງານເຄື່ອງໃນສາງໃຫຍ່ທັງໝົດ(ເຄື່ອງຂາຍ)
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
          <table width="100%" id="table">
               <thead>
                    <tr>
                         <th style="text-align:center" class="thead" width='60px'>#</th>
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
                         <tr>
                              <td style="text-align:center"><?php echo $i ?></td>
                              <td style="text-align:center">
                                   <?php echo $key['pro_number']?></td>
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