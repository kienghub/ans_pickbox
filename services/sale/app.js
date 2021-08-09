var app = angular.module("app", []);
app.controller("controller", function ($scope, $http) {
  var sellConfirm = angular.element("#sellConfirm");

  $scope._callCategory = function () {
    $http.get("sql/call_category.php").success(function (data) {
      $scope._callcate = data;
    });
  };
  $scope._callSize = function () {
    $http.get("sql/query_size.php").success(function (data) {
      $scope._callSize = data;
    });
  };

  $scope._callProduct = function () {
    $http.get("sql/query_product.php").success(function (data) {
      $scope._callproduct = data;
      $scope._length = data.length;
    });
  };

  $scope._callOrders = function () {
    $http.get("sql/query_order_list.php").success(function (data) {
      var arr = data.split(";");
      $scope._orderList = JSON.parse(arr[0]);
      $scope.summaryOrder = arr[1];
    });
  };
  $scope._callOrders();

  $scope._onSelected = function (id) {
    $scope.cate_id = id;
  };
  $scope._onSelectedSize = function (size) {
    console.log(size);
    $scope.pro_sizes = size;
  };

  $scope._selectType = function (x) {
    $scope.type = x;
  };
  $scope._showUser = function (data) {
    $scope.user_img = data.user_img;
    $scope.user_fname = data.user_fname;
    $scope.user_lname = data.user_lname;
  };

  $scope.btnName = "ອານຸມັດ";
  $scope._onApproved = function (x) {
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການອານຸມັດນີ້ແທ້ ຫຼື ບໍ່ ?",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http
          .post("sql/create_paylist.php", {
            branchID: x,
            btnName: $scope.btnName,
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

  // ?add new bill_no
  $scope._addBill = function (bill_no) {
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການເພີ່ມບິນໃໝ່ແທ້ ຫຼື ບໍ່ ?",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http
          .post("sql/create_paylist.php?create_bill", {
            bill_old: bill_no,
          })
          .success(function (data) {
            console.log(data);
            if (data == 200) {
              _Success();
              setTimeout(() => {
                window.location.reload();
              }, 2000);
            } else {
              _Fail();
            }
          });
      },
      function () {}
    );
  };

  // ?get product item
  $scope.addToCart = async function (pro_id) {
    //* get total from stock
    await $http
      .get("sql/query_sum_total.php?pro_id=" + pro_id)
      .success(function (data) {
        $scope.total = data;
      });

    //* get product detail
    await $http
      .get("sql/query_product_detail.php?pro_id=" + pro_id)
      .success(function (data) {
        $scope.req_qty = 1;
        var arr = data.split(";");
        var newData = JSON.parse(arr[1]);
        $scope.rec_sprice = arr[0];
        $scope.pro_id = newData.pro_id;
        $scope.pro_img = newData.pro_img;
        $scope.pro_size = newData.pro_size;
      });
    //! qty control
    $scope.req_qty = 1;
    $scope._plus = function () {
      if ($scope.req_qty + 1 > $scope.total) {
        return false;
      } else {
        $scope.req_qty++;
        $scope.total--;
      }
    };
    $scope._minus = function () {
      if ($scope.req_qty < 1) {
        return false;
      } else {
        $scope.req_qty--;
        $scope.total++;
      }
    };
    //* show modal
    sellConfirm.modal("show");
  };

  // *close Modal
  $scope._close = function () {
    sellConfirm.modal("hide");
  };

  //? SAVE ORDER
  $scope._onConfirm = function (bill_no) {
    if (!$scope.req_qty) {
      _Warning("ກະລຸນາປ້ອນຈຳນວນກ່ອນ");
      $('[ng-model="req_qty"]').focus();
    } else if ($scope.total < 1) {
      _Warning("ຈຳນວນເຄື່ອງໃນສາງບໍ່ພຽງພໍ");
      $('[ng-model="total"]').focus();
    } else {
      const _data = {
        pro_id: $scope.pro_id,
        req_qty: $scope.req_qty,
        rec_sprice: $scope.rec_sprice,
        req_date: moment($scope.pay_date).format("YYYY-MM-DD"),
        req_note: $scope.req_note,
        total: $scope.total,
        bill_no: bill_no,
      };
      $http
        .post("sql/create_paylist.php?create_order", _data)
        .success(function (output) {
          console.log(output);
          if (output == "DATA_READY_EXIT") {
            _Warning("ຂໍ້ມູນທີ່ທ່ານປ້ອນມີຢູ່ແລ້ວ");
          } else if (output == 200) {
            _Success();
            $scope._callOrders();
            $scope._callProduct();
          } else {
            _Fail();
          }
        });
    }
  };

  // !remove items on orderlist
  $scope._removeItem = function (_id, pro_id, qty) {
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການລຶບລາຍການນີ້ແທ້ ຫຼື ບໍ່ ?",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http
          .post("sql/create_paylist.php?removeItem", {
            _id: _id,
            pro_id: pro_id,
            qty: qty,
          })
          .success(function (data) {
            console.log(data);
            if (data == 200) {
              _Success();
              $scope._callOrders();
              $scope._callProduct();
            } else {
              _Fail();
            }
          });
      },
      function () {}
    );
  };

  $scope.addRequest = function (title, url, w, h) {
    layer.open({
      type: 2,
      area: [w + "px", h + "px"],
      fix: true,
      maxmin: true,
      shade: 0.4,
      title: title,
      content: url,
    });
  };

  $scope.requestedList = function (title, url, w, h) {
    layer.open({
      type: 2,
      area: [w + "%", h + "%"],
      fix: true,
      maxmin: true,
      shade: 0.4,
      title: title,
      content: url,
    });
  };

  $scope.requestingList = function (title, url, w, h) {
    layer.open({
      type: 2,
      area: [w + "%", h + "%"],
      fix: true,
      maxmin: true,
      shade: 0.4,
      title: title,
      content: url,
    });
  };

  $scope.confirmed = function (title, url, w, h) {
    layer.open({
      type: 2,
      area: [w + "%", h + "%"],
      fix: true,
      maxmin: true,
      shade: 0.4,
      title: title,
      content: url,
    });
  };

  $scope.paylistHistory = function (title, url, w, h) {
    layer.open({
      type: 2,
      area: [w + "%", h + "%"],
      fix: true,
      maxmin: true,
      shade: 0.4,
      title: title,
      content: url,
    });
  };

  $scope.saleList = function (title, url, w, h) {
    layer.open({
      type: 2,
      area: [w + "%", h + "%"],
      fix: true,
      maxmin: true,
      shade: 0.4,
      title: title,
      content: url,
    });
  };

  $scope._onApprovedThis = function (id) {
    reConfirm.modal("show");
    $http
      .get("../checking_stock/sql/query_request.php?id=" + id)
      .success(function (data) {
        $scope._list = data;
        console.log(data);
      });

    $http
      .get("../checking_stock/sql/query_branch_name.php?id=" + id)
      .success(function (data) {
        $scope._listBranch = data;
      });
    $scope.branch_id = id;
  };

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
            btnName: $scope.btnName,
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
});
// ?End Controller

app.controller("addPaylist", function ($scope, $http) {
  $scope.btnName = "ສົ່ງຄຳຂໍ";
  $scope._onRequesting = function () {
    var number = Number($scope.pay_qty.replace(/[^0-9.-]+/g, ""));
    if (!$scope.pro_id) {
      _Warning("ກະລຸນາເລືອກລາຍການເຄື່ອງກ່ອນ");
      $('[ng-model="pro_id"]').focus();
    } else if ($scope.total < number) {
      _Warning("ຈຳນວນເຄື່ອງໃນສາງບໍ່ພຽງພໍ");
      $('[ng-model="total"]').focus();
    } else if (!$scope.pay_qty) {
      _Warning("ກະລຸນາປ້ອນຈຳນວນກ່ອນ");
      $('[ng-model="pay_qty"]').focus();
    } else {
      $http
        .post("sql/create_paylist.php", {
          pro_id: $scope.pro_id,
          pay_qty: $scope.pay_qty,
          pay_date: moment($scope.pay_date).format("YYYY-MM-DD"),
          branch_id: $scope.branch_id,
          pay_note: $scope.pay_note,
          total: $scope.total,
          btnName: $scope.btnName,
        })
        .success(function (output) {
          console.log(output);
          if (output == "DATA_READY_EXIT") {
            _Warning("ຂໍ້ມູນທີ່ທ່ານປ້ອນມີຢູ່ແລ້ວ");
          } else if (output == 200) {
            _Success();
            setTimeout(() => {
              window.location.reload();
            }, 1000);
          } else {
            _Fail();
          }
        });
    }
  };

  $scope.selectedProducts = function () {
    var pro_id = $scope.pro_id;
    $http
      .get("./sql/query_sum_total.php?pro_id=" + pro_id)
      .success(function (data) {
        $scope.total = data;
      });
  };

  $scope._clear = function () {
    window.location.reload();
  };
});

app.controller("requestedList", function ($scope, $http) {
  $scope.btnName = "ອານຸມັດ";
  $scope._onApproved = function (x) {
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການອານຸມັດນີ້ແທ້ ຫຼື ບໍ່ ?",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http
          .post("sql/create_paylist.php", {
            branchID: x,
            btnName: $scope.btnName,
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
});

app.controller("requestingList", function ($scope, $http) {
  var updateRequesting = angular.element("#updateRequesting");
  // $scope.btnName = "ອານຸມັດ";
  $scope.requesting_actived = "active";
  $scope._requested_list = true;
  $scope._onSelected = function (x) {
    if (x == 0) {
      $scope.requesting_actived = "active";
      $scope.requested_actived = "false";
      $scope._requested_list = true;
      $scope._requesting_list = false;
    } else {
      $scope.requested_actived = "active";
      $scope.requesting_actived = "false";
      $scope._requesting_list = true;
      $scope._requested_list = false;
    }
  };

  $scope._onUpdate = function (id, qty) {
    $scope.btnName = "ແກ້ໄຂ";
    updateRequesting.modal("show");
    $scope.req_qty = qty;
    $scope._onSaved = function () {
      if ($scope.req_qty < 1) {
        _Warning("ຈຳນວນເຄື່ອງບໍ່ພຽງພໍ");
      } else {
        $http
          .post("sql/create_paylist.php", {
            _id: id,
            req_qty: $scope.req_qty,
            btnName: $scope.btnName,
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
      }
    };
  };

  $scope._onDelete = function (id) {
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການຍົກເລີກລາຍການນີ້ແທ້ ຫຼື ບໍ່ ?",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http
          .post("sql/delete_playlist.php", {
            _id: id,
            btnName: $scope.btnName,
          })
          .success(function (data) {
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

  // QTY CONTRYLL
});

app.controller("confirmed", function ($scope, $http) {
  var staticBackdrop = angular.element("#staticBackdrop");
  $scope.btnName = "ຮັບເຄື່ອງ";
  $scope._justConfirm = function (id, pro_id, qty) {
    Notiflix.Confirm.Show(
      "ຢືນຢັນການຮັບເຄື່ອງ",
      "ທ່ານກວດສອບເຄື່ອງຖື້ກຕ້ອງແລ້ວ ຫຼື ບໍ່ ?\n ຖ້າຖືກຕ້ອງແລ້ວກະລຸນາກົດຮັບເລີຍ",
      "ຮັບ",
      "ຍົກເລີກ",
      function () {
        $http
          .post("sql/create_paylist.php", {
            req_id: id,
            pro_id: pro_id,
            req_qty: qty,
            btnName: $scope.btnName,
          })
          .success(function (data) {
            console.log(data);
            if (data == "DATA_MINI_EXIT") {
              _Warning("ເຄື່ອງບໍ່ພຽງພໍໃນການເບີກ");
            } else if (data == 200) {
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

  $scope._rejected = function (id, pro_id) {
    staticBackdrop.modal("show");
    $scope._id = id;
    $scope._proID = pro_id;
  };
  $scope.close = function () {
    staticBackdrop.modal("hide");
  };
  $scope._Rejected = function () {
    if (!$scope.note) {
      _Warning("ກະລຸນາປ້ອນເຫດຜົນການປະຕິເສດ");
      $('[ng-model="note"]').focus();
    } else {
      $http
        .post("sql/create_paylist.php", {
          _id: _id,
          pro_id: _proID,
          note: $scope.note,
          btnName: "onReject",
        })
        .success(function (data) {
          console.log(data);
          if (data == 200) {
            staticBackdrop.modal("hide");
            _Success();
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
app.controller("paylistHistory", function ($scope, $http) {});

app.controller("saleList", function ($scope, $http) {
  var updateSaleList = angular.element("#updateSaleList");
  $scope._onUpdate = function (id, pro_id, qty) {
    $scope.btnName = "ບັນທຶກການປ່ຽນແປງ";
    updateSaleList.modal("show");
    $scope.s_qty = qty;
    $scope.oldQty = qty;
    $scope._onSaved = function () {
      if ($scope.s_qty < 1) {
        _Warning("ຈຳນວນເຄື່ອງບໍ່ພຽງພໍ");
      } else {
        $http
          .post("sql/create_paylist.php", {
            _id: id,
            s_qty: $scope.s_qty,
            pro_id: pro_id,
            oldQty: qty,
            btnName: $scope.btnName,
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
      }
    };
  };

  $scope._onDelete = function (id, pro_id, qty) {
    Notiflix.Confirm.Show(
      "ຢືນຢັນ",
      "ທ່ານຕ້ອງການຍົກເລີກລາຍການນີ້ແທ້ ຫຼື ບໍ່ ?",
      "ຕົກລົງ",
      "ຍົກເລີກ",
      function () {
        $http
          .post("sql/delete_sale.php", {
            _id: id,
            pro_id: pro_id,
            s_qty: qty,
            btnName: "onDelete",
          })
          .success(function (data) {
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

  // QTY CONTRYLL
  $scope.s_qty = 1;
  $scope._plus = function () {
    if ($scope.s_qty + 1 > $scope.total) {
      return false;
    } else {
      $scope.s_qty++;
      $scope.total--;
    }
  };
  $scope._minus = function () {
    if ($scope.s_qty < 1) {
      return false;
    } else {
      $scope.s_qty--;
      $scope.total++;
    }
  };
});

app.controller("addCart", function ($scope, $http) {
  $scope._callBranchState = function () {
    $http.get("../../").success(function (data) {
      $scope._province = data;
    });
  };

  // QTY CONTRYLL
  $scope.req_qty = 1;
  $scope._plus = function () {
    if ($scope.req_qty + 1 > $scope.total) {
      return false;
    } else {
      $scope.req_qty++;
      $scope.total--;
    }
  };
  $scope._minus = function () {
    if ($scope.req_qty < 1) {
      return false;
    } else {
      $scope.req_qty--;
      $scope.total++;
    }
  };
});

function selectedCategory() {
  var cate_id = $("#cate_id").val();
  $.get("./sql/call_product_from_category.php", { cate_id }, function (data) {
    $("#pro_id").html(data);
  });
}

function selectedState() {
  var id = $("#stateId").val();
  $.get("./sql/query_branch_for_province.php", { id }, function (data) {
    $("#state").html(data);
  });
}
