<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
     .visually-hidden {
          margin-top: -200px !important;
     }

     small {
          font-size: 12px !important;
     }

     span.text-success:hover {
          color: red !important;
     }

     .goal-card {
          -webkit-box-shadow: 0px -1px 14px 1px rgba(203, 205, 207, 1);
          -moz-box-shadow: 0px -1px 14px 1px rgba(203, 205, 207, 1);
          box-shadow: 0px -1px 14px 1px rgba(203, 205, 207, 1);
      }
     </style>
</head>
<?php 
     include('../../connection.php');
     $callSummaryForReceive=$_sql($con,"SELECT sum(rec_qty) AS recTotal FROM ans_receive_of_sale");
     $receive=$_assoc($callSummaryForReceive);

     $callSummaryForPaylist=$_sql($con,"SELECT sum(qty) AS payTotal FROM ans_branch_stocks");
     $res=$_assoc($callSummaryForPaylist);
     mysqli_close($con) 
?>

<body>
     <div class="main-container">
          <div class="row gutters p-3">
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="goal-card">
                         <i class="icon-area-graph"></i>
                         <h2 class="text-danger">
                              <?php echo number_format($receive['recTotal']-$res['payTotal'])?> <small> LAK</small>
                         </h2>
                         <h5 class="mt-2">ລວມຍອດຂາຍມື້ນີ້</h5>
                    </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="goal-card">
                         <i class="icon-area-graph"></i>
                         <h2 class="text-danger">
                              <?php echo number_format($receive['recTotal']-$res['payTotal'])?> <small> LAK</small>
                         </h2>
                         <h5 class="mt-2">ລວມຍອດຂາຍເດືອນນີ້</h5>
                    </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="goal-card">
                         <i class="icon-area-graph"></i>
                         <h2 class="text-danger">
                              <?php echo number_format($receive['recTotal']-$res['payTotal'])?> <small> LAK</small>
                         </h2>
                         <h5 class="mt-2">ລວມຍອດຂາຍທັງໝົດ</h5>
                    </div>
               </div>
          </div>
          <div class="blog p-3" style="margin-top:-90px">
               <div class="row mt-5">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center mt-5">
                         <h3 class="mb-3">
                              <u>ລາຍງານລາຍລະອຽດສາງເຄື່ອງຂາຍ </u>
                         </h3>
                    </div>
                    <?php 
                         include('../../connection.php');
                         $call_office_branch=$_sql($con,"SELECT id_branch,branch_name FROM office_branches WHERE provinceID='".$_SESSION['pro_id']."'");
                         mysqli_close($con);
                         foreach ($call_office_branch as $key) {?>
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                         <h4>
                              <u><?php echo $key['branch_name']?></u>
                         </h4>
                         <ul class="mb-3">
                              <li>ຈຳນວນຂາຍອອກ <span class="float-right text-success">00 ອັນ</span></li>
                              <li>ຍອດຂາຍອອກ <span class="float-right text-success">00 ກີບ</span></li>
                         </ul>
                    </div>
                    <?php } ?>
               </div>
          </div>
          <div class="row">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                         <div class="card-header">
                              <div class="card-title">ສະຖິຕິການຂາຍປະຈຳເດືອນ</div>
                         </div>
                         <div class="card-body pt-0">
                              <div id="visitors"></div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="blog p-3" style="margin-top:-90px">
               <div class="row mt-5">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center mt-5">
                         <h3 class="mb-3">
                              <u>ລາຍງານເຄື່ອງໃສສາງແຕ່ລະສາຂາ </u>
                         </h3>
                    </div>
                    <?php 
                         include('../../connection.php');
                         $call_office_branch=$_sql($con,"SELECT id_branch,branch_name FROM office_branches WHERE provinceID='".$_SESSION['pro_id']."'");
                         mysqli_close($con);
                         foreach ($call_office_branch as $key) {?>
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                         <h4>
                              <u><?php echo $key['branch_name']?></u>
                         </h4>
                         <ul class="mb-3">
                              <?php 
                              include('../../connection.php');
                              $call_products=$_sql($con,"SELECT pro_id,pro_title,pro_size FROM ans_production_of_sale");
                              mysqli_close($con);
                              foreach ($call_products as $key) {?>
                              <li><?php echo $key['pro_title'].' '.$key['pro_size'];?>
                                   <span class="float-right text-success">00 ອັນ</span>
                              </li>
                              <?php } ?>
                         </ul>
                    </div>
                    <?php } ?>
               </div>
          </div>
          <!-- Row end -->
     </div>
</body>
<?php include('../../components/lib/script.php') ?>
<script type="text/javascript">
$(function() {
     var options = {
          chart: {
               height: 280,
               type: "bar",
               stacked: true,
               toolbar: {
                    show: false
               },
               zoom: {
                    enabled: true
               }
          },
          plotOptions: {
               bar: {
                    horizontal: false,
                    columnWidth: "40%"
               }
          },
          dataLabels: {
               enabled: false
          },
          series: [{
               name: "ຍອດນຳເຂົ້າ",
               data: [4, 5, 5, 5, 20, 10, 8, 30, 8, 50, 30, 40]
          }, {
               name: "ຍອດເບີກອອກ",
               data: [4, 5, 5, 5, 20, 10, 8, 30, 8, 50, 30, 40]
          }, {
               name: "ຍອດຂາຍ",
               data: [4, 5, 5, 5, 20, 10, 8, 30, 8, 50, 30, 40]
          }],
          xaxis: {
               type: "ເດືອນ",
               categories: [
                    "ມັງກອນ",
                    "ກຸມພາ",
                    "ມີນາ",
                    "ເມສາ",
                    "ພຶດສະພາ",
                    "ມີຖຸນາ",
                    "ກໍລະກົດ",
                    "ສິງຫາ",
                    "ກັນຍາ",
                    "ຕຸລາ",
                    "ພະຈິກ",
                    "ທັນວາ"
               ]
          },
          legend: {
               offsetY: -7
          },
          fill: {
               opacity: 1
          },
          colors: ["#099268", "#c92a2a", "#ffb90f"],
          tooltip: {
               y: {
                    formatter: function(val) {
                         return currency(val, {
                              separator: ','
                         }).format();;
                    }
               }
          }
     };
     var chart = new ApexCharts(document.querySelector("#visitors"), options);
     chart.render();

})

function _openSearch(title, url, w, h) {
     layer.open({
          type: 2,
          area: [w + "%", h + "%"],
          fix: true,
          maxmin: true,
          shade: 0.5,
          title: title,
          content: url
     });
};
</script>

</html>