 <div class="row">
   <?php
    $ListPost =  $data['ListPost'];
    if (count($ListPost) > 0) {
      foreach ($ListPost as $post) { ?>
       <div class="col medium-6 small-12 large-4">
         <div class="col-inner">
           <?php require "./mvc/views/block/post.php" ?>
         </div>
       </div>
     <?php }
    } else { ?>
     <div class="container">
       Không có bài viết phù hợp
     </div>
   <?php } ?>
 </div>