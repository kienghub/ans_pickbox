<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
     <?php include('../../connection.php') ?>
</head>

<body ng-app="app" ng-controller="addReceiveOfSale" ng-init="_callCategory();
     rec_date='<?php echo $_today ?>';
     user_holder='<?php echo $_user_fname.' '.$_user_lname ?>'">
     <!-- Page header end -->
     <!-- Page header end -->
     <div class="main-container bg-white pt-3">
          <form action="#" method="POST">
               <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                              <label for="taskTitle">ໝວດເຄື່ອງ
                                   <?php isVal()?></label>
                              <select class="form-control select2" id="cate_id" ng-model='cate_id'
                                   ng-change="selectedCategory()" required>
                                   <option value="">-- ເລືອກໝວດເຄື່ອງ -- </option>
                                   <?php 
                                        include('../../connection.php');
                                        $query  =mysqli_query($con,"SELECT * FROM ans_category_of_sale");
                                        foreach ($query as $key) {
                                        ?>
                                   <option value="<?php echo $key['cate_id']?>">
                                        <?php echo $key['cate_title']?>
                                   </option>
                                   <?php } ?>
                              </select>
                         </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                              <label for="taskTitle">ລາຍການເຄື່ອງ
                                   <?php isVal()?></label>
                              <select class="form-control select2" id="pro_id" name="pro_id" required>
                                   <option value="">ເລືອກລາຍການເຄື່ອງ</option>
                                   <option ng-repeat="n in production" value={{n.pro_id}}
                                        ng-bind="n.pro_title +' '+ n.pro_size">
                                   </option>
                              </select>
                         </div>
                    </div>
                    <div class="col-6">
                         <div class="form-group">
                              <label for="taskTitle">ລາຄາ
                                   <?php isVal()?>
                              </label>
                              <input type="text" class="form-control text-right" id="rec_sprice" name="rec_sprice"
                                   required placeholder="00">
                         </div>
                    </div>
                    <div class="col-6">
                         <div class="form-group">
                              <label for="taskTitle">ຈຳນວນ
                                   <?php isVal()?></label>
                              <input type="text" class="form-control text-right" id="rec_qty" name="rec_qty" required
                                   placeholder="00">
                         </div>
                    </div>
                    <div class="col-md-12">
                         <div class="form-group">
                              <label for="taskTitle">ວັນທີ
                                   <?php isVal()?></label>
                              <input type="text" data-toggle="datepicker" class="form-control" name="rec_date" required
                                   value={{rec_date}}>
                         </div>
                    </div>
                    <div class="col-md-12">
                         <div class="form-group">
                              <label for="taskTitle">ໝາຍເຫດ</label>
                              <textarea rows="4" class="form-control" name="rec_note" id="rec_note"
                                   placeholder="ກະລຸນາປ້ອນໝາຍເຫດ"></textarea>
                         </div>
                    </div>
                    <div class="col-md-6">
                         <button type="submit" name="handelSave" class="btn btn-success">
                              <i class="icon-check-circle"></i>
                              <span ng-bind="btnName"></span>
                         </button>
                         <button type="reset" class="btn btn-danger">
                              <i class="icon-x-circle"></i> ຍົກເລີກ
                         </button>
                    </div>
               </div>
          </form>
     </div>
     <!-- Page wrapper end -->
     <?php include('../../components/lib/script.php') ?>
     <script src="./app.js"></script>
     <script>
     $("#rec_bprice,#rec_sprice,#rec_qty").on("keyup click change paste input", function(event) {
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
     <?php 
          include ('../../connection.php');
          if(isset($_POST['handelSave'])){
          @$pro_id = $_setString($con, $_POST['pro_id']);
          @$rec_sprice =filter_var($_POST['rec_sprice'],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
          @$rec_qty = filter_var($_POST['rec_qty'],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
          @$rec_date = $_setString($con, $_POST['rec_date']);
          @$rec_note = $_setString($con, $_POST['rec_note']);
          $userName=$_user_fname.' '.$_user_lname;
          // INSERT DATA
          $_checkStock=$_sql($con,"SELECT*FROM ans_stock_of_sale WHERE pro_id='$pro_id'");
          $catch=$_count($_checkStock);
          $_queryProduction = $_sql($con, "SELECT * FROM ans_receive_of_sale WHERE pro_id='$pro_id' AND rec_qty='$rec_qty' AND rec_bprice='$rec_bprice' AND rec_sprice='$rec_sprice' AND rec_date='$rec_date'");
          $_catch = $_count($_queryProduction);
               if($_catch>0){
                    Duplicate('./add_receive.php');
               }
          // CHECK ID NUMBER
          $_select_max_id_for_add_id=$_sql($con,"SELECT _id FROM ans_receive_of_sale WHERE _id=(SELECT MAX(_id)FROM ans_receive_of_sale)");
          $result=$_assoc($_select_max_id_for_add_id);
          $max_number=$result['_id'];
          if($max_number==""){
               $id_number=1;
          }else{ 
               $id_number=$max_number+1;
          }
          
          $data = "'$id_number','$pro_id','0','$rec_sprice','$rec_qty','$rec_date','true','$rec_note','$_timestamp','$userName','$_state_branch'";
          $_createCategory = $_sql($con, "INSERT INTO ans_receive_of_sale VALUE($data)");
          
          if ($_createCategory) { 
               $_sql($con, "INSERT INTO ans_pricing(pro_id,price_item,createdAt,createdBy)VALUE('$pro_id','$rec_sprice','$_timestamp','$userName')");
                    if($catch<1){
                         mysqli_query($con,"INSERT INTO ans_stock_of_sale(pro_id,st_qty) VALUE('$pro_id','$rec_qty')");
                         _Success('./add_receive.php');
                    }else{
                         $_sql($con, "UPDATE ans_stock_of_sale SET st_qty=st_qty+'$rec_qty' WHERE pro_id='$pro_id' AND branch_id='$_state_branch'"); 
                         _Success('./add_receive.php');
                    }
               } else {
                    Fail('add_receive.php');
               }
          }
     ?>
</body>

</html>