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
        <?php if (isset($_SESSION["user"])) : ?>
        <div id="comment_form_wrapper">
          <a href="javascript:void(0);" id="cancel-comment-reply-link">Cancel Reply</a>
          <form method="POST" id="comment-form" data-id="<?= $post['id']; ?>">
            <div class="form-group comment-form-comment">
              <textarea id="comment" name="content" cols="45" rows="8" maxlength="1000" required
                placeholder="Nội dung  *"></textarea>
            </div>
            <input type="hidden" name="parent_id" id="parent_id" value="">
            <div class="text-center" style="margin-top: 1rem">
              <button type="submit" form="comment-form" value="Submit" class="button primary">
                Gửi bình luận
              </button>
            </div>
          </form>
        </div>
        <?php else :
          $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]#comments";
        ?>
        <p>Vui lòng <a href="<?= SITE_URL ?>/login&refurl=<?= base64_encode($actual_link) ?>"
            style=" color: #cc3528; "><strong>đăng nhập</strong></a> để bình
          luận</p>
        <?php endif ?>
      </div>
      <?php $comments = $data["Comment"];
      $children = array();
      foreach ($comments as $comment) {
        $children[$comment['parent_id']][] = $comment;
      }
      ?>
      <div class="comments-container">
        <ul id="comments-list" class="comments-list">
          <?php
          if (isset($children[0])) {
            foreach ($children[0] as $c) { ?>
          <li>
            <div class="comment-main-level">
              <div class="comment-avatar">
                <img src="<?= $c["avatar"] ?>" alt="<?= $c['fullName'] ? $c['fullName'] : $c['username'] ?>" />
              </div>
              <div class="comment-box">
                <div class="comment-head">
                  <h6 class="comment-name">
                    <?= $c['fullName'] ? $c['fullName'] : $c['username'] ?></a>
                  </h6>
                  <div class="reply-icon">
                    <i class="fa fa-heart"></i>
                    <i class="fa fa-reply" data-id="<?= $c['id']; ?>"></i>
                  </div>
                </div>
                <div class=" comment-content"><?= $c["content"] ?></div>
              </div>
            </div>
            <ul class="comments-list reply-list parent_id-<?= $c['id']; ?>">
              <?php if (in_array($c["id"], array_keys($children))) { ?>
              <?php foreach (array_reverse($children[$c["id"]]) as $x) { ?>
              <li>
                <div class="comment-avatar">
                  <img src="<?= $x["avatar"] ?>" alt="<?= $x['fullName'] ? $x['fullName'] : $x['username'] ?>" />
                </div>
                <div class="comment-box">
                  <div class="comment-head">
                    <h6 class="comment-name"><?= $x['fullName'] ? $x['fullName'] : $x['username'] ?></a></h6>
                    <div class="reply-icon">
                      <i class="fa fa-heart"></i>
                    </div>
                  </div>
                  <div class="comment-content"><?= $x["content"] ?></div>
                </div>
              </li>
              <?php
                    }
                  } ?>
            </ul>
          </li>
          <?php }
          } ?>
        </ul>
      </div>

      <?php
      $RelatedPost =  $data['RelatedPost'];
      if ($RelatedPost) { ?>
      <div id="related-posts">
        <div class="title text-center">
          <h2>Bài viết liên quan</h2>
          <img src="<?= SITE_URL ?>/public/img/title.png">
        </div>
        <div class="related-posts owl-carousel owl-theme">
          <?php foreach ($RelatedPost as $post) { ?>
          <?php require "./mvc/views/block/post.php" ?>
          <?php } ?>
        </div>
      </div>
      <?php } ?>

    </article>
  </div>
  <div class="large-3 col sidebar">
  </div>
</div>
<script src="<?= SITE_URL ?>/public/js/comment.js"></script>