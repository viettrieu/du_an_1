<!DOCTYPE html>
<html lang="vi">
<head>
	<?php include_once 'layout/layout.meta' ?>
</head>
<body style="background-color: #ffffff">

<?php
	session_start();
	$conn = new PDO('mysql:host=ps17048.com:3366;dbname=web2013_asm;charset=utf8', 'root', '');

	if(isset($_SESSION['user'])){
		header('location: taikhoan.php');
	}else if(isset($_POST['submit'])){
		$sql = "select * from user where user_email='".$_POST['email']."'";
		$checkEmail = $conn->query($sql)->fetch();
		$sql = "select * from user where user_phone='".$_POST['phone']."'";
		$checkPhone = $conn->query($sql)->fetch();
		if($checkEmail){
			echo '<script>swal({title: "Lỗi!",text: "Email đã được đăng ký, hãy sử dụng email khác!",icon: "error",button: "ok",});</script>';
		}else if($checkPhone){
			echo '<script>
					swal({
						title: "Lỗi!",
						text: "Số điện thoại đã được đăng ký, hãy sử dụng số điện thoại khác!",
						icon: "error",
						button: "ok",
					});
				</script>';
		}else{
			$sql = "INSERT INTO USER(user_email, user_password, user_fullname, user_birthday, user_phone, user_address)
			VALUES('".$_POST['email']."','".$_POST['password']."','".$_POST['fullname']."','".$_POST['birthday']."','".$_POST['phone']."','".$_POST['address']."');
			";
			$result = $conn->exec($sql);

			if($result){
				echo '<script>
						swal({
							title: "Thành công!",
							text: "Bạn đã đăng ký thành công, hãy đăng nhập!",
							icon: "success",
							button: "ok",
						}).then((value) => {window.location.href = "dangnhap.php";});
					</script>';
			}else{
				echo '<script>
						swal({
							title: "Lỗi!",
							text: "Đã có lỗi trong khi đăng ký!",
							icon: "error",
							button: "ok",
						});
					</script>';
			}
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
				<h4>Đăng Ký</h4>
			</div>
			<div class="row">
				<div class="col-12">
					<form action="" method="POST">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="email"><strong>Email:</strong></label>
									<input type="text" placeholder="Email" class="form-control" name="email" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="password"><strong>Mật khẩu:</strong></label>
									<input type="password" placeholder="Mật khẩu" class="form-control" name="password" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="ho"><strong>Họ và tên:</strong></label>
									<input type="text" placeholder="Họ và tên" class="form-control" name="fullname" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="ten"><strong>Ngày sinh: </strong></label>
									<input type="date" class="form-control" name="birthday" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="ho"><strong>Số điện thoại:</strong></label>
									<input type="text" placeholder="Số điện thoại" class="form-control" name="phone" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="ten"><strong>Địa chỉ: </strong></label>
									<input type="text" placeholder="Địa chỉ" class="form-control" name="address" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" name="submit" class="btn-primary px-4 py-2" style="margin-top: 20px;">Đăng ký</button>
						</div>
					</form>
				</div>
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