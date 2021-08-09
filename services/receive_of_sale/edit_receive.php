<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
</head>
<?php
     include_once('../../connection.php');
     $id=$_GET['id'];
     $call_data_from_local=mysqli_query($con,"SELECT*FROM ans_receive_of_sale 
	LEFT JOIN ans_production_of_sale ON ans_receive_of_sale.pro_id = ans_production_of_sale.pro_id WHERE ans_receive_of_sale._id='$id'");
     $res=$_assoc($call_data_from_local);
     ?>

<body ng-app="app" ng-controller="editReceiveOfSale" ng-init="_callCategory();
     _id='<?php echo $res['_id']?>';
     pro_id='<?php echo $res['pro_id']?>';
     pro_title='<?php echo $res['pro_title']?>';
     pro_size='<?php echo $res['pro_size']?>';
     rec_qty='<?php echo number_format($res['rec_qty'])?>';
     rec_bprice='<?php echo number_format($res['rec_bprice'])?>';
     rec_sprice='<?php echo number_format($res['rec_sprice'])?>';
     rec_date='<?php echo $res['rec_date']?>';
     user_holder='<?php echo $res['user_holder']?>';
     rec_note='<?php echo $res['rec_note']?>';
     old_qty='<?php echo $res['rec_qty']?>';
     ">
     <!-- Page header end -->
     <div class="main-container bg-white pt-3">
          <!-- Page header end -->
          <form action="#" method="post">
               <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                              <label for="taskTitle">ໝວດເຄື່ອງ
                                   <?php isVal()?></label>
                              <input type="text" ng-model="_id" name="_id" style="display:none">
                              <input type="text" ng-model="old_qty" name="old_qty" style="display:none">
                              <select class="form-control select2" ng-model="cate_id" ng-change="selectedCategory()">
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
                              <select class="form-control select2" ng-model="pro_id" name="pro_id">
                                   <option value={{pro_id}} ng-bind="pro_title +' '+pro_size"></option>
                                   <option ng-repeat="n in production" value={{n.pro_id}}
                                        ng-bind="n.pro_title+' '+n.pro_size">
                                   </option>
                              </select>
                         </div>
                    </div>
                    <div class="col-6">
                         <div class="form-group">
                              <label for="taskTitle">ລາຄາ
                                   <?php isVal()?>
                              </label>
                              <input type="text" class="form-control text-right" id="rec_sprice" name="rec_sprice" ng-model="rec_sprice">
                         </div>
                    </div>
                    <div class="col-6">
                         <div class="form-group">
                              <label for="rec_qty">ຈຳນວນ <?php isVal()?></label>
                              <input type="text" class="form-control text-right" id="rec_qty" name="rec_qty" ng-model="rec_qty">
                         </div>
                    </div>
                    <div class="col-md-12">
                         <div class="form-group">
                              <label for="taskTitle">ວັນທີ <?php isVal()?></label>
                              <input type="text" data-toggle="datepicker" class="form-control" name="rec_date" ng-model="rec_date"
                                   value={{rec_date}}>
                         </div>
                    </div>
                    <div class="col-md-12">
                         <div class="form-group">
                              <label for="taskTitle">ໝາຍເຫດ</label>
                              <textarea rows="4" class="form-control" ng-model="rec_note" name="rec_note"></textarea>
                         </div>
                    </div>
                    <div class="col-md-6">
                         <button type="submit" name="handelSave" class="btn btn-success">
                              <i class="icon-check-circle"></i> ແກ້ໄຂຂໍ້ມູນ
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
          @$id = $_setString($con, $_POST['_id']);
          @$pro_id = $_setString($con, $_POST['pro_id']);
          @$rec_sprice =filter_var($_POST['rec_sprice'],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
          @$rec_qty = filter_var($_POST['rec_qty'],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
          @$old_qty = filter_var($_POST['old_qty'],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
          @$rec_date = $_setString($con, $_POST['rec_date']);
          @$rec_note = $_setString($con, $_POST['rec_note']);
          $userName=$_user_fname.' '.$_user_lname;
          // INSERT DATA
          $onReset=$_sql($con, "UPDATE ans_stock_of_sale SET st_qty=st_qty-'$old_qty' WHERE pro_id='$pro_id'");
          if($onReset){
               $newData = "pro_id='$pro_id',rec_qty='$rec_qty',rec_sprice='$rec_sprice',rec_date='$rec_date',rec_note='$rec_note',rec_createdAt='$_timestamp',rec_createdBy='$userName'"; 
               $onUpdate=$_sql($con, "UPDATE ans_receive_of_sale SET $newData  WHERE _id='$id'");

               $updated=$_sql($con, "UPDATE ans_stock_of_sale SET st_qty=st_qty+'$rec_qty' WHERE pro_id='$pro_id'"); 
          _Success('./add_receive.php');
               } else {
                    Fail('add_receive.php');
               }
          }
     ?>
</body>

</html>