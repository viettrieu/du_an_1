<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
echo '
<header class="hn-header">
	<div class="hn-top-header">
		<div class="container">
			<div class="row">
				<div class="d-none d-sm-block col-sm-4 col-lg-8 col-xl-7  text-left">
					<div class="row">
						<div class="hn-header-phone col-12 col-lg-4 d-block">
							<i class="fas fa-phone-volume"></i>
							<span><strong>Tư vấn 24/7:</strong></span>
							<span><a href="">0932643306</a></span>
						</div>
						<div class="hn-header-address col-12 col-lg-8 d-none d-lg-block">
							<span><strong>Địa chỉ:</strong></span>
							<span>5M62 , ẤP 5 , Xã Phạm Văn Hai , Tp Hồ Chí Minh </span>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-8 col-lg-4 col-xl-5 text-right">';
if (!isset($_SESSION['user'])) {
	echo '
								<a href="dangnhap.php">Đăng nhập</a>
								<a href="dangky.php">Đăng ký</a>';
} else {
	echo '
								<a href="taikhoan.php">Quản lý tài khoản</a>';
}
if (isset($_SESSION['carts'])) {
	$i = 0;
	$toltalProducts = 0;
	$totalPrice = 0;
	if (count($_SESSION['carts']) > 0) {
		echo '
									<div class="hn-header-cart">
										<a href="">
											<i class="fas fa-shopping-cart"></i>
											<span class="d-none d-sm-inline"> Giỏ hàng </span>
											<span>(' . count($_SESSION['carts']) . ')</span>
										</a>
										<div class="cart-hidden">';
		foreach ($_SESSION['carts'] as $product) {

			$sql = '
										SELECT * FROM products WHERE product_id=' . $product['id'];
			$row = $conn->query($sql)->fetch();

			echo '
												<div class="cart-small-item">
												<div class="row">
													<div class="col-5 cart-thumb">
														<a href="./sanpham.php?id=' . $row['product_id'] . '"><img src="./images/product-images/' . $row['product_images'] . '"  alt=""></a>
													</div>
													<div class="col-7">
														<a style="color: black !important;" href="./sanpham.php?id=' . $row['product_id'] . '">' . $row['product_name']  . '</a>
														<p><strong>' . $row['product_price']  . 'đ</strong></p>
														<span>Số lượng: </span>' . $product['quantity'] . '
														<a  href="./giohang.php?delete=' . $row['product_id'] . '" class="btn btn-primary ml-4"><i class="fa fa-trash" aria-hidden="true"></i></a>
													</div>
												</div>
												</div>
										';
			$toltalProducts += $product['quantity'];
			$totalPrice += $product['quantity'] * (int)str_replace(".", "", $row['product_price']);
		}
		echo '
										<span>Tổng tiền tạm tính: <strong>' . number_format($totalPrice) . '</strong></span>
										<a href="giohang.php" class="btn btn-primary w-100 mt-2 py-2">
											<h6>Xem giỏ hàng</h6>
										</a>
										</div>';
	} else {
		echo '
									<div class="hn-header-cart">
										<a href="">
											<i class="fas fa-shopping-cart"></i>
											<span class="d-none d-sm-inline"> Giỏ hàng </span>
											<span>(0)</span>
										</a>
										<div class="cart-hidden">
											<div class="cart-content"><p>Bạn không có sản phẩm nào trong giỏ hàng</p>
										</div>
										</div>';
	}
} else {
	echo '
								<div class="hn-header-cart">
									<a href="">
										<i class="fas fa-shopping-cart"></i>
										<span class="d-none d-sm-inline"> Giỏ hàng </span>
										<span>(0)</span>
									</a>
									<div class="cart-hidden">
										<div class="cart-content"><p>Bạn không có sản phẩm nào trong giỏ hàng</p>
									</div>
								</div>';
}
echo '
							<!--
							<div class="cart-small-item">
								<div class="row">
									<div class="col-5 cart-thumb">
										<a href=""><img src="https://bizweb.dktcdn.net/100/109/381/products/8bga6dorkoto1zoom.jpg?v=1469632683513" alt=""></a>
									</div>
									<div class="col-7">
										<h6><a>Tủ quần áo hiện đại</a></h6>
										<p><strong>1.800.000</strong></p>
										<span>Số lượng</span><input type="number" min="1" max="9" step="1" value="1" class="ml-2">
										<button class="btn-primary w-100 mt-2 py-2">Bỏ ra khỏi giỏ hàng</button>
									</div>
								</div>
							</div>
							<div class="cart-small-item">
								<div class="row">
									<div class="col-5 cart-thumb">
										<a href=""><img src="https://bizweb.dktcdn.net/100/109/381/products/8bga6dorkoto1zoom.jpg?v=1469632683513" alt=""></a>
									</div>
									<div class="col-7">
										<h6><a>Tủ quần áo hiện đại</a></h6>
										<p><strong>1.800.000</strong></p>
										<span>Số lượng</span><input type="number" min="1" max="9" step="1" value="1" class="ml-2">
										<button class="btn-primary w-100 mt-2 py-2">Bỏ ra khỏi giỏ hàng</button>
									</div>

								</div>
							</div>
							<div class="cart-content">
								<span>Tổng tiền tạm tính: <strong>1.800.000</strong></span>
								<a href="giohang.php" class="btn btn-primary w-100 mt-2 py-2">
									<h6>Xem giỏ hàng</h6>
								</a>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="hn-middle-header">
		<div class="container">
			<div class="row">
				<div class="col-6 col-lg-3">
					<div class="hn-header-logo">
						<a href="index.php">
							<img src="https://cdn.logo.com/hotlink-ok/logo-social.png" alt="Logo">
						</a>
					</div>
				</div>
				<div class="d-none d-lg-inline col-12 col-lg-9">
					<div class="row">
						<div class="col-4">
							<div class="hn-service-icon">
								<i class="fas fa-user-tie"></i>
							</div>
							<div class="hn-service-content">
								TƯ VẤN 24/7&thinsp;<span>MIỄN PHÍ</span>
							</div>
						</div>
						<div class="col-4">
							<div class="hn-service-icon">
								<i class="fas fa-truck"></i>
							</div>
							<div class="hn-service-content">
								VẬN CHUYỂN&thinsp;<span>MIỄN PHÍ</span>
							</div>
						</div>
						<div class="col-4">
							<div class="hn-service-icon">
								<i class="fas fa-hand-holding-usd"></i>
							</div>
							<div class="hn-service-content">
								NHẬN HÀNG&thinsp;<span>NHẬN TIỀN</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 d-inline d-lg-none">
					<nav class="navbar navbar-light" style="justify-content: flex-end; color: black;">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="hn-nav-header">
		<div class="container">
			<div class="row">
				<div class="col-12 d-none d-lg-flex justify-content-between align-items-center">
					<nav>
						<ul>
							<li><a href="index.php">Trang chủ</a></li>
							<!--
						-->
							<li><a href="gioithieu.php">Giới thiệu</a></li>
							<!--
						-->
							<li class="hn-nav-drop">
								<a href="danhsach.php">Sản phẩm
									<i class="fas fa-chevron-down"></i>
									<div class="hn-nav-submenu">
										<div class="container">
											<div class="row">
												<div class="col-3">
													<h5>SamSung</h5>
													<nav>
														<ul>
															<li><a href="">SamSung J</a></li>
															<li><a href="">SamSung Note</a></li>
															<li><a href="">Samsung Lite</a></li>
															<li><a href="">SamSung Hot</a></li>
															<li><a href="">SamSung </a></li>
														</ul>
													</nav>
												</div>
												<div class="col-3">
													<h5>Iphone</h5>
													<nav>
														<ul>
															<li><a href="">Iphone X</a></li>
															<li><a href="">Iphone XII</a></li>
															<li><a href="">Iphone VI</a></li>
															<li><a href="">Iphone XIII</a></li>
															<li><a href="">Iphone XII</a></li>
														</ul>
													</nav>
												</div>
											</div>
										</div>
									</div>
								</a>
							</li>
							<!--
						-->
							<li><a href="tintuc.php">Tin tức</a></li>
							<!--
						-->
							<li><a href="lienhe.php">Liên hệ</a></li>
						</ul>
					</nav>
					<div class="hn-nav-search">
						<form class="search" action="./danhsach.php">
							<input class="" type="search" placeholder="Search" name="search" value="' . $search . ' ">
							<button class="btn" type="submit"><i class="fas fa-search"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="hn-nav-mobile d-block d-lg-none">
		<div class="container">
			<div class="collapse" id="navbarToggleExternalContent">
				<nav>
					<ul>
						<li><a href="">Trang chủ</a></li>
						<li><a href="">Giới thiệu</a></li>
						<li>
							<div class="dropdown">
								<a href="">Sản phẩm</a>
								<a class="dropdown-toggle" data-toggle="dropdown"></a>
								<ul class="dropdown-menu">
									<li>
										<a href="#">Phòng khách</a>
										<a class="drop"></a>
										<ul class="dropdown-menu">
											<li><a href="#">Bàn ghế gỗ</a></li>
											<li><a href="#">Sofa phòng khách</a></li>
											<li><a href="#">Tủ để giày</a></li>
											<li><a href="#">Tủ rượu</a></li>
											<li><a href="#">Vách ngăn</a></li>
										</ul>
									</li>
									<li>
										<a href="#">Phòng khách</a>
										<a class="drop"></a>
										<ul class="dropdown-menu">
											<li><a href="#">Bàn ghế gỗ</a></li>
											<li><a href="#">Sofa phòng khách</a></li>
											<li><a href="#">Tủ để giày</a></li>
											<li><a href="#">Tủ rượu</a></li>
											<li><a href="#">Vách ngăn</a></li>
										</ul>
									</li>
									<li>
										<a href="#">Phòng khách</a>
										<a class="drop"></a>
										<ul class="dropdown-menu">
											<li><a href="#">Bàn ghế gỗ</a></li>
											<li><a href="#">Sofa phòng khách</a></li>
											<li><a href="#">Tủ để giày</a></li>
											<li><a href="#">Tủ rượu</a></li>
											<li><a href="#">Vách ngăn</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</li>
						<li><a href="">Tin tức</a></li>
						<li><a href="">Liên hệ</a></li>
					</ul>
				</nav>
			</div>
			<div class="hn-nav-search w-100">
				<form class="search d-flex">
					<input class="flex-grow-1" type="search" placeholder="Search">
					<button class="btn" type="submit"><i class="fas fa-search"></i></button>
				</form>
			</div>
		</div>

	</div>
	</header>
';