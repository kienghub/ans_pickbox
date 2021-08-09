<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <title>print</title>
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
     }

     td,
     .thead {
          border: 1px inset black;
          padding: 5px;
     }
     </style>
</head>
<?php   
      include('../../../connection.php');
          $_SESSION['st_date']=$_GET['st_date'];
          $_SESSION['end_date']=$_GET['end_date'];
          $_SESSION['state']=$_GET['state'];

          $st_date=$_GET['st_date']=$_SESSION['st_date'];
          $end_date=$_GET['end_date']=$_SESSION['end_date'];
          $state=$_GET['state']=$_SESSION['state'];
         
          if(!$_GET['state']){
          $branch="";
          $newState="";
          }else{
          $branch=$_SESSION['state'];
          $newState="AND ans_sale.branch_id='$branch'";
          }
          $call_date_for_sum=$_sql($con,"SELECT sum(s_qty) AS total FROM ans_sale WHERE s_date BETWEEN '$st_date' AND '$end_date' $newState");
          $res=$_assoc($call_date_for_sum);
          mysqli_close($con);
     ?>
<?php function renderBranch($id){
     include('../../../connection.php');
     $query  =mysqli_query($con,"SELECT*FROM office_branches WHERE id_branch='$id'");
     $res=$_assoc($query);
     echo $res['branch_name'];
     mysqli_close($con);
}?>

<body onload="printThis('layout')" ng-app="app" ng-controller="paylistHistory" ng-init="
     st_date='<?php echo $st_date ?>';
     end_date='<?php echo $end_date ?>'">
     <div class="main-container blog">
          <div id="layout">
               <table width="100%" style="text-align:left;margin-left:20px">
                    <tr>
                         <th colspan="2">
                              <center>
                                   <h3 style="color:black!important">
                                        ລາຍງານການເບີກເຄື່ອງອອກສາງ(ເຄື່ອງຂາຍ)
                                   </h3>
                                   <p>ວັນທີ <?php if($_GET['st_date']==$_GET['end_date']){
                                  echo  $_GET['st_date'];
                              }else{
                                    echo  $_GET['st_date'].' - '.$_GET['end_date'];;
                              }?> </p>
                                   <p><?php if($branch==""){echo "ທັງໝົດ";}else{renderBranch($_GET['state']);}?></p>
                              </center>
                         </th>
                    </tr>
                    <tr>
                         <th width="50%">
                              <img src="../../../img/logo_next_day.png" width="150px">
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
               <div class="row">
                    <div class="col-md-4">
                         <ul>
                              <li>ຈຳນວນເຄື່ອງທີ່ເບີກອອກ:
                                   <strong><?php echo number_format($res['total'])?></strong>
                                   ອັນ
                              </li>
                         </ul>
                    </div>
               </div><br>
               <div class="table-responsive mt-4">
                    <table id="table" width="100%">
                         <thead>
                              <tr style="background-color:#c92a2a;color:white">
                                   <th style="text-align:center" class='thead'>#</th>
                                   <th style="text-align:center" class='thead'>ເລກກຳກັບເຄື່ອງ</th>
                                   <th style="text-align:center" class='thead'>ລາຍການເຄື່ອງ</th>
                                   <th style="text-align:center" class='thead'>ຈຳນວນ</th>
                                   <th style="text-align:center" class='thead'>ລາຄາ</th>
                                   <th style="text-align:center" class='thead'>ເປັນມູນຄ່າ</th>
                                   <th style="text-align:center" class='thead'>ຜູ້ເບີກ</th>
                                   <th style="text-align:center" class='thead'>ວັນທີ່ເບີກ</th>
                              </tr>
                              <thead>
                              <tbody>
                                   <?php
                                   include('../../../connection.php');
                                   $sql=mysqli_query($con,"SELECT SUM(s_qty)as qtyTotal FROM ans_sale WHERE s_date BETWEEN '$st_date' AND '$end_date' $newState");
                                   $subTotal=$_assoc($sql);
                                   $sumAllPrice=mysqli_query($con,"SELECT SUM(ans_sale.s_qty*ans_receive_of_sale.rec_sprice)AS priceTotal FROM ans_sale LEFT JOIN ans_receive_of_sale ON ans_sale.pro_id = ans_receive_of_sale.pro_id WHERE s_date BETWEEN '$st_date' AND '$end_date' $newState");
                                   $sumTotal=$_assoc($sumAllPrice);

                                   function sumQty($x){
                                        include('../../../connection.php');
                                        global $st_date;
                                        global $end_date;
                                        global $newState;
                                        $sql=mysqli_query($con,"SELECT SUM(s_qty)AS qtyTotal FROM ans_sale WHERE s_date BETWEEN '$st_date' AND '$end_date' AND branch_id='$x'");
                                        $res=$_assoc($sql);
                                        echo number_format($res['qtyTotal']);
                                        mysqli_close($con);
                                   }
                                   function sumPrice($x){
                                        include('../../../connection.php');
                                        global $st_date;
                                        global $end_date;
                                        global $newState;
                                        $sql=mysqli_query($con,"SELECT SUM(ans_sale.s_qty*ans_receive_of_sale.rec_sprice)AS priceTotal FROM ans_sale LEFT JOIN ans_receive_of_sale ON ans_sale.pro_id = ans_receive_of_sale.pro_id WHERE s_date BETWEEN '$st_date' AND '$end_date' AND ans_sale.branch_id='$x'");
                                        $res=$_assoc($sql);
                                        echo number_format($res['priceTotal']);
                                        mysqli_close($con);
                                   }

                                   $x=1;
                                   $_branch=mysqli_query($con,"SELECT * FROM ans_sale WHERE s_date BETWEEN '$st_date' AND '$end_date' $newState  GROUP BY branch_id ORDER BY s_date DESC");
                                   foreach ($_branch as $key) { ?>

                                   <tr>
                                        <td colspan="8"># <?php echo $x?>
                                             <?php renderBranch($key['branch_id'])?> </td>
                                   </tr>
                                   <?php
                                        $i=1;
                                        $bran_id=$key['branch_id'];

                                        $_Result=mysqli_query($con,"SELECT*FROM ans_sale
                                                  LEFT JOIN ans_production_of_sale ON ans_sale.pro_id = ans_production_of_sale.pro_id
                                                  LEFT JOIN ans_receive_of_sale ON ans_sale.pro_id = ans_receive_of_sale.pro_id
                                                  WHERE ans_sale.branch_id='$bran_id' AND s_date BETWEEN '$st_date' AND '$end_date' $newState ORDER BY ans_sale.s_date DESC");
                                        foreach ($_Result as $res) { ?>
                                   <tr>
                                        <td style="text-align:right"><?php echo $i ?> </td>
                                        <td style="text-align:center">
                                             <?php echo $res['pro_number']?></td>
                                        <td><?php echo $res['pro_title']?></td>
                                        <td style="text-align:right">
                                             <?php echo number_format($res['s_qty'])?>
                                        </td>
                                        <td style="text-align:right">
                                             <?php echo number_format($res['rec_sprice'])?>
                                        </td>
                                        <td style="text-align:right">
                                             <?php echo number_format($res['s_qty']*$res['rec_sprice'])?>
                                        </td>
                                        <td style="text-align:center">
                                             <?php echo $res['s_createdBy']?>
                                        </td>
                                        <td style="text-align:center">
                                             <?php echo $res['s_date']?>
                                        </td>
                                   </tr>
                                   <?php $i++;} ?>
                                   <tr style="background-color:#f1f1f1f1;font-weight:bold">
                                        <td colspan="7" style="text-align:right">ຈຳນວນເບີກທັງໝົດ</td>
                                        <td style="text-align:right"><?php sumQty($bran_id) ?> ອັນ
                                        </td>
                                   </tr>
                                   <tr style="background-color:#f1f1f1f1;font-weight:bold">
                                        <td colspan="7" style="text-align:right">ເປັນມູນຄ່າ</td>
                                        <td style="text-align:right"><?php sumPrice($bran_id) ?> ກີບ
                                        </td>
                                   </tr>
                                   <?php $x++; } ?>
                                   <tr style="background-color:#ccc;font-weight:bold">
                                        <td colspan="7" style="text-align:right">
                                             ສະຫຼຸບລວມທັງໝົດທຸກສາຂາ
                                        </td>
                                        <td colspan="2" style="text-align:right">
                                             <?php echo number_format($subTotal['qtyTotal'])?> ອັນ
                                        </td>
                                   </tr>
                                   <tr style="background-color:#ccc;font-weight:bold">
                                        <td colspan="7" style="text-align:right">
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