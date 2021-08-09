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

<body ng-app="app" ng-controller="saleList" ng-init="
     st_date='<?php echo $subDate?>';
     end_date='<?php echo $_today?>'">
     <div class="main-container blog">
          <div class="row">
               <div class="col-md-12 pt-3 text-right">
                    <a href="./print/print_dayly.php" target="_blank" class="btn btn-secondary mt-2">
                         <i class="icon-print"></i> ພິມລາຍງານ
                    </a>
               </div>
          </div>
          <!-- Page content end -->
          <div class="table-responsive mt-4" ng-hide="_requesting_list">
               <table id="data" class="table table-striped table-hover table-sm">
                    <thead>
                         <tr style="background-color:#c92a2a;color:white">
                              <th style="text-align:center" width='50px'>#</th>
                              <th style="text-align:center">ເລກກຳກັບເຄື່ອງ</th>
                              <th style="text-align:center">ລາຍການເຄື່ອງ</th>
                              <th style="text-align:center">ຫົວໜ່ວຍ</th>
                              <th style="text-align:center">ຂະໜາດ</th>
                              <th style="text-align:center">ຈຳນວນ</th>
                              <th style="text-align:center">ລາຄາຂາຍ</th>
                              <th style="text-align:center">ເປັນເງິນ</th>
                              <th style="text-align:center">ຜູ້ຂາຍ</th>
                              <th style="text-align:center">ວັນທີ່ຂາຍ</th>
                              <th style="text-align:center" <?php echo $modify ?>></th>
                         </tr>
                         <thead>
                         <tbody>
                              <?php
                                   include('../../connection.php');
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
                              <tr>
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
                                   <td style="width:90px!important;text-align:center" <?php echo $modify ?>>
                                        <div class="btn-group">
                                             <button type="button"
                                                  ng-click="_onUpdate('<?php echo $res['_id']?>','<?php echo $res['pro_id']?>','<?php echo $res['s_qty']?>')"
                                                  class="btn btn-outline-success btn-sm">
                                                  <i class="icon-edit"></i>
                                             </button>
                                             <button type="button"
                                                  ng-click="_onDelete('<?php echo $res['_id']?>','<?php echo $res['pro_id']?>','<?php echo $res['s_qty']?>')"
                                                  class="btn btn-outline-danger btn-sm">
                                                  <i class="icon-trash"></i>
                                             </button>
                                        </div>
                                   </td>
                              </tr>
                              <?php $i++;} ?>
                              <tr>
                                   <td colspan="9" class="text-right">ລວມຈຳນວນຂາຍ</td>
                                   <td class="text-right">
                                        <?php echo number_format($subTotal['qtyTotal']) ?> ອັນ
                                   </td>
                              </tr>
                              <tr>
                                   <td colspan="9" class="text-right">ລວມມູນຄ່າຂາຍ</td>
                                   <td class="text-right">
                                        <?php echo number_format($priceTotal['priceTotal']) ?>
                                        ກີບ
                                   </td>
                              </tr>
                         </tbody>
               </table>
          </div>
     </div>

     <!-- Modal -->
     <div class="modal fade" id="updateSaleList" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title text-white" id="exampleModalLongTitle">ແກ້ໄຂຈຳນວນ</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <div class="modal-body">
                         <div class="form-group mt-2">
                              <div class="input-group">
                                   <div class="input-group-prepend">
                                        <button class="btn btn-danger" type="button" ng-click="_minus()"
                                             id="button-addon1">
                                             <i class="icon-minus-circle"></i>
                                        </button>
                                   </div>
                                   <input type="text" class="form-control text-center" ng-model="s_qty"
                                        ng-minlength="minlength" value="1" autofocus placeholder="0"
                                        aria-describedby="button-addon1">
                                   <div class="input-group-prepend">
                                        <button class="btn btn-success" ng-click="_plus()" type="button"
                                             id="button-addon1">
                                             <i class="icon-plus-circle"></i>
                                        </button>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" ng-click="_onSaved()" class="btn btn-success">
                              <i class="icon-check-circle"></i>
                              <span ng-bind="btnName"></span>
                         </button>
                         <button type="button" class="btn btn-danger" data-dismiss="modal">
                              <i class="icon-x-circle"></i>
                              ຍົກເລີກ
                         </button>
                    </div>
               </div>
          </div>
     </div>
     <!-- Page wrapper end -->
     <?php include('../../components/lib/script.php') ?>
     <script src="./app.js"></script>

</body>

</html>