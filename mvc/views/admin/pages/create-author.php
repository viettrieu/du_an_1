<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Tác giả</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Tạo Tác giả</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <form method="POST" id="create_author" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                                <label>Tên Tác giả:</label>
                                <input type="text" class="form-control" id="title" required name="title">
                                <div class=" invalid-feedback">Vui lòng nhập tên Tác giả.
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Trích dẫn:</label>
                                <div id="summary"></div>
                                <input type="hidden" name="quote">
                            </div>
                            <div class="form-group">
                                <label>Mô tả :</label>
                                <div id="content"></div>
                                <input type="hidden" name="content">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Facebook:</label>
                                <input type="text" class="form-control" id="fblink" required name="fblink">
                            </div>
                            <div class="form-group">
                                <label>Youtube:</label>
                                <input type="text" class="form-control" id="youtubelink" required name="youtubelink">
                            </div>
                            <div class="form-group">
                                <label>Twitter:</label>
                                <input type="text" class="form-control" id="twitterlink" required name="twitterlink">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Ảnh Tác giả</label>
                                <div class="thumbnail-upload">
                                    <div class="thumbnail-edit">
                                        <input type="file" id="thumbnail" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <label for="thumbnail"><i class="fas fa-pencil-alt"></i></label>
                                    </div>
                                    <div class="thumbnail-preview">
                                        <div id="thumbnailPreview"
                                            style="background-image: url(<?= SITE_URL ?>/public/img/default-product-image.png)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="create_author" class="btn btn-block btn-primary btn-lg">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>