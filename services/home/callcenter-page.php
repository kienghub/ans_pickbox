<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
</head>

<body>
     <div class="main-container">
          <div class="row gutters">
               <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- Row starts -->
                    <div class="row gutters">
                         <?php 
                         include('../../connection.php');
                         function all($x){
                         global $con;
                         global $_state_branch;
                         $check_stock_for_branch=mysqli_query($con,"SELECT SUM(qty) as total from ans_branch_stocks where pro_id='$x' AND ans_branch_stocks.branch_id='$_state_branch'");
                         $res=mysqli_fetch_assoc($check_stock_for_branch);
                         echo number_format($res['total']);
                         }

                         $query  =mysqli_query($con,"SELECT*FROM ans_branch_stocks
                            LEFT JOIN ans_production_of_sale
                            ON ans_branch_stocks.pro_id = ans_production_of_sale.pro_id WHERE ans_branch_stocks.branch_id='$_state_branch' group by ans_branch_stocks.pro_id");
                            foreach ($query as $key) {?>
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                              <div class="goal-card">
                                   <i class="icon-box"></i>
                                   <h2 class="text-danger">
                                        <?php all($key['pro_id']) ?>
                                   </h2>
                                   <h5 class="mt-2"><?php echo $key['pro_title']?></h5>
                              </div>
                         </div>
                         <?php } ?>
                         <div class="col-md-12">
                              <div class="card h-400">
                                   <div class="card-header">
                                        <h4><i class="icon-timeline"></i> ລາຍການຂາຍປະຈຳວັນ</h4>
                                        <hr>
                                   </div>
                                   <div class="card-body">
                                        <div class="customScroll5">
                                             <div class="top-agents-container">
                                                  <table id="data" class="table table-striped table-hover table-sm">
                                                       <thead>
                                                            <tr style="background-color:#c92a2a;color:white">
                                                                 <th style="text-align:center" width='50px'>#</th>
                                                                 <th style="text-align:center">ລາຍການເຄື່ອງ</th>
                                                                 <th style="text-align:center">ຫົວໜ່ວຍ</th>
                                                                 <th style="text-align:center">ຂະໜາດ</th>
                                                                 <th style="text-align:center">ຈຳນວນ</th>
                                                                 <th style="text-align:center">ລາຄາຂາຍ</th>
                                                                 <th style="text-align:center">ເປັນເງິນ</th>
                                                                 <th style="text-align:center">ຜູ້ຂາຍ</th>
                                                                 </th>
                                                            </tr>
                                                            <thead>
                                                            <tbody>
                                                                 <?php
                                                           include('../../connection.php');
                                                            $sql=mysqli_query($con,"SELECT SUM(s_qty)as qtyTotal FROM ans_sale WHERE branch_id='$_state_branch' AND s_date='$_today'");
                                                            $subTotal=$_assoc($sql);

                                                            $callAmount=mysqli_query($con,"SELECT SUM(s_qty*sprice)as priceTotal FROM ans_sale  WHERE branch_id='$_state_branch' AND s_date='$_today'");
                                                            $priceTotal=$_assoc($callAmount);
                                   
                                                            $i=1;
                                                            $_Result=mysqli_query($con,"SELECT*FROM ans_sale
                                                            LEFT JOIN ans_production_of_sale
                                                            ON ans_sale.pro_id = ans_production_of_sale.pro_id
                                                            WHERE  ans_sale.branch_id='$_state_branch' AND ans_sale.s_date='$_today' ORDER BY ans_sale._id DESC");
                                                            mysqli_close($con);
                                                            foreach ($_Result as $res) { ?>
                                                                 <tr>
                                                                      <td style="text-align:center"><?php echo $i ?>
                                                                      </td>
                                                                      <td><?php echo $res['pro_title']?></td>
                                                                      <td><?php echo $res['pro_unit']?></td>
                                                                      <td><?php echo $res['pro_size']?></td>
                                                                      <td style="text-align:right">
                                                                           <?php echo number_format($res['s_qty'])?>
                                                                      </td>
                                                                      <td style="text-align:right">
                                                                           <?php echo number_format($res['sprice'])?>
                                                                      </td>
                                                                      <td style="text-align:right">
                                                                           <?php echo number_format($res['s_qty']*$res['sprice'])?>
                                                                      </td>
                                                                      <td> <?php echo $res['s_createdBy']?></td>
                                                                 </tr>
                                                                 <?php $i++;} ?>
                                                                 <tr>
                                                                      <td colspan="7" class="text-right">ລວມຈຳນວນຂາຍ
                                                                      </td>
                                                                      <td class="text-right">
                                                                           <?php echo number_format($subTotal['qtyTotal']) ?>
                                                                           ອັນ
                                                                      </td>
                                                                 </tr>
                                                                 <tr>
                                                                      <td colspan="7" class="text-right">ລວມມູນຄ່າຂາຍ
                                                                      </td>
                                                                      <td class="text-right">
                                                                           <?php echo number_format($priceTotal['priceTotal']) ?>
                                                                           ກີບ
                                                                      </td>
                                                                 </tr>
                                                            </tbody>
                                                  </table>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- Row ends -->
               </div>
               <?php 
                    include('../../connection.php');
                    @$callSummaryForReceive=$_sql($con,"SELECT sum(req_qty) AS recTotal FROM ans_requirements WHERE req_status='DONE' AND branch_id='1'");
                    @$receive=$_assoc($callSummaryForReceive);

                    $callSummaryForPaylist=$_sql($con,"SELECT sum(qty) AS payTotal FROM ans_branch_stocks WHERE branch_id='$_state_branch'");
                    $res=$_assoc($callSummaryForPaylist);
               mysqli_close($con) 
               ?>
               <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 bg-primary pt-3">
                    <h4 class="text-white"> <i class="icon-list"></i> ຍອດເຄື່ອງໃນສາງ </h4>
                    <ul>
                         <li class="p-1 text-white">
                              <span>ຈຳນວນນຳເຂົ້າ</span>
                              <p class="pull-right"> <?php echo number_format($receive['recTotal']).' '.'ອັນ';?></p>

                         </li>
                         <li class="p-1 text-white">
                              <span>ຈຳນວນເບີກອອກ</span>
                              <p class="pull-right">
                                   <?php echo number_format($receive['recTotal']-$res['payTotal']).' '.'ອັນ';?>
                              </p>

                         </li>
                         <li class="p-1 text-white">
                              <span>ຄົງເຫຼືອໃນສາງ</span>
                              <p class="pull-right">
                                   <?php echo number_format($res['payTotal']).' '.'ອັນ';?>
                              </p>
                         </li>
                    </ul>
                    <hr style="border-color:white">
                    <h4 class="text-white"> <i class="icon-list"></i> ລາຍລະອຽດເຄື່ອງໃນສາງ </h4>
                    <ul>
                         <?php 
                         include('../../connection.php');
                        $ResultDetails=mysqli_query($con,"SELECT*FROM ans_branch_stocks
                            LEFT JOIN ans_production_of_sale
                            ON ans_branch_stocks.pro_id = ans_production_of_sale.pro_id WHERE ans_branch_stocks.branch_id='$_state_branch' GROUP BY ans_branch_stocks.pro_id");
                         mysqli_close($con);
                         foreach ($ResultDetails as $list) { ?>
                         <li class="p-1 text-white">
                              <span><?php echo $list['pro_title']?> / <?php echo $list['pro_unit']?></span>
                              <ul class="ml-3">
                                   <?php 
                                   include('../../connection.php');
                                   $trackingSize=mysqli_query($con,"SELECT*FROM ans_branch_stocks
                                   LEFT JOIN ans_production_of_sale
                                   ON ans_branch_stocks.pro_id = ans_production_of_sale.pro_id WHERE ans_branch_stocks.branch_id='$_state_branch' GROUP BY ans_production_of_sale.pro_size");
                                   mysqli_close($con);
                                   foreach ($trackingSize as $size) { ?>
                                   <li>
                                        <span><?php echo $size['pro_size']?></span>
                                        <span class="pull-right">
                                             <?php 
                                             $pro_size=$size['pro_size'];
                                             $proID=$list['pro_id'];
                                             include('../../connection.php');
                                             $trackingforSize=mysqli_query($con,"SELECT sum(qty) as total FROM ans_branch_stocks LEFT JOIN ans_production_of_sale on ans_branch_stocks.pro_id=ans_production_of_sale.pro_id WHERE pro_size='$pro_size' AND ans_branch_stocks.branch_id='$_state_branch' AND ans_branch_stocks.pro_id='$proID'");
                                             $result=mysqli_fetch_assoc($trackingforSize);
                                             echo number_format($result['total']).' '.'ອັນ'; 
                                        ?>
                                        </span>
                                   </li>
                                   <?php } ?>
                              </ul>
                         </li>
                         <?php } ?>
                    </ul>
                    <hr style="border-color:white">
                    <h5 class="text-center text-white">Anousith-Stocks</h5>
               </div>
               <!-- Row end -->

          </div>
          <!-- Row end -->
     </div>
</body>

</html>