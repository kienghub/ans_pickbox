<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php')?>
     <?php include('../../access/access.php')?>
</head>

<body>
     <!-- Page wrapper start -->
     <div class="page-wrapper">
          <?php include('../../components/layout/side-bar.php') ?>
          <!-- Page content start  -->
          <div class="page-content">
               <?php include('../../components/layout/heading.php')?>
               <!-- Page header start -->
               <div class="page-header">
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item">ຈັດການຂໍ້ມູນ</li>
                         <li class="breadcrumb-item active">ຈັດການຂໍ້ມູນສາງ</li>
                    </ol>
               </div>
               <!-- Page header end -->
               <!-- Main container start -->
               <div class="main-container" id="main">
                    <div class="row gutters">
                         <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12" id="sublist">
                              <a href="../products_of_sale/">
                                   <div class="info-stats4">
                                        <div class="info-icon">
                                             <i class="icon-layers2"></i>
                                        </div>
                                        <div class="sale-num">
                                             <h4>ລາຍການເຄື່ອງ</h4>
                                             <p>ຈັດການຂໍ້ມູນ</p>
                                        </div>
                                   </div>
                              </a>
                         </div>
                    </div>
                    <!-- Row end -->
               </div>
               <!-- Main container end -->
          </div>
          <!-- Page content end -->
     </div>
     <!-- Page wrapper end -->
     <?php include('../../components/lib/script.php')?>
     <script>
     $(function() {
          $('#setting_icon').addClass('text-white')
          $('#setting_text').addClass('text-white')
          $('#ms_stock_for_sale').addClass('text-white')
     })
     </script>
</body>

</html>