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
          let price = ``;
          if (product.discount > 0) {
            price += `<del aria-hidden="true">
        <span>${formatCash(product.price)}₫</span>
      </del>`;
          }
          price += `<ins class="sizeprice-1">
        <span>${formatCash(
          product.discount > 0 ? product.discount : product.price
        )}₫</span>
        </ins>`;

          products += `<tr>
          <td class="id">${product.id}</td>
          <td>
            <h2 class="table-avatar">
              <a href="${SITE_URL}/store/product/${product.id}"><img class="avatar avatar-lg mr-2 avatar-img rounded" src="${SITE_URL}${product.thumbnail}" alt="${product.title}">
                <span class="title">${product.title}</span>
              </a>
            </h2>
          </td>
          <td>${price}</td>
          <td class="text-right">${product.quantity}</td>
        </tr>`;
        });
        $("#" + action + " .show").html(products);
      },
    });
  }
  (function () {
    let order;
    let colors = [
      "#283447",
      "#f39c12",
      "#2196f3",
      "#c580ff",
      "#26af48",
      "#e63c3c",
    ];
    let pieChart = buildChart();
    function buildChart() {
      var pieCtx = document.getElementById("invoice_chart"),
        pieConfig = {
          noData: {
            text: "Loading...",
          },
          series: [],
          legend: {
            show: false,
            position: "bottom",
            horizontalAlign: "center",
          },
          chart: {
            fontFamily: "Poppins, sans-serif",
            height: 350,
            type: "pie",
          },
          responsive: [
            {
              breakpoint: 576,
              options: {
                legend: {
                  show: true,
                  position: "bottom",
                },
              },
            },
          ],
        };
      var pieChart = new ApexCharts(pieCtx, pieConfig);
      pieChart.render();
      return pieChart;
    }
    $.ajax({
      url: ADMIN_URL + "/dashboard/invoice",
      dataType: "JSON",
      success: (data) => {
        order = data;
        let color = [];
        for (const c of data[2]) {
          color.push(colors[c - 1]);
        }
        for (let x in data[0]) {
          let total = data[1][x].toLocaleString("it-IT", {
            style: "currency",
            currency: "VND",
          });
          $("#invoice_statistic").append(`<div class="col-4">
            <div class="mt-3">
              <p class="mb-1 text-truncate"><i class="fas fa-circle mr-1" style=" color: ${color[x]}; "></i> ${data[0][x]} (${data[2][x]})</p>
              <h6> ${total}</h6>
            </div>
          </div>`);
        }
        pieChart.updateOptions({
          colors: color,
          series: data[1],
          tooltip: {
            custom: function ({ series, seriesIndex, dataPointIndex, w }) {
              let color = w.config.colors[seriesIndex];
              let label = w.config.labels[seriesIndex];
              let total = series[seriesIndex].toLocaleString("it-IT", {
                style: "currency",
                currency: "VND",
              });
              return `<span style="background-color: ${color};  padding: 5px 10px; ">${label}</span>`;
            },
          },
          labels: data[0],
        });
      },
    });
    $(document).on("change", "[name=loai]", function (e) {
      let value = $("[name=loai] option:selected").val();
      if (value == "sl") {
        pieChart.updateOptions({
          series: order[2],
        });
      } else {
        pieChart.updateOptions({
          series: order[1],
        });
      }
    });
  })();
  (function () {
    var url = ADMIN_URL + "/dashboard/category";
    $.getJSON(url, buildChart);
    function buildChart(data) {
      console.log(data);
      var pieCtx = document.getElementById("category_chart");
      var pieConfig = {
        series: data[1],
        legend: {
          show: true,
          position: "bottom",
          horizontalAlign: "center",
        },
        chart: {
          fontFamily: "Poppins, sans-serif",
          height: 350,
          type: "pie",
        },
        labels: data[0],
        responsive: [
          {
            breakpoint: 576,
            options: {
              legend: {
                show: true,
                position: "bottom",
              },
            },
          },
        ],
      };
      var pieChart = new ApexCharts(pieCtx, pieConfig);
      pieChart.render();
      return pieChart;
    }
    $(document).on("change", "[name=loai]", function (e) {
      let value = $("[name=loai] option:selected").val();
      if (value == "sl") {
        pieChart.updateOptions({
          series: order[2],
        });
      } else {
        pieChart.updateOptions({
          series: order[1],
        });
      }
    });
  })();
});
