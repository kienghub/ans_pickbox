<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php'); ?>
     <style>
     .box-table {
          cursor: pointer;
     }

     .box-table:hover {
          background-color: #a5d8ff;
          color: black !important;
          -webkit-box-shadow: 4px 10px 15px -5px rgba(0, 0, 0, 0.75);
          -moz-box-shadow: 4px 10px 15px -5px rgba(0, 0, 0, 0.75);
          box-shadow: 4px 10px 15px -5px rgba(0, 0, 0, 0.75);
     }

     table tr td {
          padding: 5px;
     }
     </style>
</head>

<body ng-app="app" ng-controller="home" ng-init="_summary()">
     <!-- Page wrapper start -->
     <div class="page-wrapper">
          <?php include('../../components/layout/side-bar.php') ?>
          <!-- Page content start  -->
          <div class="page-content">
               <?php include('../../components/layout/heading.php')?>
               <!-- Page header start -->
               <div class="page-header">
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item">ໜ້າຫຼັກ</li>
                         <li class="breadcrumb-item active">ລາຍລະອຽດ </li>
                    </ol>
               </div>

               <?php
               if($permission==1 || $permission==4 && $permission_id!=501){
                    include('admin-page.php');
               }else{
                    include('admin-page2.php');
               }
                ?>
          </div>
          <!-- Page content end -->
     </div>
     <!-- Page wrapper end -->
     <?php include('../../components/lib/script.php') ?>
     <script src="app.js"></script>
     <script>
     $('#home_text,#home_icon').addClass('text-white')
     </script>
</body>

</html>