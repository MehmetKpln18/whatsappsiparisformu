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
$vericek = $conn -> prepare("SELECT * FROM urunler where id = :id");
$vericek->bindParam(':id', $_GET['id']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>

<?php
if (isset($_POST["Gonder"])) {
  $ids = $_GET['id'];
  $urunbaslik = $_POST['urunbaslik'];
  $urunicerik = $_POST['urunicerik'];
  $urunfiyat = $_POST['urunfiyat'];
  $urunstok = $_POST['urunstok'];
  $temp = explode(".", $_FILES["urunresim"]["name"]);
  $newfilename = round(microtime(true)) . '.' . end($temp);
  $urunresimtemp = $_FILES["urunresim"]["tmp_name"];
  $urunresim = $newfilename;
  if($urunresimtemp != "")
  {
    move_uploaded_file($urunresimtemp, "assets/resim/" . $newfilename);
    $guncelle = $conn -> prepare("UPDATE urunler SET urunbaslik=:urunbaslik, urunicerik=:urunicerik, urunfiyat=:urunfiyat, urunstok=:urunstok, urunresim=:urunresim WHERE id=:id");  
    $guncelle->bindParam(':urunresim', $urunresim);
  }else {
    $guncelle = $conn -> prepare("UPDATE urunler SET urunbaslik=:urunbaslik, urunicerik=:urunicerik, urunfiyat=:urunfiyat, urunstok=:urunstok WHERE id=:id");

  }
  $guncelle->bindParam(':id', $ids);
  $guncelle->bindParam(':urunbaslik', $urunbaslik);
  $guncelle->bindParam(':urunicerik', $urunicerik);
  $guncelle->bindParam(':urunfiyat', $urunfiyat);
  $guncelle->bindParam(':urunstok', $urunstok);
  $guncelle-> execute();
  if($guncelle){
    $mesaj = '<meta http-equiv="refresh" content="2;URL=?sayfa=urunler">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Başarı İle Düzenlendi. 2 Saniye İçinde Yönlendiriliyorsunuz...</strong>
    </div>';
  }else{
    $mesaj = '<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Hata Oluştu !</strong>
    </div>';
  }
}
?>

<?php
if (isset($_GET['numaram'])) {
  $numaras = $_GET['numaram'];  
  $urunsil = $conn -> prepare("DELETE FROM urunler where id = :id");
  $urunsil->bindParam(':id', $_GET['numaram']);
  $urunsil-> execute();
  if($urunsil){
    $mesaj = '<meta http-equiv="refresh" content="2;URL=?sayfa=urunler">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Ürün Başarı İle Silindi. 2 Saniye İçinde Yönlendiriliyorsunuz</strong>
    </div>';
  }else{
    $mesaj = '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Hata Oluştu !</strong>
    </div>';
  }  
} 
?>
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
    <li class="breadcrumb-item"><a href="?sayfa=urunler">Ürün Düzenle</a></li>
    <li class="breadcrumb-item active"><?php echo $veriyigoster['urunbaslik']; ?></li>
  </ol>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-xl-12 col-sm-12 mb-3">
        <div class="message"></div>
        <?php if(!empty($mesaj)): ?>
          <p><?= $mesaj ?></p>
        <?php endif; ?>
      </div>
      <div class="col-xl-4 col-sm-12 mb-3">
        <div class="card shadow img-upload">
          <img src='assets/resim/<?php echo $veriyigoster['urunresim']; ?>' id='img-upload'/>
        </div>
      </div>
      <div class="col-xl-8 col-sm-12 mb-3">
        <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text" id="inputGroupFileAddon01">Ürün Resmi</span></div>
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="urunresim" id="imgInp" aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01">Seç</label>
          </div>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text">Ürün Başlığı</span></div>
          <input type="text" name="urunbaslik" class="form-control" value="<?php echo $veriyigoster['urunbaslik']; ?>">
          <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $_GET['id']; ?>">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text">Ürün İçeriği</span></div>
          <input type="text" name="urunicerik" class="form-control" value="<?php echo $veriyigoster['urunicerik']; ?>">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text">Ürün Fiyatı</span></div>
          <input type="text" name="urunfiyat" class="form-control" value="<?php echo $veriyigoster['urunfiyat']; ?>">
          <div class="input-group-append"><span class="input-group-text">TL</span></div>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend"><span class="input-group-text">Ürün Stok</span></div>
          <input type="text" name="urunstok" class="form-control" value="<?php echo $veriyigoster['urunstok']; ?>">
          <div class="input-group-append"><span class="input-group-text">Adet</span></div>
        </div>
      </div>
      <div class="col-xl-12 col-sm-12 mb-3">
        <hr>
        <a href="?sayfa=urunler" class="btn btn-danger pull-left">Geri Dön</a>
        <button type="submit" name="Gonder" class="btn btn-success float-right">Kaydet</button>
      </div>
    </div>
  </form>
</div>
