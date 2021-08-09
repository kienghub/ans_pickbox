<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
     <style>
     .card {
          cursor: pointer;
          border: 1px solid #ced4da;
     }

     .card:hover {
          background-color: #ced4da;
     }

     .list-menu .active {
          background-color: #ced4da;
          border-bottom: 3px solid black;
     }

     .check-box {
          width: 18px;
          height: 18px;
     }

     .w-2 {
          width: 20px;
     }

     .presize {
          margin-top: -35px;
          margin-right: -17px;
          width: 80px;
          padding: 3px;
          background-color: #c92a2a;
          color: white;
          border-top-right-radius: 5px;
          border-bottom-left-radius: 5px;
     }
     </style>
</head>

<body ng-app="app" ng-controller="confirmed" ng-init="
     st_date='<?php echo $subDate?>';
     end_date='<?php echo $_today?>'">
     <div class="main-container blog">
          <div class="row">
               <div class="table-responsive mt-4" ng-hide="_done_list">
                    <table id="data_table" class="table table-striped table-hover table-sm">
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
                                   <th style="text-align:center">ວັນທີອານຸມັດ</th>
                                   <th style="text-align:center">ຜູ້ອານຸມັດ</th>
                                   <th style="text-align:center"></th>
                              </tr>
                              <thead>
                              <tbody>
                                   <?php
                                   include('../../connection.php');
                                        $sql=mysqli_query($con,"SELECT SUM(req_qty)as qtyTotal FROM ans_requirements WHERE req_status='APPROVED' AND branch_id='$_state_branch'");
                                        $subTotal=$_assoc($sql);

                                        $i=1;
                                        $_Result=mysqli_query($con,"SELECT*FROM ans_requirements
                                                  LEFT JOIN ans_production_of_sale
                                                  ON ans_requirements.pro_id = ans_production_of_sale.pro_id
                                                  WHERE req_status='APPROVED' AND ans_requirements.branch_id='$_state_branch' ORDER BY ans_requirements._id DESC");
                                        mysqli_close($con);
                                        foreach ($_Result as $res) { ?>
                                   <tr>
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
                                        <td style="text-align:center"> <?php echo $res['approv_date']?>
                                        <td style="text-align:center"> <?php echo $res['req_user_provider']?>
                                        </td>
                                        <td class="text-success" style="width:200px!important;text-align:center">
                                             <button type="button"
                                                  ng-click="_justConfirm(<?php echo $res['_id']?>,<?php echo $res['pro_id']?>,<?php echo $res['req_qty']?>)"
                                                  class="btn btn-success">
                                                  <i class="icon-check-circle"></i>
                                                  <span ng-bind="btnName"></span>
                                             </button>
                                             <button type="button"
                                                  ng-click="_rejected(<?php echo $res['_id']?>,<?php echo $res['pro_id']?>)"
                                                  class="btn btn-primary">
                                                  <i class="icon-x-circle"></i>
                                                  ປະຕິເສດ
                                             </button>
                                        </td>
                                   </tr>
                                   <?php $i++;} ?>
                              </tbody>
                    </table>
               </div>
          </div>

          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
               aria-labelledby="staticBackdropLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                    <input type="hidden" ng-model="_id">
                    <input type="hidden" ng-model="_proID">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h5 class="modal-title text-white" id="staticBackdropLabel">ປະຕິເສດການອານຸມັດ</h5>
                              <a href="#" ng-click="close"><i class="icon-x text-white"></i></a>
                         </div>
                         <div class="modal-body">
                              <label for="">ເຫດຜົນ</label>
                              <textarea rows="3" cols="3" ng-model="note" class="form-control"></textarea>
                         </div>
                         <div class="modal-footer">
                              <button type="button" ng-click="_Rejected()" class="btn btn-success">
                                   <i class="icon-check-circle"></i>
                                   ປະຕິເສດ
                              </button>
                              <button type="button" class="btn btn-primary" ng-click="close">
                                   <i class="icon-x"></i>
                                   ຍົກເລີກ</button>
                         </div>
                    </div>
               </div>
          </div>
          <!-- Page wrapper end -->
          <?php include('../../components/lib/script.php') ?>
          <script src="./app.js"></script>

</body>

</html>