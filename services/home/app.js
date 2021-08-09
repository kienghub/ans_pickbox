var app = angular.module("app", []);
app.controller("home", function ($scope, $http) {
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

  // $scope._callStocks = function (st_date, end_date) {
  //   $http
  //     .get("sql/query_stock.php?st_date=" + st_date + "&end_date=" + end_date)
  //     .success(function (data) {
  //       $scope._stocks = data;
  //     });
  // };

  $scope._summary = function () {
    $http.get("./sql/summary.php").success(function (data) {
      var arr = data.split(",");
      console.log(arr);
      $scope.sumRecQty = arr[0];
      $scope.sumPayQty = arr[1];
      $scope.qtyTotal = arr[2];
      $scope.branchTotal = arr[3];
    });
  };
});
