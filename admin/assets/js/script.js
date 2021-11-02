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
      icons: {
        up: "fas fa-angle-up",
        down: "fas fa-angle-down",
        next: "fas fa-angle-right",
        previous: "fas fa-angle-left",
      },
    });
  }

  // Tooltip
  if ($('[data-toggle="tooltip"]').length > 0) {
    $('[data-toggle="tooltip"]').tooltip();
  }

  // Datatable
  if ($(".datatable").length > 0) {
    $(".datatable").DataTable({
      bFilter: false,
      order: [[0, "desc"]],
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

$("#create_product").submit(function (e) {
  e.preventDefault();
  $(this)
    .find("[type=submit]")
    .prepend(
      '<span class="spinner-border spinner-border-sm mr-2" role="status"></span>'
    );
  var formData = new FormData(this);
  let content = $("#content .ql-editor");
  let summary = $("#summary .ql-editor");
  formData.append("action", "create_product");
  formData.append("content", content.html());
  formData.append("summary", summary.html());
  $.ajax({
    url: "./ajax.php",
    type: "POST",
    data: formData,
    dataType: "JSON",
    success: function (data) {
      $(".spinner-border").remove();
      Swal.fire({
        title: "Đăng thành công",
        html: `Bạn vừa đăng thành công sản phẩm <b>${data[1]}</b>`,
        icon: "success",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xem chi tiết sản phẩm",
        cancelButtonText: "Đăng sản phẩm khác",
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = "../?action=san-pham&id=" + data[0];
        } else {
          document.getElementById("create_product").reset();
          $(".select2-selection__choice").remove();
          summary.html("");
          content.html("");
        }
      });
    },
    cache: false,
    contentType: false,
    processData: false,
  });
});

$("#edit_product").submit(function (e) {
  e.preventDefault();
  $(this)
    .find("[type=submit]")
    .prepend(
      '<span class="spinner-border spinner-border-sm mr-2" role="status"></span>'
    );
  $(this).data("id");
  var formData = new FormData(this);
  let content = $("#content .ql-editor");
  let summary = $("#summary .ql-editor");
  formData.append("action", "edit_product");
  formData.append("id", $(this).data("id"));
  formData.append("content", content.html());
  formData.append("summary", summary.html());
  $.ajax({
    url: "./ajax.php",
    type: "POST",
    data: formData,
    dataType: "JSON",
    success: function (data) {
      $(".spinner-border").remove();
      Swal.fire({
        title: "Cập nhật thành công",
        html: `Bạn vừa cập nhật thành công sản phẩm <b>${data[1]}</b>`,
        icon: "success",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xem chi tiết sản phẩm",
        cancelButtonText: "Tiếp tục cập nhật",
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = "../?action=san-pham&id=" + data[0];
        }
      });
    },
    cache: false,
    contentType: false,
    processData: false,
  });
});
function deleteItem(element, action, item) {
  let id = element.closest("tr").find(".id").text();
  let title = element.closest("tr").find(".title").text();
  title = title ? title : "#" + id;
  var dtRow = element.parents("tr");
  var postForm = {
    action: action,
    id,
  };
  Swal.fire({
    title: `Xóa ${item}`,
    html: `Bạn có muốn xoá ${item} <b>${title}</b>`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Xóa",
    cancelButtonText: "Không",
    showLoaderOnConfirm: true,
    preConfirm: () => {
      return $.ajax({
        type: "POST",
        url: "./ajax.php",
        data: postForm,
        dataType: "JSON",
        success: function (x) {
          return x;
        },
      });
    },
    allowOutsideClick: () => !Swal.isLoading(),
  }).then((result) => {
    if (result.isConfirmed) {
      var table = $(".datatable").DataTable();
      table.row(dtRow).remove().draw(false);
      Swal.fire({
        title: "Xóa thành công",
        text: `Bạn đã xoá ${item} '${title}'`,
        icon: "success",
      });
    }
  });
}
$("#product_list").on("click", ".delete", function (e) {
  let $this = $(this);
  deleteItem($this, "delete_product", "sản phẩm");
});

$("#DataTables_Table_0").on("click", ".status", function (e) {
  $this = $(this);
  let idOrder = $(this).closest("tr").find(".id").text();
  let idStatus = $(this).data("id");
  let textStatus = $(this).text();
  let badge = $(this).closest("tr").find(".badge");
  var postForm = {
    action: "update_status_order",
    idOrder,
    idStatus,
  };
  Swal.fire({
    title: "Thay đổi trạng thái",
    html: `Bạn muốn thay đổi trạng thái sang <b>${textStatus}</b>`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Có",
    cancelButtonText: "Không",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "./ajax.php",
        data: postForm,
        dataType: "JSON",
        success: function (x) {
          console.log(x);
          badge.text(textStatus);
          badge.removeClass();
          badge.addClass(`badge bg-status-${idStatus}`);
          Swal.fire({
            title: "Thay đổi thành công",
            html: `Trạng thái hiện tại là <b>${textStatus}</b>`,
            icon: "success",
          });
        },
      });
    }
  });
});

// $("#create_category").submit(function (e) {
//   e.preventDefault();
//   var formData = new FormData(this);
//   let content = $("#content .ql-editor");
//   formData.append("action", "create_category");
//   formData.append("content", content.html());
//   $.ajax({
//     url: "./ajax.php",
//     type: "POST",
//     data: formData,
//     dataType: "JSON",
//     success: function (data) {
//       if (data[0] == 1) {
//         Swal.fire({
//           title: "Tạo thành công",
//           html: `Bạn vừa tạo công danh mục <b>${data[1]}</b>`,
//           icon: "success",
//         });
//         document.getElementById("create_category").reset();
//         content.html("");
//         console.log(data);
//         var table = $(".datatable").DataTable();
//         table.row
//           .add([
//             data[2],
//             data[1],
//             "3",
//             0,
//             `
//         <a href="./sua-san-pham.php?id=${data[1]}" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i>Sửa</a>
//         <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger delete"><i class="far fa-trash-alt mr-1"></i>Xóa</a>`,
//           ])
//           .draw(false);
//       } else {
//         Swal.fire({
//           title: "Đã tồn tại",
//           html: `Tên danh mục <b>${data[1]}</b> đã tồn tại`,
//           icon: "error",
//         });
//       }
//     },
//     cache: false,
//     contentType: false,
//     processData: false,
//   });
// });

$("#create_category").submit(function (e) {
  let content = $("#content .ql-editor");
  $("#content ~ input").val(content.html());
});

$("#category_list").on("click", ".delete", function (e) {
  let $this = $(this);
  deleteItem($this, "delete_category", "danh mục");
});

$("#user_list").on("click", ".delete", function (e) {
  let $this = $(this);
  deleteItem($this, "delete_user", "thành viên");
});
$("#tag_list").on("click", ".delete", function (e) {
  let $this = $(this);
  deleteItem($this, "delete_tag", "từ khóa");
});
$("#reviews_list").on("click", ".delete", function (e) {
  let $this = $(this);
  deleteItem($this, "delete_review", "Đánh giá");
});
$("#reviews_list").on("click", ".accept", function (e) {
  e.preventDefault();
  console.log(e);
  let badge = $(this).closest("tr").find(".badge");
  let idReview = $(this).closest("tr").find(".id").text();
  var postForm = {
    action: "accept_review",
    idReview,
  };
  Swal.fire({
    title: "Phê duyệt đánh giá sản phẩm",
    html: `Bạn muốn phê duyệt đánh giá <b>#${idReview}</b>`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Có",
    cancelButtonText: "Không",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "./ajax.php",
        data: postForm,
        dataType: "JSON",
        success: function (x) {
          badge.text("Đã duyệt");
          badge.removeClass();
          badge.addClass("badge badge-pill bg-success-light");
          $(e.target).remove();
          Swal.fire({
            title: "Thành công",
            html: `Đánh giá <b>#${idReview}</b> đã được phê duyệt`,
            icon: "success",
          });
        },
      });
    }
  });
});
window.setTimeout(function () {
  $(".alert.alert-success")
    .fadeTo(500, 0)
    .slideUp(500, function () {
      $(this).remove();
    });
}, 3000);
