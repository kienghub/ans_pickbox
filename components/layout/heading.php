<!-- Header start -->
<?php 
include('../../connection.php');
$_callBranch=$_sql($con,"SELECT*FROM office_branches WHERE id_branch='".$_SESSION['branch_id']."'");
$_state_branchName=$_assoc($_callBranch);
?>
<header class="header" onload="openFullscreen()" style="background-color:#c92a2a">
     <div class="toggle-btns">
          <a id="toggle-sidebar" href="#">
               <i class="icon-list"></i>
          </a>
          <a id="pin-sidebar" href="#">
               <i class="icon-list"></i>
          </a>
     </div>
     <button type="button" onclick="window.location='../../services/settings/'" class="btn btn-light customer-service">
          <i class="icon-domain"></i>
          ຈັດການສາງເຄື່ອງຂາຍ(ໃຫຍ່)</button>
     <div class="header-items">
          <!-- Custom search start -->
          <div class="custom-search customer-service">
               <select id="pro_id" class="search-query" onchange="_selectProvince()">
                    <option value="<?php echo $_SESSION['pro_id'] ?>">
                         <?php
                          if($_SESSION['pro_id']){ _renderProvinceName($_SESSION['pro_id']);}else{echo 'ເລືອກແຂວງ...';}
                          ?>
                    </option>
                    <?php 
                         $query_state_branch =$_sql($con,"SELECT*FROM office_state_branches");
                         foreach ($query_state_branch as $resultset) {
                         ?>
                    <option value="<?php echo $resultset['id_state'];?>">
                         <?php echo $resultset['provinceName']?>
                    </option>
                    <?php  mysqli_close($con); } ?>
               </select>
          </div>
          <div class="custom-search customer-service">
               <select id="branchID" class="search-query" onchange="switchBranch()">
                    <?php 
                    if($_SESSION['branch_id']){ ?>
                    <option value="<?php echo $_SESSION['branch_id']; ?>">
                         <?php echo $_state_branchName['branch_name']; ?>
                    </option>
                    <?php } if($_SESSION['provinceID']){
                    include('../../connection.php');
                         $stateID=$_SESSION['provinceID'];
                         $_callBranchs=$_sql($con,"SELECT*FROM office_branches WHERE provinceID='".$_SESSION['pro_id']."'");
                         foreach ($_callBranchs as $key) {?>
                    <option value="<?php echo $key['id_branch']?>"><?php echo $key['branch_name']?></option>
                    <?php } }else{ ?>
                    <option value="<?php echo $_SESSION['branch_id']; ?>">
                         <?php echo $_state_branchName['branch_name']; ?>
                    </option>
                    <?php }?>
               </select>
          </div>
          <!-- Header actions start -->
          <ul class="header-actions">
               <li class="dropdown bg-secondary">
                    <a href="#" onclick="_openSalePage(' ໜ້າຂາຍ','../../services/sale/',100,100)" aria-haspopup="true">
                         <b class="text-white"> <i class="icon-shopping-cart1 text-white"></i> ຂາຍ</b>
                    </a>
               </li>
               <li class="dropdown">
                    <a href="#" aria-haspopup="true">
                         <i class="icon-search1 text-white"></i>
                    </a>
               </li>
               <li class="dropdown">
                    <a href="#" id="notifications" aria-haspopup="true">
                         <i class="icon-bell text-white"></i>
                         <span class="count-label" id="total"
                              style="background-color:green;border-radius:50px!important;font-size:11px!important">
                         </span>
                         <?php if($length['total']==0){echo "";}else{?>
                         <img class="ldld" id="traffic" src="../../img/notify.svg"
                              style="width:50px;margin:-26px;z-index:999">
                         <?php } ?>
                    </a>
               </li>
               <li class="dropdown">
                    <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                         <span class="user-name"><?php echo $_USER_NAME ?></span>
                         <span class="avatar">
                              <img src="<?php if($profile['profile_picture']){echo $profile['profile_picture'];}else{echo 'https://jlg.ro/wp-content/uploads/2020/09/empty-avatar.png';}?>"
                                   alt="">
                              <span class="status busy"></span>
                         </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                         <div class="header-profile-actions">
                              <div class="header-user-profile">
                                   <div class="header-user">
                                        <img src="<?php if($profile['profile_picture']){echo $profile['profile_picture'];}else{echo 'https://jlg.ro/wp-content/uploads/2020/09/empty-avatar.png';}?>"
                                             alt="">
                                   </div>
                                   <h5><?php echo $_user_fname ?></h5>
                                   <h6><?php echo $_user_lname ?></h6>
                                   <hr>
                                   <h5> <?php echo $_state_branchName['branch_name']; ?></h5>
                              </div>

                              <a href="#" onclick="_logout()"><i class="icon-log-out1"></i> ອອກຈາກລະບົບ</a>
                         </div>
                    </div>
               </li>
          </ul>
          <!-- Header actions end -->
     </div>
</header>
<!-- Header end -->