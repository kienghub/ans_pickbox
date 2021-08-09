<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <?php include('../../components/lib/lib.php') ?>
     <?php include('../../access/access.php') ?>
     <style>
     .card {
          cursor: pointer;
          border: 1px solid #ced4da;
     }

     .card:hover {
          background-color: #ced4da;
     }

     .list-menu .active {
          background-color: #ced4da;
          border-bottom: 3px solid black;
     }

     .check-box {
          width: 18px;
          height: 18px;
     }

     .w-2 {
          width: 20px;
     }

     .presize {
          margin-top: -35px;
          margin-right: -17px;
          width: 80px;
          padding: 3px;
          background-color: #c92a2a;
          color: white;
          border-top-right-radius: 5px;
          border-bottom-left-radius: 5px;
     }
     </style>
</head>
<?php   
     include('../../connection.php');
     $_SESSION['st_date']=$_GET['st_date'];
     $_SESSION['end_date']=$_GET['end_date'];
     $_SESSION['state']=$_GET['state'];

     $st_date=$_GET['st_date']=$_SESSION['st_date'];
     $end_date=$_GET['end_date']=$_SESSION['end_date'];
     $state=$_SESSION['state']=$_GET['state'];
     if(!$_GET['state']){
     $branch="";
     $newState="";
     }else{
     $branch=$_SESSION['state'];
     $newState="AND ans_sale.branch_id='$branch'";
     }
     $call_date_for_sum=$_sql($con,"SELECT sum(s_qty) AS total FROM ans_sale WHERE s_date BETWEEN '$st_date' AND '$end_date' $newState");
     $res=$_assoc($call_date_for_sum);
     mysqli_close($con);
     ?>

<body ng-app="app" ng-controller="paylistHistory" ng-init="
     st_date='<?php echo $st_date ?>';
     end_date='<?php echo $end_date ?>'">
     <div class="main-container blog">
          <div class="row">
               <div class="col-md-2">
                    <div class="form-group">
                         <label for="taskTitle">ແຂວງ </label>
                         <select class="form-control select2" id="stateId" name="pro_id" onchange="selectedState()">
                              <option value="">-- ເລືອກແຂວງ --</option>
                              <?php 
                                   include('../../connection.php');
                                   $query  =mysqli_query($remote_db,"SELECT * FROM office_state_branches");
                                   foreach ($query as $key) {
                                   ?>
                              <option value="<?php echo $key['id_state']?>">
                                   <?php echo $key['provinceName']?>
                              </option>
                              <?php } ?>
                         </select>
                    </div>
               </div>

               <div class="col-md-2">
                    <div class="form-group">
                         <label for="taskTitle">ສາຂາປາຍທາງ </label>
                         <select class="form-control select2" id="state">
                              <option value="<?php echo $_SESSION['state'] ?>">
                                   <?php if($_SESSION['state']==0){echo "ເລືອກສາຂາ";}else{ renderBranch($_SESSION['state']);}?>
                              </option>
                         </select>
                    </div>
               </div>
               <div class="col-md-2">
                    <label for="">ແຕ່ວັນທີ</label>
                    <input type="text" data-toggle="datepicker" class="form-control" id='st_date' ng-model="st_date"
                         value={{st_date}}>
               </div>
               <div class="col-md-2">
                    <label for="">ເຖິງວັນທີ</label>
                    <input type="text" data-toggle="datepicker" class="form-control" id="end_date" ng-model="end_date"
                         value={{end_date}}>
               </div>
               <div class="col-md-2 pt-4">
                    <label for=""></label>
                    <a href="#" onclick="onSearch()" class="btn btn-primary mt-2">
                         <i class="icon-search"></i> ຄົ້ນຫາ
                    </a>
               </div>
               <div class="col-md-2 pt-4">
                    <a href="./print/print_history.php?st_date=<?php echo $st_date ?>&end_date=<?php echo $end_date?>&state=<?php echo $state ?>"
                         target="_blank" class="btn btn-secondary mt-2">
                         <i class="icon-print"></i> ພິມລາຍງານ
                    </a>
               </div>
               <div class="col-md-4 mt-3">
                    <ul>
                         <li>ຈຳນວນເຄື່ອງທີ່ຂາຍອອກ:
                              <strong><?php echo number_format($res['total'])?></strong>
                              ອັນ
                         </li>
                    </ul>
               </div>
          </div>
          <div class="row">
               <!-- Page content end -->
               <div class="table-responsive mt-4">
                    <table class="table table-striped table-hover table-sm">
                         <thead>
                              <tr style="background-color:#c92a2a;color:white">
                                   <th style="text-align:center" width='50px'>#</th>
                                   <th style="text-align:center">ເລກກຳກັບເຄື່ອງ</th>
                                   <th style="text-align:center">ລາຍການເຄື່ອງ</th>
                                   <th style="text-align:center">ຫົວໜ່ວຍ</th>
                                   <th style="text-align:center">ຂະໜາດ</th>
                                   <th style="text-align:center">ຈຳນວນ</th>
                                   <th style="text-align:center">ລາຄາ</th>
                                   <th style="text-align:center">ເປັນມູນຄ່າ</th>
                                   <th style="text-align:center">ຜູ້ຂາຍ</th>
                                   <th style="text-align:center">ວັນທີ່ຂາຍ</th>
                              </tr>
                              <thead>
                              <tbody>
                                   <?php
                                   include('../../connection.php');
                                   $sql=mysqli_query($con,"SELECT SUM(s_qty)as qtyTotal FROM ans_sale WHERE s_date BETWEEN '$st_date' AND '$end_date' $newState");
                                   $subTotal=$_assoc($sql);
                                   $sumAllPrice=mysqli_query($con,"SELECT SUM(s_qty*sprice)AS priceTotal FROM ans_sale  WHERE s_date BETWEEN '$st_date' AND '$end_date' $newState");
                                   $sumTotal=$_assoc($sumAllPrice);

                                   function sumQty($x){
                                        include('../../connection.php');
                                        global $st_date;
                                        global $end_date;
                                        global $newState;
                                        $sql=mysqli_query($con,"SELECT SUM(s_qty)AS qtyTotal FROM ans_sale WHERE s_date BETWEEN '$st_date' AND '$end_date' AND branch_id='$x'");
                                        $res=$_assoc($sql);
                                        echo number_format($res['qtyTotal']);
                                        mysqli_close($con);
                                   }
                                   function sumPrice($x){
                                        include('../../connection.php');
                                        global $st_date;
                                        global $end_date;
                                        global $newState;
                                        $sql=mysqli_query($con,"SELECT SUM(s_qty*sprice)AS priceTotal FROM ans_sale WHERE s_date BETWEEN '$st_date' AND '$end_date' AND ans_sale.branch_id='$x'");
                                        $res=$_assoc($sql);
                                        echo number_format($res['priceTotal']);
                                        mysqli_close($con);
                                   }

                                   $x=1;
                                   $_branch=mysqli_query($con,"SELECT * FROM ans_sale WHERE s_date BETWEEN '$st_date' AND '$end_date' $newState  GROUP BY branch_id ORDER BY s_date DESC");
                                   foreach ($_branch as $key) { ?>
                                   <tr>
                                        <td colspan="10"># <?php echo $x?>
                                             <?php renderBranch($key['branch_id'])?> </td>
                                   </tr>
                                   <?php
                                        $i=1;
                                        $bran_id=$key['branch_id'];

                                        $_Result=mysqli_query($con,"SELECT*FROM ans_sale
                                                  LEFT JOIN ans_production_of_sale ON ans_sale.pro_id = ans_production_of_sale.pro_id
                                                  WHERE ans_sale.branch_id='$bran_id' AND s_date BETWEEN '$st_date' AND '$end_date' $newState ORDER BY ans_sale.s_date DESC");
                                        foreach ($_Result as $res) { ?>
                                   <tr>
                                        <td style="text-align:right"><?php echo $i ?> </td>
                                        <td style="text-align:center">
                                             <?php echo $res['pro_number']?></td>
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
                                        <td style="text-align:center"><?php echo $res['s_createdBy']?>
                                        </td>
                                        <td style="text-align:center"> <?php echo $res['s_date']?>
                                        </td>
                                   </tr>
                                   <?php $i++;} ?>
                                   <tr style="background-color:#ffe3e3;font-weight:bold">
                                        <td colspan="7"></td>
                                        <td colspan="2" style="text-align:right">ຈຳນວນຂາຍທັງໝົດ</td>
                                        <td style="text-align:right"><?php sumQty($bran_id) ?> ອັນ
                                        </td>
                                   </tr>
                                   <tr style="background-color:#ffe3e3;font-weight:bold">
                                        <td colspan="7"></td>
                                        <td colspan="2" style="text-align:right">ເປັນມູນຄ່າ</td>
                                        <td style="text-align:right"><?php sumPrice($bran_id) ?> ກີບ
                                        </td>
                                   </tr>
                                   <?php $x++; } ?>
                                   <tr style="background-color:#ccc;font-weight:bold">
                                        <td colspan="8" style="text-align:right">
                                             ສະຫຼຸບລວມທັງໝົດທຸກສາຂາ
                                        </td>
                                        <td colspan="2" style="text-align:right">
                                             <?php echo number_format($subTotal['qtyTotal'])?> ອັນ
                                        </td>
                                   </tr>
                                   <tr style="background-color:#ccc;font-weight:bold">
                                        <td colspan="8" style="text-align:right">
                                             ລວມເປັນມູນຄ່າໝົດທຸກສາຂາ
                                        </td>
                                        <td colspan="2" style="text-align:right">
                                             <?php echo number_format($sumTotal['priceTotal'])?> ກີບ
                                        </td>
                                   </tr>
                              </tbody>
                    </table>
               </div>
          </div>
          <!-- Page wrapper end -->
          <?php include('../../components/lib/script.php') ?>
          <script src="./app.js"></script>
          <script>
          function onSearch() {
               var st_date = moment($('#st_date').val()).format("YYYY-MM-DD")
               var end_date = moment($('#end_date').val()).format("YYYY-MM-DD")
               var state = $('#state').val()
               window.location = "./paylist_history.php?st_date=" + st_date + "&end_date=" + end_date + "&state=" +
                    state
          }
          </script>

</body>

</html>