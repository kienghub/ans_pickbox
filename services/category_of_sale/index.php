<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
</head>

<body ng-app="app" ng-controller="controller" ng-init="_callCategory();">
     <div class="main-container mt-3">
          <div class="row">
               <div class="col-md-3 col-sm-3 col-xs-12 card p-3">
                    <h4 class="mt-2 text-center" ng-bind="titles"></h4>
                    <hr>
                    <div class="form-group">
                         <label for="">ໝວດເຄື່ອງ <?php isVal() ?></label>
                         <input type="text" ng-model="cate_title" class="form-control"
                              placeholder="ກະລຸນາປ້ອນໝວດເຄື່ອງ">
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
                         <h4 class="t-header"><i class="icon-list"></i> ລາຍການໝວດເຄື່ອງທັງໝົດ
                         </h4>
                         <div class="table-responsive">
                              <table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-sm">
                                   <thead>
                                        <tr>
                                             <th class="text-center" width='90'>#</th>
                                             <th class="text-center">ໝວດເຄື່ອງ</th>
                                             <th class="text-center">ວັນທີສ້າງ</th>
                                             <th class="text-center">ສ້າງໂດຍ</th>
                                             <th class="text-center"></th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr ng-repeat="n in _categorys">
                                             <td class="text-center" ng-bind="$index+1"></td>
                                             <td ng-bind="n.cate_title"></td>
                                             <td class="text-center" ng-bind="n.cate_createdAt">
                                             </td>
                                             <td class="text-center" ng-bind="n.cate_createdBy"></td>
                                             <td style="width:100px!important;text-align:center">
                                                  <div class="btn-group">
                                                       <button type="button"
                                                            ng-click="_onUpdate(n.cate_ide,n.cate_title)"
                                                            class="btn btn-outline-success">
                                                            <i class="icon-edit"></i>
                                                       </button>
                                                       <button type="button" ng-click="_onDelete(n.cate_id)"
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
     </script>
</body>

</html>