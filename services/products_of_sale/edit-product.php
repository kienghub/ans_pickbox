<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
</head>
<?php
     include_once('../../connection.php');
     $pro_id=$_GET['id'];
     $call_data_from_local=mysqli_query($con,"SELECT*FROM ans_production_of_sale LEFT JOIN ans_category_of_sale ON ans_category_of_sale.cate_id=ans_production_of_sale.cate_id WHERE ans_production_of_sale.pro_id='$pro_id'");
     $res=$_assoc($call_data_from_local);
?>

<body class="bg-white" ng-app="app" ng-controller="addNew" ng-init="
_callProducts();
_callCategory();
pro_id='<?php echo $res['pro_id'] ?>';
pro_title='<?php echo $res['pro_title'] ?>';
cate_id='<?php echo $res['cate_id'] ?>';
cate_title='<?php echo $res['cate_title'] ?>';
pro_unit='<?php echo $res['pro_unit'] ?>';
pro_size='<?php echo $res['pro_size'] ?>';
pro_serial_number='<?php echo $res['pro_serial_number'] ?>';
pro_model_number='<?php echo $res['pro_model_number'] ?>';
pro_detail='<?php echo $res['pro_detail'] ?>';
pro_img='<?php echo $res['pro_img'] ?>'
">
     <!-- Page wrapper start -->
     <div class="main-container mt-4">
          <form action="#" method="post" id="AddNew">
               <div class="row">
                    <div class="col-md-12">
                         <div class="form-group">
                              <div class="user-profile text-center">
                                   <div class="image">
                                        <div class="dropbox">
                                             <input type="file" name="pro_img" ng-model="por_img"
                                                  onchange="readURL(this);" id="file-5"
                                                  class="hidden inputfile inputfile-4"
                                                  data-multiple-caption="{count} files selected" multiple
                                                  style="display: none!important" />
                                             <label for="file-5">
                                                  <img src="../../img/{{pro_img ? pro_img :'photo.jpg'}}" id="preview"
                                                       style="width:150px;height:130px;margin-bottom:15px" />
                                                  <span class="btn btn-success btn-block btn-sm">
                                                       <i class="icon-link1"></i>
                                                       ເລືອກຮູບ</span>
                                             </label>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                              <label for="taskTitle">ໝວດເຄື່ອງ
                                   <?php isVal()?></label>
                              <div class="input-group mb-2">
                                   <select class="form-control" name="cate_id" ng-model="cate_id">
                                        <option value="{{cate_id}}">{{cate_title}}</option>
                                        <option ng-repeat="x in category" value="{{x.cate_id}}" ng-bind="x.cate_title">
                                        </option>
                                   </select>
                                   <div class="input-group-prepend">
                                        <a href="#" ng-click="AddCategory()" class="input-group-text">
                                             <i class="icon-plus-circle"></i>
                                        </a>
                                   </div>

                              </div>

                         </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                              <label for="taskTitle">ຊື່ເຄື່ອງ
                                   <?php isVal()?></label>
                              <input type="text" class="form-control" style="display:none" name="pro_id"
                                   ng-model="pro_id" />
                              <input type="text" class="form-control" name="pro_title" ng-model="pro_title"
                                   placeholder="ກະລຸນາປ້ອນຊື່ເຄື່ອງ" />
                         </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                              <label for="taskTitle">ຫົວໜວ່ຍ
                                   <?php isVal()?></label>
                              <input type="text" class="form-control" name="pro_unit" ng-model="pro_unit"
                                   placeholder="ກະລຸນາປ້ອນຫົວໜ່ວຍເຄື່ອງ">
                         </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                              <label for="taskTitle">ຂະໜາດ</label>
                              <input type="text" class="form-control" name="pro_size" ng-model="pro_size"
                                   placeholder="ກະລຸນາປ້ອນຂະໜາດເຄື່ອງ">
                         </div>
                    </div>
                    <div class="col-md-12">
                         <div class="form-group">
                              <label for="taskTitle">ລາຍລະອຽດ</label>
                              <textarea rows="4" class="form-control" name="pro_detail" ng-model="pro_detail">
                                                                      </textarea>
                         </div>
                    </div>
                    <div class="col-md-6">
                         <button type="submit" class="btn btn-success">
                              <i class="icon-check-circle"></i> ບັນທຶກ
                         </button>
                         <button type="reset" class="btn btn-danger">
                              <i class="icon-x-circle"></i> ຍົກເລີກ
                         </button>
                    </div>
               </div>
          </form>
     </div>
     <div class="modal fade mt" id="frmCategory" tabindex="-1" data-keyboard="false" data-backdrop='static'
          role="dialog" aria-labelledby="addNewDocumentLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                    <div class="modal-body">
                         <a href="#" ng-click="frmHide2()" style="float:right">
                              <h3> <i class="icon-x-circle text-danger"></i></h3>
                         </a>
                         <h4>ເພີ່ມໝວດເຄື່ອງ</h4>
                         <hr>
                         <form action="#" method="post" id="AddCategory">
                              <div class="row">
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label for="taskTitle">ໝວດເຄື່ອງ
                                                  <?php isVal()?></label>
                                             <input type="hidden" ng-model="cate_id">
                                             <input type="text" class="form-control" id="cate_title"
                                                  ng-model="cate_title" placeholder="ກະລຸນາປ້ອນໝວດເຄື່ອງ">
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <button type="button" ng-click="_onSave()" class="btn btn-success">
                                             <i class="icon-check-circle"></i>
                                             ແກ້ໄຂ
                                        </button>
                                        <button type="reset" class="btn btn-danger">
                                             <i class="icon-x-circle"></i> ຍົກເລີກ
                                        </button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
     <!-- Page wrapper end -->
     <?php include('../../components/lib/script.php') ?>
     <script src="./app.js"></script>

</body>

</html>