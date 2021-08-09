var app = angular.module("app", ["datatables"]);
app.controller("product", function ($scope, $http) {
  // notification
  function _Success() {
    Notiflix.Notify.Success("ການດຳເນີນງານສຳເລັດ");
  }

  function _Warning(e) {
    Notiflix.Notify.Warning(e);
  }

  function _Fail() {
    Notiflix.Notify.Failure("ການດຳເນີນງານບໍ່ສຳເລັດ");
  }

  // CALL PRODUCTS
  $scope._callProducts = function () {
    $http.get("sql/query_product.php").success(function (data) {
      $scope._products = data;
      $scope._length = data.length;
    });
  };
  // CALL CATEGORY
  // DELETE DATA
  $scope._onDelete = function (id) {
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ແທ້ ຫຼື ບໍ່ ?",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http
          .post("sql/delete_product.php", {
            pro_id: id
          })
          .success(function (data) {
            if (data == 200) {
              _Success();
              $scope._callProducts();
            } else {
              _Fail();
            }
          });
      },
      function () {
        $scope._callProducts();
      }
    );
  };

  $scope._onAdd = function (title, url, w, h) {
    layer.open({
      type: 2,
      area: [w + "px", h + "px"],
      fix: true,
      maxmin: true,
      shade: 0.4,
      title: title,
      content: url
    });
  };

  $scope._onUpdate = function (title, url, w, h) {
    layer.open({
      type: 2,
      area: [w + "px", h + "px"],
      fix: true,
      maxmin: true,
      shade: 0.4,
      title: title,
      content: url
    });
  };
});

app.controller("addNew", function ($scope, $http) {
  var frmCategory = angular.element("#frmCategory");
  // notification
  function _Success() {
    Notiflix.Notify.Success("ການດຳເນີນງານສຳເລັດ");
  }

  function _Warning(e) {
    Notiflix.Notify.Warning(e);
  }

  function _Fail() {
    Notiflix.Notify.Failure("ການດຳເນີນງານບໍ່ສຳເລັດ");
  }
  // CALL CATEGORY
  $scope._callCategory = function () {
    $http.get("./sql/query_category.php").success(function (data) {
      $scope.category = data;
    });
  };
  $scope.AddCategory = function () {
    frmCategory.modal("show");
  };

  $scope._onSave = function () {
    if ($scope.cate_title == null) {
      _Warning("ກະລຸນາປ້ອນຊື່ໝວດເຄື່ອງກ່ອນ");
    } else {
      $http
        .post("./sql/create_category.php", {
          cate_id: $scope.cate_id,
          cate_title: $scope.cate_title,
          btnName: $scope.btnName
        })
        .success(function (output) {
          console.log(output);
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

  $scope.frmHide2 = function () {
    frmCategory.modal("hide");
  };
  // INSERT DATA
  $("#AddNew").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
      url: "./sql/create_product.php",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data);
        if (data == "PRO_CATE_ID_INVALID") {
          _Warning("ກະລຸນາເລືອກເຄື່ອງກ່ອນ");
        } else if (data == "PRO_TITLE_INVALID") {
          _Warning("ກະລຸນາປ້ອ່ນຊື່ເຄື່ອງກ່ອນ");
        } else if (data == "PRO_UNIT_INVALID") {
          _Warning("ກະລຸນາປ້ອນຫົວໜ່ວຍກ່ອນ");
        } else if (data == "DATA_READY_EXIT") {
          _Warning("ຂໍ້ມູນ");
        } else if (data == 200) {
          _Success();
          $scope._callProducts();
        } else {
          _Fail();
        }
      }
    });
  });
});
