var app = angular.module("app", ["datatables"]);
app.controller("receive_of_sale", function ($scope, $http) {
  var newReceive = angular.element("#newReceive");

  var stDate = "";
  var endDate = "";
  function local(st_date, end_date) {
    localStorage.setItem("st_date", st_date);
    localStorage.setItem("end_date", end_date);
  }
  function getItem() {
    stDate = localStorage.getItem("st_date");
    endDate = localStorage.getItem("end_date");
  }
  getItem();
  $scope.st_date = stDate;
  $scope.end_date = endDate;

  $scope.newForm = function () {
    newReceive.modal("show");
    local("", "");
  };
  $scope.frmHide = function () {
    newReceive.modal("hide");
  };

  $scope._callMainData = function () {
    $http.get("sql/query_receive_of_sale.php").success(function (data) {
      $scope._mainData = data;
    });
  };

  // SUMMARY
  $scope.summary = function () {
    $http.get("sql/summary.php").success(function (data) {
      var arr = data.split(",");
      $scope.total = arr[0];
      $scope.pv = arr[1];
    });
  };

  // FILTER DATA
  $scope.onSearch = function () {
    var st_date = moment($scope.st_date).format("YYYY-MM-DD");
    var end_date = moment($scope.end_date).format("YYYY-MM-DD");
    local(st_date, end_date);
    $http
      .get(
        "sql/query_receive_of_sale.php?st_date=" +
          st_date +
          "&end_date=" +
          end_date
      )
      .success(function (data) {
        $scope._mainData = data;
      });

    $http
      .get("sql/summary.php?st_date=" + st_date + "&end_date=" + end_date)
      .success(function (data) {
        var arr = data.split(",");
        $scope.total = arr[0];
        $scope.pv = arr[1];
      });
  };

  // DELETE DATA
  $scope._onDelete = function (id, qty, pro_id) {
    var params = { id: id, pro_id: pro_id, qty: qty };
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ແທ້ ຫຼື ບໍ່ ?",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http.post("sql/delete_receive.php", params).success(function (data) {
          if (data == 200) {
            _Success();
            $scope._callMainData();
            $scope.summary();
          } else {
            _Fail();
            $scope._callMainData();
            $scope.summary();
          }
        });
      },
      function () {
        $scope._callMainData();
        $scope.summary();
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

app.controller("addReceiveOfSale", function ($scope, $http) {
  $scope.btnName = "ບັນທຶກ";
  $scope.selectedCategory = function () {
    var cate_id = $scope.cate_id;
    $http
      .get("sql/query_production.php?cate_id=" + cate_id)
      .success(function (data) {
        $scope.production = data;
      });
  };

  $scope._onSave = function () {
    if (!$scope.pro_id) {
      _Warning("ກະລຸນາເລືອກລາຍການເຄື່ອງກ່ອນ");
      $('[ng-model="pro_id"]').focus();
    } else if (!$scope.rec_sprice) {
      _Warning("ກະລຸນາປ້ອນລາຄາຂາຍກ່ອນ");
      $('[ng-model="rec_sprice"]').focus();
    } else if (!$scope.rec_qty) {
      _Warning("ກະລຸນາປ້ອນຈຳນວນເຄື່ອງກ່ອນ");
      $('[ng-model="rec_qty"]').focus();
    } else {
      $http
        .post("sql/create_receive.php", {
          pro_id: $scope.pro_id,
          rec_sprice: $scope.rec_sprice,
          rec_qty: $scope.rec_qty,
          rec_date: moment($scope.rec_date).format("YYYY-MM-DD"),
          user_holder: $scope.user_holder,
          rec_note: $scope.rec_note,
          btnName: $scope.btnName
        })
        .success(function (output) {
          console.log(output);
          if (output == "DATA_READY_EXIT") {
            _Warning("ຂໍ້ມູນທີ່ທ່ານປ້ອນມີຢູ່ແລ້ວ");
          } else if (output == 200) {
            _Success();
            $scope.btnName = "ບັນທຶກ";
            setTimeout(() => {
              window.location.reload();
            }, 1000);
          } else {
            _Fail();
          }
        });
    }
  };
});

app.controller("editReceiveOfSale", function ($scope, $http) {
  $scope.btnName = "ແກ້ໄຂ";
  $scope.selectedCategory = function () {
    var cate_id = $scope.cate_id;
    $http
      .get("sql/query_production.php?cate_id=" + cate_id)
      .success(function (data) {
        $scope.production = data;
      });
  };

  $scope._onSave = function () {
    if (!$scope.pro_id) {
      _Warning("ກະລຸນາເລືອກລາຍການເຄື່ອງກ່ອນ");
      $('[ng-model="pro_id"]').focus();
    } else if (!$scope.rec_bprice) {
      _Warning("ກະລຸນາປ້ອນລາຄາຊື້ກ່ອນ");
      $('[ng-model="rec_bprice"]').focus();
    } else if (!$scope.rec_sprice) {
      _Warning("ກະລຸນາປ້ອນລາຄາຂາຍກ່ອນ");
      $('[ng-model="rec_sprice"]').focus();
    } else if (!$scope.rec_qty) {
      _Warning("ກະລຸນາປ້ອນຈຳນວນເຄື່ອງກ່ອນ");
      $('[ng-model="rec_qty"]').focus();
    } else if (!$scope.user_holder) {
      _Warning("ກະລຸນາປ້ອນຜູ້ຖືຄອງເຄື່ອງກ່ອນ");
      $('[ng-model="user_holder"]').focus();
    } else {
      $http
        .post("sql/create_receive.php", {
          rec_id: $scope._id,
          pro_id: $scope.pro_id,
          rec_bprice: $scope.rec_bprice,
          rec_sprice: $scope.rec_sprice,
          rec_qty: $scope.rec_qty,
          rec_date: moment($scope.rec_date).format("YYYY-MM-DD"),
          user_holder: $scope.user_holder,
          rec_note: $scope.rec_note,
          old_qty: $scope.old_qty,
          btnName: $scope.btnName
        })
        .success(function (output) {
          console.log(output);
          if (output == "DATA_READY_EXIT") {
            _Warning("ຂໍ້ມູນທີ່ທ່ານປ້ອນມີຢູ່ແລ້ວ");
          } else if (output == 200) {
            _Success();
            $scope.btnName = "ບັນທຶກ";
            setTimeout(() => {
              window.location.reload();
            }, 1000);
          } else {
            _Fail();
          }
        });
    }
  };
});
