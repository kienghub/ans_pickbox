        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/moment.js"></script>
        <script src="../../assets/js/currency.min.js"></script>
        <!-- Slimscroll JS -->
        <script src="../../assets/vendor/slimscroll/slimscroll.min.js"></script>
        <script src="../../assets/vendor/slimscroll/custom-scrollbar.js"></script>

        <!-- Daterange -->
        <script src="../../assets/vendor/daterange/daterange.js"></script>
        <script src="../../assets/vendor/daterange/custom-daterange.js"></script>
        <!-- Polyfill JS -->
        <script src="../../assets/vendor/polyfill/polyfill.min.js"></script>
        <script src="../../assets/AIO/notiflix-aio-2.0.0.min.js"></script>

        <!-- Data Tables -->
        <script src="../../assets/select2/dist/js/select2.min.js"></script>
        <script src="../../assets/datepicker/js/datepicker.js"></script>
        <script src="../../assets/layer/2.4/layer.js"></script>

        <!-- Download / CSV / Copy / Print -->
        <script src="../../assets/data-table/jquery.dataTables.min.js"></script>
        <script src="../../assets/data-table/dataTables.bootstrap4.min.js"></script>

        <!-- Main JS -->
        <script src="../../assets/js/main.js"></script>
        <script src="../../assets/js/app.js"></script>
        <script src="../../assets/js/onload_file.js"></script>
        <script src="../../assets/darkbox/darkbox.min.js"></script>
        <script src="../../assets/angularjs.1.4.0/angular.min.js"></script>
        <script src="../../assets/angularjs.1.4.0/angular-datatables.min.js"></script>
        <script src="../../assets/js/printThis.js"></script>
        <!-- demo -->
        <!-- Apex Charts -->
        <script src="../../assets/vendor/apex/apexcharts.min.js"></script>
        <audio src="../../assets/bell.mp3" id="_sound" display="none"></audio>
        <script>
$(function() {
     $('[data-toggle="datepicker"]').datepicker({
          autoHide: true,
          zIndex: 2048,
     });
});
        </script>
        <script>
$(function() {
     $('#reportPaylist').on("click", function() {
          $('#invice').printThis({
               importCSS: false,
               importStyle: true, //thrown in for extra measure
               loadCSS: '../../assets/css/app.css',
               header: "<br><br><center><h2>ລາຍງານການເບີກເຄື່ອງເດືອນ <?php echo $_month ?></h2></center><h4 style='float:right'> <?php echo $_today ?></h4><img src='../../img/logo_next_day.png' style='width:120px><h4> ບໍລິສັດ ອານູສິດ ໂລຈິສຕິກ ຈໍາກັດ <br>ບ້ານ ໂພນສະຫວ່າງ, ເມືອງ ຈັນທະບູລີ, ນະຄອນຫຼວງວຽງຈັນ</h4><center><h2>ລາຍການເບີກເຄື່ອງເດືອນ <?php echo $_month ?></h2></center>",
               footer: "<br><br><table width='100%'><tr><td  style='text-align:center'>ບັນຊີສາງ</td><td  style='text-align:center'>ຜູ້ອຳນວຍການ</td></tr></table>",
               base: 'http://localhost/ans_stock/services/paylist/paylist_for_month.php'
          });
     });
     $('#reportReceive').on("click", function() {
          $('#printThis').show();
          $('#printThis').printThis({
               importCSS: false,
               importStyle: true, //thrown in for extra measure
               loadCSS: '../../assets/css/app.css',
               header: "<br><br><center><h2>ລາຍງານການນຳເຄື່ອງເຂົ້າສາງເດືອນ <?php echo $_month ?></h2></center><h4 style='float:right'> <?php echo $_today ?></h4><img src='../../img/logo_next_day.png' style='width:120px'><h4> ບໍລິສັດ ອານູສິດ ໂລຈິສຕິກ ຈໍາກັດ <br>ບ້ານ ໂພນສະຫວ່າງ, ເມືອງ ຈັນທະບູລີ, ນະຄອນຫຼວງວຽງຈັນ</h4><center><h2>ລາຍການເຄື່ອງເຂົ້າສາງເດືອນ <?php echo $_month ?></h2></center>",
               footer: "<br><br><table width='100%'><tr><td  style='text-align:center'>ບັນຊີສາງ</td><td  style='text-align:center'>ຜູ້ອຳນວຍການ</td></tr></table>",
               base: 'http://localhost/ans_stock/services/receive/recieve_for_month.php'
          });
     });
})

function reportStatisticReceive() {
     $('#printThisInvoice').show();
     $('#printThisInvoice').printThis({
          importCSS: false,
          importStyle: true, //thrown in for extra measure
          loadCSS: '../../assets/css/app.css',
          base: 'http://localhost/ans_stock/services/report_statistic/report_samday.php'
     });
}

$(document).ready(function() {
     $(".select2").select2();
     $('#data_table').DataTable();
     $('[data-toggle="tooltip"]').tooltip()
});
$(function() {
     var $disabledResults = $(".select2");
     $disabledResults.select2();
});

async function _selectProvince() {
     var id = $('#pro_id').val()
     await $.get('../../services/branchService/query_branch.php', {
          id
     }, function(data) {
          $('#branchID').html(data)
     })

     await $.get('../../services/branchService/update_state_id.php', {
          id
     }, function(data) {
          if (data == 200) {
               window.location.reload();
          }
     })
}

function switchBranch() {
     let branchID = $('#branchID').val()
     console.log(branchID)
     $.post('../../services/branchService/swicth_branch.php', {
          branchID
     }, function(res) {
          console.log("===>>", res)
          if (res == 200) {
               window.location.reload();
          } else {
               alert('ບໍ່ສາມາດປ່ຽນສາຂາໄດ້')
          }
     })
}
        </script>

        <script>
// Notification
function showNotification(evt) {
     const notification = new Notification("ມີການແຈ້ງເຕືອນໃໝ່", {
          body: evt,
          icon: "../../img/bell.png",
          timeout: 6000,
          onClick: function() {
               window.focus();
               this.close();
          }
     });
}

function _notification(e) {
     showNotification(e)
     document.getElementById("_sound").play();
}

function _notiList() {
     $.get('../../services/notification/query-order.php', function(data) {
          if (data < 1) {
               $('#notifications-list').addClass('hidden');
          } else {
               $('#noti-list').html(data);
          }
     })
}



setInterval(() => {
     _notiList();
     $.get("../../services/notification/count_total.php", function(data) {

          var _oldLength = 0;

          function _trigger(e) {
               localStorage.setItem("notify", e); //save into local storage
          }

          function _showNotify() {
               var length = localStorage.getItem("notify"); //get value from local storage
               _oldLength = length;
          }

          _showNotify();

          var _newLength = Number(data | 0);
          $('#total,#noti').html(_newLength)
          $('#traffic').removeClass('hidden')

          var _total = Number(_newLength - _oldLength);

          _trigger(_newLength);

          if (_total > 0) {
               _notification("ມີການແຈ້ງເຕືອນໃໝ່ " + _total + " ລາຍການ");
          }
     })
}, 3000);

function _openSalePage(title, url, w, h) {
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


if (length == 0) {
     $('#total,#noti').html('...')
     $('#traffic').addClass('hidden');
} else {
     $('#traffic').removeClass('hidden')
     $('#noti,#noti').html(_newLength)
}
        </script>