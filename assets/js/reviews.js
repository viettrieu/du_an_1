$("#reviews-form").submit(function (e) {
  e.preventDefault();
  $(this)
    .find("[type=submit]")
    .prepend(
      '<span class="spinner-border spinner-border-sm mr-2" role="status"></span>'
    );
  var formData = new FormData(this);
  formData.append("action", "reviews_product");
  formData.append("productId", $(this).data("id"));
  $.ajax({
    url: "./ajax.php",
    type: "POST",
    data: formData,
    dataType: "JSON",
    success: function (data) {
      $(".noreviews").remove();
      $(".spinner-border").remove();
      $("#reviews-form").trigger("reset");
      $("#reviews-list").prepend(`
        <li>
        <p class="note">Đánh giá của bạn đã gửi thành công và đang chờ kiểm duyệt</p>
          <div class="comment-main-level">
            <div class="comment-avatar">
              <img src=" ${data["avatar"]}" alt="${data["fullName"]}" />
            </div>
            <div class="comment-box">
              <div class="comment-head">
                <h6 class="comment-name by-customer">
                 ${data["fullName"]}
                </h6>
                <div class="star-ratings-css">
                  <div class="star-ratings-inner" style="width: ${
                    data["rating"] * 20
                  }%"></div>
                </div>
              </div>
              <div class="comment-content">
              ${data["content"]}
              </div>
            </div>
          </div>
        </li>
        `);
    },
    cache: false,
    contentType: false,
    processData: false,
  });
});
