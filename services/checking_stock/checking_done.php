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
                                                  <a class="nav-link"
                                                       href="./checking_request.php">ກວດສອບການຂໍເບີກເຄື່ອງ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link"
                                                       href="./checking_stock_of_sale.php">ກວດສອບການສົ່ງມອບການຂາຍ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link active"
                                                       href="./checking_stock_of_sale.php">ກວດສອບການເບີກສຳເລັດ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link"
                                                       href="./checking_stock_done.php?st_date=<?php echo $subDate ?>&end_date=<?php echo $_today ?>">ກວດສອບການສົ່ງມອບສຳເລັດ</a>
                                             </li>
                                        </ul>
                                   </div>
                                   <div class="row">
                                        <div class="col-md-3">
                                             <label for="">ແຕ່ວັນທີ</label>
                                             <input type="text" data-toggle="datepicker" class="form-control"
                                                  id='st_date' ng-model="st_date" value={{st_date}}>
                                        </div>
                                        <div class="col-md-3">
                                             <label for="">ເຖິງວັນທີ</label>
                                             <input type="text" data-toggle="datepicker" class="form-control"
                                                  id="end_date" ng-model="end_date" value={{end_date}}>
                                        </div>
                                        <div class="col-md-2 pt-4">
                                             <label for=""></label>
                                             <a href="#" onclick="onSearch()" class="btn btn-primary mt-2">
                                                  <i class="icon-search"></i> ຄົ້ນຫາ
                                             </a>
                                        </div>
                                        <table id="data" class="table table-striped table-hover table-sm mt-3">
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
                                                       <th style="text-align:center">ສະຖານະ</th>
                                                  </tr>
                                                  <thead>
                                                  <tbody>
                                                       <?php
                                                       include('../../connection.php');
                                                       function sumQty($x){

                                                            global $st_date;
                                                            global $end_date;
                                                            global $_assoc;
                                                            global $con;
                                                            $sql=mysqli_query($con,"SELECT SUM(req_qty)as qtyTotal FROM ans_requirements WHERE req_status='DONE' AND ans_requirements.branch_id='$x' AND req_date BETWEEN '$st_date' AND '$end_date'");
                                                            $res=$_assoc($sql);
                                                            echo number_format($res['qtyTotal']);
                                                            mysqli_close($con);
                                                       }

                                                       $x=1;
                                                       $_branch=mysqli_query($con,"SELECT * FROM ans_requirements WHERE req_status='DONE' AND req_date BETWEEN '$st_date' AND '$end_date' GROUP BY ans_requirements.branch_id");
                                                       foreach ($_branch as $key) { ?>
                                                       <tr>
                                                            <td colspan="8">
                                                                 <h5># <?php renderBranch($key['branch_id'])?></h5>
                                                            </td>
                                                            <td class="text-right">
                                                                 <strong class="text-success">
                                                                      <i class="icon-check"></i>
                                                                      ກວດສອບສຳເລັດແລ້ວ</strong>
                                                            </td>
                                                       </tr>
                                                       <?php 
                                                        include('../../connection.php');
                                                        $index=1;
                                                         $branchID=$key['branch_id'];
                                                        $goupBydate=mysqli_query($con,"SELECT * FROM ans_requirements WHERE ans_requirements.branch_id='$branchID' AND req_status='DONE' AND req_date BETWEEN '$st_date' AND '$end_date' GROUP BY ans_requirements.req_date DESC");
                                                       foreach ($goupBydate as $_today) { ?>
                                                       <tr>
                                                            <td colspan="8"> ວັນທີ:
                                                                 <?php echo $_today['req_date']?>
                                                            </td>
                                                            <td class="text-right">
                                                            </td>
                                                       </tr>
                                                       <?php
                                                       $i=1;
                                                       include('../../connection.php');
                                                      
                                                       $_diff_date=$_today['req_date'];
                                                       $_Result=mysqli_query($con,"SELECT*FROM ans_requirements
                                                                 LEFT JOIN ans_production_of_sale
                                                                 ON ans_requirements.pro_id = ans_production_of_sale.pro_id
                                                                 WHERE req_status='DONE' AND ans_requirements.branch_id='$branchID' AND ans_requirements.req_date='$_diff_date' ORDER BY ans_requirements._id DESC");
                                                       foreach ($_Result as $res) { ?>
                                                       <tr id="row">
                                                            <td style="text-align:center"><?php echo $i ?> </td>
                                                            <td style="text-align:center">
                                                                 <?php echo $res['pro_number']?></td>
                                                            <td><?php echo $res['pro_title']?></td>
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
                                                       <?php $i++;}} ?>
                                                       <tr style="background-color:#ffe3e3;font-weight:bold">
                                                            <td colspan="6"></td>
                                                            <td colspan="2">ຈຳນວນຂໍເບີກທັງໝົດ</td>
                                                            <td style="text-align:right"><?php sumQty( $branchID) ?> ອັນ
                                                            </td>

                                                       </tr>
                                                       <?php $x++;}?>
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

          <!-- Page wrapper end -->
          <?php 
          include('../../components/lib/script.php');
      ?>
          <script src="./app.js"></script>
          <script>
          function onSearch() {
               var st_date = moment($('#st_date').val()).format("YYYY-MM-DD")
               var end_date = moment($('#end_date').val()).format("YYYY-MM-DD")
               window.location = "./checking_done.php?st_date=" + st_date + "&end_date=" + end_date
          }
          $("#checking_icon,#checking_text,#checking_of_sale").addClass("text-white");
          </script>
</body>

</html>