"use strict";

$(document).ready(function () {
  let uniq = (a) => [...new Set(a)];
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

  function chartSessionsUsers() {
    let options = {
      noData: {
        text: "Loading...",
      },
      series: [],
      chart: {
        height: 350,
        type: "line",
        stacked: false,
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: [1, 1, 2],
      },
      xaxis: {
        categories: [],
      },
      yaxis: [
        {
          axisTicks: {
            show: true,
          },
          axisBorder: {
            show: true,
            color: "#008FFB",
          },
          labels: {
            style: {
              colors: "#008FFB",
            },
          },
          title: {
            text: "Users",
            style: {
              color: "#008FFB",
            },
          },
          tooltip: {
            enabled: true,
          },
        },
        {
          seriesName: "Income",
          opposite: true,
          axisTicks: {
            show: true,
          },
          axisBorder: {
            show: true,
            color: "#00E396",
          },
          labels: {
            style: {
              colors: "#00E396",
            },
          },
          title: {
            text: "Sessions",
            style: {
              color: "#00E396",
            },
          },
        },
        {
          seriesName: "Revenue",
          opposite: true,
          axisTicks: {
            show: true,
          },
          axisBorder: {
            show: true,
            color: "#FEB019",
          },
          labels: {
            style: {
              colors: "#FEB019",
            },
          },
          title: {
            text: "Page views",
            style: {
              color: "#FEB019",
            },
          },
        },
      ],
      // tooltip: {
      //   fixed: {
      //     enabled: true,
      //     position: "topLeft", // topRight, topLeft, bottomRight, bottomLeft
      //     offsetY: 30,
      //     offsetX: 60,
      //   },
      // },
    };
    let chart = new ApexCharts(document.querySelector("#ggg"), options);
    chart.render();
    return chart;
  }

  let SessionsUsers = chartSessionsUsers();
  function showChartSU(startDate, endDate, action) {
    $.ajax({
      url: ADMIN_URL + action,
      type: "POST",
      dataType: "JSON",
      data: {
        startDate,
        endDate,
      },
      success: (data) => {
        let ngay = data.dimensions["ga:date"].map((e) =>
          moment(e, "YYYYMMDD").format("MMM D")
        );
        let Sessions = data.metrics["ga:Sessions"].map((e) => Number(e));
        let users = data.metrics["ga:users"].map((e) => Number(e));
        let Pageviews = data.metrics["ga:Pageviews"].map((e) => Number(e));
        SessionsUsers.updateOptions({
          series: [
            {
              name: "Users",
              type: "column",
              data: users,
            },
            {
              name: "Sessions",
              type: "column",
              data: Sessions,
            },
            {
              name: "Page views",
              type: "line",
              data: Pageviews,
            },
          ],
          xaxis: {
            categories: ngay,
          },
        });
      },
    });
  }

  let SU = "#reportrange";
  function cb(start, end) {
    $(SU + " span").html(
      start.format("DD-MM-YYYY") + " - " + end.format("DD-MM-YYYY")
    );
    showChartSU(
      start.format("YYYY-MM-DD"),
      end.format("YYYY-MM-DD"),
      "/dashboard/getDaterangeSU"
    );
  }
  function getDaterangeSU(element, ranges) {
    let start = moment().subtract(6, "days").locale("vi");
    let end = moment().locale("vi");
    // ranges = { Today: [moment(), moment()], ...ranges };
    getDaterange(start, end, ranges, element, cb);
  }
  getDaterangeSU(SU, ranges);
  // ==============================

  function chartRadialGG(el, color) {
    var options = {
      noData: {
        text: "Loading...",
      },
      series: [],
      chart: {
        height: 220,
        type: "radialBar",
      },
      plotOptions: {
        radialBar: {
          hollow: {
            size: "70%",
          },
          dataLabels: {
            showOn: "always",
            name: {
              offsetY: -5,
              show: true,
              color: "#888",
              fontSize: "16px",
            },
            value: {
              color: color,
              fontSize: "20px",
              show: true,
            },
          },
        },
      },

      fill: {
        colors: [color],
      },
      labels: [],
    };
    let chart = new ApexCharts(document.querySelector(el), options);
    chart.render();
    return chart;
  }
  let percentOldSessions = chartRadialGG("#percentNewSessions", "#ffc107");
  let percentNewSessions = chartRadialGG("#percentOldSessions", "#2196f3");
  let bounceRate = chartRadialGG("#bounceRate", "#f44336");
  function showChartGG(startDate, endDate, action) {
    $.ajax({
      url: ADMIN_URL + action,
      type: "POST",
      dataType: "JSON",
      data: {
        startDate,
        endDate,
      },
      success: (data) => {
        const secs = data.metrics["ga:avgSessionDuration"][0];
        const formatted = moment.utc(secs * 1000).format("HH:mm:ss");
        $("#avgSessionDuration").html(formatted);
        $("#users").html(data.metrics["ga:users"][0]);
        $("#sessions").html(data.metrics["ga:Sessions"][0]);
        $("#pageviewsPerSession").html(
          parseFloat(data.metrics["ga:pageviewsPerSession"][0]).toFixed(2)
        );
        $("#Pageviews").html(data.metrics["ga:Pageviews"][0]);
        percentOldSessions.updateOptions({
          series: [
            parseFloat(data.metrics["ga:percentNewSessions"][0]).toFixed(2),
          ],
          labels: ["Phiên mới"],
        });
        percentNewSessions.updateOptions({
          series: [
            parseFloat(100 - data.metrics["ga:percentNewSessions"][0]).toFixed(
              2
            ),
          ],
          labels: ["Phiên cũ"],
        });
        bounceRate.updateOptions({
          series: [parseFloat(data.metrics["ga:bounceRate"][0]).toFixed(2)],
          labels: ["Tỷ lệ thoát"],
        });
      },
    });
  }
  let GG = "#reportrange2";
  function cbGG(start, end) {
    $(GG + " span").html(
      start.format("DD-MM-YYYY") + " - " + end.format("DD-MM-YYYY")
    );
    showChartGG(
      start.format("YYYY-MM-DD"),
      end.format("YYYY-MM-DD"),
      "/dashboard/get"
    );
  }
  function getGG(element, ranges) {
    let start = moment().locale("vi");
    let end = moment().locale("vi");
    ranges = { Today: [moment(), moment()], ...ranges };
    getDaterange(start, end, ranges, element, cbGG);
  }
  getGG(GG, ranges);

  //==============================

  function listPageView(startDate, endDate, action) {
    $.ajax({
      url: ADMIN_URL + action,
      type: "POST",
      dataType: "JSON",
      data: {
        startDate,
        endDate,
      },
      success: (data) => {
        let list = ``;
        let datal =
          data.dimensions["ga:pagepath"].length < 10
            ? data.dimensions["ga:pagepath"].length
            : 10;
        for (let i = 0; i < datal; i++) {
          let pagepath = data.dimensions["ga:pagepath"][i];
          let sessions = data.metrics["ga:sessions"][i];
          let bounceRate = data.metrics["ga:bounceRate"][i];
          let Pageviews = data.metrics["ga:Pageviews"][i];
          let uniquePageviews = data.metrics["ga:uniquePageviews"][i];
          let avgTimeOnPage = data.metrics["ga:avgTimeOnPage"][i];
          let exitRate = data.metrics["ga:exitRate"][i];
          const secs = avgTimeOnPage;
          const formatted = moment.utc(secs * 1000).format("HH:mm:ss");
          list += `
            <tr>
              <td>${pagepath}</td>
              <td>${Pageviews}</td>
              <td>${uniquePageviews}</td>
              <td>${formatted}</td>
              <td>${sessions}</td>
              <td>${parseFloat(bounceRate).toFixed(2)}</td>
              <td class="text-right">${parseFloat(exitRate).toFixed(2)} </td>
            </tr>`;
        }
        $("#pageview").html(list);
      },
    });
  }
  function cbPageView(start, end) {
    $("#reportrange3 span").html(
      start.format("DD-MM-YYYY") + " - " + end.format("DD-MM-YYYY")
    );
    listPageView(
      start.format("YYYY-MM-DD"),
      end.format("YYYY-MM-DD"),
      "/dashboard/listPageView"
    );
  }
  function getDatePageView(element, ranges) {
    let start = moment().locale("vi");
    let end = moment().locale("vi");
    ranges = { Today: [moment(), moment()], ...ranges };
    getDaterange(start, end, ranges, element, cbPageView);
  }
  getDatePageView("#reportrange3", ranges);

  //=======================

  function chartDeviceCategory(el) {
    let options = {
      noData: {
        text: "Loading...",
      },
      series: [],
      chart: {
        type: "bar",
        height: 350,
        stacked: true,
        stackType: "100%",
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            legend: {
              position: "bottom",
              offsetX: -10,
              offsetY: 0,
            },
          },
        },
      ],
      xaxis: {
        categories: [],
      },
      fill: {
        opacity: 1,
      },
    };

    let chart = new ApexCharts(document.querySelector(el), options);
    chart.render();
    return chart;
  }
  let DeviceCategory = chartDeviceCategory("#device_category");
  function showChartDC(startDate, endDate, action) {
    $.ajax({
      url: ADMIN_URL + action,
      type: "POST",
      dataType: "JSON",
      data: {
        startDate,
        endDate,
      },
      success: (data) => {
        let date = uniq(data.dimensions["ga:date"]);
        let ngay = date.map((e) => moment(e, "YYYYMMDD").format("MMM D"));
        let device = uniq(data.dimensions["ga:DeviceCategory"]);
        let series = device.reduce(function (acc, obj, key) {
          if (!acc[obj]) {
            acc[key] = {
              name: obj,
              data: date.map((e) => 0),
            };
          }
          return acc;
        }, []);
        let dates = data.dimensions["ga:date"];
        let devices = data.dimensions["ga:DeviceCategory"];
        for (let i = 0; i < dates.length; i++) {
          let key = date.indexOf(dates[i]);
          let keyy = device.indexOf(devices[i]);
          series[keyy].data[key] = Number(data.metrics["ga:users"][i]);
        }
        DeviceCategory.updateOptions({
          series: series,
          xaxis: {
            categories: ngay,
          },
        });
      },
    });
  }
  let DC = "#reportrange4";
  function cbDC(start, end) {
    $(DC + " span").html(
      start.format("DD-MM-YYYY") + " - " + end.format("DD-MM-YYYY")
    );
    showChartDC(
      start.format("YYYY-MM-DD"),
      end.format("YYYY-MM-DD"),
      "/dashboard/DeviceCategory"
    );
  }
  function getDC(element, ranges) {
    let start = moment().subtract(6, "days").locale("vi");
    let end = moment().locale("vi");
    getDaterange(start, end, ranges, element, cbDC);
  }
  getDC(DC, ranges);
});
