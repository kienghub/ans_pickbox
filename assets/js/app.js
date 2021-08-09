function _logout() {
  Notiflix.Confirm.Show(
    "ສະຖານະ",
    "ທ່ານຕ້ອງການອອກຈາກລະບົບແທ້ ຫຼື ບໍ່?",
    "ຕົກລົງ",
    "ຍົກເລີກ",
    function () {
      window.location = "../../logout.php";
    },
    function () {
      close();
    }
  );
}

// SEARCH DATA GLOBAL
$("#filter").keyup(function () {
  var filter = $(this).val(),
    count = 0;
  $("#data #row").each(function () {
    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
      $(this).hide(); // MY CHANGE
    } else {
      $(this).show(); // MY CHANGE
      count++;
    }
  });
});

//SEARCH MENU
$("#search").keyup(function () {
  var filter = $(this).val(),
    count = 0;
  $("#data #row").each(function () {
    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
      $(this).hide(); // MY CHANGE
    } else {
      $(this).show(); // MY CHANGE
      count++;
    }
  });
});

//SEARCH CATEGORY
$("#searchCategory").keyup(function () {
  var filter = $(this).val(),
    count = 0;
  $("#categorys #category").each(function () {
    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
      $(this).hide(); // MY CHANGE
    } else {
      $(this).show(); // MY CHANGE
      count++;
    }
  });
});
//SEARCH CATEGORY
$("#searchMember").keyup(function () {
  var filter = $(this).val(),
    count = 0;
  $("#members #member").each(function () {
    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
      $(this).hide(); // MY CHANGE
    } else {
      $(this).show(); // MY CHANGE
      count++;
    }
  });
});

//SEARCH CATEGORY
$("#filter").keyup(function () {
  var filter = $(this).val(),
    count = 0;
  $("#data_table #sublist").each(function () {
    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
      $(this).hide(); // MY CHANGE
    } else {
      $(this).show(); // MY CHANGE
      count++;
    }
  });
});

// duration of scroll animation
var scrollDuration = 300;
// paddles
var leftPaddle = document.getElementsByClassName("left-paddle");
var rightPaddle = document.getElementsByClassName("right-paddle");
// get items dimensions
var itemsLength = $(".item").length;
var itemSize = $(".item").outerWidth(true);
// get some relevant size for the paddle triggering point
var paddleMargin = 20;

// get wrapper width
var getMenuWrapperSize = function () {
  return $(".menu-wrapper").outerWidth();
};
var menuWrapperSize = getMenuWrapperSize();
// the wrapper is responsive
$(window).on("resize", function () {
  menuWrapperSize = getMenuWrapperSize();
});
// size of the visible part of the menu is equal as the wrapper size
var menuVisibleSize = menuWrapperSize;

// get total width of all menu items
var getMenuSize = function () {
  return itemsLength * itemSize;
};
var menuSize = getMenuSize();
// get how much of menu is invisible
var menuInvisibleSize = menuSize - menuWrapperSize;

// get how much have we scrolled to the left
var getMenuPosition = function () {
  return $(".menu").scrollLeft();
};

$(function () {
  var print = function (msg) {
    alert(msg);
  };

  var setInvisible = function (elem) {
    elem.css("visibility", "hidden");
  };
  var setVisible = function (elem) {
    elem.css("visibility", "visible");
  };

  var elem = $("#elem");
  var items = elem.children();

  // Inserting Buttons
  elem.prepend(
    '<div id="right-button" style="visibility: hidden;"><a href="#"><i class="icon-chevrons-left" style="font-size:30px;margin-top:35px"></i></a></div>'
  );
  elem.append(
    '  <div id="left-button"><a href="#"><i class="icon-chevrons-right"  style="font-size:35px;"></i></a></div>'
  );

  // Inserting Inner
  items.wrapAll('<div id="inner" />');

  // Inserting Outer
  debugger;
  elem.find("#inner").wrap('<div id="outer"/>');

  var outer = $("#outer");

  var updateUI = function () {
    var maxWidth = outer.outerWidth(true);
    var actualWidth = 0;
    $.each($("#inner >"), function (i, item) {
      actualWidth += $(item).outerWidth(true);
    });

    if (actualWidth <= maxWidth) {
      setVisible($("#left-button"));
    }
  };
  updateUI();

  $("#right-button").click(function () {
    var leftPos = outer.scrollLeft();
    outer.animate(
      {
        scrollLeft: leftPos - 200
      },
      800,
      function () {
        debugger;
        if ($("#outer").scrollLeft() <= 0) {
          setInvisible($("#right-button"));
        }
      }
    );
  });

  $("#left-button").click(function () {
    setVisible($("#right-button"));
    var leftPos = outer.scrollLeft();
    outer.animate(
      {
        scrollLeft: leftPos + 200
      },
      800
    );
  });

  $(window).resize(function () {
    updateUI();
  });
});

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

function _loading(e) {
  Notiflix.Loading.Dots(e + "...");
}

function _loading_stop() {
  Notiflix.Loading.Remove();
}
