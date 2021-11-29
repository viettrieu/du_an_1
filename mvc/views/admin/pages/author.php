<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Tác giả</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Danh sách Tác giả</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="<?= ADMIN_URL; ?>/product/create" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Thêm Tác giả
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
                        <div class="table-responsive" id="product_list">
                            <table class="table table-center table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>SKU</th>
                                        <th>Kho</th>
                                        <th>Giá</th>
                                        <th>Ngày tạo</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ListAuthor = $data["ListAuthor"];
                                    if (isset($ListAuthor)) {
                                        foreach ($ListAuthor as $product) { ?>
                                            <tr>
                                                <td class="id"><?= $product['id']; ?></td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="<?= SITE_URL ?>/store/product/<?= $product['id']; ?>"><img class="avatar avatar-lg mr-2 avatar-img rounded" src="<?= SITE_URL ?><?= $product['thumbnail'] == null ? '/public/img/default-product-image.png' : $product['thumbnail']; ?>" alt="<?= $product['title']; ?>">
                                                            <span class="title"><?= $product['title']; ?></span>
                                                        </a>
                                                    </h2>
                                                </td>
                                                <td><?= $product['sku']; ?></td>
                                                <td>
                                                    <span class="badge badge-pill bg-<?= $product['quantity'] == null || $product['quantity']  > 10 ? 'success' : ($product['quantity'] == 0 ? 'danger' : 'warning'); ?>-light">
                                                        <?= $product['quantity'] == null || $product['quantity']  > 10 ? 'Còn hàng' : ($product['quantity'] == 0 ? 'Hết hàng' : 'Sắp hết'); ?>
                                                    </span>
                                                </td>
                                                <td><?= number_format($product['price'], 0, ',', '.'); ?><sup>đ</sup></td>
                                                <td><?= $product['published']; ?></td>
                                                <td class="text-right">
                                                    <a href="<?= ADMIN_URL ?>/product/edit/<?= $product['id']; ?>" class="btn btn-sm btn-white text-success mr-2"><i class="far fa-edit mr-1"></i>Sửa</a>
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