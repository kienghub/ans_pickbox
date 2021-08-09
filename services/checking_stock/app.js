var app = angular.module("app", []);
app.controller("requestedList", function ($scope, $http) {
  var reConfirm = angular.element("#reConfirm");
  $scope.btnName = "ອານຸມັດ";
  $scope._onApproved = function (x) {
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການອານຸມັດນີ້ແທ້ ຫຼື ບໍ່ ?",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http
          .post("../sale/sql/create_paylist.php", {
            branchID: x,
            btnName: $scope.btnName
          })
          .success(function (data) {
            console.log(data);
            if (data == 200) {
              _Success();
              setTimeout(() => {
                window.location.reload();
              }, 1000);
            } else {
              _Fail();
            }
          });
      },
      function () {}
    );
  };
  $scope._onApprovedThis = function (id) {
    reConfirm.modal("show");
    $http.get("sql/query_request.php?id=" + id).success(function (data) {
      $scope._list = data;
      console.log(data);
    });

    $http.get("sql/query_branch_name.php?id=" + id).success(function (data) {
      $scope._listBranch = data;
    });
    $scope.branch_id = id;
  };

  $scope._close = function () {
    reConfirm.modal("hide");
  };

  $scope._onApproved = function (branch_id) {
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການຢືນຢັນການສົ່ງມອບ ຫຼື ບໍ່ ? ",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http
          .post("../sale/sql/create_paylist.php", {
            btnName: "ອານຸມັດ",
            branchID: branch_id
          })
          .success(function (data) {
            if (data == 200) {
              _loading("ກຳລັງດຳເນີນງານ...");
              setTimeout(() => {
                _Success();
                _loading_stop();
                setTimeout(() => {
                  window.location.reload();
                }, 2000);
              }, 2000);
            } else {
              _Fail();
            }
          });
      },
      function () {}
    );
  };

  // $scope._onApproved = function (branch_id) {
  //   Notiflix.Confirm.Show(
  //     "ຢືນຢັນ",
  //     "ທ່ານຕ້ອງການຢືນຢັນການສົ່ງມອບ ຫຼື ບໍ່ ? ",
  //     "ຕົກລົງ",
  //     "ຍົກເລີກ",
  //     function () {
  //       $http
  //         .post("./sql/server.php?request=approved&branch_id=" + branch_id)
  //         .success(function (data) {
  //           console.log(data);
  //           if (data == 200) {
  //             _loading("ກຳລັງດຳເນີນງານ...");
  //             setTimeout(() => {
  //               _Success();
  //               _loading_stop();
  //               setTimeout(() => {
  //                 window.location.reload();
  //               }, 2000);
  //             }, 2000);
  //           } else {
  //             _Fail();
  //           }
  //         });
  //     },
  //     function () {}
  //   );
  // };
});

app.controller("delivered", function ($scope, $http) {});
