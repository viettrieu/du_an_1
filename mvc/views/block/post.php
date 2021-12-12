<div class="post has-hover">
  <div class="box-image image-zoom">
    <a href="<?= SITE_URL ?>/news/post/<?= $post["id"] ?>">
      <img src="<?= SITE_URL . "" . $post["thumbnail"] ?>" alt="<?= $post["title"] ?>" />
    </a>
  </div>
  <div class="box-text">
    <div class="post-meta flex-row">
      <p class="post-date"><?= $post["published"] ?></p>
      <p class="post-author">
        Posted by <strong><?= $post["fullName"] == NULL ? $post["username"] : $post["fullName"] ?></strong>
      </p>
    </div>
    <h5 class="post-title">
      <a href="<?= SITE_URL ?>/news/post/<?= $post["id"] ?>">
        <?= $post["title"] ?>
      </a>
    </h5>
    <p class="post-excerpt">
      <?= $post["excerpt"] ?>
    </p>
  </div>
</div>