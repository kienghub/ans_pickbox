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

     .bt-border {
          border-bottom: 3px solid red !important;
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

     .noti {
          padding: 0;
          width: 8px;
          height: 8px;
          margin-bottom: -10px;
          margin-left: 10px;
          z-index: 999;
          background-color: #37b24d;
          border-radius: 50%;
     }

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

     .user-card {
          -webkit-box-shadow: 0px -1px 14px 1px rgba(203, 205, 207, 1);
          -moz-box-shadow: 0px -1px 14px 1px rgba(203, 205, 207, 1);
          box-shadow: 0px -1px 14px 1px rgba(203, 205, 207, 1);
     }
     </style>
</head>
<?php 
include('../../connection.php');
   $_checkStocks = $_sql($con, "SELECT sum(req_qty) as total FROM ans_requirements WHERE  req_status='REQUESTING'");
   $_results = $_assoc($_checkStocks);
   $noti=$_results['total'];

   $confirmRequired = $_sql($con, "SELECT sum(req_qty) as total FROM ans_requirements WHERE  req_status='APPROVED'");
   $_results = $_assoc($confirmRequired);
   $news=$_results['total'];
?>

<body ng-app="app" ng-controller="controller"
     ng-init="_callProduct();_callCategory();cate_id='';pro_sizes='';_callSize();req_date='<?php echo $_today?>'">
     <!-- Page content start  -->
     <div class="page-content text-right p-3">
          <ul class="app-actions">
               <button type="button" ng-click="addRequest('ຂໍເບີກເຄື່ອງ','./add_paylist.php',900,440)"
                    class="btn btn-success btn-lg admin">
                    <i class="icon-box"></i>
                    ຂໍເບີກເຄື່ອງ
               </button>
               <div class="w-2"></div>
               <button type="button" ng-click="confirmed('ຮັບເຄື່ອງ','./confirm_list.php',100,100)"
                    class="btn btn-warning btn-lg admin">
                    <?php if($news>0){?>
                    <div class="noti"></div>
                    <?php  } ?>
                    <i class="icon-playlist_add_check"></i>
                    ຮັບເຄື່ອງ
               </button>
               <div class="w-2"></div>
               <button type="button" ng-click="requestingList('ລາຍການທີຂໍເບີກເຄື່ອງ','./requesting_list.php',100,100)"
                    class="btn btn-warning btn-lg admin">
                    <i class="icon-list"></i>
                    ລາຍການທີ່ຂໍເບີກເຄື່ອງ
               </button>
               <div class="w-2 admin"></div>
               <button type="button" ng-click="saleList('ລາຍການຂາຍເຄື່ອງປະຈຳວັນ','./sale_list.php',100,100)"
                    class="btn btn-warning btn-lg admin">
                    <i class="icon-list"></i>
                    ລາຍການຂາຍປະຈຳວັນ
               </button>
               <div class="w-2"></div>
               <button type="button" ng-click="paylistHistory('ປະຫວັດການເບີກເຄື່ອງອອກສາງໃຫຍ່','./paylist_history.php?state=<?php echo $_GET['state'] ?>&
                                                       st_date=<?php echo $subDate ?>&
                                                       end_date=<?php echo $_today ?>',100,100)"
                    class="btn btn-primary customer-service">
                    <i class="icon-settings_backup_restore"></i>
                    ປະວັດການຂາຍ
               </button>
          </ul>
     </div>
     <!-- Main container start -->
     <div class="main-container">
          <div class="row admin">
               <div class="task-section" style="width:100%;height:95vh!important">
                    <form action="#" method="POST">
                         <!-- Row start -->
                         <div class="row no-gutters">
                              <div class="col-md-1 p-2" style="overflow-y:scroll;height:80vh!important">
                                   <center>
                                        <h5>ຂະໜາດ </h5>
                                   </center>
                                   <hr>
                                   <button type="button" class="btn btn-{{pro_sizes==''?'primary':'light'}} btn-block"
                                        ng-click="_onSelectedSize('')"> ທັງໝົດ
                                   </button>
                                   <button type="button" ng-repeat="n in _callSize | filter:_filter"
                                        ng-bind="n.pro_size"
                                        class="btn btn-{{pro_sizes==n.pro_size?'primary':'light'}} btn-block"
                                        ng-click='_onSelectedSize(n.pro_size)'>
                                   </button>
                              </div>
                              <div class="col-md-7 col-sm-7">
                                   <div class="labels-container p-3">
                                        <div id="elem">
                                             <label class="list-menu {{cate_id=='' ? 'bg-light bt-border':''}}"
                                                  ng-click="_onSelected('')">
                                                  <span> <strong> ທັງໝົດ</strong></span>
                                             </label>
                                             <label ng-repeat="i in _callcate"
                                                  class="list-menu {{cate_id==i.cate_id ? 'bg-light bt-border':''}}"
                                                  ng-click='_onSelected(i.cate_id)'>
                                                  <span>
                                                       <strong ng-bind='i.cate_title'></strong></span>
                                             </label>
                                        </div>

                                        <div class="p-2">
                                             <div class="row filters-block mt-3"
                                                  style="overflow-y:scroll;height:80vh!important;">
                                                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mt-2"
                                                       ng-repeat="i in _callproduct | filter:{cate_id:cate_id,pro_size:pro_sizes}">
                                                       <figure class="user-card pb-3"
                                                            style="background-color:white;cursor:pointer"
                                                            ng-click="addToCart(i.pro_id)">
                                                            <div class="presize pull-right">
                                                                 <span ng-bind="i.pro_size"></span>
                                                            </div>
                                                            <figcaption class="p-1"
                                                                 style="margin-right:-15px;margin-left:-15px;margin-top:-30px">
                                                                 <img src="../../img/{{i.pro_img?i.pro_img :'box.png'}}"
                                                                      alt="user" style="width:100%;height:170px;">
                                                            </figcaption>
                                                            <hr>
                                                            <strong ng-bind="i.pro_title+' '+i.pro_size"
                                                                 style="font-size:16px"></strong>
                                                            <strong style="font-size:16px">
                                                                 <h4 ng-bind="i.total"></h4>
                                                            </strong>
                                                       </figure>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4 p-2" style="overflow-y:scroll;height:80vh!important">
                                   <h4 class="m-3">ເລກບິນ
                                        <?php 
                                        $callBillNo=$_sql($con,"SELECT bill_no FROM ans_bills where bill_id=(select max(bill_id)from ans_bills)");
                                        $bill=$_assoc($callBillNo);
                                        echo $bill['bill_no'];
                                        ?>
                                        <button type="button" ng-click="_addBill(<?php echo $bill['bill_no'] ?>)"
                                             class="btn btn-primary float-right mb-2">
                                             <i class="icon-plus-circle"></i> ເພີ່ມບິນໃໝ່
                                        </button>
                                   </h4>
                                   <table class="table">
                                        <tr>
                                             <td>#</td>
                                             <td>ລາຍການ</td>
                                             <td>ຈຳນວນ</td>
                                             <td>ລາຄາ</td>
                                             <td>ເປັນເງິນ</td>
                                             <td></td>
                                        </tr>
                                        <tr ng-repeat="x in _orderList">
                                             <td ng-bind="$index+1"></td>
                                             <td ng-bind="x.pro_title+' '+x.pro_size"></td>
                                             <td class="text-right" ng-bind="x.s_qty | number"></td>
                                             <td class="text-right" ng-bind="x.sprice | number"></td>
                                             <td class="text-right" ng-bind="x.sprice*x.s_qty | number"></td>
                                             <td>
                                                  <a href="" ng-click="_removeItem(x._id,x.pro_id,x.s_qty)">
                                                       <i class="icon-x-circle text-danger"></i>
                                                  </a>
                                             </td>
                                        </tr>
                                        <tr>
                                             <td colspan="5" class="text-right">
                                                  <b ng-bind="(summaryOrder | number) + ' LAK'"></b>
                                             </td>
                                        </tr>
                                        <tr>
                                             <td></td>
                                             <td colspan="4" class="text-right">
                                             </td>
                                        </tr>
                                   </table>

                              </div>
                         </div>
                         <!-- Main container end -->
               </div>
               <!-- Page content end -->
          </div>
          <div class="modal fade" id="sellConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h5 class="modal-title text-white" id="exampleModalLabel">ຢືນຢັນການຂາຍ</h5>
                         </div>
                         <div class="modal-body">
                              <div class="row p-4">
                                   <div class="col-sm-4">
                                        <div class="form-group text-center">
                                             <img src="../../img/{{pro_img?pro_img:'photo.jpg'}}" id='pro_img'
                                                  style="width:200px;height:180px" alt="">
                                        </div>
                                        <div class="form-group text-center">
                                             <h3 ng-bind="pro_title"></h3>
                                             <h3 class="text-danger" ng-bind="pro_size"></h3>
                                        </div>
                                        <div class="form-group mt-2">
                                             <div class="input-group">
                                                  <input type="hidden" ng-model="pro_id">
                                                  <input type="hidden" ng-model="rec_sprice">
                                                  <div class="input-group-prepend">
                                                       <button class="btn btn-danger" type="button" ng-click="_minus()"
                                                            id="button-addon1">
                                                            <i class="icon-minus-circle"></i>
                                                       </button>
                                                  </div>
                                                  <input type="text" class="form-control text-center" ng-model="req_qty"
                                                       ng-minlength="minlength" value="1" autofocus
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
                                   <div class="col-sm-8">
                                        <div class="form-group">
                                             <label for="total">ຈຳນວນເຄື່ອງໃນສາງ</label>
                                             <input type="text" disabled ng-model="total" class="form-control">
                                        </div>
                                        <div class="form-group">
                                             <label for="taskTitle">ວັນທີເບີກ <?php isVal()?></label>
                                             <input type="text" class="form-control" readonly ng-model="req_date"
                                                  value={{req_date}}>
                                        </div>
                                        <div class="form-group">
                                             <label for="">ໝາຍເຫດ</label>
                                             <textarea ng-model="req_note" class="form-control"
                                                  placeholder="ກະລຸນາປ້ອນໝາຍເຫດ" cols="30" rows="3"></textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" ng-click="_onConfirm(<?php echo $bill['bill_no'] ?>)"
                                   class="btn btn-success">
                                   <i class="icon-check-circle"></i>
                                   ຢືນຢັນການຂາຍ
                              </button>
                              <button type="button" ng-click="_close()" class="btn btn-primary">
                                   <i class="icon-x-circle"></i>
                                   ປິດອອກ
                              </button>
                         </div>
                    </div>
               </div>
          </div>
          <!-- Page wrapper end -->
          <?php include('../../components/lib/script.php') ?>
          <script src="./app.js"></script>
          <script>
          $('#paylist_of_sale,#stock_of_sale_icon,#stock_of_sale_text').addClass('text-white')

          function printThis(data) {
               var id = $('#branch_id').val();
               window.open("../checking_stock/print_request.php?id=" + id, '_blank')
          }
          </script>

</body>

</html>