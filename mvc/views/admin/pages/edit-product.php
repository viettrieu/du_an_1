<?php
$product = $data["Product"];
?>

<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Sản phẩm</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Tạo sản phẩm</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <form method="POST" id="edit_product" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <?php foreach ($data["Errors"] as $error) :
                                $class = $error["status"] == "ERROR" ? "alert-danger" : "alert-success";
                            ?>
                            <div class="alert <?= $class ?> alert-dismissible fade show" role="alert">
                                <?= $error["message"] ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <?php endforeach ?>
                            <div class="form-group ">
                                <label>Tên sản phẩm:</label>
                                <input type="text" class="form-control" id="title" required name="title"
                                    value="<?= $product['title']; ?>">
                                <div class=" invalid-feedback">Vui lòng nhập tên sản phẩm.
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả chi tiết:</label>
                                <div id="content"><?= $product['content']; ?></div>
                                <input type="hidden" name="content">
                            </div>
                            <div class="form-group">
                                <label>Mô tả ngắn:</label>
                                <div id="summary"><?= $product['summary']; ?></div>
                                <input type="hidden" name="summary">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Danh mục sản phẩm:</label>
                                <select name="category" class="select custom-select" required>
                                    <option value="" selected>Chọn danh mục sản phẩm</option>
                                    <?php foreach ($data["ListCategory"] as $category) : ?>
                                    <option value="<?= $category['id'] ?>"
                                        <?= in_array($category['title'], $data["Categorys"]) ? 'selected' : '' ?>>
                                        <?= $category['title'] ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Từ khóa sản phẩm:</label>
                                <select name="tag[]" class="select2tag" multiple="multiple">
                                    <?php foreach ($data["ListTag"] as $tag) : ?>
                                    <option value="<?php echo $tag['id']; ?>"
                                        <?= in_array($tag['title'], $data["Tags"]) ? 'selected' : '' ?>>
                                        <?php echo $tag['title']; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>NXB sản phẩm:</label>
                                <select name="publisher" class="select custom-select">
                                    <?php foreach ($data["ListPublisher"] as $publisher) : ?>
                                    <option value="<?php echo $publisher['id']; ?>"
                                        <?= $product['publisherId'] == $publisher['id'] ? 'selected' : '' ?>>
                                        <?php echo $publisher['title']; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tác giả:</label>
                                <select name="author[]" class="select2tag" multiple="multiple">
                                    <?php foreach ($data["ListAuthor"] as $author) : ?>
                                    <option value="<?php echo $author['id']; ?>"
                                        <?= in_array($author['title'], $data["Author"]) ? 'selected' : '' ?>>
                                        <?php echo $author['title']; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Giá bán thường:</label>
                                <div class="input-group ">
                                    <input type="number" class="form-control" id="price" required name="price"
                                        value="<?= $product['price']; ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text">VNĐ</span>
                                    </div>
                                    <div class="invalid-feedback">Vui lòng nhập giá bán sản phẩm.</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Giá khuyến mãi:</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="discount" name="discount"
                                        value="<?= $product['discount']; ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text">VNĐ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <div class="thumbnail-upload">
                                    <div class="thumbnail-edit">
                                        <input type="file" id="thumbnail" name="thumbnail" accept=".png, .jpg, .jpeg" />
                                        <label for="thumbnail"><i class="fas fa-pencil-alt"></i></label>
                                    </div>
                                    <div class="thumbnail-preview">
                                        <div id="thumbnailPreview"
                                            style="background-image: url(<?= SITE_URL ?><?= $product['thumbnail'] ? $product['thumbnail'] : "/public/img/default-product-image.png"; ?>)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary btn-lg" name="edit_product">Đăng sản
                        phẩm</button>
                </div>
            </div>
        </form>
    </div>
</div>