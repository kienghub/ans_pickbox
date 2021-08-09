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
          width: 100%;
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
function renderBranch($id){
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
                                        ລາຍງານການຂາຍເຄື່ອງອອກສາງປະຈຳວັນ
                                   </h3>
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
                              <li>ຈຳນວນເຄື່ອງທີ່ຂາຍອອກ:
                                   <strong><?php echo number_format($res['total'])?></strong>
                                   ອັນ
                              </li>
                         </ul>
                    </div>
               </div><br>
               <div class="table-responsive mt-4">
                    <table id="table">
                         <thead>
                              <tr style="background-color:#c92a2a;color:white">
                                   <th style="text-align:center" class="thead" width='50px'>#</th>
                                   <th style="text-align:center" class="thead">ເລກກຳກັບເຄື່ອງ</th>
                                   <th style="text-align:center" class="thead">ລາຍການເຄື່ອງ</th>
                                   <th style="text-align:center" class="thead">ຫົວໜ່ວຍ</th>
                                   <th style="text-align:center" class="thead">ຂະໜາດ</th>
                                   <th style="text-align:center" class="thead">ຈຳນວນ</th>
                                   <th style="text-align:center" class="thead">ລາຄາຂາຍ</th>
                                   <th style="text-align:center" class="thead">ເປັນເງິນ</th>
                                   <th style="text-align:center" class="thead">ຜູ້ຂາຍ</th>
                                   <th style="text-align:center" class="thead">ວັນທີ່ຂາຍ</th>
                              </tr>
                              <thead>
                              <tbody>
                                   <?php
                                   include('../../../connection.php');
                                        $sql=mysqli_query($con,"SELECT SUM(s_qty)as qtyTotal FROM ans_sale WHERE branch_id='$_state_branch' AND s_date='$_today'");
                                        $subTotal=$_assoc($sql);

                                        $callAmount=mysqli_query($con,"SELECT SUM(s_qty*sprice)as priceTotal FROM ans_sale  WHERE branch_id='$_state_branch' AND s_date='$_today'");
                                        $priceTotal=$_assoc($callAmount);
               
                                        $i=1;
                                        $_Result=mysqli_query($con,"SELECT*FROM ans_sale
                                        LEFT JOIN ans_production_of_sale
                                        ON ans_sale.pro_id = ans_production_of_sale.pro_id
                                        WHERE  ans_sale.branch_id='$_state_branch' AND ans_sale.s_date='$_today' ORDER BY ans_sale._id DESC");
                                        mysqli_close($con);
                                        foreach ($_Result as $res) { ?>
                                   <td style="text-align:center"><?php echo $i ?> </td>
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
                                   <td> <?php echo $res['s_createdBy']?></td>
                                   <td style="text-align:center">
                                        <?php echo $res['s_date']?>
                                   </td>
                                   </tr>
                                   <?php $i++;} ?>
                                   <tr>
                                        <td colspan="9" style="text-align:right">ລວມຈຳນວນຂາຍ</td>
                                        <td style="text-align:right">
                                             <?php echo number_format($subTotal['qtyTotal']) ?> ອັນ
                                        </td>
                                   </tr>
                                   <tr>
                                        <td colspan="9" style="text-align:right">ລວມມູນຄ່າຂາຍ</td>
                                        <td style="text-align:right">
                                             <?php echo number_format($priceTotal['priceTotal']) ?>
                                             ກີບ
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