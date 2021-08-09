<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
</head>

<body ng-app="app" ng-controller="addPaylist" ng-init="_callCategory();
     _callPaylist();
     pay_date='<?php echo $_today ?>';
     _callBranchState();
     user_provider='<?php echo $_user_fname.' '.$_user_lname ?>';
     _callMember();
  ">
     <!-- Page header end -->
     <div class="main-container bg-white p-4">
          <div class="row">
               <div class="col-md-6">
                    <div class="form-group">
                         <label for="taskTitle">ໝວດເຄື່ອງ <?php isVal()?></label>
                         <select class="form-control select2" id="cate_id" onchange="selectedCategory()">
                              <option value="">-- ເລືອກໝວດເຄື່ອງ --</option>
                              <?php 
                                   include('../../connection.php');
                                   $query  =mysqli_query($con,"SELECT * FROM ans_category_of_sale");
                                   foreach ($query as $key) {
                                   ?>
                              <option value="<?php echo $key['cate_id']?>"><?php echo $key['cate_title']?></option>
                              <?php } ?>
                         </select>
                    </div>
               </div>
               <div class="col-md-4">
                    <div class="form-group">
                         <label for="taskTitle">ລາຍການເຄື່ອງ <?php isVal()?></label>
                         <select class="form-control select2" id="pro_id" ng-model="pro_id"
                              ng-change="selectedProducts()">
                              <option value="">ເລືອກລາຍການເຄື່ອງ</option>
                         </select>
                    </div>
               </div>
               <div class="col-md-2">
                    <div class="form-group">
                         <label for="taskTitle">ຈຳນວນເຄື່ອງໃນສາງ </label>
                         <input type="text" class="form-control text-center text-danger" ng-model="total" readonly>
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                         <label for="taskTitle">ຈຳນວນ <?php isVal()?></label>
                         <input type="text" class="form-control text-right" id="pay_qty" ng-model="pay_qty"
                              placeholder="00">
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                         <label for="taskTitle">ວັນທີ <?php isVal()?></label>
                         <input type="text" data-toggle="datepicker" class="form-control" id="pay_date"
                              ng-model="pay_date" value="<?php echo $_today ?>">
                    </div>
               </div>

               <div class=" col-md-12">
                    <div class="form-group">
                         <label for="taskTitle">ໝາຍເຫດ</label>
                         <textarea rows="4" class="form-control" id="pay_note" ng-model="pay_note"
                              placeholder="ກະລຸນາປ້ອນໝາຍເຫດ"></textarea>
                    </div>
               </div>
               <div class="col-md-6">
                    <button type="button" ng-click="_onRequesting()" class="btn btn-success">
                         <i class="icon-check-circle"></i>
                         <span ng-bind="btnName"></span>
                    </button>
                    <button type="button" ng-click="_clear()" class="btn btn-danger">
                         <i class="icon-x-circle"></i>
                         ຍົກເລີກ
                    </button>
               </div>
          </div>
     </div>
     <!-- Page wrapper end -->
     <?php include('../../components/lib/script.php') ?>
     <script src="./app.js"></script>
     <script>
     $("#pay_qty").on("keyup click change paste input", function(event) {
          $(this).val(function(index, value) {
               if (value != "") {
                    //return '$' + value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    var decimalCount;
                    value.match(/\./g) === null ?
                         (decimalCount = 0) :
                         (decimalCount = value.match(/\./g));

                    if (decimalCount.length > 1) {
                         value = value.slice(0, -1);
                    }
                    var components = value.toString().split(".");
                    if (components.length === 1) components[0] = value;
                    components[0] = components[0]
                         .replace(/\D/g, "")
                         .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    if (components.length === 2) {
                         components[1] = components[1].replace(/\D/g, "").replace(
                              /^\d{3}$/,
                              "");
                    }
                    if (components.join(".") != "") return components.join(".");
                    else return "";
               }
          });
     });
     </script>
</body>

</html>