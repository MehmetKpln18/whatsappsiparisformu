<?php session_start(); ob_start(); ?>
<?php include 'baglantilar/database.php'; ?>
<?php
if( isset($_SESSION['yonetici']) && !empty($_SESSION['yonetici']) ){
  $records = $conn->prepare('SELECT * FROM yoneticiler WHERE id = :id');
  $records->bindParam(':id', $_SESSION['yonetici']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);
  $user = NULL;
  if( count($results) > 0){
    $user = $results;
  }
}
else
{
  header("Location: giris.php");
  die();
}
?>

<?php 
$vericek = $conn -> prepare("SELECT * FROM yoneticiler where id = :id");
$vericek->bindParam(':id', $_SESSION['yonetici']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>

<?php
if (isset($_POST["Gonder"])) {
  $ids = $_SESSION['yonetici'];
  $adiniz = $_POST['adiniz'];
  $email = $_POST['email'];
  $kullaniciadi = $_POST['kullaniciadi'];
  $password = $_POST['password'];
  $telefon = $_POST['telefon'];
  $aciklama = $_POST['aciklama'];
  $guncelle = $conn -> prepare("UPDATE yoneticiler SET adiniz=:adiniz, email=:email, kullaniciadi=:kullaniciadi, password=:password, telefon=:telefon, aciklama=:aciklama WHERE id=:id");
  $guncelle->bindParam(':id', $ids);
  $guncelle->bindParam(':adiniz', $adiniz);
  $guncelle->bindParam(':email', $email);
  $guncelle->bindParam(':kullaniciadi', $kullaniciadi);
  $guncelle->bindParam(':password', $password);
  $guncelle->bindParam(':telefon', $telefon);
  $guncelle->bindParam(':aciklama', $aciklama);
  $guncelle-> execute(); 
  if($guncelle){
    $mesaj = '<meta http-equiv="refresh" content="1;URL=?sayfa=hesabim">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Başarılı !</strong>
    </div>';
  }else{
    $mesaj = '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Başarısız !</strong>
    </div>';
  }
}
?>
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
    <li class="breadcrumb-item active">Hesabım</li>
  </ol>
  <div class="row">
    <div class="col-xl-12 col-sm-12 mb-3">
      <form action="" method="post">
        <div class="message"></div>
        <?php if(!empty($mesaj)): ?>
          <p><?= $mesaj ?></p>
        <?php endif; ?>
        <div class="row">
          <div class="col-xl-6 col-sm-12">
            <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $_SESSION['yonetici']; ?>">
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Adınız</span>
              </div>
              <input type="text" name="adiniz" class="form-control" id="adiniz" value="<?php echo $veriyigoster['adiniz']; ?>">
            </div>
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Kullanıcı Adınız</span>
              </div>
              <input type="text" name="kullaniciadi" class="form-control" id="kullaniciadi" value="<?php echo $veriyigoster['kullaniciadi']; ?>">
            </div>
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Şifre</span>
              </div>
              <input type="password" name="password" class="form-control" id="password" value="<?php echo $veriyigoster['password']; ?>">
            </div>
          </div>
          <div class="col-xl-6 col-sm-12">
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">E-Posta</span>
              </div>
              <input type="text" name="email" class="form-control" id="email" value="<?php echo $veriyigoster['email']; ?>">
            </div>
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Telefon</span>
              </div>
              <input type="text" name="telefon" class="form-control" id="telefon" value="<?php echo $veriyigoster['telefon']; ?>">
            </div>
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Açıklama</span>
              </div>
              <input type="text" name="aciklama" class="form-control" id="aciklama" value="<?php echo $veriyigoster['aciklama']; ?>">
            </div>
          </div>
        </div>   
        <hr>
        <a href="?sayfa=anasayfa" class="btn btn-danger pull-left">Geri Dön</a>
        <button type="submit" name="Gonder" class="btn btn-success pull-right">Kaydet</button>
      </form>
    </div>
  </div>
</div>