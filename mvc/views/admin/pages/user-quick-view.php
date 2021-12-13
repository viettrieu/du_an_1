<?php
$user = $data["User"];
?>
<div class="card bg-white">
  <div class="card-header">
    <h5 class="card-title">Thông tin người dùng <em>#<?= $user['id'] ?></em></h5>
  </div>
  <div class="card-body">
    <ul class="nav nav-tabs nav-tabs-solid nav-justified">
      <li class="nav-item"><a class="nav-link active" href="#solid-justified-tab1" data-toggle="tab">Thông tin</a></li>
      <li class="nav-item"><a class="nav-link" href="#solid-justified-tab2" data-toggle="tab">Thống kê đơn hàng</a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane show active" id="solid-justified-tab1">
        <div class="row">
          <div class="col-lg-6 text-center border-right">
            <div class="avatar avatar-xxl">
              <img class="avatar-img rounded-circle" alt="User Image" src="<?= $user['avatar'] ?>">
            </div>
            <h3 class="text-warning"><?= $user['username'] ?></h3>
            <strong>(<?= $user['admin'] == 1 ? "Quản lý" : "Khách hàng" ?>)</strong>
          </div>
          <div class="col-lg-6">
            <p><strong>Họ và tên:</strong> <?= $user['fullName'] ?></p>
            <p><strong>Số điện thoại:</strong> <?= $user['mobile'] ?></p>
            <p><strong>Email:</strong> <?= $user['email'] ?></p>
            <p><strong>Giới tính:</strong><?= $user['gender'] == 0 ? "Nam" : "Nữ" ?></p>
          </div>
        </div>
        <div class="row border-top pt-3 mt-3">
          <div class="col-xl-4 col-sm-4 col-12">
            <div class="dash-widget-header">
              <span class="dash-widget-icon bg-1">
                <i class="fas fa-star"></i>
              </span>
              <div class="dash-count">
                <div class="dash-title">Đánh giá</div>
                <div class="dash-counts">
                  <p><?= $data["Count"][0] ?></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-sm-4 col-12">
            <div class="dash-widget-header">
              <span class="dash-widget-icon bg-4">
                <i class="fas fa-heart"></i>
              </span>
              <div class="dash-count">
                <div class="dash-title">Sách yêu thích</div>
                <div class="dash-counts">
                  <p><?= $data["Count"][2] ?></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-sm-4 col-12">
            <div class="dash-widget-header">
              <span class="dash-widget-icon bg-3">
                <i class="fas fa-file-alt"></i>
              </span>
              <div class="dash-count">
                <div class="dash-title">Đơn hàng</div>
                <div class="dash-counts">
                  <p><?= $data["Count"][2] ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="solid-justified-tab2">
        <div id="invoice_chart"></div>
        <div class=" row" id="invoice_statistic"></div>
      </div>
    </div>
  </div>
</div>
<script>
var url = ADMIN_URL + "/user/statistical/<?= $user['id'] ?>";
$.getJSON(url, buildChart);

function buildChart(data) {
  var pieCtx = document.getElementById("invoice_chart");
  if (data == false) {
    pieCtx.innerHTML = "Chưa có đơn hàng";
    return false;
  }
  let colors = [
    "#283447",
    "#f39c12",
    "#2196f3",
    "#c580ff",
    "#26af48",
    "#e63c3c",
  ];
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
          <p class="mb-1 text-truncate"><i class="fas fa-circle mr-1" style=" color: ${color[x]}; "></i> ${data[0][x]}</p>
          <h6> ${total}</h6>
        </div>
      </div>`);
  }
  // console.log(colors);
  var pieConfig = {
    colors: color,
    series: data[1],
    tooltip: {
      custom: function({
        series,
        seriesIndex,
        dataPointIndex,
        w
      }) {
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
      position: "bottom",
      horizontalAlign: "center",
    },
    chart: {
      fontFamily: "Poppins, sans-serif",
      height: 350,
      type: "pie",
    },
    labels: data[0],
    responsive: [{
      breakpoint: 576,
      options: {
        legend: {
          show: true,
          position: "bottom",
        },
      },
    }, ],
  };
  var pieChart = new ApexCharts(pieCtx, pieConfig);
  pieChart.render();
}
</script>