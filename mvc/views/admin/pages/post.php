<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Sản phẩm</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Danh sách sản phẩm</li>
          </ul>
        </div>
        <div class="col-auto">
          <a href="<?= ADMIN_URL; ?>/post/create" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tạo bài viết
          </a>
        </div>
      </div>
    </div>
    <!-- /Page Header -->

    <!-- Search Filter -->

    <!-- /Search Filter -->

    <div class="row">
      <div class="col-sm-12">
        <div class="card card-table">
          <div class="card-body">
            <div class="table-responsive" id="post_list">
              <table class="table table-center table-hover datatable">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Tác giả</th>
                    <th>Ngày tạo</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $listPost = $data["ListPost"];
                  if (isset($listPost)) {
                    foreach ($listPost as $post) { ?>
                  <tr>
                    <td class="id"><?= $post['id']; ?></td>
                    <td>
                      <h2 class="table-avatar">
                        <a href="<?= SITE_URL ?>/news/post/<?= $post['id']; ?>"><img
                            class="avatar avatar-lg mr-2 avatar-img rounded"
                            src="<?= SITE_URL ?><?= $post['thumbnail'] == null ? '/public/img/default-product-image.png' : $post['thumbnail']; ?>"
                            alt="<?= $post['title']; ?>">
                          <span class="title"><?= $post['title']; ?></span>
                        </a>
                      </h2>
                    </td>
                    <td>Tác giả</td>
                    <td><?= $post['published'] ?></td>
                    <td class="text-right">
                      <a href="<?= ADMIN_URL ?>/post/edit/<?= $post['id']; ?>"
                        class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i>Sửa</a>
                      <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger delete"><i
                          class="far fa-trash-alt mr-1"></i>Xóa</a>
                    </td>
                  </tr>
                  <?php }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>