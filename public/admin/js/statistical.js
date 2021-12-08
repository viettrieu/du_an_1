"use strict";

$(document).ready(function () {
  let ranges = {
    "Last 7 Days": [moment().subtract(6, "days"), moment()],
    "Last 14 Days": [moment().subtract(13, "days"), moment()],
    "Last 30 Days": [moment().subtract(29, "days"), moment()],
    "This Month": [moment().startOf("month"), moment().endOf("month")],
    "Last Month": [
      moment().subtract(1, "month").startOf("month"),
      moment().subtract(1, "month").endOf("month"),
    ],
  };
  function getDaterange(start, end, ranges, element, callback) {
    callback(start, end);
    $(element).daterangepicker(
      {
        maxDate: moment(),
        startDate: start,
        endDate: end,
        ranges,
      },
      callback
    );
  }
  function cb(start, end, label = "") {
    let id = $("#hot_product .category option:selected").val();
    $("#hot_product .reportrange span").html(
      start.format("DD-MM-YYYY") + " - " + end.format("DD-MM-YYYY")
    );
    if (label !== "") {
      getData(
        "hot_product",
        id,
        start.format("YYYY-MM-DD"),
        end.add(1, "days").format("YYYY-MM-DD")
      );
    }
  }
  let start = moment().subtract(6, "days").locale("vi");
  let end = moment().add(1, "days").locale("vi");
  getDaterange(start, end, ranges, "#hot_product .reportrange span", cb);
  (function () {
    $(document).on("change", "#hot_product .category", function (e) {
      let id = $(this).val();
      getData(
        "hot_product",
        id,
        start.format("YYYY-MM-DD"),
        end.format("YYYY-MM-DD")
      );
    });
  })();

  (function () {
    $(document).on("change", "#wishlist_product .category", function (e) {
      let id = $(this).val();
      getData("wishlist_product", id);
    });
  })();

  function getData(action, id, start = 0, end = 0) {
    $.ajax({
      url: ADMIN_URL + "/dashboard/getdatasql",
      type: "POST",
      dataType: "JSON",
      data: { action, id, start, end },
      beforeSend: function () {},
      success: function (data) {
        console.log(data);
        let products = ``;
        data.forEach((product) => {
          products += `<tr>
          <td class="id">${product.id}</td>
          <td>
            <h2 class="table-avatar">
              <a href="${SITE_URL}/store/product/${
            product.id
          }"><img class="avatar avatar-lg mr-2 avatar-img rounded" src="${SITE_URL}${
            product.thumbnail
          }" alt="${product.title}">
                <span class="title">${product.title}</span>
              </a>
            </h2>
          </td>
          <td>${formatCash(product.price)}<sup>đ</sup></td>
          <td class="text-right">${product.quantity}</td>
        </tr>`;
        });
        $("#" + action + " .show").html(products);
      },
    });
  }
});
