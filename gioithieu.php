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
				<div class="col-lg-3">
					
				</div>
				<div class="col-lg-9">
					<div class="hn-page-title">
						<h4>Giới thiệu</h4>
					</div>
					<div class="hn-page-content">
							<h4>"Luôn đem đến Cho bạn sự tiện dụng nhất"</h4>
							<p>Là phương châm hoạt động của LoGo - đến với chúng tôi, bạn sẽ cảm thấy thật sự hài lòng khi được phục vụ bởi đội ngũ Nhân Viên Chuyên Nghiệp tư vấn đầy đủ mọi mặt hàng điện tử ...</p>
							<p><img src="//bizweb.dktcdn.net/100/103/391/files/khach1.jpg?v=1468477415312"></p>
							<p>Ngoài ra Logo&nbsp;còn đảm nhận tư vấn tận tâm &amp; đưa đầ đủ thông tin, mặt hàng với sự giúp đỡ của nhiều chuyên gia trong lĩnh vực này nhằm giúp trải nghiệm của khách hàng trở lên hoàn hảo nhất.</p>
							<h4>YẾU TỐ CON NGƯỜI</h4>
							<p>Sự thành công của một doanh nghiệp bất kỳ phụ thuộc vào yếu tố con người và cách thức quản lý những con người ấy. Công ty SamSung &amp; acer là một đơn vị đi đầu trong lĩnh vực điện thoại thông minh và laptop .<br>
								Chúng tôi quyết định thực thi cam kết:<br>
								Về Tư vấn : Cung cấp cho khách hàng các sản phẩm tốt nhất,nhiều tính sáng năng nhất và đặc biệt phù hợp với yêu cầu của khách Hàng.<br>
						</p>
							<h4>VAI TRÒ NGƯỜI LÃNH ĐẠO</h4>
							<p>Sự thành công của Logo ngày nay là nhờ vào sự tin tưởng của khách hàng đã dành cho công ty. Chính vì vậy, ban lãnh đạo của công ty luôn sẵn sàng đứng ra đảm bảo quyền lợi cho khách hàng, chịu trách nhiệm với khách hàng trong mọi trường hợp mà khách hàng không hài lòng, luôn tiếp thu ý kiến của khách hàng để ngày càng củng cố, hoàn thiện bộ máy hoạt động của công ty.</p>
							<p>Hãy để chúng tôi Tư vấn và bán hàng cho gia đỉnh bạn. Nhữngsản phẩm mà bạn đang cần, hãy để LoGo được đồng Hành cùng bạn.<br>
							Xin chân thành cảm ơn !!!</p>
					</div>
				</div>
			</div>
		</div>
	</section>




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