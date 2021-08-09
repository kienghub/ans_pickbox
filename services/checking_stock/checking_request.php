<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
     <style>
     /* #table {
          margin: 20px;
          border-collapse: collapse;
          border-spacing: 0;
          width: 100%;
     } */
     .tbody {
          border: 1px inset black;
          padding: 5px;

          font-size: 16px !important;
     }

     .thead {
          border: 1px inset black;
          padding: 5px;
          font-size: 16px !important;
          font-weight: bolder;
     }

     @media print {
          .tbody {
               border: 1px inset black;
               padding: 5px;
               font-size: 16px;
          }

          .thead {
               border: 1px inset black;
               padding: 5px;
               font-size: 16px !important;
               font-weight: bolder;
          }
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

<body ng-app="app" ng-controller="requestedList" ng-init="
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
                                                  <a class="nav-link active"
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
                                                  <a class="nav-link"
                                                       href="./checking_stock_done.php?st_date=<?php echo $subDate ?>&end_date=<?php echo $_today ?>">ກວດສອບການສົ່ງມອບສຳເລັດ</a>
                                             </li>
                                        </ul>
                                   </div>
                                   <div class="row">
                                        <table id="data" class="table table-striped table-hover table-sm">
                                             <thead>
                                                  <tr style="background-color:#c92a2a;color:white">
                                                       <th style="text-align:center" width='50px'>#</th>
                                                       <th style="text-align:center">ເລກກຳກັບເຄື່ອງ</th>
                                                       <th style="text-align:center">ລາຍການເຄື່ອງ</th>
                                                       <th style="text-align:center">ຫົວໜ່ວຍ</th>
                                                       <th style="text-align:center">ຂະໜາດ</th>
                                                       <th style="text-align:center">ຈຳນວນ</th>
                                                       <th style="text-align:center">ຜູ້ຂໍເບີກ</th>
                                                       <th style="text-align:center">ວັນທີ່ເບີກ</th>
                                                       <th style="text-align:center"></th>
                                                  </tr>
                                                  <thead>
                                                  <tbody>
                                                       <?php
                                                       include('../../connection.php');
                                                       function sumQty($x){
                                                            global $_assoc;
                                                            global $con;
                                                            $sql=mysqli_query($con,"SELECT SUM(req_qty)as qtyTotal FROM ans_requirements WHERE req_status='REQUESTING' AND ans_requirements.branch_id='$x'");
                                                            $res=$_assoc($sql);
                                                            echo number_format($res['qtyTotal']);
                                                            mysqli_close($con);
                                                       }

                                                       $x=1;
                                                       $_branch=mysqli_query($con,"SELECT * FROM ans_requirements WHERE req_status='REQUESTING' GROUP BY ans_requirements.branch_id");
                                                       foreach ($_branch as $key) { ?>
                                                       <tr>
                                                            <td colspan="8"># <?php echo $x?>
                                                                 <?php renderBranch($key['branch_id'])?>
                                                            </td>
                                                            <td class="text-right">
                                                                 <button type="button"
                                                                      ng-click="_onApprovedThis('<?php echo $key['branch_id'] ?>')"
                                                                      class='btn btn-success'>
                                                                      <i class="icon-check-circle"></i>
                                                                      <span ng-bind="btnName"></span>
                                                                 </button>
                                                            </td>
                                                       </tr>
                                                       <?php
                                                       $i=1;
                                                       include('../../connection.php');
                                                       $branchID=$key['branch_id'];
                                                       $_Result=mysqli_query($con,"SELECT*FROM ans_requirements
                                                                 LEFT JOIN ans_production_of_sale
                                                                 ON ans_requirements.pro_id = ans_production_of_sale.pro_id
                                                                 WHERE req_status='REQUESTING' AND ans_requirements.branch_id='$branchID' ORDER BY ans_requirements._id DESC");
                                                       foreach ($_Result as $res) { ?>
                                                       <tr id="row">
                                                            <td style="text-align:center"><?php echo $i ?> </td>
                                                            <td style="text-align:center">
                                                                 <?php echo $res['pro_number']?></td>
                                                            <td style="text-align:left"><?php echo $res['pro_title']?>
                                                            </td>
                                                            <td><?php echo $res['pro_unit']?></td>
                                                            <td><?php echo $res['pro_size']?></td>
                                                            <td style="text-align:right">
                                                                 <?php echo number_format($res['req_qty'])?>
                                                            </td>
                                                            <td> <?php echo $res['req_user_consumer']?></td>
                                                            <td style="text-align:center"> <?php echo $res['req_date']?>
                                                            </td>
                                                            <td></td>
                                                       </tr>
                                                       <?php $i++;} ?>
                                                       <tr style="background-color:#ffe3e3;font-weight:bold">
                                                            <td colspan="6"></td>
                                                            <td colspan="2">ຈຳນວນຂໍເບີກທັງໝົດ</td>
                                                            <td style="text-align:right"><?php sumQty( $branchID) ?> ອັນ
                                                            </td>

                                                       </tr>
                                                       <?php $x++; } ?>
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
          <div class="modal fade" id="reConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h5 class="modal-title text-white" id="exampleModalLabel">ຢືນຢັນການອານຸມັດ</h5>
                              <a href="#" onclick="printThis()" class="text-white btn btn-outline-warning">
                                   <i class="icon-print"></i> ພິມໃບມອບ
                              </a>
                         </div>
                         <div class="modal-body" id="data">
                              <input type="text" id="branch_id" ng-model="branch_id" style="display:none">
                              <table width="100%" style="border:none!important;font-size:14px">
                                   <tr>
                                        <td colspan="2">
                                             <center>
                                                  <h3 style="color:black!important">
                                                       ໃບມອບເຄື່ອງຂາຍ
                                                  </h3>
                                             </center>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td width="50%">
                                             <img src="../../img/logo_next_day.png" width="150px">
                                        </td>
                                   </tr>
                                   <tr>
                                        <td width="50%">
                                             ບໍລິສັດ ອານູສິດ ໂລຈິສຕິກ ຈໍາກັດ
                                        </td>

                                        <td width="50%" style="text-align:right;">
                                             ວັນທີ: <?php echo $_today ?> &nbsp;&nbsp;
                                        </td>
                                   </tr>
                                   <tr>
                                        <td width="50%">
                                             ບ້ານ ໂພນສະຫວ່າງ, ເມືອງ ຈັນທະບູລີ, ນະຄອນຫຼວງວຽງຈັນ
                                        </td>
                                   </tr>
                              </table><br>
                              <div class="table-responsive text-center">
                                   <table style="border-collapse: collapse;border-spacing: 0; width: 100%;">
                                        <thead>
                                             <tr>
                                                  <td class="thead">#</td>
                                                  <td class="thead">ລາຍການ</td>
                                                  <td class="thead">ຈຳນວນເຄື່ອງ</td>
                                                  <td class="thead">ສາຂາປາຍທາງ</td>
                                                  <td class="thead">ຜູ້ຂໍເບີກ</td>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <tr ng-repeat="n in _list">
                                                  <td class="tbody" ng-bind="$index+1"></td>
                                                  <td class="tbody" style="text-align:left"
                                                       ng-bind="n.pro_title +' '+n.pro_size"></td>
                                                  <td class="tbody text-right"
                                                       ng-bind="(n.req_qty | number) +' '+n.pro_unit"></td>
                                                  <td class="tbody" ng-repeat="x in _listBranch"
                                                       ng-bind="x.branch_name"></td>
                                                  <td class="tbody" ng-bind="n.req_user_consumer"></td>
                                             </tr>
                                        </tbody>
                                   </table><br>
                                   <table width="100%"
                                        style="text-align:center;margin-top:15px;margin-bottom:100px;border:none!important;font-size:15px">
                                        <tr>
                                             <td width="33%">
                                                  <u> ນາຍສາງ </u>
                                             </td>
                                             <td width="33%">
                                                  <u> ໂຊເຟີ່ </u>
                                             </td>
                                             <td width="33%">
                                                  <u> ຜູ້ຮັບ </u>
                                             </td>
                                        </tr>
                                   </table>
                              </div>

                         </div>
                         <div class="modal-footer text-left">
                              <button type="button" ng-click="_onApproved(branch_id)" class="btn btn-success">
                                   <i class="icon-check-circle"></i>
                                   ອານຸມັດ
                              </button>
                              <button type="button" ng-click="_close()" class="btn btn-primary">
                                   <i class="icon-x-circle"></i>
                                   ຍົກເລີກ
                              </button>
                         </div>
                    </div>
               </div>
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
          $("#checking_icon,#checking_text,#checking_of_sale").addClass("text-white");

          function printThis(data) {
               var id = $('#branch_id').val();
               window.open("print_request.php?id=" + id, '_blank')
          }
          </script>
</body>

</html>