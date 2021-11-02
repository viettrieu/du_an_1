<div class="page-wrapper">
  <div class="content container-fluid">
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Sản phẩm</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Đánh giá</li>
          </ul>
        </div>
        <div class="col-auto">
          <a href="#" class="btn btn-primary mr-1">
            <i class="fas fa-plus"></i>
            Tạo đánh giá mới
          </a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="card card-table">
          <div class="card-body">

            <div class="table-responsive" id="reviews_list">
              <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Đánh giá</th>
                    <th>Nội dung</th>
                    <th>Sản phẩm</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th class="text-right">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT review.id, avatar, review.fullName, rating , review.content, title , DATE_FORMAT(review.published, '%e/%c/%Y') AS 'published', status FROM ps_product_review review LEFT JOIN ps_users ON userId  = ps_users.id INNER JOIN ps_product ON productId = ps_product.id";
                  $member = $conn->query($query);
                  while ($row = $member->fetch_assoc()) {
                  ?>
                  <tr>
                    <td class="id"><?php echo $row['id']; ?></td>
                    <td>
                      <h2 class="table-avatar">
                        <a href="./index.php?action=chi-tiet-don-hang&id=<?php echo $row['id']; ?>"
                          class="avatar avatar-sm mr-2">
                          <img class="avatar-img rounded-circle"
                            src=".<?php echo $row['avatar'] == null ? './assets/img/avatar-default.png' : $row['avatar']; ?>"
                            alt="User Image" />
                        </a>
                        <a href="./index.php?action=chi-tiet-don-hang&id=<?php echo $row['id']; ?>">
                          <?php echo $row['fullName'] == null ? $row['username'] : $row['fullName']; ?>
                        </a>
                      </h2>
                    </td>
                    <td>
                      <div class="star-ratings-css">
                        <div class="star-ratings-inner" style="width: <?= $row['rating'] * 20; ?>%"></div>
                      </div>
                    </td>
                    <td><?php echo $row['content']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['published']; ?></td>
                    <td>
                      <span class="badge badge-pill bg-<?= $row['status'] == 1 ? 'success' : 'warning'; ?>-light">
                        <?= $row['status'] == 1 ? 'Đã duyệt' : 'Chờ phê duyệt'; ?>
                    </td>
                    <td class="text-right">
                      <?php if ($row['status'] == 0) : ?>
                      <a href="./index.php?action=chi-tiet-don-hang&id=<?php echo $row['id']; ?>"
                        class="btn btn-sm btn-white text-primary mr-2 accept"><i
                          class="fas fa-check-circle mr-1"></i>Duyệt</a>
                      <?php endif ?>
                      <!-- <a href="edit-expenses.html" class="btn btn-sm btn-white text-success mr-2"><i
                          class="far fa-edit mr-1"></i> Edit</a> -->
                      <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger delete"><i
                          class="far fa-trash-alt mr-1"></i>Xóa</a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>