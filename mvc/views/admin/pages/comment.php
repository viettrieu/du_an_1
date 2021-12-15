<div class="page-wrapper">
  <div class="content container-fluid">
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Bài viết</h3>
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

            <div class="table-responsive" id="comment_list">
              <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Người dùng</th>
                    <th>Trả lời</th>
                    <th>Nội dung</th>
                    <th>Bài viết</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th class="text-right">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ListComment = $data["ListComment"];
                  if (isset($ListComment)) {
                    foreach ($ListComment as $comment) { ?>
                  <tr>
                    <td class="id"><?= $comment['id']; ?></td>
                    <td>
                      <h2 class="table-avatar">
                        <a href="./index.php?action=chi-tiet-don-hang&id=<?= $comment['id']; ?>"
                          class="avatar avatar-sm mr-2">
                          <img class="avatar-img rounded-circle" src="<?= $comment['avatar'] ?>" alt="User Image" />
                        </a>
                        <a href="./index.php?action=chi-tiet-don-hang&id=">
                          <?= $comment['fullName'] ? $comment['fullName'] : $comment['username'] ?>
                        </a>
                      </h2>
                    </td>
                    <td><?= $comment['parent_id'] == 0 ? "" : $comment['parent_id']; ?></td>
                    <td><?= $comment['content']; ?></td>
                    <td><?= $comment['title']; ?></td>
                    <td><?= $comment['published']; ?></td>
                    <td class="status">
                      <span class="badge-pill bg-<?= $comment['status'] == 1 ? 'success' : 'warning'; ?>-light">
                        <?= $comment['status'] == 1 ? 'Đã duyệt' : 'Chờ phê duyệt'; ?>
                    </td>
                    <td class="text-right">
                      <?php if ($comment['status'] == 0) : ?>
                      <a href="javascript:void(0);" class="btn btn-sm btn-white text-primary mr-2 accept"><i
                          class="fas fa-check-circle mr-1"></i>Duyệt</a>
                      <?php endif ?>
                      <!-- <a href="edit-expenses.html" class="btn btn-sm btn-white text-success mr-2"><i
                          class="far fa-edit mr-1"></i> Edit</a> -->
                      <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger delete"><i
                          class="far fa-trash-alt mr-1"></i>Xóa</a>
                    </td>
                  </tr>
                  <?php }
                  } ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>