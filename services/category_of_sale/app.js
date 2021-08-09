var app = angular.module("app", ["datatables"]);
app.controller("controller", function ($scope, $http) {
  $scope.btnName = "ບັນທຶກ";
  $scope.titles = "ເພີ່ມຂໍ້ມູນໝວດເຄື່ອງ";
  function _Success() {
    Notiflix.Notify.Success("ການດຳເນີນງານສຳເລັດ");
  }

  function _Warning(e) {
    Notiflix.Notify.Warning(e);
  }

  function _Fail() {
    Notiflix.Notify.Failure("ການດຳເນີນງານບໍ່ສຳເລັດ");
  }
  $scope._refresh = function () {
    window.location.reload();
  };
  // QUERY DATA
  $scope._callCategory = function () {
    $http.get("sql/query_category.php").success(function (data) {
      $scope._categorys = data;
    });
  };
  // INSERT DATA
  $scope._onSave = function () {
    if ($scope.cate_title == null) {
      _Warning("ກະລຸນາປ້ອນຊື່ໝວດເຄື່ອງກ່ອນ");
    } else {
      $http
        .post("sql/create_category.php", {
          cate_id: $scope.cate_id,
          cate_title: $scope.cate_title,
          btnName: $scope.btnName
        })
        .success(function (output) {
          if (output == "DATA_READY_EXIT") {
            _Warning("ຂໍ້ມູນທີ່ທ່ານປ້ອນມີຢູ່ແລ້ວ");
          } else if (output == 200) {
            _Success();
            $scope.cate_id = null;
            $scope.cate_title = null;
            $scope.btnName = "ບັນທຶກ";
            $scope._callCategory();
          } else {
            _Fail();
            $scope._callCategory();
          }
        });
    }
  };
  //   UPDATE DATA
  $scope._onUpdate = function (id, title) {
    $scope.cate_id = id;
    $scope.cate_title = title;
    $scope.titles = "ແກ້ໄຂຂໍ້ມູນໝວດເຄື່ອງ";
    $scope.btnName = "ແກ້ໄຂ";
    addCategory.modal("show");
  };
  $scope._onReset = function () {
    $scope.cate_title = null;
    $scope.btnName = "ບັນທຶກ";
    $scope.titles = "ເພີ່ມຂໍ້ມູນໝວດເຄື່ອງ";
  };
  // DELETE DATA
  $scope._onDelete = function (id) {
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ແທ້ ຫຼື ບໍ່ ?",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http
          .post("sql/delete_category.php", { id: id })
          .success(function (data) {
            if (data == 200) {
              _Success();
              $scope._callCategory();
            } else {
              _Fail();
              $scope._callCategory();
            }
          });
      },
      function () {
        $scope._callCategory();
      }
    );
  };
});
