<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
</head>
<?php 
include('../../connection.php');
@$_id=$_GET['_id'];
$query  =mysqli_query($con,"SELECT*FROM ans_pricing LEFT JOIN ans_production_of_sale ON ans_pricing.pro_id=ans_production_of_sale.pro_id WHERE _id='$_id'");
$res=$_assoc($query);
?>

<body ng-app="app" ng-controller="controller" ng-init="_callPricing();
_id='<?php echo $res['_id']?>';
pro_id='<?php echo $res['pro_id']?>';
pro_title='<?php echo $res['pro_title']?>';
pro_size='<?php echo $res['pro_size']?>';
price_item='<?php echo number_format($res['price_item'])?>';
">
     <div class="main-container mt-3">
          <div class="row">
               <div class="col-md-3 col-sm-3 col-xs-12 card p-3">
                    <h4 class="mt-2 text-center" ng-bind="titles"></h4>
                    <hr>
                    <div class="form-group">
                         <input type="hidden" ng-model="_id">
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
                    <div class="form-group">
                         <label for="taskTitle">ລາຍການເຄື່ອງ <?php isVal()?></label>
                         <select class="form-control select2" id="pro_id" ng-model="pro_id"
                              ng-change="selectedProducts()">
                              <option value={{pro_id}}
                                   ng-bind="pro_title==''?'ເລືອກລາຍການເຄື່ອງ':pro_title+' '+pro_size"></option>
                         </select>
                    </div>
                    <div class="form-group">
                         <label for="taskTitle">ລາຄາ <?php isVal()?></label>
                         <input type="text" id="price_item" ng-model="price_item" class="form-control text-right"
                              value="<?php echo $res['price_item']?>" placeholder="00.00">
                    </div>
                    <div class="form-group">
                         <button type="button" class="btn btn-outline-success w-45" ng-click="_onSave()">
                              <i class="icon-check-circle"></i>
                              <span ng-bind="btnName"></span>
                         </button>
                         <button type="button" class="btn btn-outline-danger w-45" ng-click="_onReset()">
                              <i class="icon-x-circle"></i> ຍົກເລີກ
                         </button>
                    </div>
               </div>
               <div class="col-md-9 col-sm-9 col-xs-12">
                    <!-- Row start -->
                    <div class="table-container p-4">
                         <h4 class="t-header"><i class="icon-list"></i> ລາຍລະອຽດການປັບລາຄາ
                         </h4>
                         <div class="table-responsive">
                              <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-sm">
                                   <thead>
                                        <tr>
                                             <th class="text-center" width='90'>#</th>
                                             <th class="text-center">ລາຍການເຄື່ອງ</th>
                                             <th class="text-center">ຫົວໜ່ວຍ</th>
                                             <th class="text-center">ຂະໜາດ</th>
                                             <th class="text-center">ລາຄາ</th>
                                             <th class="text-center">ວັນທີປັບປຸງ</th>
                                             <th class="text-center">ປັບປຸງໂດຍ</th>
                                             <th class="text-center"></th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr ng-repeat="n in _pricing">
                                             <td class="text-center" ng-bind="$index+1"></td>
                                             <td ng-bind="n.pro_title"></td>
                                             <td ng-bind="n.pro_unit"></td>
                                             <td ng-bind="n.pro_size"></td>
                                             <td class="text-right" ng-bind="n.price_item | number"></td>
                                             <td class="text-center" ng-bind="n.createdAt">
                                             </td>
                                             <td class="text-center" ng-bind="n.createdBy"></td>
                                             <td style="width:100px!important;text-align:center">
                                                  <div class="btn-group">
                                                       <a href="./?_id={{n._id}}" class="btn btn-outline-success">
                                                            <i class="icon-edit"></i>
                                                       </a>
                                                       <button type="button" ng-click="_onDelete(n._id)"
                                                            class="btn btn-outline-danger">
                                                            <i class="icon-trash"></i>
                                                       </button>
                                                  </div>
                                             </td>
                                        </tr>
                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>
               <!-- Row end -->
          </div>
          <!-- Main container end -->
     </div>
     </div>
     <!-- Page wrapper end -->
     <?php include('../../components/lib/script.php') ?>
     <script src="./app.js"></script>
     <script>
     $(function() {
          $('#setting_icon').addClass('text-white')
          $('#setting_text').addClass('text-white')
          $('#ms_stock_for_sale').addClass('text-white')
     })

     $("#price_item").on("keyup click change paste input", function(event) {
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
                         components[1] = components[1].replace(/\D/g, "").replace(/^\d{3}$/,
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