<?php session_start(); ob_start(); ?>
<?php include 'baglantilar/database.php'; ?>
<?php
if(isset($_SESSION['yonetici']) ){
  header("Location: index.php");
  exit();
}
if($_POST)
{
  $kullaniciadi=$_POST["kullaniciadi"];
  $password=$_POST["password"];
  if(!empty($kullaniciadi) && !empty($password))
  {
    $sorgu=$conn->prepare("SELECT * FROM yoneticiler WHERE kullaniciadi=? and password=?");
    $sorgu->execute(array($kullaniciadi,$password));
    $islem=$sorgu->fetch();
    if($islem)
    {
      $_SESSION['yonetici'] = $islem['id'];
      header("Location: index.php?sayfa=anasayfa");
      $uyari = '<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Başarı:</strong> Yönlendiriliyorsunuz.</div>';
    }
    else
    {
      $uyari = '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>Hata:</strong> Kullanıcı adı veya şifre geçersiz.</div>';
    }
  }
  else
  {
    $uyari = '<div class="alert alert-dismissible alert-warning"><button type="button" class="close" data-dismiss="alert">×</button><strong>Bilgi:</strong> Boş alan bırakmayınız.</div>';
  }
} 
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Giriş Yap</title>
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><center>Yönetim Paneli</center></div>
      <div class="card-body">
        <form action="giris.php" method="POST">
          <div class="message">   
            <?php if(!empty($uyari)): ?>
              <p><?= $uyari ?></p>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="kullaniciadi" id="kullaniciadi" class="form-control">
              <label for="inputEmail">Kullanıcı Adı</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="password" class="form-control">
              <label for="inputPassword">Şifre</label>
            </div>
          </div>
          <input type="submit" class="btn btn-success btn-block" value="Giriş Yap"> 
        </form>
      </div>
    </div>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><center>Demo Hesap Bilgileri</center></div>
      <div class="card-body">
        <div class="form-label-group">Kullanıcı Adı : demo</div>
        <div class="form-label-group">Şifre : demo</div>
      </div>
    </div>
  </div>
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>
