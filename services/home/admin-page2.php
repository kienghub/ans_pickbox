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
     //? summary of day
     $callSummaryOfToday=$_sql($con,"SELECT sum(s_qty*sprice) AS total FROM ans_sale where s_date='$_today' AND branch_id='$_state_branch'");
     $Today=$_assoc($callSummaryOfToday);

     //? summary of month
     $callSummaryOfTMonth=$_sql($con,"SELECT sum(s_qty*sprice) AS total FROM ans_sale where s_date like'_____$_month%' AND branch_id='$_state_branch'");
     $month=$_assoc($callSummaryOfTMonth);

     //? summary of all
     $callSummaryOfAll=$_sql($con,"SELECT sum(s_qty*sprice) AS total FROM ans_sale WHERE branch_id='$_state_branch'");
     $all=$_assoc($callSummaryOfAll);
     mysqli_close($con) 
?>

<body>
     <div class="main-container">
          <div class="row gutters p-3">
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="goal-card">
                         <i class="icon-area-graph"></i>
                         <h2 class="text-danger">
                              <?php echo number_format($Today['total'])?> <small> LAK</small>
                         </h2>
                         <h5 class="mt-2">ລວມຍອດຂາຍມື້ນີ້</h5>
                    </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="goal-card">
                         <i class="icon-area-graph"></i>
                         <h2 class="text-danger">
                              <?php echo number_format($month['total'])?> <small> LAK</small>
                         </h2>
                         <h5 class="mt-2">ລວມຍອດຂາຍເດືອນນີ້</h5>
                    </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="goal-card">
                         <i class="icon-area-graph"></i>
                         <h2 class="text-danger">
                              <?php echo number_format($all['total'])?> <small> LAK</small>
                         </h2>
                         <h5 class="mt-2">ລວມຍອດຂາຍທັງໝົດ</h5>
                    </div>
               </div>
          </div>
          <div class="blog p-3" style="margin-top:-90px">
               <div class="row mt-5">
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                         <h4 class="mb-3 mt-3">
                              <u>ລາຍງານຍອດນຳເຂົ້າເດືອນນີ້ </u>
                         </h4>
                         <ul class="mb-3">
                              <?php 
                              function _summary_for_receive($x){
                              include('../../connection.php');
                              $getTotal=$_sql($con,"SELECT SUM(rec_qty) as total FROM ans_receive_of_sale WHERE pro_id='$x' AND branch_id='$_state_branch'");
                              $res=$_assoc($getTotal);
                              echo @number_format($res['total']);
                              }

                              include('../../connection.php');
                              $call_products=$_sql($con,"SELECT pro_id,pro_title,pro_size FROM ans_production_of_sale");
                              mysqli_close($con);
                              foreach ($call_products as $keys) {?>
                              <li><?php echo $keys['pro_title'].' '.$keys['pro_size'];?>
                                   <span class="float-right text-success"><?php _summary_for_receive($keys['pro_id'])?>
                                        ອັນ</span>
                              </li>
                              <?php } ?>
                         </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                         <h4 class="mb-3 mt-3">
                              <u>ລາຍງານຍອດເບີກ(ຂາຍ)ເດືອນນີ້ </u>
                         </h4>
                         <ul class="mb-3">
                              <?php 
                              function _summary_for_sale($x){
                              include('../../connection.php');
                              $getTotal=$_sql($con,"SELECT SUM(s_qty) as total FROM ans_sale WHERE pro_id='$x' AND branch_id='$_state_branch'");
                              $res=$_assoc($getTotal);
                              echo @number_format($res['total']);
                              }
                              
                              include('../../connection.php');
                              $call_products=$_sql($con,"SELECT pro_id,pro_title,pro_size FROM ans_production_of_sale");
                              mysqli_close($con);
                              foreach ($call_products as $keys) {?>
                              <li><?php echo $keys['pro_title'].' '.$keys['pro_size'];?>
                                   <span class="float-right text-success"><?php _summary_for_sale($keys['pro_id'])?>
                                        ອັນ</span>
                              </li>
                              <?php } ?>
                         </ul>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                         <h4 class="mb-3 mt-3">
                              <u>ລາຍງານຍອດເຫລືອເຄື່ອງໃນສາງ </u>
                         </h4>
                         <ul class="mb-3">
                              <?php 
                              function _summary($x){
                              include('../../connection.php');
                              $getTotal=$_sql($con,"SELECT SUM(qty) as total FROM ans_branch_stocks WHERE pro_id='$x' AND branch_id='$_state_branch'");
                              $res=$_assoc($getTotal);
                              echo @number_format($res['total']);
                              }
                              
                              include('../../connection.php');

                              $call_products=$_sql($con,"SELECT pro_id,pro_title,pro_size FROM ans_production_of_sale");
                              mysqli_close($con);
                              foreach ($call_products as $keys) {?>
                              <li><?php echo $keys['pro_title'].' '.$keys['pro_size'];?>
                                   <span class="float-right text-success">
                                        <?php _summary($keys['pro_id'])?> ອັນ
                                   </span>
                              </li>
                              <?php } ?>
                         </ul>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                         <div class="card-header">
                              <div class="card-title">ສະຖິຕິການຂາຍປະຈຳເດືອນ </div>
                         </div>
                         <div class="card-body pt-0">
                              <div id="visitors"></div>
                         </div>
                    </div>
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
               name: "ຍອດການຂາຍ",
               data: [
                    <?php for($i=1;$i<12;$i++){
                    include('../../connection.php');
                    $callSummaryOfGraph=$_sql($con,"SELECT sum(s_qty*sprice) AS total FROM ans_sale where MONTH(s_date)='$i' AND branch_id='$_state_branch'");
                    $m=$_assoc($callSummaryOfGraph); 
                    if($m['total']>0){
                    echo @$m['total'].',';
                    }else{
                         echo '0'.',';
                    }
                    }?>
               ]
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
          colors: ["#c92a2a"],
          tooltip: {
               y: {
                    formatter: function(val) {
                         return currency(val, {
                              separator: ',',
                              symbol: '₭ '
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