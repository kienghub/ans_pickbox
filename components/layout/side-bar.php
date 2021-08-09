<!-- Sidebar wrapper start -->
<nav id="sidebar" class="sidebar-wrapper" style="background-color:#2e3440">
     <!-- Sidebar brand start  -->
     <div class="sidebar-brand text-center">
          <a href="../../services/home/">
               <img src="../../img/site_login_small.jpeg" style="max-width:100%">
          </a>
     </div>
     <!-- Sidebar content start -->
     <div class="sidebar-content">
          <!-- sidebar menu start -->
          <div class="sidebar-menu pb-5">
               <ul>
                    <li class="menu">
                         <a href="../../services/home/">
                              <i class="icon-home" id="home_icon"></i>
                              <span class="menu-text" id="home_text">ໜ້າຫຼັກ</span>
                         </a>
                    </li>
                    <li class="sidebar-dropdown active">
                         <a href="#" class="stocks">
                              <i class="icon-playlist_add" id="stock_of_sale_icon"></i>
                              <span class="menu-text" id="stock_of_sale_text">ເຄື່ອງນຳເຂົ້າສາງຍ່ອຍ</span>
                         </a>
                         <div class="sidebar-submenu">
                              <ul>
                                   <li>
                                        <a href="../../services/receive_of_branch/">
                                             <span class="menu-text" id="receive_of_branch">ນຳເຄື່ອງເຂົ້າສາງ</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="../../services/receive_of_branch/report.php">
                                             <span class="menu-text" id="report_receive">ລາຍງານເຄື່ອງເຂົ້າສາງ</span>
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    </li>
                    <li class="sidebar-dropdown active">
                         <a href="#" class="stocks">
                              <i class="icon-shopping-cart1" id="stock_of_sale_icon"></i>
                              <span class="menu-text" id="stock_of_sale_text">ເຄື່ອງອອກສາງ</span>
                         </a>
                         <div class="sidebar-submenu">
                              <ul>
                                   <li>
                                        <a
                                             href="../../services/delivered/?st_date=<?php echo $subDate ?>&end_date=<?php echo $_today ?>">
                                             <span class="menu-text" id="report_delivered">ເບີກເຄື່ອງອອກສາງ</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="../../services/report_stock_of_sale/">
                                             <span class="menu-text" id="report_stock_of_sale">ລາຍງານເຄື່ອງອອກສາງ</span>
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    </li>
                    <li class="sidebar-dropdown active">
                         <a href="#" class="stocks">
                              <i class="icon-assignment" id="stock_of_sale_icon"></i>
                              <span class="menu-text" id="stock_of_sale_text">ສົ່ງມອບການຂາຍ</span>
                         </a>
                         <div class="sidebar-submenu">
                              <ul>
                                   <li>
                                        <a
                                             href="../../services/delivered/?st_date=<?php echo $subDate ?>&end_date=<?php echo $_today ?>">
                                             <span class="menu-text" id="report_delivered">ສົ່ງມອບການຂາຍ</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="../../services/report_stock_of_sale/">
                                             <span class="menu-text" id="report_stock_of_sale">ລາຍງານເຄື່ອງໃນສາງ</span>
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    </li>

                    <li class="sidebar-dropdown active customer-service">
                         <a href="#" class="statistic">
                              <i class="icon-local_library" id="checking_icon"></i>
                              <span class="menu-text" id="checking_text">ກວດສອບບັນຊີສາງ</span>
                         </a>
                         <div class="sidebar-submenu">
                              <ul>
                                   <li>
                                        <a href="../../services/checking_stock/checking_request.php">
                                             <span class=" menu-text" id="checking_of_sale"> ການຂໍເບີກເຄື່ອງ</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="../../services/checking_stock/checking_stock_of_sale.php">
                                             <span class=" menu-text" id="checking_of_sale"> ການສົ່ງມອບການຂາຍ</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="../../services/checking_stock/checking_done.php">
                                             <span class=" menu-text" id="checking_of_sale"> ປະຫວັດການເບີກສຳເລັດ</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="../../services/checking_stock/checking_stock_done.php">
                                             <span class=" menu-text" id="checking_of_sale">
                                                  ປະຫວັດການສົ່ງມອບສຳເລັດ</span>
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    </li>
                    <li class="sidebar-dropdown active">
                         <a href="#" class="statistic">
                              <i class="icon-local_library" id="checking_icon"></i>
                              <span class="menu-text" id="checking_text">ລາຍງານການຂາຍ</span>
                         </a>
                         <div class="sidebar-submenu">
                              <ul>
                                   <li>
                                        <a href="../../services/checking_stock/checking_request.php">
                                             <span class=" menu-text" id="checking_of_sale"> ລາຍງານການຂາຍປະຈຳສາຂາ</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="../../services/checking_stock/checking_stock_of_sale.php">
                                             <span class=" menu-text" id="checking_of_sale"> ລາຍງານການຂາຍທັງໝົດ</span>
                                        </a>
                                   </li>
                              </ul>
                         </div>
                    </li>
                    <!-- <li class="menu customer-service call-center">
                         <a href="../../services/settings/">
                              <i class="icon-cog" id="settings_icon"></i>
                              <span class="menu-text" id="setting_text">ຈັດການຂໍ້ມູນເຄື່ອງ</span>
                         </a>
                    </li> -->
               </ul>
          </div>
          <!-- sidebar menu end -->

     </div>
     <!-- Sidebar content end -->
</nav>
<!-- Sidebar wrapper end -->