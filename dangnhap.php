<!DOCTYPE html>
<html lang="vi">
<head>
	<?php include_once 'layout/layout.meta' ?>
</head>
<body style="background-color: #ffffff">
<?php
	session_start();
	$conn = new PDO('mysql:host=ps17048.com:3366;dbname=web2013_asm;charset=utf8;charset=utf8', 'root', '');
	if(isset($_SESSION['user'])){
		header('location: taikhoan.php');
	}else if(isset($_POST['login'])){
		$conn = new PDO('mysql:host=ps17048.com:3366;dbname=web2013_asm;charset=utf8;charset=utf8', 'root', '');

		$sql = "select * from user where user_email='".$_POST['email']."' and user_password='".$_POST['password']."'";

		$result = $conn->query($sql)->fetch();

		if($result){
			if (session_status() == PHP_SESSION_NONE) {
			}
			unset($_SESSION['user']);
			$_SESSION['user'] = ['id' => $result['user_id']];
			echo '<script>
					swal({
						title: "Thành công!",
						text: "Đăng nhập thành công!",
						icon: "success",
						button: "ok",
					}).then((value) => {window.location.href = "taikhoan.php";});
				</script>';
		}else{
			echo '<script>
					swal({
						title: "Lỗi!",
						text: "Hãy kiểm tra lại tài khoản hoặc mật khẩu!",
						icon: "error",
						button: "ok",
					});
				</script>';
		}
	}
?>
	<!-- HEADER -->
	<?php include_once 'layout/layout-header.php' ?>
	<!-- END HEADER -->

	<!------------------------------------------>

	<section class="breadcrumbs">
		<div class="container">
			<ul>
				<li>
					<a href="index.php">Trang chủ</a>
					<i class="fas fa-chevron-right"></i>
				</li>
				<li>
					<span>Đăng nhập</span>
				</li>
			</ul>
		</div>
	</section>
	<section class="hn-page">
		<div class="container">
			<div class="hn-page-title">
				<h4>Đăng nhập</h4>
			</div>
			<div class="row">
				<div class="col-12 col-lg-6">
					<form action="" method="POST">
						<span>Nếu bạn đã có tài khoản, đăng nhập tại đây</span>
						<div class="form-group">
							<label for="username"><strong>Email đăng nhập:</strong></label>
							<input type="text" placeholder="Email đăng nhập" class="form-control" name="email" required>
						</div>
						<div class="form-group">
							<label for="password"><strong>Mật khẩu:</strong></label>
							<input type="password" placeholder="Mật khẩu" class="form-control" name="password" required>
						</div>
						<div class="form-group" style="margin-bottom: 20px;">
							<button type="submit" name="login" class="btn-primary px-4 py-2 mt-3 mr-2">Đăng nhập</button>
							<a href="dangky.php">Đăng ký</a>
						</div>
					</form>
				</div>
				<!-- <div class="col-12 col-lg-6">
					<form action="">
						<div class="form-group">
							<span>Bạn quên mật khẩu? Nhập địa chỉ email để lấy lại mật khẩu qua email.</span>
							<label for="email"><strong>Email:</strong></label>
							<input type="text" placeholder="Email" class="form-control" id="email">
						</div>
						<div class="form-group">
							<button class="btn-primary px-4 py-2" style="margin-top: 30px;">Lấy lại mật khẩu</button>
						</div>
					</form>
				</div> -->
			</div>
		</div>
	</section>


	<!------------------------------------------>

	<!-- MAP -->
	<?php include_once 'layout/layout.map' ?>
	<!-- END MAP -->

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
<script src="js/jquery-3.4.0.slim.min.js"></script>
<!-- jquery -->
<script src="js/jquery-3.4.0.min.js"></script>
<!-- fancybox script -->
<script src="js/jquery.fancybox.min.js"></script>
<!-- popper js -->
<script src="js/popper.min.js"></script>
<!-- bootstrap.min.js -->
<script src="js/bootstrap_js/bootstrap.min.js"></script>

<!-- owlcarousel -->
<script src="owlcarousel/owl.carousel.min.js"></script>


<script>
	//carousel script
	$(".partner-carousel").owlCarousel({loop:!1,margin:10,responsiveClass:!0,responsive:{0:{items:1,nav:!1},360:{items:2,nav:!1},760:{items:3,nav:!0},1000:{items:5,nav:!0},1200:{items:6,nav:!0,loop:!1}}}),$(".news-carousel").owlCarousel({loop:!1,margin:10,responsiveClass:!0,responsive:{0:{items:1,nav:!1},480:{items:2,nav:!0},768:{items:3,nav:!0},1024:{items:4,nav:!0,loop:!1}}}),$("#hn-review-carousel").owlCarousel({autoplay:!0,autoplayTimeout:5e3,loop:!0,margin:0,items:1}),$(".owl-carousel").owlCarousel({loop:!1,margin:10,responsiveClass:!0,responsive:{0:{items:2,nav:!1},480:{items:3,nav:!0},768:{items:4,nav:!0},1024:{items:4,nav:!0,loop:!1}}});

	// dropdown script
	$('.dropdown-toggle').dropdown({
		flip:false
	})
	$(document).ready(function(){
		$('.dropdown a.drop').on("click", function(e){
			$(this).next('ul').toggle();
			e.stopPropagation();
			e.preventDefault();
		});
	});
</script>	
</html>