$(document).ready(function () {
  $(".menu-mobi").click(function () {
    $(this).toggleClass("active");
    $("#header-bottom > *").toggleClass("nav-active");
    if ($("#header-bottom > *").hasClass("nav-active")) {
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
window.addEventListener("load", function () {
  document.querySelector("body").classList.add("loaded");
});

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
$(".close").click(function () {
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
