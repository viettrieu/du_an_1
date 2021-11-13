<div class="page-wrapper">
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Tác Giả</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item active">Danh sách tác giả</li>
          </ul>
        </div>
        <div class="col-auto">
          <a href="<?= ADMIN_URL; ?>/product/create" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Thêm Tác Giả
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
            <div class="table-responsive" id="author_list">
              <table class="table table-center table-hover datatable">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Tên Tác Giả</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $listAuthor = $data["ListAuthor"];
                  if (isset($listAuthor)) {
                    foreach ($listAuthor as $author) { ?>
                      <tr>
                        <td class="id"><?= $author['id']; ?></td>
                        <td>
                          <h2 class="table-avatar">
                            <a href="<?= SITE_URL ?>/store/product/<?= $author['id']; ?>"><img class="avatar avatar-lg mr-2 avatar-img rounded" src="<?= SITE_URL ?><?= $author['thumbnail'] == null ? '/public/img/default-product-image.png' : $author['thumbnail']; ?>" alt="<?= $author['title']; ?>">
                              <span class="title"><?= $author['title']; ?></span>
                            </a>
                          </h2>
                        </td>
                        <td class="text-right">
                          <a href="<?= ADMIN_URL ?>/author/edit/<?= $author['id']; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i>Sửa</a>
                          <a href="javascript:void(0);" class="btn btn-sm btn-white text-danger delete"><i class="far fa-trash-alt mr-1"></i>Xóa</a>
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