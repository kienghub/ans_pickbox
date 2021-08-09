var app = angular.module("app", []);
app.controller("delivered", function ($scope, $http) {
  $scope.deliveredShow = function (title, url, w, h) {
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

app.controller("print_delivered", function ($scope, $http) {
  $scope._onApproved = function () {
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການຢືນຢັນການສົ່ງມອບ ຫຼື ບໍ່ ?",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http.post("sql/server.php?request=update").success(function (data) {
          console.log(data);
          if (data == 200) {
            _loading("ກຳລັງສົ່ງຂໍ້ມູນເພື່ອກວດສອບ...");
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
});
