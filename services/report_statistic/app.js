var app = angular.module("app", ["angularUtils.directives.dirPagination"]);
app.controller("report", function ($scope, $http) {
  $scope.serial = 1;
  $scope.indexCount = function (newPageNumber) {
    $scope.serial = newPageNumber * $scope._limitTo - ($scope._limitTo - 1);
  };

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

  $scope._callStateBranch = function () {
    $http.get("sql/query_office_state_branches.php").success(function (data) {
      $scope._stateBranchs = data;
      $scope._length = data.length;
    });
  };

  $scope._callBranch = function (pro_id) {
    $.get("./sql/query_branch_for_state.php", { pro_id }, function (data) {
      var item = JSON.parse(data);
      let _newData = [];
      console.log(_newData);
      $scope._branchs = arr;
      for (var i = 0; i > item.length; i++) {
        _newData.push(item[i]);
      }
    });
  };
});

// JQUERY
function _selectedProvince() {
  var pro_id = $("#province_Id").val();
  $.get("./sql/query_branch_from_pro_id.php", { pro_id }, function (data) {
    console.log("data", data);
    $("#branch_Id").html(data);
  });
}
// FORMAT NUMBER
function convertNumber(x) {
  if (x == null) {
    return 0;
  } else {
    return x.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
  }
}

// SEARCH FOR SAME DAY
function _onSearch() {
  var branch_Id = $("#branch_Id").val();
  var weight = $("#weight").val();
  window.location =
    "report_samday.php?branch_Id=" + branch_Id + "&weight=" + weight;
}

function _searchDate() {
  var start_date = $("#start_date").val();
  var end_date = $("#end_date").val();
  window.location =
    "report_nextday.php?start_date=" + start_date + "&end_date=" + end_date;
}
function _searchDate2() {
  var start_date = $("#start_date").val();
  var end_date = $("#end_date").val();
  window.location =
    "report_sameday.php?start_date=" + start_date + "&end_date=" + end_date;
}

function _searchDate3() {
  var start_date = $("#start_date").val();
  var end_date = $("#end_date").val();
  window.location =
    "charges_report.php?start_date=" + start_date + "&end_date=" + end_date;
}
