<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
</head>

<body ng-app="app" ng-controller="product" ng-init="_callProducts();_callCategory()">
     <!-- Page wrapper start -->
     <div class="page-wrapper ">
          <?php include('../../components/layout/side-bar.php') ?>
          <!-- Page content start  -->
          <div class="page-content">
               <?php include('../../components/layout/heading.php') ?>
               <!-- Page header start -->
               <div class="page-header">
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item" onclick="window.location='../settings/'">
                              ຈັດການຂໍ້ມູນ</li>
                         <li class="breadcrumb-item active">ຈັດການລາຍການເຄື່ອງ</li>
                    </ol>
                    <ul class="app-actions">
                         <li>
                              <button type="button" ng-click="_onAdd('ເພິ່ມຂໍ້ມູນເຄື່ອງ','./add-product.php',900,660)"
                                   class="btn btn-primary btn-lg">
                                   <i class="icon-plus-circle"></i> ເພີ່ມລາຍການເຄື່ອງ </button>
                         </li>
                         &nbsp;&nbsp;
                         <li>
                              <button type="button"
                                   onclick="_showCategory('ຂໍ້ມູນໝວດເຄື່ອງ','../category_of_sale/',100,100)"
                                   class="btn btn-light btn-lg">
                                   <i class="icon-list"></i> ໝວດເຄື່ອງ </button>
                         </li>
                         &nbsp;&nbsp;
                         <li>
                              <button type="button" onclick="_showCategory('ປັບປຸງລາຄາເຄື່ອງ','../pricing/',100,100)"
                                   class="btn btn-light btn-lg">
                                   <i class="icon-timeline"></i> ປັບລາຄາເຄື່ອງ </button>
                         </li>
                    </ul>
               </div>
               <!-- Page header end -->
               <div class="main-container">
                    <div class="row">
                         <div class="col-12">
                              <!-- Row start -->
                              <a href=""></a>
                              <div class="table-container p-4">
                                   <div class="t-header">
                                        <ul class="nav nav-tabs">
                                             <li class="nav-item">
                                                  <a class="nav-link"
                                                       href="../stocks_of_sale/">ເຄື່ອງໃນສາງໃຫຍ່ທັງໝົດ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link" href="../receive_of_sale/">ເອົາເຄື່ອງເຂົ້າສາງ</a>
                                             </li>
                                             <li class="nav-item">
                                                  <a class="nav-link active" href="./">ຈັດການຂໍ້ມູນເຄື່ອງ</a>
                                             </li>
                                        </ul>
                                   </div>
                                   <div class="table-responsive" style="overflow:auto;">
                                        <table datatable="ng" dt-option="vm.dtOption"
                                             class="table table-striped table-sm">
                                             <thead>
                                                  <tr style="background-color:red">
                                                       <th class="text-center" width='50px'>#</th>
                                                       <th class="text-center">ຮູບ</th>
                                                       <th class="text-center">ເລກກຳກັບເຄື່ອງ</th>
                                                       <th class="text-center">ລາຍການເຄື່ອງ</th>
                                                       <th class="text-center">ຫົວໜ່ວຍ</th>
                                                       <th class="text-center">ຂະໜາດ</th>
                                                       <th class="text-center">ລາຍລະອຽດ</th>
                                                       <th class="text-center">ສ້າງໂດຍ</th>
                                                       <th class="text-center"></th>
                                                  </tr>
                                                  <thead>
                                                  <tbody>
                                                       <tr ng-repeat="x in _products | filter:_filter">
                                                            <td class="text-center" ng-bind="$index+1"></td>
                                                            <td class="text-center">
                                                                 <img src="../../img/{{x.pro_img?x.pro_img:'photo.jpg'}}"
                                                                      style="width:80px;height:80px" alt="">
                                                            </td>
                                                            <td class="text-center" ng-bind="x.pro_number"></td>
                                                            <td ng-bind="x.pro_title"></td>
                                                            <td class="text-center" ng-bind="x.pro_unit"></td>
                                                            <td class="text-center" ng-bind="x.pro_size"></td>
                                                            <td ng-bind="x.pro_detail"></td>
                                                            <td class="text-center" ng-bind="x.pro_createdBy"></td>
                                                            <td style="width:90px!important;text-align:center">
                                                                 <div class="btn-group">
                                                                      <button type="button"
                                                                           ng-click="_onUpdate('ແກ້ໄຂຂໍ້ມູນເຄື່ອງ','./edit-product.php?id='+x.pro_id,900,660)"
                                                                           class="btn btn-outline-success">
                                                                           <i class="icon-edit"></i>
                                                                      </button>
                                                                      <button type="button"
                                                                           ng-click="_onDelete(x.pro_id)"
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
                              <!-- Row end -->
                         </div>
                         <!-- Main container end -->
                    </div>
                    <!-- Page content end -->
                    <!-- Page wrapper end -->
                    <?php include('../../components/lib/script.php') ?>
                    <script src="./app.js"></script>
                    <script>
                    $(function() {
                         $('#setting_icon').addClass('text-white')
                         $('#setting_text').addClass('text-white')
                         $('#ms_stock_for_sale').addClass('text-white')
                    })

                    function _showCategory(title, url, w, h) {
                         layer.open({
                              type: 2,
                              area: [w + "%", h + "%"],
                              fix: true,
                              maxmin: true,
                              shade: 0.4,
                              title: title,
                              content: url
                         });
                    };
                    </script>
</body>

</html>