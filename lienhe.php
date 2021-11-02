<!DOCTYPE html>
<html lang="vi">
<head>
	<?php include_once 'layout/layout.meta' ?>
</head>
<body style="background-color: #ffffff">
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
					<span>Giới thiệu</span>
				</li>
			</ul>
		</div>
	</section>
	<section class="hn-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="hn-page-title">
						<h4>Liên hệ</h4>
					</div>
					<div class="contact-box">
						<h2>LGshop</h2>
						<p><i class="fas fa-map-marker-alt"></i>
							<span>5M62 , Ấp 5 , Xã Phạm Văn Hai , TP Hồ Chí Minh , Việt Nam</span>
						</p>
						<p>
							<i class="fas fa-mobile-alt"></i>
							<span><a href="">0932643306</a></span>
						</p>
						<p>
							<i class="fas fa-envelope"></i>
							<span><a href="">talon1gb@gmail.com</a></span>
						</p>
					</div>
					<div class="contact-form">
						<form>
							<div class="form-group">
								<label>Gửi tin nhắn cho chúng tôi</label>
								<input type="name" class="form-control" type="text" placeholder="Họ và tên">
								<input type="email" class="form-control" type="text"  placeholder="Email">
								<input type="phone" class="form-control" type="text"  placeholder="Số điện thoại">
								<textarea class="form-control" rows="5" type="text"  placeholder="Nhập nội dung"></textarea>
								<button type="submit" class="btn btn-primary">Gửi liên hệ</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-7">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7849.546677299947!2d106.36!3d10.360000000000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1557155736666!5m2!1svi!2s" frameborder="0" style="border:0; width: 100%; height: 100%;" allowfullscreen></iframe>
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