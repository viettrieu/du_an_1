<!DOCTYPE html>
<html lang="vi">
<head>
	<?php include_once 'layout/layout.meta' ?>
</head>
<?php

session_start();
$conn = new PDO('mysql:host=ps17048.com:3366;dbname=web2013_asm;charset=utf8;charset=utf8', 'root', '');

if (!isset($_SESSION['carts'])) {
	$_SESSION['carts'] = [];
}
if (isset($_GET['add'])) {
	$id = $_GET['add'];
	$quantity = isset($_GET['quantity'])?$_GET['quantity']:1;
		if (in_array($id, array_column($_SESSION['carts'], 'id'))) {
			foreach ($_SESSION['carts'] as $key => $values) {
				if ($values['id'] == $id) {
					$_SESSION['carts'][$key]['quantity'] += $quantity;
				}
			}
		} else {
			array_push($_SESSION['carts'], array('id' => $id, 'quantity' => $quantity));
		}
	header('Location: giohang.php');
}
if(isset($_GET['delete'])) {
	$id = $_GET['delete'];
	if (in_array($id, array_column($_SESSION['carts'], 'id'))) {
		$index =  array_search($id, array_column($_SESSION['carts'], 'id'));
		print_r($index);
		array_splice($_SESSION['carts'], $index, 1);
	}
	header('Location: giohang.php');
}
?>

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
					<span>Đăng nhập</span>
				</li>
			</ul>
		</div>
	</section>
	<section class="hn-page">
		<div class="container">
			<div class="hn-page-title">
				<h4>Thanh toán</h4>
			</div>
			<div class="row">
				<div class="col-12">
				<?php	
						
						$i=0;
						$toltalProducts = 0;
						$totalPrice = 0;

                        if (count($_SESSION['carts']) > 0) {
							$conn = new PDO('mysql:host=ps17048.com:3366;dbname=web2013_asm;charset=utf8;charset=utf8', 'root', '');
							
                            echo '
							<table class="table table-bordered table-thanhtoan">
								<thead>
									<tr>
										<th scope="col">Hình ảnh sản phẩm</th>
										<th scope="col">Tên sản phẩm</th>
										<th scope="col">Đơn giá</th>
										<th scope="col">Số lượng</th>
										<th scope="col">Thành tiền</th>
										<th scope="col">Xóa</th>
									</tr>
								</thead>
								<tbody>';
						foreach ($_SESSION['carts'] as $product) {
							
							$sql = '
							SELECT * FROM products WHERE product_id=' . $product['id'];
							$row = $conn->query($sql)->fetch();

							echo '
										
										<tr>
											<th scope="row"><a href=""><img style="max-height: 5rem; width: auto;" src="./images/product-images/' . $row['product_images'] . '" alt=""></a></th>
											<td><a href="./sanpham.php?id=' . $row['product_id'] . '">' . $row['product_name']  . '</a></td>
											<td><strong>' . $row['product_price']  . 'đ</strong></td>
											<td><input type="number" min="1" max="9" step="1" value="' . $product['quantity'] . '" class="ml-2"></td>
											<td><strong>' . number_format($product['quantity'] * (int)str_replace(".","",$row['product_price']))  . ' đ</strong></td>
											<td><a href="./giohang.php?delete='.$row['product_id'] .'"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
										</tr>
									';
									$toltalProducts += $product['quantity'];
									$totalPrice += $product['quantity'] * (int)str_replace(".","",$row['product_price']);
							}
							echo '
						</tbody>
					</table>';
					} else {
						echo '
						<p>Bạn không có sản phẩm nào trong giỏ hàng</p>
						<a href="./index.php">Quay lại</a>
						';
					}
					?>
				</div>
				<div class="col-12">
					<div class="row">
						<div class="col-6">
							<button class="btn-primary px-4 py-2">Tiếp tục mua hàng</button>
						</div>
						<div class="col-6">
							<?php
							if(isset($_SESSION['carts']) && count($_SESSION['carts'])>0){
								echo '
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td>Tạm tính</td>
											<td>'.number_format($totalPrice).' đ</td>
										</tr>
										<tr>
											<td>Thành tiền</td>
											<td>'.number_format($totalPrice).' đ</td>
										</tr>
									</tbody>
								</table>
								<a href="thanhtoan.php" class="btn btn-primary px-4 py-2 w-100 text-white">Tiến hành thanh toán</a>
								';
							}
							?>
						</div>
					</div>
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