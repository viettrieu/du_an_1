<!DOCTYPE html>
<html lang="vi">

<head>
    <?php include_once 'layout/layout.meta' ?>
</head>

<body>
    <?php
    
    session_start();
    if(isset($_GET['logout'])){
        unset($_SESSION['user']);
    }
    if ($_SESSION['user']) {
        $id = $_SESSION['user']['id'];
        $conn = new PDO('mysql:host=ps17048.com:3366;dbname=web2013_asm;charset=utf8;charset=utf8', 'root', '');
        
        $sql = "select * from user where user_id='".$id."'";

        $result = $conn->query($sql)->fetch();
    }else{
        header('location: index.php');
    }
    ?>
    <!-- HEADER -->
    <?php include_once 'layout/layout-header.php' ?>
    <!-- END HEADER -->

    <!------------------------------------------>

    <section class="hn-section-4">
        <div class="container">
            <div class="row">
                <div class="col-12 py-5">
                    <div class="card">
                        <div class="card-header">
                            <span class="h5">Xin chào <u><?php echo $result['user_fullname'] ?></u>!</span>
                        </div>
                        <div class="card-body">
                            <!-- <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                            <a href="taikhoan.php?logout" class="btn btn-primary">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!------------------------------------------>

    <!-- FOLLOW -->
    <?php include_once 'layout/layout.follow' ?>
    <!-- END FOLLOW -->

    <!------------------------------------------>

    <!-- FOOTER -->
    <?php include_once 'layout/layout.footer' ?>
    <!-- END FOOTER -->

    <!------------------------------------------>

    <!-- COPYRIGHT -->
    <?php include_once 'layout/layout.copyright' ?>
    <!-- END COPYRIGHT -->

    <!------------------------------------------>

</body>

<!-- jquery.slim.min.js -->
<script src=" js/jquery-3.4.0.slim.min.js"> </script> <!-- jquery -->
<script src="js/jquery-3.4.0.min.js"></script>
<!-- fancybox script -->
<script src="js/jquery.fancybox.min.js"></script>
<!-- popper js -->
<script src="js/popper.min.js"></script>
<!-- bootstrap.min.js -->
<script src="js/bootstrap_js/bootstrap.min.js"></script>

<!-- owlcarousel -->
<script src="owlcarousel/owl.carousel.min.js"></script>


</html>