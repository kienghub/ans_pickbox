<!doctype html>
<html lang="en">
<style>
body,
li,
a,
p,
span,
input,
label,
select,
select.form-control,
.search-query,
.menu-text,
.page-header {
     font-size: 16px !important
}
</style>

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <!-- Meta -->
     <meta name="description" content="ANS-STOCK">
     <meta name="author" content="ANS-STOCK">
     <!-- Title -->
     <title>Login</title>
     <link rel="icon" href="./img/ans_logo_new.jpeg" />
     <!-- *************
			************ Common Css Files *************
          ************ -->
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
     <!-- Master CSS -->
     <link rel="stylesheet" href="./assets/css/main.css" />
     <link rel="stylesheet" href="./assets/font/font-style.css" />
     <link rel="stylesheet" href="./assets/fonts/style.css" />
     <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
     <?php
    function isVal()
    {
        echo "<font style='color:red'>*</font>";
    }
    ?>

</head>

<body class="authentication" style="background:#e02129">
     <!-- Container start -->
     <div class="container">
          <form action="#" method="post">
               <div class="row justify-content-md-center">
                    <div class="login-screen">
                         <div class="login-box">
                              <div style="text-align:center!important">
                                   <center>
                                        <img src="./img/logo_next_day.png" alt="logo-app" style="width:200px" />
                                   </center>
                                   <br>
                                   <h3>ANS-STOCK</h3>
                                   <br>
                              </div>
                              <div class="form-group">
                                   <label for="">ເບີໂທ ຫຼື ອີເມວ</label>
                                   <input type="text" class="form-control" name="user_name"
                                        placeholder="ກະລຸນາປ້ອນເບີໂທ ຫຼື ອີເມວ" />
                              </div>
                              <div class="form-group">
                                   <label for="">ລະຫັດຜ່ານ</label>
                                   <input type="password" class="form-control" id="password" name="password"
                                        placeholder="ກະລຸນາປ້ອນລະຫັດຜ່ານ" />
                              </div>
                              <div class="actions mb-4">
                                   <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" onchange="_view()"
                                             id="remember_pwd">
                                        <label class="custom-control-label" for="remember_pwd"
                                             style="font-size:13px!important">
                                             ສະແດງລະຫັດຜ່ານ</label>
                                   </div>
                                   <button type="submit" name="onLogin" class="btn btn-primary w-50">
                                        <i class="icon-log-in"></i>
                                        ເຂົ້າສູ່ລະບົບ</button>
                              </div>
                         </div>
                    </div>
               </div>
          </form>
     </div>
     <!-- Container end -->
     <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
     <script type="text/javascript" src="assets/AIO/notiflix-aio-2.0.0.min.js"></script>
     <?php
//     include './db_config_company.php';
    include './connection.php';
    if (isset($_POST['onLogin'])) {
        @$username = $_setString($con, $_POST['user_name']);
        @$_password =$_POST['password'];
        @$password = md5($_POST['password']);
        $_DATA_USERS = mysqli_query($con, "SELECT * FROM member_user WHERE phone_number='$username' AND password='$password' OR email='$username'");
        $count = mysqli_num_rows($_DATA_USERS);
        if ($count == 1) {
             $row = mysqli_fetch_array($_DATA_USERS);
             $_SESSION['first_name']=$row['first_name'];
             $_SESSION['last_name']=$row['last_name'];
             $_SESSION['phone_number']=$row['phone_number'];
             $_SESSION['email']=$row['email'];
             $_SESSION['branch_id']=$row['branch_id'];
             $_SESSION['id']=$row['id_user'];
              // CALL PROVINCE ID 
               $call_branch_data=$_sql($con,"SELECT*FROM office_branches WHERE id_branch='$row[branch_id]'");
               $result=$_assoc($call_branch_data);
               $_SESSION['pro_id']=$result['provinceID'];
             echo "<script>Notiflix.Loading.Pulse('ກຳລັງດຳເນີນງານ...');setTimeout(function () {window.location='services/home/'}, 2000);</script>";
        } else {
            echo "<script> Notiflix.Report.Failure('ຜິດພາດ','ເບີໂທ ຫຼື ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ !', 'ປິດ',function () {window.location='index.php'});</script>";  
    }
}
    ?>
     <!-- show password  -->
     <script>
     function _view() {
          const newLocal = "password";
          var temp = document.getElementById(newLocal);
          if (temp.type === "password") {
               temp.type = "text";
          } else {
               temp.type = "password";
          }
     }
     </script>
</body>

</html>