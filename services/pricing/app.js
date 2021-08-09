var app = angular.module("app", ["datatables"]);
app.controller("controller", function ($scope, $http) {
  $scope.btnName = "ບັນທຶກ";
  $scope.titles = "ປັບປຸງລາຄາເຄື່ອງ";

  $scope._refresh = function () {
    window.location.reload();
  };
  // QUERY DATA
  $scope._callPricing = function () {
    $http.get("sql/query_pricing.php").success(function (data) {
      $scope._pricing = data;
    });
  };
  // INSERT DATA
  $scope._onSave = function () {
    if ($scope.pro_id == null) {
      _Warning("ກະລຸນາເລືອກລາຍການເຄື່ອງກ່ອນ");
      $('[ng-model="pro_id"]').focus();
    } else if ($scope.price_item < 1) {
      _Warning("ກະລຸນາປ້ອນລາຄາ");
      $('[ng-model="price_item"]').focus();
    } else {
      $http
        .post("sql/create_pricing.php", {
          _id: $scope._id,
          pro_id: $scope.pro_id,
          price_item: $scope.price_item,
          btnName: $scope.btnName
        })
        .success(function (output) {
          console.log(output);
          if (output == "DATA_READY_EXIT") {
            _Warning("ຂໍ້ມູນທີ່ທ່ານປ້ອນມີຢູ່ແລ້ວ");
          } else if (output == 200) {
            _Success();
            setTimeout(() => {
              window.location = "./";
            }, 1000);
          } else {
            _Fail();
            $scope._callPricing();
          }
        });
    }
  };

  $scope._onReset = function () {
    $scope.cate_title = null;
    $scope.btnName = "ບັນທຶກ";
    $scope.titles = "ປັບປຸງລາຄາເຄື່ອງ";
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
          .post("sql/delete_pricing.php", { id: id })
          .success(function (data) {
            if (data == 200) {
              _Success();
              $scope._callPricing();
            } else {
              _Fail();
              $scope._callPricing();
            }
          });
      },
      function () {
        $scope._callPricing();
      }
    );
  };
});

function selectedCategory() {
  var cate_id = $("#cate_id").val();
  $.get(
    "../sale/sql/call_product_from_category.php",
    { cate_id },
    function (data) {
      $("#pro_id").html(data);
    }
  );
}
