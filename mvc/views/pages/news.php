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
 <div class="container">
   <nav class="pagination">
     <ul class="page-numbers nav-pagination links text-center">
       <li>
         <span aria-current="page" class="page-number current">1</span>
       </li>
       <li>
         <a class="page-number" href="#2">2</a>
       </li>
       <li>
         <a class="page-number" href="#3">3</a>
       </li>
       <li>
         <a class="page-number" href="#4">4</a>
       </li>
       <li>
         <a class="page-number" href="#5">5</a>
       </li>
       <li>
         <a class="next page-number" href="#2">
           <i class="fa fa-angle-right"></i>
         </a>
       </li>
     </ul>
   </nav>
 </div>