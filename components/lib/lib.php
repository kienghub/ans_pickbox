<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Meta -->
<meta name="description" content="">
<meta name="author" content="ANS_STOCK">
<?php 
include('../../connection.php');
if($permission==1 || $permission==4 && $permission_id!=501){?>
<style>
.admin {
     display: none !important;
}
</style>
<?php }else if($permission==2 && $permission_id==570 || $permission==2 && $permission_id==104||$permission==2 && $permission_id==382||$permission==4 && $permission_id==501){?>
<style>
.call-center {
     display: none !important;
}
</style>
<?php }else{ ?>
<style>
.customer-service {
     display: none !important;
}
</style>
<?php  }?>


<style>
.pro-img {
     width: 100% !important;
     height: 130px;
}
</style>

<?php 
    @session_start();
    include('../../connection.php');
    $_newData=$_sql($con,"SELECT count(*)as total FROM ans_requirements WHERE req_status='REQUESTING'  group by branch_id");
     $length=mysqli_fetch_assoc($_newData);
     
     function _renderProvinceName($x){
	global $con;
	$call_province_name=mysqli_query($con,"SELECT* FROM office_state_branches WHERE id_state ='$x'");
	$result=mysqli_fetch_assoc($call_province_name);
	echo $result['provinceName'];
}
    ?>
<link rel="shortcut icon" href="../../img/ans_logo_new.jpeg" />

<title><?php if($length['total']==0){echo "";}else{echo '('.$length['total'].')';} ?> Anousith | Pick Box Sell </title>

<!-- Bootstrap css -->
<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
<!-- Icomoon Font Icons css -->
<link rel="stylesheet" href="../../assets/fonts/style.css">
<link href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Main css -->
<link rel="stylesheet" href="../../assets/css/main.css">
<link rel="stylesheet" href="../../assets/font/font-style.css">
<!-- DateRange css -->
<link href="../../assets/css/scroll_menu.css" rel="stylesheet" />
<link rel="stylesheet" href="../../assets/vendor/daterange/daterange.css" />
<link href="../../assets/darkbox/darkbox.css" rel="stylesheet" />
<link href="../../assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../../assets/data-table/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/datepicker/css/datepicker.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/loading.css@v2.0.0/dist/loading.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/loading.css@v2.0.0/dist/loading.min.css">
<script>
var ldld = new ldLoader({
     root: '.ldld'
});
</script>

<style>
.confirm-button-ok {
     background-color: #e02129 !important;
     color: white !important;
}

li,
a,
p,
span,
input,
label,
select,
button,
select.form-control,
.search-query,
.menu-text,
.page-header {
     font-size: 16px !important;
     font-weight: normal !important;
}

.table,
#data_table,
.dataTables_info {
     font-size: 15px !important;
}

body {
     background-color: #adb5bd !important
}

select.search-query {
     padding: 3px !important
}

.select2 {
     width: 100% !important;
     font-size: 30px;
}

.select2-results__options:hover {
     color: #2e3440 !important;
}

.select2-selection__rendered:hover {
     color: #2e3440 !important;
}

a.ng-binding {
     background-color: #2e3440;
     color: white;
     padding-left: 10px;
     padding-right: 10px;
     margin-left: 1px;
     margin-right: 5px;
     border-radius: 50%;
     font-size: 12px;
}

li.ng-scope a {
     padding-right: 10px;
     margin: 3px;
     width: 30px !important;
     height: 30px !important;
}

.sidebar-content ul li a i,
span:hover {
     color: white !important;
}

#settings_icon,
#home_icon {
     color: #adb5bd !important
}

.btn-light {
     background-color: #fafafafa;

}

h1,
h2,
h3,
h4,
h5 {
     color: #2e3440 !important;
     font-weight: bold !important
}

.breadcrumb-item {
     cursor: pointer;
}

table tr th {
     background-color: #2e3440 !important;
     color: aliceblue !important;
}

#reportrange {
     font-size: 18px !important;
     font-weight: bold;
     color: #2e3440 !important;
}

.wrap-text {
     overflow: hidden !important;
     white-space: nowrap !important;
     text-overflow: ellipsis !important;
}

.text-indent {
     text-indent: 30px;
}

.select2 {
     color: black !important
}

.select2-results__options:hover {
     color: black !important
}

.limit-text {
     overflow: hidden;
     text-overflow: ellipsis;
     display: -webkit-box;
     -webkit-line-clamp: 2;
     /* number of lines to show */
     -webkit-box-orient: vertical;
}

.btn,
.card,
.card-header,
.fom-control,
.search-query,
.goal-card,
.task-section,
.blog,
.user-card {
     border-radius: 0 !important;
}
</style>

<?php
$today = date('D');
function isVal()
{
    echo "<font style='color:red'>*</font>";
}

function _back($url)
{ ?>
<a href="#" onclick="window.location='<?php echo $url; ?>'">
     <i class="fa fa-angle-left fa-2x"
          style="margin-top:3px!important;margin-bottom:-0px!important;margin-right:20px!important;"></i></a>
<?php } ?>

<?php function _close()
{ ?>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
               class="icon-x-circle" style="color:white"></i> </span>
</button>
<?php } ?>

<?php function callBack($params)
{ ?>
<button type="button" class="btn btn-outline-danger w-45" style="margin-left:20px"
     onclick="window.location='<?php echo $params; ?>'">
     <i class="icon-x-circle"></i> ຍົກເລີກ
</button>
<?php } ?>

<?php function Success($location)
{ ?>
<script>
Notiflix.Report.Success('ສຳເລັດ', 'ການດຳເນີນງານສຳເລັດ...', 'ປິດ',
     function() {
          window.location = '<?php $location; ?>'
     })
</script>
<?php } ?>

<?php function Fail($location)
{ ?>
<script>
Notiflix.Report.Failure('ຜິດພາດ', 'ການດຳເນີນງານບໍ່ສຳເລັດ ກະລຸນາກວດຄືນແລ້ວລອງໃໝ່ພາຍຫຼັງ', 'ປິດ',
     function() {
          window.location = '<?php $location; ?>'
     })
</script>
<?php } ?>

<?php function Duplicate($location)
{ ?>
<script>
Notiflix.Report.Warning('ຜິດພາດ', 'ຂໍ້ມູນທີ່ທ່ານປ້ອນມີແລ້ວ ກະລຸນາກວດຄືນແລ້ວປ້ອນໃໝ່ພາຍຫຼັງ', 'ປິດ',
     function() {
          window.location = '<?php $location; ?>'
     })
</script>
<?php } ?>


<?php function _Success($location)
{ ?>
<script>
Notiflix.Notify.Success('ການດຳເນີນງານສຳເລັດ');
setTimeout(() => {
     window.location = '<?php echo $location ?>';
}, 2000);
</script>
<?php } ?>

<?php function Del_Fail($location)
{ ?>
<script>
window.location = "<?php echo $location; ?>";
</script>
<?php } ?>

<?php function controller($total)
{ ?>
<div class="row mb-3">
     <div class="col-md-6 pt-5">
          ທັງໝົດ <?php echo $total ?> ລາຍການ
     </div>
     <div class="col-md-4">
          <label for="">ຄົ້ນຫາ</label>
          <input type="text" ng-model="txt" class="form-control" placeholder="ຄົ້ນຫາ...">
     </div>
     <div class="col-md-2">
          <label for="">ສະແດງລາຍການ</label>
          <select class="form-control" ng-model="limit">
               <option value="">ທັງໝົດ</option>
               <?php
                for ($i = 10; $i < 500; $i += 10) { ?>
               <option value="<?php echo $i ?>"><?php echo $i; ?></option>
               <?php } ?>
          </select>
     </div>
</div>
<?php } ?>

<?php function _limit(){?>
<select class="form-control" id="_limitTo" ng-model="_limitTo" required="required"
     style="width:167px;float:right;margin-top:-5px">
     <option value="">ທັງໝົດ</option>
     <option value={{_limitTo}}>{{_limitTo}} ລາຍການ</option>
     <?php for($i=10;$i < 1000; $i+=10){ ?>
     <option value="<?php echo $i ?>"><?php echo $i ?> ລາຍການ</option>
     <?php } ?>
</select>
<?php } ?>

<?php 
function _length(){ ?>
<div class="col-md-12 p-3">
     ທັງໝົດ <span ng-bind="_length | number"></span> ລາຍການ
</div>
<?php } ?>

<?php function _Pagination(){?>
<div class="row">
     <div class="col-md-10">
          <dir-pagination-controls max-size="8" direction-links="true" boundary-links="true"
               on-page-change='indexCount(newPageNumber)'>
          </dir-pagination-controls>
     </div>
     <div class="col-md-2" style="font-size:16px">ໜ້າທີ: <strong> {{currentPage}}</strong></div>
</div>
<?php } ?>

<?php function renderBranch($id){
     include('../../connection.php');
     $query  =mysqli_query($con,"SELECT*FROM office_branches WHERE id_branch='$id'");
     $res=$_assoc($query);
     echo $res['branch_name'];
      mysqli_close($con);
}?>


<?php function closeModal(){ ?>
<a href="#" ng-click="frmHide()" style="float:right">
     <h3> <i class="icon-x-circle text-danger"></i></h3>
</a>
<?php } ?>

<?php
// ໄວ້ສະແດງຂໍ້ມູນ
function _renderGenderShow($e)
{
    switch ($e) {
        case "FEMALE":
            echo "ນາງ";
            break;
        case "MALE":
            echo "ທ້າວ";
            break;
        case "MONK":
            echo "ພະ";
            break;
        case "OTHER":
            echo "ອື່ນໆ";
            break;
    }
}

function loading_icon(){
     echo "<img src='../../assets/layer/2.4/skin/default/loading-2.gif' style='width=20px;height:20px'>";
}

// ໄວ້ເລືອກຂໍ້ມູນ
function _renderGenderSelect($e)
{
    switch ($e) {
        case "FEMALE":
            echo "ຍິງ";
            break;
        case "MALE":
            echo "ຊາຍ";
            break;
        case "MONK":
            echo "ພະ";
            break;
        case "OTHER":
            echo "ອື່ນໆ";
            break;
    }
}

?>