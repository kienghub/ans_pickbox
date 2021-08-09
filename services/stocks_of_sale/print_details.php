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
          width: 100%;
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
          $_SESSION['st_date']=$_GET['st_date'];
          $_SESSION['end_date']=$_GET['end_date'];
          $_SESSION['state']=$_GET['state'];

          $st_date=$_GET['st_date']=$_SESSION['st_date'];
          $end_date=$_GET['end_date']=$_SESSION['end_date'];
          $state=$_SESSION['state']=$_GET['state'];
          if(!$_GET['state']){
          $branch="";
          $newState="";
          }else{
          $branch=$_SESSION['state'];
          $newState="AND ans_requirements.branch_id='$branch'";
          }
          $call_date_for_sum=$_sql($con,"SELECT sum(req_qty) AS total FROM ans_requirements WHERE req_date BETWEEN '$st_date' AND '$end_date' $newState");
          $res=$_assoc($call_date_for_sum);
          mysqli_close($con);
     ?>
<?php function renderBranch($id){
     include('../../connection.php');
     $query  =mysqli_query($con,"SELECT*FROM office_branches WHERE id_branch='$id'");
     $res=$_assoc($query);
     echo $res['branch_name'];
     mysqli_close($con);
}?>

<body onload="printThis('layout')" ng-app="app" ng-controller="stock" ng-init="_callStocks();_summary();">
     <!-- Page header end -->

     <div id="layout">
          <table width="100%" style="text-align:left;margin-left:20px">
               <tr>
                    <th colspan="2">
                         <center>
                              <h3 style="color:black!important">
                                   ລາຍງານລາຍລະອຽດການເບີກເຄື່ອງທັງໝົດ(ເຄື່ອງຂາຍ)
                              </h3>
                              <p><?php if($st_date==$end_date){echo $end_date;}else{echo $st_date.' - '.$end_date;} ?>
                              </p>
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

          <table id="table">
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
                         <th style="text-align:center" class="thead">ຜູ້ຂໍເບີກ</th>
                         <th style="text-align:center" class="thead">ວັນທີຂໍເບີກ</th>
                         <th style="text-align:center" class="thead">ຜູ້ອານຸມັດ</th>
                         <th style="text-align:center" class="thead">ວັນທີອານຸມັດ</th>
                    </tr>
                    <thead>
                    <tbody>
                         <?php
                                   include('../../connection.php');
                                   $sql=mysqli_query($con,"SELECT SUM(req_qty)as qtyTotal FROM ans_requirements WHERE req_date BETWEEN '$st_date' AND '$end_date' $newState");
                                   $subTotal=$_assoc($sql);

                                   $sumAllPrice=mysqli_query($con,"SELECT SUM(req_qty*sprice)AS priceTotal FROM ans_requirements LEFT JOIN ans_sale ON ans_requirements.pro_id=ans_sale.pro_id  WHERE req_date BETWEEN '$st_date' AND '$end_date' $newState");
                                   $sumTotal=$_assoc($sumAllPrice);

                                   function sumQty($x){
                                        include('../../connection.php');
                                        global $st_date;
                                        global $end_date;
                                        $sql=mysqli_query($con,"SELECT SUM(req_qty)AS qtyTotal FROM ans_requirements WHERE req_date BETWEEN '$st_date' AND '$end_date' AND branch_id='$x'");
                                        $res=$_assoc($sql);
                                        echo number_format($res['qtyTotal']);
                                        mysqli_close($con);
                                   }
                                   function sumPrice($x){
                                        include('../../connection.php');
                                        global $st_date;
                                        global $end_date;
                                        $sql=mysqli_query($con,"SELECT SUM(req_qty*sprice)AS priceTotal FROM ans_requirements LEFT JOIN ans_sale ON ans_requirements.pro_id=ans_sale.pro_id  WHERE req_date BETWEEN '$st_date' AND '$end_date' AND ans_requirements.branch_id='$x'");
                                        $res=$_assoc($sql);
                                        echo number_format($res['priceTotal']);
                                        mysqli_close($con);
                                   }

                                   $x=1;
                                   $_branch=mysqli_query($con,"SELECT * FROM ans_requirements WHERE req_date BETWEEN '$st_date' AND '$end_date' $newState  GROUP BY branch_id ORDER BY _id DESC");
                                   foreach ($_branch as $key) { ?>
                         <tr>
                              <td colspan="12"># <?php echo $x?>
                                   <?php renderBranch($key['branch_id'])?> </td>
                         </tr>
                         <?php
                                        $i=1;
                                        $bran_id=$key['branch_id'];

                                        $_Result=mysqli_query($con,"SELECT*FROM ans_requirements
                                                  LEFT JOIN ans_production_of_sale ON ans_requirements.pro_id = ans_production_of_sale.pro_id
                                                  LEFT JOIN ans_sale ON ans_requirements.pro_id = ans_sale.pro_id
                                                  WHERE ans_requirements.branch_id='$bran_id' AND req_date BETWEEN '$st_date' AND '$end_date' $newState ORDER BY ans_requirements._id DESC");
                                        foreach ($_Result as $res) { ?>
                         <tr>
                              <td style="text-align:right"><?php echo $i ?> </td>
                              <td style="text-align:center">
                                   <?php echo $res['pro_number']?></td>
                              <td><?php echo $res['pro_title']?></td>
                              <td><?php echo $res['pro_unit']?></td>
                              <td><?php echo $res['pro_size']?></td>
                              <td style="text-align:right">
                                   <?php echo number_format($res['req_qty'])?>
                              </td>
                              <td style="text-align:right">
                                   <?php echo number_format($res['sprice'])?>
                              </td>
                              <td style="text-align:right">
                                   <?php echo number_format($res['req_qty']*$res['sprice'])?>
                              </td>
                              <td style="text-align:center"><?php echo $res['req_user_consumer']?>
                              </td>
                              <td style="text-align:center"> <?php echo $res['req_date']?>
                              </td>
                              <td style="text-align:center"><?php echo $res['req_user_provider']?>
                              </td>
                              <td style="text-align:center"> <?php echo $res['approv_date']?>
                              </td>
                         </tr>
                         <?php $i++;} ?>
                         <tr style="background-color:#ffe3e3;font-weight:bold">
                              <td colspan="10" style="text-align:right">ຈຳນວນເບີກທັງໝົດ</td>
                              <td colspan="2" style="text-align:right"><?php sumQty($bran_id) ?> ອັນ
                              </td>
                         </tr>
                         <tr style="background-color:#ffe3e3;font-weight:bold">
                              <td colspan="10" style="text-align:right">ເປັນມູນຄ່າ</td>
                              <td colspan="2" style="text-align:right"><?php sumPrice($bran_id) ?> ກີບ
                              </td>
                         </tr>
                         <?php $x++; } ?>
                         <tr style="background-color:#ccc;font-weight:bold">
                              <td colspan="10" style="text-align:right">
                                   ສະຫຼຸບລວມທັງໝົດທຸກສາຂາ
                              </td>
                              <td colspan="2" style="text-align:right">
                                   <?php echo number_format($subTotal['qtyTotal'])?> ອັນ
                              </td>
                         </tr>
                         <tr style="background-color:#ccc;font-weight:bold">
                              <td colspan="10" style="text-align:right">
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