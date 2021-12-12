<?php
$post = $data["Post"];
?>
<div class="row page-wrapper">
  <div class="large-9 col">
    <article>
      <header class="entry-header">
        <h1 class="entry-title"><?= $post["title"] ?></h1>
        <div class="entry-meta">
          <ul>
            <li class="meta-date">
              <i class="fas fa-calendar-alt"></i><?= $post["published"] ?>
            </li>
            <li class="meta-author">
              <i class="fas fa-user"></i>
              <a href="./author.html">
                <?= $post["fullName"] == NULL ? $post["username"] : $post["fullName"] ?>
              </a>
            </li>
            <li class="meta-cat">
              <i class="fas fa-folder-open"></i>
              <a href="">Ẩm thực</a>
              /
              <a href="">Hamburger</a>
            </li>
            <li class="meta-comments">
              <i class="fa fa-comments"></i><a href="">1 Bình luận</a>
            </li>
            <li class="meta-views">
              <i class="fa fa-eye"></i><span>459 Lượt xem</span>
            </li>
          </ul>
        </div>
      </header>
      <div class="entry-content">
        <?= $post["content"] ?>
      </div>
      <div class="entry-share">
        <ul class="social-media">
          <li>
            <a class="facebook" href="https://www.facebook.com/share.php?u={{url}}&title={{title}}" target="blank">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li>
            <a class="twitter" href="https://twitter.com/intent/tweet?status={{title}}+{{url}}" target="blank">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li>
            <a class="linkedin"
              href="https://www.linkedin.com/shareArticle?mini=true&url={{url}}&title={{title}}&source={{source}}"
              target="blank">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </li>
          <li>
            <a class="pinterest"
              href="https://pinterest.com/pin/create/bookmarklet/?media={{media}}&url={{url}}&is_video=false&description={{title}}"
              target="blank">
              <i class="fab fa-pinterest"></i>
            </a>
          </li>
        </ul>
      </div>
      <div id="comments">
        <div class="title text-center">
          <h2>Bình luận</h2>
          <img src="<?= SITE_URL ?>/public/img/title.png">
        </div>
        <form action="" method="get" id="comment-form">
          <div class="row">
            <div class="col small-12 large-12">
              <p style="font-weight: 600">
                Địa chỉ email của bạn sẽ không được công bố. Các trường bắt
                buộc được đánh dấu <span class="required">*</span>
              </p>
              <div class="form-group comment-form-comment">
                <textarea id="comment" name="comment" cols="45" rows="8" maxlength="1000" required
                  placeholder="Nội dung  *"></textarea>
              </div>
            </div>
            <div class="col medium-6 small-12 large-6">
              <div class="form-group comment-form-author">
                <input id="author" name="author" type="text" value="" size="30" required placeholder="Họ và tên *" />
              </div>
            </div>
            <div class="col medium-6 small-12 large-6">
              <div class="form-group comment-form-email">
                <input id="email" name="email" type="email" value="" size="30" required placeholder="Email *" />
              </div>
            </div>
          </div>
          <div class="container">
            <input id="cookies-consent" name="cookies-consent" type="checkbox" value="yes" />
            <label for="cookies-consent">Lưu tên, email và trang web của tôi trong trình duyệt này cho
              lần tôi nhận xét tiếp theo.</label>
            <div class="text-center" style="margin-top: 1rem">
              <button type="submit" form="comment-form" value="Submit" class="button primary">
                Gửi bình luận
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="comments-container">
        <ul id="comments-list" class="comments-list">
          <li>
            <div class="comment-main-level">
              <div class="comment-avatar">
                <img src="./assets/img/author.jpg" alt="Nghia.l.t" />
              </div>

              <div class="comment-box">
                <div class="comment-head">
                  <h6 class="comment-name by-author">
                    <a href="./author.html">Nghia.l.t</a>
                  </h6>
                  <div class="reply-icon">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-reply"></i>
                  </div>
                </div>
                <div class="comment-content">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Velit omnis animi et iure laudantium vitae, praesentium
                  optio, sapiente distinctio illo?
                </div>
              </div>
            </div>

            <ul class="comments-list reply-list">
              <li>
                <div class="comment-avatar">
                  <img src="./assets/img/member-1.jpg" alt="MyXit" />
                </div>

                <div class="comment-box">
                  <div class="comment-head">
                    <h6 class="comment-name">
                      <a href="./author.html">MyXit</a>
                    </h6>
                    <div class="reply-icon">
                      <i class="fa fa-heart"></i>
                      <i class="fa fa-reply"></i>
                    </div>
                  </div>
                  <div class="comment-content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit. Velit omnis animi et iure laudantium vitae,
                    praesentium optio, sapiente distinctio illo?
                  </div>
                </div>
              </li>

              <li>
                <div class="comment-avatar">
                  <img src="./assets/img/author.jpg" alt="Nghia.l.t" />
                </div>
                <div class="comment-box">
                  <div class="comment-head">
                    <h6 class="comment-name by-author">
                      <a href="./author.html">Nghia.l.t</a>
                    </h6>
                    <div class="reply-icon">
                      <i class="fa fa-heart"></i>
                      <i class="fa fa-reply"></i>
                    </div>
                  </div>
                  <div class="comment-content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit. Velit omnis animi et iure laudantium vitae,
                    praesentium optio, sapiente distinctio illo?
                  </div>
                </div>
              </li>
            </ul>
          </li>

          <li>
            <div class="comment-main-level">
              <div class="comment-avatar">
                <img src="./assets/img/member-1.jpg" alt="MyXit" />
              </div>
              <!-- Contenedor del Comentario -->
              <div class="comment-box">
                <div class="comment-head">
                  <h6 class="comment-name">
                    <a href="./author.html">MyXit</a>
                  </h6>
                  <div class="reply-icon">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-reply"></i>
                  </div>
                </div>
                <div class="comment-content">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Velit omnis animi et iure laudantium vitae, praesentium
                  optio, sapiente distinctio illo?
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div id="related-posts">
        <div class="title text-center">
          <h2>Bài viết liên quan</h2>
          <img src="<?= SITE_URL ?>/public/img/title.png">
        </div>
        <div class="related-posts owl-carousel owl-theme">
          <div class="post has-hover item">
            <div class="box-image image-zoom">
              <a href=""><img src="<?= SITE_URL ?>/public/img/blog-1.jpg"
                  alt="Những lý do nên bao gồm rau hữu cơ trong chế độ ăn" /></a>
            </div>
            <div class="box-text">
              <div class="post-meta flex-row">
                <p class="post-date">10/02/2021</p>
                <p class="post-author">
                  Posted by <a href="/author.html">Nghia.l.t</a>
                </p>
              </div>
              <h5 class="post-title">
                <a href="">
                  Những lý do nên bao gồm rau hữu cơ trong chế độ ăn
                </a>
              </h5>
              <p class="post-excerpt">
                Ngay cả khi bạn không phải là một chuyên gia về da, không
                khó để nhận ra rằng hầu hết phụ nữ Hàn Quốc có làn da như
                sương, sáng và gần như mờ…
              </p>
            </div>
          </div>
          <div class="post has-hover item">
            <div class="box-image image-zoom">
              <a href=""><img src="<?= SITE_URL ?>/public/img/blog-2.jpg"
                  alt="Chiếc bánh hamburger ngon nhất thế giới hiện tại" /></a>
            </div>
            <div class="box-text">
              <div class="post-meta flex-row">
                <p class="post-date">10/02/2021</p>
                <p class="post-author">
                  Posted by <a href="/author.html">Nghia.l.t</a>
                </p>
              </div>
              <h5 class="post-title">
                <a href="">
                  Chiếc bánh hamburger ngon nhất thế giới hiện tại
                </a>
              </h5>
              <p class="post-excerpt">
                Ai cũng biết McDonald’s – Cửa hàng bán bánh hamburger Big
                Mac nổi tiếng nhất thế giới vừa mới mở cửa hàng đầu tiên ở
                Việt Nam....
              </p>
            </div>
          </div>
          <div class="post has-hover item">
            <div class="box-image image-zoom">
              <a href=""><img src="<?= SITE_URL ?>/public/img/blog-3.jpg"
                  alt="Tổng hợp các chiếc bánh hamburger xúc xích ngon nhất" /></a>
            </div>
            <div class="box-text">
              <div class="post-meta flex-row">
                <p class="post-date">10/02/2021</p>
                <p class="post-author">
                  Posted by <a href="/author.html">Nghia.l.t</a>
                </p>
              </div>
              <h5 class="post-title">
                <a href="">
                  Tổng hợp các chiếc bánh hamburger xúc xích ngon nhất
                </a>
              </h5>
              <p class="post-excerpt">
                Nhắc đến xúc xích sẽ chẳng xa lạ gì với mọi thực khách từ
                trẻ đến già. Hầu hết chúng ta thưởng thức xúc xích rán, ăn
                lẩu hay nấu canh...
              </p>
            </div>
          </div>
          <div class="post has-hover item">
            <div class="box-image image-zoom">
              <a href=""><img src="<?= SITE_URL ?>/public/img/blog-2.jpg"
                  alt="Chiếc bánh hamburger ngon nhất thế giới hiện tại" /></a>
            </div>
            <div class="box-text">
              <div class="post-meta flex-row">
                <p class="post-date">10/02/2021</p>
                <p class="post-author">
                  Posted by <a href="/author.html">Nghia.l.t</a>
                </p>
              </div>
              <h5 class="post-title">
                <a href="">
                  Chiếc bánh hamburger ngon nhất thế giới hiện tại
                </a>
              </h5>
              <p class="post-excerpt">
                Ai cũng biết McDonald’s – Cửa hàng bán bánh hamburger Big
                Mac nổi tiếng nhất thế giới vừa mới mở cửa hàng đầu tiên ở
                Việt Nam....
              </p>
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>
  <div class="large-3 col sidebar">
  </div>
</div>