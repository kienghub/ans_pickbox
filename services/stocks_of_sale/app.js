var app = angular.module("app", ["datatables"]);
app.controller("report_stock_of_sale", function ($scope, $http) {
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
  $scope._callStocks = function () {
    $http.get("sql/query_stock.php").success(function (data) {
      $scope._stocks = data;
    });
  };
  $scope.selectedCategory = function () {
    $scope.cateId = $scope.cate_id[0];
  };

  $scope._summary = function () {
    $http.get("./sql/summary.php").success(function (data) {
      var arr = data.split(",");
      console.log(arr);
      $scope.sumRecQty = arr[0];
      $scope.sumPayQty = arr[1];
      $scope.qtyTotal = arr[2];
    });
  };
  $scope.reportAll = function (title, url, w, h) {
    layer.open({
      type: 2,
      area: [w + "%", h + "%"],
      fix: true,
      maxmin: true,
      shade: 0.4,
      title: title,
      content: url
    });
  };
});
