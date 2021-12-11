$(document).ready(function () {
  $(".hamburger-menu").click(function (e) {
    e.preventDefault();
    $(".hamburger-menu").toggleClass("animate");
    $("#header-bottom").toggleClass("nav-active");
    if ($("#header-bottom").hasClass("nav-active")) {
      $("body").addClass("no-scroll");
    } else {
      $("body").removeClass("no-scroll");
    }
  });
  $(".slider").owlCarousel({
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    smartSpeed: 800,
    autoplayHoverPause: true,
    nav: true,
    dots: false,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    items: 1,
  });
  $("#book_author").owlCarousel({
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    smartSpeed: 800,
    autoplayHoverPause: true,
    touchDrag: false,
    mouseDrag: false,
    nav: true,
    dots: false,
    items: 1,
  });

  $(".related-book").owlCarousel({
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    smartSpeed: 800,
    autoplayHoverPause: true,
    margin: 30,
    nav: true,
    dots: false,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });
  setTimeout(() => {
    let getHeight = $(
      "#book_author > .owl-stage-outer > .owl-stage > .owl-item.active "
    ).height();
    $("#book_author").height(getHeight);
    $("#book_author > .owl-stage-outer").height(getHeight);
  }, 0);

  $(".list-posts").owlCarousel({
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    smartSpeed: 800,
    autoplayHoverPause: true,
    margin: 30,
    nav: true,
    dots: false,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });
  $(".related-posts").owlCarousel({
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    smartSpeed: 800,
    autoplayHoverPause: true,
    margin: 30,
    nav: true,
    dots: false,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1,
      },
      1000: {
        items: 2,
      },
    },
  });

  $(".our-team").owlCarousel({
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    smartSpeed: 800,
    autoplayHoverPause: true,
    margin: 30,
    nav: true,
    dots: false,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });
  $(".our-awards").owlCarousel({
    loop: true,
    autoplay: false,
    autoplayTimeout: 8000,
    smartSpeed: 800,
    autoplayHoverPause: true,
    margin: 30,
    nav: true,
    dots: false,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    responsive: {
      0: {
        items: 2,
      },
      600: {
        items: 4,
      },
      1000: {
        items: 6,
      },
    },
  });
  $(".testi").owlCarousel({
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    smartSpeed: 800,
    autoplayHoverPause: true,
    margin: 30,
    nav: true,
    dots: false,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 2,
      },
    },
  });
  var btn = $("#back-to-top");
  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      btn.addClass("show");
    } else {
      btn.removeClass("show");
    }
  });
  btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "300");
  });
});
// window.addEventListener("load", function () {
document.querySelector("body").classList.add("loaded");
// });

var url = new URL(window.location.href);
var id = url.searchParams.get("id");
// let cart = [];
// function saveCart() {
//   localStorage.setItem("shoppingCart", JSON.stringify(cart));
// }
// function loadCart() {
//   cart = JSON.parse(localStorage.getItem("shoppingCart"));
// }
// if (localStorage.getItem("shoppingCart") != null) {
//   loadCart();
// }
function getCount() {
  let count = document.querySelector(".top-bar-nav .fa-shopping-cart");
  count.setAttribute(
    "data-count",
    cart.reduce((counts, count) => counts + Number(count.quantity), 0)
  );
  if (cart.length != 0) {
    count.classList.add("count");
  } else {
    count.classList.remove("count");
  }
}
setTimeout(getCount);
function formatCash(str) {
  str = String(str);
  return str
    .split("")
    .reverse()
    .reduce((prev, next, index) => {
      return (index % 3 ? next : next + ".") + prev;
    });
}
window.setTimeout(function () {
  $(".alert.alert-success.fade")
    .fadeTo(500, 0)
    .slideUp(500, function () {
      $(this).remove();
    });
}, 3000);
$(document).on("click", ".alert .close", function (e) {
  $(this)
    .parent()
    .fadeTo(500, 0)
    .slideUp(500, function () {
      $(this).remove();
    });
});

const popupCenter = ({ url, title, w, h }) => {
  // Fixes dual-screen position                             Most browsers      Firefox
  const dualScreenLeft =
    window.screenLeft !== undefined ? window.screenLeft : window.screenX;
  const dualScreenTop =
    window.screenTop !== undefined ? window.screenTop : window.screenY;

  const width = window.innerWidth
    ? window.innerWidth
    : document.documentElement.clientWidth
    ? document.documentElement.clientWidth
    : screen.width;
  const height = window.innerHeight
    ? window.innerHeight
    : document.documentElement.clientHeight
    ? document.documentElement.clientHeight
    : screen.height;

  const systemZoom = width / window.screen.availWidth;
  const left = (width - w) / 2 / systemZoom + dualScreenLeft;
  const top = (height - h) / 2 / systemZoom + dualScreenTop;
  const newWindow = window.open(
    url,
    title,
    `
    scrollbars=yes,
    width=${w / systemZoom},
    height=${h / systemZoom},
    top=${top},
    left=${left}
    `
  );

  // if (window.focus) newWindow.focus();
};
$(document).ready(function () {
  $("#socialauth a").click(function (e) {
    e.preventDefault();
    const url = $(this).attr("href");
    console.log(url);
    popupCenter({ url: url, title: "xtf", w: 500, h: 500 });
  });
});

(function () {
  "use strict";
  window.addEventListener(
    "load",
    function () {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName("needs-validation");
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener(
          "submit",
          function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add("was-validated");
          },
          false
        );
      });
    },
    false
  );
})();
$(document).ready(function () {
  $(document).on("click", ".bpfw-action-flip", function (e) {
    e.preventDefault();
    $(".bpfw-flip-wrapper").toggleClass("bpfw-view");
  });
});
$(document).on("click", ".quick_view", function (e) {
  let id = $(this).data("id");
  $(this).find("i").removeClass().addClass("fas fa-spinner fa-spin");
  $.ajax({
    type: "POST",
    data: { id },
    url: SITE_URL + "/store/quickview",
    dataType: "HTML",
    success: (data) => {
      $(this).find("i").removeClass().addClass("fas fa-search");
      $("#modal-quick_view .show_quick_view").empty().append(data);
      $("#modal-quick_view").addClass("md-show");
    },
  });
});
$(document).on("click", ".wishlist", function (e) {
  let id = $(this).data("id");
  $(this).find("i").removeClass().addClass("fas fa-spinner fa-spin");
  $.ajax({
    type: "POST",
    data: { productId: id },
    url: SITE_URL + "/wishlist/add",
    dataType: "JSON",
    success: (data) => {
      if (data["type"] == "success") {
        $(this).attr("href", SITE_URL + "/wishlist");
        $(this).removeClass("wishlist");
        $(this).find("i").removeClass().addClass("fas fa-heart");
      } else {
        $(this).find("i").removeClass().addClass("far fa-heart");
      }
      notification({
        duration: 3000,
        ...data,
      });
    },
  });
});

function getSubTotal() {
  let sum = cart.reduce((sum, item) => sum + item.quantity * item.price, 0);
  return sum;
}
function getDiscount(subTotal) {
  let sum = 0;
  if (coupon["type"] == 0) {
    sum = (coupon["discount"] / 100) * subTotal;
  } else if (coupon["type"] == 1) {
    sum = coupon["discount"];
  }
  return sum;
}
function getshipmentFee() {
  if (shipmentFee.length > 0) {
    return shipmentFee[0]["fee"];
  }
  return 0;
}
function showCoupon(discount) {
  let info = ``;
  if (coupon["code"]) {
    info = `<tr class="cart-discount">
    <th>Coupon: ${coupon["code"]}</th>
    <td>-<span class="discount">${formatCash(discount)}</span>
      <sup>đ</sup> <a href="" id="remove-coupon">[xóa]</a>
    </td>
  </tr>`;
  }
  return info;
}
function getTotal(subTotal, discount, ship = 0) {
  let sum = subTotal - discount + ship;
  return sum < 0 ? 0 : sum;
}
$("#mailchimp").submit(function () {
  var mailchimpform = $(this);
  $("#mailchimp button").prepend(`<i class="fas fa-spinner fa-spin"></i>`);
  $.ajax({
    url: SITE_URL + "/formsubscribe",
    type: "POST",
    data: mailchimpform.serialize(),
    dataType: "JSON",
    success: function (data) {
      let alert = ``;
      data.forEach((element) => {
        if (element.status == "OK") {
          $("#mailchimp")[0].reset();
        }
        let status =
          element.status == "ERROR" ? "alert-danger" : "alert-success";
        alert = `<div class="alert ${status} alert-dismissible fade show" role="alert">
      ${element.message}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>`;
      });
      $("#news-letter .errors").html(alert);
      console.log($(this).find("i"));
      $("#mailchimp .fas").remove();
    },
  });
  return false;
});
(function () {
  let cache = {};
  $(document).on("click", "#newest .cat-item", function (e) {
    e.preventDefault();
    const id = $(this).data("id");
    $("#newest li").removeClass("active");
    $(this).addClass("active");
    if (Object.keys(cache).includes(String(id))) {
      $("#show_product").html(cache[id][0] + cache[id][1]);
      return;
    }
    $.ajax({
      url: SITE_URL + "/store/loadmore/category/" + id,
      dataType: "JSON",
      success: (data) => {
        cache[id] = [data[0], data[1]];
        $("#show_product").html(data[0] + data[1]);
      },
    });
  });
  $(document).on("click", "#newest .load-more", function (e) {
    var spinner = '<span class="spinner"></span>';
    $(this).addClass("loading").html(spinner);
    e.preventDefault();
    const href = $(this).data("href");
    const id = $(this).data("id");
    $.ajax({
      url: href,
      dataType: "JSON",
      success: (data) => {
        $(this).closest("div")[0].remove();
        $("#show_product").append(data[0] + data[1]);
        cache[id][0] += data[0];
        cache[id][1] = data[1];
      },
    });
  });
})();
