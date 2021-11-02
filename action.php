<?php
if (isset($_GET['action'])) {
  $action = $_GET['action'];
  switch ($action) {
    case 'trang-chu':
      $page = 'trang-chu';
      $title = 'Trang chủ';
      break;
    case 'gioi-thieu':
      $page = 'gioi-thieu';
      $title = 'Giới thiệu';
      break;
    case 'cua-hang':
      $page = 'cua-hang';
      $title = 'Cửa hàng';
      break;
    case 'danh-muc':
      $page = 'danh-muc';
      $title = 'Danh mục';
      break;
    case 'tu-khoa':
      $page = 'tu-khoa';
      $title = 'Từ khóa';
      break;
    case 'search':
      $page = 'search';
      $title = 'Search';
      break;
    case 'san-pham':
      $page = 'san-pham';
      $title = 'Sản phẩm';
      break;
    case 'cau-hoi-thuong-gap':
      $page = 'cau-hoi-thuong-gap';
      $title = 'Câu Hỏi Thường Gặp';
      break;
    case 'chinh-sach':
      $page = 'chinh-sach';
      $title = 'Chính sách';
      break;
    case 'tin-tuc':
      $page = 'tin-tuc';
      $title = 'Tin tức';
      break;
    case 'bai-viet':
      $page = 'bai-viet';
      $title = 'Bài viết';
      break;
    case 'lien-he':
      $page = 'lien-he';
      $title = 'Liên hệ';
      break;
    case 'gio-hang':
      $page = 'gio-hang';
      $title = 'Giỏ hàng';
      break;
    case 'thanh-toan':
      $page = 'thanh-toan';
      $title = 'Thanh toán';
      break;
    case 'order-received':
      $page = 'order-received';
      $title = 'Tiếp nhận đơn hàng';
      break;
    case 'dang-nhap':
      $page = 'dang-nhap';
      $title = 'Đăng nhập';
      break;
    case 'dang-ky':
      $page = 'dang-ky';
      $title = 'Đăng ký';
      break;
    case 'tai-khoan':
      $page = 'tai-khoan';
      $title = 'Tài khoản';
      break;
    case 'don-hang':
      $page = 'don-hang';
      $title = 'Đơn hàng';
      break;
    case 'doi-mat-khau':
      $page = 'doi-mat-khau';
      $title = 'Đổi mật khẩu';
      break;
    case 'view-order':
      $page = 'view-order';
      $title = 'Đơn hàng';
      break;
    default:
      $page = '404';
      $title = '404';
      break;
  }
} else {
  $page = 'trang-chu';
  $title = 'Trang chủ';
}