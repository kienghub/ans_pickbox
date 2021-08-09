<!doctype html>
<html lang="en">

<head>
     <title>print</title>
     <style>
          body{
                background-color: white!important;
          }
     #table {
          border-collapse: collapse;
          border-spacing: 0;
          width: 100%;
          font-size: 16px!important;
     }

     .tbody {
          border: 1px inset black;
          padding: 5px;
          font-size: 16px!important;
     }

     .thead {
          border: 1px inset black;
          padding: 5px;
          font-size: 16px!important;
          font-weight: bolder;
     }
@media print{
     body{
          background-color: white;
          font-size: 15px!important;
          font-family: phetsarath OT;
     }
}
     </style>
</head>
<?php include('../../connection.php')?>
<body onload="printThis('layout')" ng-app="app" ng-controller="requestedList" ng-init="_onApprovedThis('<?php echo $_GET['id']?>')">
<div id="layout">
     <!-- Page wrapper start -->
     <table width="100%">
          <tr>
               <td colspan="2">
                    <center>
                         <h2 style="color:black!important">
                           <u>   ໃບມອບເຄື່ອງຂາຍ </u>
                         </h2>
                    </center>
               </td>
          </tr>
          <tr>
               <td width="50%">
                    <img src="../../img/logo_next_day.png" width="150px">
               </td>
          </tr>
          <tr>
               <td width="50%">
                    ບໍລິສັດ ອານູສິດ ໂລຈິສຕິກ ຈໍາກັດ
               </td>

               <td width="50%" style="text-align:right;">
                    ວັນທີ: <?php echo $_today ?> &nbsp;&nbsp;
               </td>
          </tr>
          <tr>
               <td width="50%">
                    ບ້ານ ໂພນສະຫວ່າງ, ເມືອງ ຈັນທະບູລີ, ນະຄອນຫຼວງວຽງຈັນ
               </td>
          </tr>
     </table><br>
     <div class="table-responsive text-center">
          <table id="table" style="border-collapse: collapse;border-spacing: 0; width: 100%;">
               <thead>
                    <tr>
                         <td class="thead">#</td>
                         <td class="thead">ລາຍການ</td>
                         <td class="thead">ຈຳນວນເຄື່ອງ</td>
                         <td class="thead">ສາຂາປາຍທາງ</td>
                         <td class="thead">ຜູ້ຂໍເບີກ</td>
                    </tr>
               </thead>
               <tbody>
                    <tr ng-repeat="n in _list">
                         <td class="tbody" ng-bind="$index+1"></td>
                         <td class="tbody" style="text-align:left" ng-bind="n.pro_title +' '+n.pro_size"></td>
                         <td class="tbody" style="text-align:right" ng-bind="(n.req_qty | number) +' '+n.pro_unit"></td>
                         <td class="tbody" ng-repeat="x in _listBranch" ng-bind="x.branch_name"></td>
                         <td class="tbody" ng-bind="n.req_user_consumer"></td>
                    </tr>
               </tbody>
          </table><br>
          <table width="100%"
               style="text-align:center;margin-top:15px;margin-bottom:100px;border:none!important;font-size:15px">
               <tr>
                    <td width="33%">
                         <u> ນາຍສາງ </u>
                    </td>
                    <td width="33%">
                         <u> ໂຊເຟີ່ </u>
                    </td>
                    <td width="33%">
                         <u> ຜູ້ຮັບ </u>
                    </td>
               </tr>
          </table>
     </div>
     </div>
     <!-- Page wrapper end -->
     <?php 
          include('../../components/lib/script.php');
      ?>
     <script>
     var app = angular.module("app", []);
     app.controller("requestedList", function($scope, $http) {
                    $scope._onApprovedThis = function(id) {
                         console.log(id)
                         $http.get("sql/query_request.php?id=" + id).success(function(data) {
                              $scope._list = data;
                              console.log(data);
                         });

                         $http.get("sql/query_branch_name.php?id=" + id).success(function(data) {
                              $scope._listBranch = data;
                         });
                         $scope.branch_id = id;
                    }
               })
     </script>
     <script>
     function printThis(data) {
          setTimeout(() => {
               var printContents = document.getElementById(data).innerHTML;
               var originalContents = document.body.innerHTML;
               document.body.innerHTML = printContents;
               window.print();
               document.body.innerHTML = originalContents;
          }, 1000);
     }
     </script>
</body>

</html>