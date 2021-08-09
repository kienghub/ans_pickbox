<!doctype html>
<html lang="en">

<head>
     <title>Print</title>
     <!-- Required meta tags -->
     <?php include('../../connection.php') ?>
     <style>
     body {
          padding: 25px;
          padding-left: 5px;
          background-color: #ffff !important;
          font-family: "Phetsarath OT";
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
          font-size: 15px;
     }
     </style>
</head>
<?php 
include('../../connection.php');
@$st_date=$_GET['st_date'];
@$end_date=$_GET['end_date'];

$call_date_for_sum=$_sql($con,"SELECT sum(rec_qty) AS total, sum(rec_qty*rec_sprice)AS fv FROM ans_receive_of_sale WHERE rec_date BETWEEN '$st_date' AND '$end_date'");
$res=$_assoc($call_date_for_sum);
mysqli_close($con);
?>

<body onload="printThis('layout')" ng-app="app" ng-controller="receive"
     ng-init="_callReceive('<?php echo $_GET['st_date'] ?>','<?php echo $_GET['end_date'] ?>');_summary('<?php echo $_GET['st_date'] ?>','<?php echo $_GET['end_date'] ?>');st_date='<?php echo $_GET['st_date'] ?>';end_date='<?php echo $_GET['end_date'] ?>'">

     <div id="layout">
          <table width="100%" style="margin-left:10px;text-align:left">
               <tr>
                    <th colspan="2">
                         <center>
                              <h2 style="color:black!important">
                                   ລາຍງານເຄື່ອງເຂົ້າສາງ(ຂາຍ)
                              </h2>
                              <p>ວັນທີ
                                   <?php if($_GET['st_date']==$_GET['end_date']){echo $_GET['st_date'];}else{echo $_GET['st_date'].' ຫາ '.$_GET['end_date'];} ?>
                              </p>
                         </center>
                    </th>
               </tr>
               <tr>
                    <th width="40%">
                         <img src="../../img/logo_next_day.png" width="150px">
                    </th>
                    <th width="50%" style="text-align:right;margin-right:25px">
                         ວັນທີ: <?php echo $_today ?>
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
          <br>
          <div class="col-md-4">
               <ul>
                    <li>ຈຳນວນເຄື່ອງທີ່ນຳເຂົ້າ:
                         <strong><?php echo number_format($res['total'])?></strong>
                         ອັນ
                    </li>
                    <li>ມູນຄ່າເຄື່ອງທີ່ນຳເຂົ້າ:
                         <strong><?php echo number_format($res['fv'])?></strong>
                         ກີບ
                    </li>
               </ul>
          </div>
          <br>
          <table width="100%" id="table">
               <thead>
                    <tr>
                         <th style="text-align:center" class="thead" width='50px'>#</th>
                         <th style="text-align:center" class="thead">ເລກກຳກັບເຄື່ອງ</th>
                         <th style="text-align:center" class="thead">ລາຍການເຄື່ອງ</th>
                         <th style="text-align:center" class="thead">ຈຳນວນ</th>
                         <th style="text-align:center" class="thead">ມູນຄ່າ</th>
                         <th style="text-align:center" class="thead">ເປັນເງິນ</th>
                         <th style="text-align:center" class="thead">ວັນທີ່ນຳເຂົ້າ</th>
                         <th style="text-align:center" class="thead">ຜູ້ນຳເຂົ້າ</th>
                    </tr>
                    <thead>
                    <tbody>
                           <?php
                         include('../../connection.php');
                         $x=1;
                         $payList=mysqli_query($con,"SELECT*FROM ans_receive_of_sale 
                         LEFT JOIN ans_production_of_sale ON ans_receive_of_sale.pro_id = ans_production_of_sale.pro_id  WHERE rec_date BETWEEN '$st_date' AND '$end_date'");
                         foreach ($payList as $key) { ?>
                         <tr>
                              <td style="text-align:center"><?php echo $i ?></td>
                              <td style="text-align:center"><?php echo $key['pro_number']?></td>
                              <td><?php echo $key['pro_title']?></td>
                              <td style="text-align:right">
                                   <?php echo number_format($key['rec_qty'])?> </td>
                              <td style="text-align:right">
                                   <?php echo number_format($key['rec_sprice'])?></td>
                              <td style="text-align:right">
                                   <?php echo number_format($key['rec_sprice']*$key['rec_qty'])?>
                              </td>
                              <td style="text-align:center"><?php echo $key['rec_date']?> </td>
                              <td><?php echo $key['rec_createdBy']?></td>
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
     <!-- Main container end -->
     </div>
     <!-- Page content end -->
     <!-- Page wrapper end -->
     <?php include('../../components/lib/script.php') ?>
     <script src="./app.js"></script>
     <script>
     function printThis(data) {
          setTimeout(() => {
               var printContents = document.getElementById(data).innerHTML;
               var originalContents = document.body.innerHTML;
               document.body.innerHTML = printContents;
               window.print();
               document.body.innerHTML = originalContents;
          }, 1000);
     }
     </script>
</body>

</html>