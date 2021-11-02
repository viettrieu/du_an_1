"use strict";

$(document).ready(function () {
  function generateData(count) {
    var i = 0;
    var series = [];
    while (i < count) {
      var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

      series.push(z);
      i++;
    }
    return series;
  }
  console.log(generateData(5, 5, 5));
  const listOfDays = [
    "Chủ nhật",
    "Thứ Hai",
    "Thứ ba",
    "Thứ tư",
    "Thứ năm",
    "Thứ sáu",
    "Thứ bảy",
  ];
  function Last7Days() {
    var result = [];
    for (var i = 0; i < 7; i++) {
      var d = new Date();
      d.setDate(d.getDate() - i);
      result.unshift(listOfDays[d.getDay()]);
    }
    return result;
  }
  var columnCtx = document.getElementById("sales_chart"),
    columnConfig = {
      colors: ["#7638ff", "#fda600"],
      series: [
        {
          name: "Hoàn thành",
          type: "column",
          data: generateData(7),
        },
        {
          name: "Chưa giải quyết",
          type: "column",
          data: generateData(7),
        },
      ],
      chart: {
        type: "bar",
        fontFamily: "Poppins, sans-serif",
        height: 450,
        toolbar: {
          show: false,
        },
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "60%",
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      xaxis: {
        categories: Last7Days(),
      },
      yaxis: {
        title: {
          text: "VNĐ",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return "$ " + val + " thousands";
          },
        },
      },
    };
  var columnChart = new ApexCharts(columnCtx, columnConfig);
  columnChart.render();

  //Pie Chart

  var url = "./char.php";
  $.getJSON(url, buildChart);
  function buildChart(data) {
    let colors = ["#26af48", "#e63c3c", "#2196f3"];
    for (let x in data[0]) {
      let total = data[1][x].toLocaleString("it-IT", {
        style: "currency",
        currency: "VND",
      });
      $("#invoice_statistic").append(` <div class="col-4">
      <div class="mt-4">
        <p class="mb-2 text-truncate"><i class="fas fa-circle mr-1" style=" color: ${colors[x]}; "></i> ${data[0][x]}</p>
        <h5> ${total}</h5>
      </div>
    </div>`);
    }
    var pieCtx = document.getElementById("invoice_chart"),
      pieConfig = {
        colors,
        series: data[1],
        tooltip: {
          custom: function ({ series, seriesIndex, dataPointIndex, w }) {
            let color = w.config.colors[seriesIndex];
            let label = w.config.labels[seriesIndex];
            let total = series[seriesIndex].toLocaleString("it-IT", {
              style: "currency",
              currency: "VND",
            });
            return `<span style="background-color: ${color};  padding: 5px 10px; ">${label} - ${total}</span>`;
          },
        },
        legend: {
          show: false,
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
  }
});
