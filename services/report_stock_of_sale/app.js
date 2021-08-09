var app = angular.module("app", []);
app.controller("report_stock_of_sale", function ($scope, $http) {
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

function selectedState() {
  var id = $("#stateId").val();
  $.get("../sale/sql/query_branch_for_province.php", { id }, function (data) {
    $("#state").html(data);
  });
}
