<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php include('../../components/lib/lib.php');?>
     <style>
     .c-img {
          display: block;
          width: 200px;
          border-radius: 3px;
          justify-content: center;
          align-items: center;

     }

     td {
          padding: 10px
     }
     </style>
</head>
<?php
     include_once('../../connection.php');
     $pro_id=$_GET['id'];
     $call_data_from_local=mysqli_query($con,"SELECT * FROM ans_pricing LEFT JOIN ans_production_of_sale on ans_production_of_sale.pro_id=ans_pricing.pro_id  WHERE  ans_pricing.createdAt=(select max(createdAt)from ans_pricing where pro_id='$pro_id') limit 1");
     $res=$_assoc($call_data_from_local);
        // get total
   $_checkStock = $_sql($con, "SELECT sum(qty) as total FROM ans_branch_stocks WHERE pro_id='$pro_id' AND branch_id='$_state_branch'");
   $_result = $_assoc($_checkStock);
   $total=$_result['total'];

?>

<body ng-app="app" ng-controller="addCart" ng-init="
          pro_img='<?php echo $res['pro_img'];?>';
          pro_id='<?php echo $res['pro_id'];?>';
          pro_title='<?php echo $res['pro_title'];?>';
          pro_size='<?php echo $res['pro_size'];?>';
          rec_sprice='<?php echo $res['price_item'];?>';
          req_date='<?php echo $_today ?>';
          total='<?php  echo $total ?>';
          ">
     <div class="row blog p-4">
          <div class="col-sm-4">
               <div class="form-group text-center">
                    <img src="../../img/{{pro_img?pro_img:'photo.jpg'}}" id='pro_img' style="width:160px;height:150px"
                         alt="">
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
                              <button class="btn btn-danger" type="button" ng-click="_minus()" id="button-addon1">
                                   <i class="icon-minus-circle"></i>
                              </button>
                         </div>
                         <input type="text" class="form-control text-center" ng-model="req_qty" ng-minlength="minlength"
                              value="1" autofocus aria-describedby="button-addon1">
                         <div class="input-group-prepend">
                              <button class="btn btn-success" ng-click="_plus()" type="button" id="button-addon1">
                                   <i class="icon-plus-circle"></i>
                              </button>
                         </div>
                    </div>
               </div>
               <div class="form-group mt-3">
                    <label for="">ຈຳນວນເຄື່ອງໃນສາງ</label>
                    <input type="text" disabled ng-model="total" class="form-input text-center">
               </div>
          </div>
          <div class="col-sm-8">
               <div class="form-group">
                    <label for="taskTitle">ວັນທີເບີກ <?php isVal()?></label>
                    <input type="text" class="form-control" readonly ng-model="req_date" value={{req_date}}>
               </div>
               <div class="form-group">
                    <label for="">ໝາຍເຫດ</label>
                    <textarea ng-model="req_note" class="form-control" placeholder="ກະລຸນາປ້ອນໝາຍເຫດ" cols="30"
                         rows="3"></textarea>
               </div>
               <hr class='mt-4'>
               <div class="btn-group" style="width:100%!important">
                    <button type="button" ng-click="_onConfirm()" class="btn btn-success w-45 mt-3">
                         <i class="icon-check-circle"></i>
                         <span ng-bind="btnName"></span>
                    </button>
               </div>
          </div>
     </div>
     </div>
     <?php include('../../components/lib/script.php');?>
     <script src="app.js"></script>
</body>

</html>