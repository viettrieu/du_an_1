/*
Author       : Dreamguys
Template Name: Kanakku - Bootstrap Admin Template
Version      : 1.0
*/

(function ($) {
  "use strict";

  // Variables declarations

  var $wrapper = $(".main-wrapper");
  var $pageWrapper = $(".page-wrapper");
  var $slimScrolls = $(".slimscroll");

  // Sidebar
  var Sidemenu = function () {
    this.$menuItem = $("#sidebar-menu a");
  };

  function init() {
    var $this = Sidemenu;
    $("#sidebar-menu a").on("click", function (e) {
      if ($(this).parent().hasClass("submenu")) {
        e.preventDefault();
      }
      if (!$(this).hasClass("subdrop")) {
        $("ul", $(this).parents("ul:first")).slideUp(350);
        $("a", $(this).parents("ul:first")).removeClass("subdrop");
        $(this).next("ul").slideDown(350);
        $(this).addClass("subdrop");
      } else if ($(this).hasClass("subdrop")) {
        $(this).removeClass("subdrop");
        $(this).next("ul").slideUp(350);
      }
    });
    $("#sidebar-menu ul li.submenu a.active")
      .parents("li:last")
      .children("a:first")
      .addClass("active")
      .trigger("click");
  }

  // Sidebar Initiate
  init();

  // Mobile menu sidebar overlay
  $("body").append('<div class="sidebar-overlay"></div>');
  $(document).on("click", "#mobile_btn", function () {
    $wrapper.toggleClass("slide-nav");
    $(".sidebar-overlay").toggleClass("opened");
    $("html").addClass("menu-opened");
    return false;
  });

  // Sidebar overlay
  $(".sidebar-overlay").on("click", function () {
    $wrapper.removeClass("slide-nav");
    $(".sidebar-overlay").removeClass("opened");
    $("html").removeClass("menu-opened");
  });

  // Page Content Height
  if ($(".page-wrapper").length > 0) {
    var height = $(window).height();
    $(".page-wrapper").css("min-height", height);
  }

  // Page Content Height Resize
  $(window).resize(function () {
    if ($(".page-wrapper").length > 0) {
      var height = $(window).height();
      $(".page-wrapper").css("min-height", height);
    }
  });

  // Select 2
  if ($(".select").length > 0) {
    $(".select").select2({
      minimumResultsForSearch: -1,
      width: "100%",
    });
  }

  // Datetimepicker

  if ($(".datetimepicker").length > 0) {
    $(".datetimepicker").datetimepicker({
      format: "DD-MM-YYYY",
    });
  }
  $("#startDate").on("dp.change", function (e) {
    $("#expiryDate").data("DateTimePicker").minDate(e.date.add(1, "days"));
  });

  if ($(".datetimepicker-coupon").length > 0) {
    $(".datetimepicker-coupon").datetimepicker({
      format: "DD-MM-YYYY",
      minDate: moment(),
    });
  }

  // $("#expiryDate").on("dp.change", function (e) {
  //   $("#startDate").data("DateTimePicker").maxDate(e.date);
  // });

  // Tooltip
  if ($('[data-toggle="tooltip"]').length > 0) {
    $('[data-toggle="tooltip"]').tooltip();
  }

  // Datatable

  if ($(".datatable").length > 0) {
    $(".datatable").DataTable({
      // bFilter: false,
      order: [[0, "desc"]],
      searching: true,
      dom: `<'row'<'col-sm-6 text-left'l><'col-sm-6 text-right'B>>
			<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'p>>`,
      buttons: [
        {
          extend: "csv",
          exportOptions: {
            columns: ":not(:last-child)",
          },
        },
        {
          extend: "excel",
          exportOptions: {
            columns: ":not(:last-child)",
          },
        },
        {
          extend: "pdf",
          exportOptions: {
            columns: ":not(:last-child)",
          },
        },
        {
          extend: "print",
          exportOptions: {
            columns: ":not(:last-child)",
          },
        },
      ],

      language: {
        sProcessing: "??ang x??? l??...",
        sLengthMenu: "Xem _MENU_ m???c",
        sZeroRecords: "Kh??ng t??m th???y d??ng n??o ph?? h???p",
        sInfo: "??ang xem _START_ ?????n _END_ trong t???ng s??? _TOTAL_ m???c",
        sInfoEmpty: "??ang xem 0 ?????n 0 trong t???ng s??? 0 m???c",
        sInfoFiltered: "(???????c l???c t??? _MAX_ m???c)",
        sInfoPostFix: "",
        sSearch: "T??m:",
        sUrl: "",
        oPaginate: {
          sFirst: "?????u",
          sPrevious: "Tr?????c",
          sNext: "Ti???p",
          sLast: "Cu???i",
        },
      },
    });
  }
  if ($("#order_list").length > 0) {
    // $("#clear").on("click", function (e) {
    //   $("#categoryFilter").val("");
    //   $("#invoice_number").val("");
    //   $("#phone").val("");
    //   $("#startDate").val("");
    //   $("#expiryDate").val("");
    //   table.columns().search("").draw();
    // });
    var table = $("#order_list").DataTable();
    var categoryIndex = 0;
    $("#order_list th").each(function (i) {
      if ($($(this)).html() == "Tr???ng th??i") {
        categoryIndex = i;
        return false;
      }
    });

    $("#categoryFilter").on("change", function (e) {
      table.columns(categoryIndex).search(this.value).draw();
    });
    $("#invoice_number").on("keyup", function (e) {
      table.columns(0).search(this.value).draw();
    });
    $("#phone").on("keyup", function (e) {
      table.columns(2).search(this.value).draw();
    });
    let flag = true;
    $("#startDate, #expiryDate").on("dp.change", function (e) {
      if (flag) {
        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
          var min = $("#startDate").val();
          var max = $("#expiryDate").val();
          min = new Date(moment(min, "DD-MM-YYYY").format("YYYY-MM-DD"));
          max = new Date(moment(max, "DD-MM-YYYY").format("YYYY-MM-DD"));
          var date = new Date(
            moment(data[4], "DD/MM/YYYY").format("YYYY-MM-DD")
          );
          if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
          ) {
            return true;
          } else {
            return false;
          }
        });
      }
      table.draw();
    });
  }
  // Sidebar Slimscroll
  if ($slimScrolls.length > 0) {
    $slimScrolls.slimScroll({
      height: "auto",
      width: "100%",
      position: "right",
      size: "7px",
      color: "#ccc",
      allowPageScroll: false,
      wheelStep: 10,
      touchScrollStep: 100,
    });
    var wHeight = $(window).height() - 60;
    $slimScrolls.height(wHeight);
    $(".sidebar .slimScrollDiv").height(wHeight);
    $(window).resize(function () {
      var rHeight = $(window).height() - 60;
      $slimScrolls.height(rHeight);
      $(".sidebar .slimScrollDiv").height(rHeight);
    });
  }

  // Password Show

  if ($(".toggle-password").length > 0) {
    $(document).on("click", ".toggle-password", function () {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $(".pass-input");
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  }

  // Check all email

  $(document).on("click", "#check_all", function () {
    $(".checkmail").click();
    return false;
  });
  if ($(".checkmail").length > 0) {
    $(".checkmail").each(function () {
      $(this).on("click", function () {
        if ($(this).closest("tr").hasClass("checked")) {
          $(this).closest("tr").removeClass("checked");
        } else {
          $(this).closest("tr").addClass("checked");
        }
      });
    });
  }

  // Mail important

  $(document).on("click", ".mail-important", function () {
    $(this).find("i.fa").toggleClass("fa-star").toggleClass("fa-star-o");
  });

  // Small Sidebar
  $(document).on("click", "#toggle_btn", function () {
    if ($("body").hasClass("mini-sidebar")) {
      $("body").removeClass("mini-sidebar");
      $(".subdrop + ul").slideDown();
    } else {
      $("body").addClass("mini-sidebar");
      $(".subdrop + ul").slideUp();
    }
    setTimeout(function () {
      mA.redraw();
      mL.redraw();
    }, 300);
    return false;
  });

  $(document).on("mouseover", function (e) {
    e.stopPropagation();
    if ($("body").hasClass("mini-sidebar") && $("#toggle_btn").is(":visible")) {
      var targ = $(e.target).closest(".sidebar").length;
      if (targ) {
        $("body").addClass("expand-menu");
        $(".subdrop + ul").slideDown();
      } else {
        $("body").removeClass("expand-menu");
        $(".subdrop + ul").slideUp();
      }
      return false;
    }
  });

  $(document).on("click", "#filter_search", function () {
    $("#filter_inputs").slideToggle("slow");
  });

  // Chat

  var chatAppTarget = $(".chat-window");
  (function () {
    if ($(window).width() > 991) chatAppTarget.removeClass("chat-slide");

    $(document).on(
      "click",
      ".chat-window .chat-users-list a.media",
      function () {
        if ($(window).width() <= 991) {
          chatAppTarget.addClass("chat-slide");
        }
        return false;
      }
    );
    $(document).on("click", "#back_user_list", function () {
      if ($(window).width() <= 991) {
        chatAppTarget.removeClass("chat-slide");
      }
      return false;
    });
  })();
})(jQuery);
// Quill

var toolbarOptions = [
  [{ header: [1, 2, 3, 4, 5, 6, false] }],
  ["bold", "italic", "underline"],
  [{ list: "ordered" }, { list: "bullet" }],
  [{ indent: "-1" }, { indent: "+1" }],
  [{ color: [] }, { background: [] }],
  [{ align: [] }],
  ["link"],
];
if ($("#content").length > 0) {
  var content = new Quill("#content", {
    modules: {
      toolbar: toolbarOptions,
    },
    theme: "snow",
  });
}
if ($("#summary").length > 0) {
  var summary = new Quill("#summary", {
    modules: {
      toolbar: toolbarOptions,
    },
    theme: "snow",
  });
}
// dsd
if ($(".select2tag").length > 0) {
  $(".select2tag").select2({
    tags: true,
    width: "100%",
  });
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#thumbnailPreview").css(
        "background-image",
        "url(" + e.target.result + ")"
      );
      $("#thumbnailPreview").hide();
      $("#thumbnailPreview").fadeIn(650);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
$("#thumbnail").change(function () {
  readURL(this);
});

// $("#create_product").submit(function (e) {
//   e.preventDefault();
//   $(this)
//     .find("[type=submit]")
//     .prepend(
//       '<span class="spinner-border spinner-border-sm mr-2" role="status"></span>'
//     );
//   var formData = new FormData(this);
//   let content = $("#content .ql-editor");
//   let summary = $("#summary .ql-editor");
//   formData.append("action", "create_product");
//   formData.append("content", content.html());
//   formData.append("summary", summary.html());
//   $.ajax({
//     url: "./ajax.php",
//     type: "POST",
//     data: formData,
//     dataType: "JSON",
//     success: function (data) {
//       $(".spinner-border").remove();
//       Swal.fire({
//         title: "????ng th??nh c??ng",
//         html: `B???n v???a ????ng th??nh c??ng s???n ph???m <b>${data[1]}</b>`,
//         icon: "success",
//         showCancelButton: true,
//         confirmButtonColor: "#d33",
//         cancelButtonColor: "#3085d6",
//         confirmButtonText: "Xem chi ti???t s???n ph???m",
//         cancelButtonText: "????ng s???n ph???m kh??c",
//       }).then((result) => {
//         if (result.isConfirmed) {
//           location.href = "../?action=san-pham&id=" + data[0];
//         } else {
//           document.getElementById("create_product").reset();
//           $(".select2-selection__choice").remove();
//           summary.html("");
//           content.html("");
//         }
//       });
//     },
//     cache: false,
//     contentType: false,
//     processData: false,
//   });
// });

// $("#edit_product").submit(function (e) {
//   e.preventDefault();
//   $(this)
//     .find("[type=submit]")
//     .prepend(
//       '<span class="spinner-border spinner-border-sm mr-2" role="status"></span>'
//     );
//   $(this).data("id");
//   var formData = new FormData(this);
//   let content = $("#content .ql-editor");
//   let summary = $("#summary .ql-editor");
//   formData.append("action", "edit_product");
//   formData.append("id", $(this).data("id"));
//   formData.append("content", content.html());
//   formData.append("summary", summary.html());
//   $.ajax({
//     url: "./ajax.php",
//     type: "POST",
//     data: formData,
//     dataType: "JSON",
//     success: function (data) {
//       $(".spinner-border").remove();
//       Swal.fire({
//         title: "C???p nh???t th??nh c??ng",
//         html: `B???n v???a c???p nh???t th??nh c??ng s???n ph???m <b>${data[1]}</b>`,
//         icon: "success",
//         showCancelButton: true,
//         confirmButtonColor: "#d33",
//         cancelButtonColor: "#3085d6",
//         confirmButtonText: "Xem chi ti???t s???n ph???m",
//         cancelButtonText: "Ti???p t???c c???p nh???t",
//       }).then((result) => {
//         if (result.isConfirmed) {
//           location.href = "../?action=san-pham&id=" + data[0];
//         }
//       });
//     },
//     cache: false,
//     contentType: false,
//     processData: false,
//   });
// });
function deleteItem(element, action, item) {
  let id = element.closest("tr").find(".id").text();
  console.log(id);
  let title = element.closest("tr").find(".title").text();
  title = title ? title : "#" + id;
  var dtRow = element.parents("tr");
  Swal.fire({
    title: `X??a ${item}`,
    html: `B???n c?? mu???n xo?? ${item} <b>${title}</b>`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "X??a",
    cancelButtonText: "Kh??ng",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      return fetch(ADMIN_URL + action + "/" + id)
        .then((response) => response.json())
        .catch((error) => {
          Swal.showValidationMessage(`${item} Kh??a ngo???i`);
        });
      return $.ajax({
        type: "POST",
        url: ADMIN_URL + action,
        data: postForm,
        dataType: "JSON",
        success: (data) => data,
      });
    },
    allowOutsideClick: () => !Swal.isLoading(),
  }).then((result) => {
    if (result.isConfirmed) {
      console.log(result.value);
      if (result.value == 1) {
        var table = $(".datatable").DataTable();
        table.row(dtRow).remove().draw(false);
        Swal.fire({
          title: "X??a th??nh c??ng",
          text: `B???n ???? xo?? ${item} '${title}'`,
          icon: "success",
        });
      } else {
        Swal.fire({
          title: "X??a kh??ng th??nh c??ng",
          text: `???? c?? l???i khi xo?? ${item} '${title}'`,
          icon: "error",
        });
      }
    }
  });
}

$("#order_list").on("click", ".dropdown-item.status", function (e) {
  $this = $(this);
  let idOrder = $(this).closest("tr").find(".id").text();
  let idStatus = $(this).data("id");
  let textStatus = $(this).text();
  let status = $(this).closest("tr").find("td.status");
  var postForm = {
    idOrder,
    idStatus,
  };
  Swal.fire({
    title: "Thay ?????i tr???ng th??i",
    html: `B???n mu???n thay ?????i tr???ng th??i sang <b>${textStatus}</b>`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "C??",
    cancelButtonText: "Kh??ng",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      return $.ajax({
        type: "POST",
        url: ADMIN_URL + "/order/StatusChange",
        data: postForm,
        dataType: "TEXT",
        success: (data) => data,
      });
    },
    allowOutsideClick: () => !Swal.isLoading(),
  }).then((result) => {
    if (result.isConfirmed) {
      if (result.value == "true") {
        if (idStatus < 5) {
          for (let i = 1; i <= idStatus; i++) {
            $(this)
              .closest("tr")
              .find("[data-id=" + i + "]")
              .remove();
          }
        } else {
          $(this).closest("tr").find(".dropdown-action").remove();
        }
        status
          .empty()
          .append(`<span class="bg-status-${idStatus}">${textStatus}</span>`);
        Swal.fire({
          title: "Thay ?????i th??nh c??ng",
          html: `Tr???ng th??i hi???n t???i l?? <b>${textStatus}</b>`,
          icon: "success",
        });
      } else {
        Swal.fire({
          title: "Thay ?????i kh??ng tr???ng th??i th??nh c??ng",
          text: `???? c?? l???i khi thay ?????i tr???ng th??i ????n h??ng '${idOrder}'`,
          icon: "error",
        });
      }
    }
  });
});
function GetQLeditor() {
  let content = $("#content .ql-editor");
  let summary = $("#summary .ql-editor");
  if (content.length > 0) $("#content ~ input").val(content.html());
  if (summary.length > 0) $("#summary ~ input").val(summary.html());
}
$("#create_category").submit(GetQLeditor);
$("#edit_category").submit(GetQLeditor);
$("#create_tag").submit(GetQLeditor);
$("#edit_tag").submit(GetQLeditor);
$("#create_publisher").submit(GetQLeditor);
$("#edit_publisher").submit(GetQLeditor);
$("#create_tag").submit(GetQLeditor);
$("#create_product").submit(GetQLeditor);
$("#edit_product").submit(GetQLeditor);
$("#create_coupon").submit(GetQLeditor);
$("#edit_coupon").submit(GetQLeditor);
$("#create_author").submit(GetQLeditor);
$("#edit_author").submit(GetQLeditor);
$("#create_post").submit(GetQLeditor);
$("#edit_post").submit(GetQLeditor);
$("#create_post_category").submit(GetQLeditor);
$("#edit_post_category").submit(GetQLeditor);
$("#product_list").on("click", ".delete", function (e) {
  return deleteItem($(this), "/product/delete", "s???n ph???m");
});
$("#category_list").on("click", ".delete", function (e) {
  return deleteItem($(this), "/category/delete", "danh m???c");
});
$("#user_list").on("click", ".delete", function (e) {
  return deleteItem($(this), "/user/delete", "th??nh vi??n");
});
$("#tag_list").on("click", ".delete", function (e) {
  return deleteItem($(this), "/tag/delete", "t??? kh??a");
});
$("#publisher_list").on("click", ".delete", function (e) {
  return deleteItem($(this), "/publisher/delete", "NXB");
});
$("#reviews_list").on("click", ".delete", function (e) {
  return deleteItem($(this), "/review/delete", "????nh gi??");
});
$("#coupon_list").on("click", ".delete", function (e) {
  return deleteItem($(this), "/coupon/delete", "Coupon");
});
$("#author_list").on("click", ".delete", function (e) {
  return deleteItem($(this), "/author/delete", "T??c gi???");
});
$("#post_list").on("click", ".delete", function (e) {
  return deleteItem($(this), "/post/delete", "B??i vi???t");
});
$("#post_category_list").on("click", ".delete", function (e) {
  return deleteItem($(this), "/postcategory/delete", "Danh m???c");
});
$("#comment_list").on("click", ".delete", function (e) {
  return deleteItem($(this), "/comment/delete", "B??nh lu???n");
});

////
$("#reviews_list").on("click", ".accept", function (e) {
  return Approve($(this), "/review/approve", "????nh gi??");
});
$("#comment_list").on("click", ".accept", function (e) {
  return Approve($(this), "/comment/approve", "B??nh lu???n");
});
function Approve(element, action, item) {
  let badge = element.closest("tr").find(".status span");
  let idReview = element.closest("tr").find(".id").text();
  var postForm = {
    idReview,
  };
  Swal.fire({
    title: `Ph?? duy???t ${item}`,
    html: `B???n mu???n ph?? duy???t ${item} <b>#${idReview}</b>`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "C??",
    cancelButtonText: "Kh??ng",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: ADMIN_URL + action,
        data: postForm,
        dataType: "JSON",
        success: function (x) {
          badge.text("???? duy???t");
          badge.removeClass();
          badge.addClass("badge-pill bg-success-light");
          element.remove();
          Swal.fire({
            title: "Th??nh c??ng",
            html: `${item} <b>#${idReview}</b> ???? ???????c ph?? duy???t`,
            icon: "success",
          });
        },
      });
    }
  });
}

window.setTimeout(function () {
  $(".alert.alert-success.fade")
    .fadeTo(500, 0)
    .slideUp(500, function () {
      $(this).remove();
    });
}, 3000);
function generateCoupon() {
  let coupon = voucher_codes.generate({
    length: 6,
    charset: "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ",
  });
  $("#code").val(coupon[0]);
}

// $("#order_list").on("click", ".create", function (e) {
//   return CreateShipmentOrder($(this), "/transport/createShipmentOrder");
// });
// $("#view_order").on("click", ".create", function (e) {
//   return CreateShipmentOrder($(this), "/transport/createShipmentOrder");
// });
$("#quickview").on("click", ".create", function (e) {
  return CreateShipmentOrder($(this), "/transport/createShipmentOrder");
});

function CreateShipmentOrder(element, action) {
  let id = element.data("id");
  element.find("i").removeClass().addClass("fas fa-spinner fa-spin");
  let status = $("#quickview .status");
  let ghtk = $("#quickview .ghtk");
  $.ajax({
    url: ADMIN_URL + action + "/" + id,
    dataType: "JSON",
    success: (data) => {
      let className =
        data["success"] == false ? "alert-danger" : "alert-success";
      $("#quickview .errors").empty()
        .append(`<div class="alert ${className} alert-dismissible" role="alert">
        ${data["message"]}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">??</span>
            </button>
          </div>`);
      if (!data["success"]) {
        element.find("i").removeClass().addClass("fas fa-shipping-fast");
      } else {
        element.remove();
        status
          .empty()
          .append(`<span class="bg-status-4">??ang giao h??ng</span>`);
        ghtk.append(`
          <p><strong>M?? v???n ????n:</strong>${data["order"]["tracking_id"]}</p>
          <p><strong>Ng??y l???y h??ng:</strong> ${data["order"]["estimated_pick_time"]}</p>
          <p><strong>Ng??y giao h??ng:</strong> ${data["order"]["estimated_deliver_time"]}</p>
          <p><strong>Tr???ng th??i:</strong> ???? ti???p nh???n</p>
          <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger cancel" data-id="${id}">
          <i class="fas fa-ban"></i>
          H???y ????n h??ng
          </a>
          <a href="javascript:void(0);" class="btn btn-sm btn-white text-info print"
          data-id="${data["order"]["tracking_id"]}">
          <i class="fas fa-print"></i>
          In ????n h??ng
        </a>`);
      }
    },
  });
}

$("#quickview").on("click", ".cancel", function (e) {
  return cancelOrder($(this), "/transport/cancelOrder");
});

function cancelOrder(element, action) {
  let id = element.data("id");
  element.find("i").removeClass().addClass("fas fa-spinner fa-spin");
  let status = $("#quickview .status");
  $.ajax({
    url: ADMIN_URL + action + "/" + id,
    dataType: "JSON",
    success: (data) => {
      let className =
        data["success"] == false ? "alert-danger" : "alert-success";
      $("#quickview .errors").empty()
        .append(`<div class="alert ${className} alert-dismissible" role="alert">
      ${data["message"]}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>`);
      if (!data["success"]) {
        element.find("i").removeClass().addClass("fas fa-ban");
      } else {
        element.remove();
        status.empty().append(`<span class="bg-status-6">Th???t b???i</span>`);
      }
    },
  });
}
$("#quickview").on("click", ".print", function (e) {
  return ajaxFileStream($(this), "/transport/printOrder");
});
function ajaxFileStream(element, action) {
  let id = element.data("id");
  element.find("i").removeClass().addClass("fas fa-spinner fa-spin");
  let url = ADMIN_URL + action + "/" + id;
  let oReq = new XMLHttpRequest();
  oReq.open("GET", url, true);
  oReq.responseType = "arraybuffer";
  oReq.onload = function (event) {
    element.find("i").removeClass().addClass("fas fa-print");
    let blob = new Blob([oReq.response], { type: "application/pdf" });
    let blobURL = URL.createObjectURL(blob);
    let iframe = document.createElement("iframe");
    document.body.appendChild(iframe);
    iframe.style.display = "none";
    iframe.src = blobURL;
    iframe.onload = function () {
      setTimeout(function () {
        iframe.focus();
        iframe.contentWindow.print();
      }, 1);
    };
  };
  oReq.send();
}
// function CreateShipmentOrdersss(element, action) {
//   let id = element.data("id");
//   let badge = element.closest("tr").find(".badge");
//   let ghtk = element.closest("tr").find(".ghtk");
//   Swal.fire({
//     title: `????ng ????n h??ng`,
//     html: `????n h??ng <b>${id}</b> c???a b???n ???? ???????c g???i l??n h??? th???ng GHTK`,
//     icon: "warning",
//     showCancelButton: true,
//     confirmButtonColor: "#3085d6",
//     cancelButtonColor: "#d33",
//     confirmButtonText: "????ng",
//     cancelButtonText: "Kh??ng",
//     showLoaderOnConfirm: true,
//     preConfirm: () => {
//       return $.ajax({
//         url: ADMIN_URL + action + "/" + id,
//         dataType: "JSON",
//         success: (data) => {
//           if (!data["success"]) {
//             Swal.showValidationMessage(`${data["message"]}`);
//           } else {
//             return data;
//           }
//         },
//       });
//     },
//     allowOutsideClick: () => !Swal.isLoading(),
//   }).then((result) => {
//     console.log(result);
//     if (result.isConfirmed) {
//       if (result.value["success"] == true) {
//         element.remove();
//         badge.text("??ang giao h??ng");
//         badge.removeClass();
//         badge.addClass("badge bg-status-4");
//         ghtk.append(
//           `<p>M?? v???n ????n: <strong>${result.value.order["tracking_id"]}</strong></p>`
//         );
//         Swal.fire({
//           title: "Th??nh c??ng",
//           html: `????n h??ng ${id} c???a b???n ???? ???????c g???i l??n h??? th???ng GHTK`,
//           icon: "success",
//         });
//       }
//     }
//   });
// }

$("#order_list").on("click", ".quick-view", function (e) {
  return QuickView($(this), "#quickview", "/order/quickview");
});

$("#user_list").on("click", ".quick-view", function (e) {
  return QuickView($(this), "#quick_view_user", "/user/quickview");
});

function QuickView(element, modal, action) {
  let id = element.closest("tr").find(".id").text();
  $.ajax({
    url: ADMIN_URL + action + "/" + id,
    dataType: "HTML",
    success: (data) => {
      $(modal + " .modal-body").html(data);
      $(modal).modal("show");
    },
  });
}
function formatCash(str) {
  str = String(str);
  return str
    .split("")
    .reverse()
    .reduce((prev, next, index) => {
      return (index % 3 ? next : next + ".") + prev;
    });
}
