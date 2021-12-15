$("#cancel-comment-reply-link").hide();
$("#comment-form").submit(function (e) {
  e.preventDefault();
  $(this)
    .find("[type=submit]")
    .prepend(
      '<span class="spinner-border spinner-border-sm mr-2" role="status"></span>'
    );
  var formData = new FormData(this);
  formData.append("postId", $(this).data("id"));
  $.ajax({
    url: SITE_URL + "/news/post/addcomment",
    type: "POST",
    data: formData,
    dataType: "JSON",
    success: function (data) {
      console.log(data);
      if (data["type"] == "success") {
        $(".noreviews").remove();
        $(".spinner-border").remove();
        $("#comment-form").trigger("reset");
        let comment = data["data"];
        if (comment["parent_id"] == 0) {
          $("#comments-list").prepend(`
          <li><p class="note">Bình luận của bạn đã gửi thành công và đang chờ kiểm duyệt</p>
          <div class="comment-main-level">
              <div class="comment-avatar">
                <img src="${comment["avatar"]}" alt=" ${comment["username"]}" />
              </div>
                <div class="comment-box">
                  <div class="comment-head">
                    <h6 class="comment-name">${comment["username"]}</h6>
                    <div class="reply-icon">
                      <i class="fa fa-heart"></i>
                      <i class="fa fa-reply" data-id="${comment["id"]}"></i>
                    </div>
                  </div>
                  <div class="comment-content">${comment["content"]}</div>
                </div>
            </div>
            <ul class="comments-list reply-list parent_id-${comment["id"]}"> </ul>
          </li>
        `);
        } else {
          $(`.parent_id-${comment["parent_id"]}`).prepend(`
          <p class="note">Bình luận của bạn đã gửi thành công và đang chờ kiểm duyệt</p>
          <li>
            <div class="comment-avatar">
              <img src="${comment["avatar"]}" alt=" ${comment["username"]}" />
            </div>
            <div class="comment-box">
              <div class="comment-head">
                <h6 class="comment-name">${comment["username"]}</h6>
                <div class="reply-icon">
                  <i class="fa fa-heart"></i>
                </div>
              </div>
              <div class="comment-content">${comment["content"]}</div>
            </div>
          </li>
          `);
        }
      }
      notification({
        duration: 3000,
        ...data,
      });
    },
    cache: false,
    contentType: false,
    processData: false,
  });
});
$(document).on("click", ".comment-main-level .fa-reply", function (event) {
  $(this).closest("li").find(".reply-list").prepend($("#comment_form_wrapper"));
  let parent_id = $(this).data("id");
  $("#parent_id").val(parent_id);
  $("#cancel-comment-reply-link").show();
});

$(document).on("click", "#cancel-comment-reply-link", function (event) {
  event.preventDefault();
  $("#parent_id").val("");
  $("#comments").append($("#comment_form_wrapper"));
  $(this).hide();
});
