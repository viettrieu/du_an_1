<?php
  $user = $data['user'] ? $data['user'] : null;
  // print_r($user);
  $order = $data['order'] ? $data['order'] : null ;
  if(!$order){
    header("Location: " . ADMIN_URL . "/order");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="vi">
<?php require_once "./mvc/views/block/pdfHead.php"; ?>
  <body>
    <div class="container-fluid mx-auto">
      <div class="row justify-content-center">
        <div class="col-10">
          <header class="clearfix">
            <div id="logo">
              <img src="https://auteur.g5plus.net/wp-content/uploads/2019/01/logo-black.png">
            </div>
            <h1>AUTEUR</h1>
            <div class="" style="flex-direction:column">
              <div style="text-align: left;"  id="project">
                <div><span>PROJECT</span> AUTEUR</div>
                <div><span>CLIENT</span> <?= $user['fullName']?></div>
                <p class="text-break mb-0"><span style='width:auto'>ADDRESS</span><?= $user['address']?></p>
                <div><span>EMAIL</span><div style="display: inline-block;"><?= $user['email']?></div></div>
                <div><span>Company</span><div style="display: inline-block;">trungnghia191919@gmail.com</div></div>
              </div>
            </div>
          </header>
          <main>
            <table >
              <thead>
                <tr>
                  <th class="service">Tên Sản Phẩm</th>
                  <th>Giá</th>
                  <th>Số Lượng</th>
                  <th>Tổng Tiền</th>
                </tr>
              </thead>
              <tbody>
               <?php
               $sum = 0;
                foreach($order as $value){
                  $sum+=($value['quantity'] * $value['price']);
               ?>
                <tr>
                  <td class="service"><?= $value['title']?></td>
                  <td class="unit"><?= $value['price']?></td>
                  <td class="qty"><?= $value['quantity']?></td>
                  <td class="total"><?= number_format($value['quantity'] * $value['price'])?></td>
                </tr>
                <?php
                  };
                ?>
                <tr>
                  <td colspan="4">Tổng Cộng</td>
                  <td class="total"><?= number_format($sum) ?></td>
                </tr>
                <tr>
                  <td colspan="4">Phí Ship</td>
                  <td class="total"><?= number_format($value['shipping']) ?></td>
                </tr>
                <tr>
                  <td colspan="4" class="grand total">GRAND TOTAL</td>
                  <td class="grand total"><?= number_format($sum + $value['shipping']) ?></td>
                </tr>
              </tbody>
            </table>
            <div id="notices">
              <div>NOTICE:</div>
              <div class="notice"><?= $value['content'] ? $value['content'] : '' ?></div>
            </div>
            <?php
              if(!$data['isExport']){
            ?>
            <form action="" style='margin-top:20px;float:right' class="from-group " method="post">
              <button class="btn btn-primary" name='back'>Back</button>
              <button class="btn btn-success" name='pdf'>Export To Pdf</button>
            </form>
            <?php
              }
            ?>
          </main>
        </div>
      </div>
    </div>
  </body>
</html>