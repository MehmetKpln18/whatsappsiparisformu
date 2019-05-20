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
$vericek = $conn -> prepare("SELECT * FROM duyurular where id = :id");
$vericek->bindParam(':id', $_GET['id']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>

<?php
if (isset($_POST["Gonder"])) {
  $ids = $_GET['id'];
  $baslik = $_POST['baslik'];
  $icerik = $_POST['icerik'];
  $guncelle = $conn -> prepare("UPDATE duyurular SET baslik=:baslik, icerik=:icerik WHERE id=:id");
  $guncelle->bindParam(':id', $ids);
  $guncelle->bindParam(':baslik', $baslik);
  $guncelle->bindParam(':icerik', $icerik);
  $guncelle-> execute(); 
  if($guncelle){
    echo '<meta http-equiv="refresh" content="2;URL=?sayfa=duyurular">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Başarı İle Düzenlendi. 2 Saniye İçinde Yönlendiriliyorsunuz...</strong>
    </div>';
  }else{
    echo '<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Hata Oluştu !</strong>
    </div>';
  }
}
?>

<?php
if (isset($_GET['numaram'])) {
  $numaras = $_GET['numaram'];  
  $urunsil = $conn -> prepare("DELETE FROM duyurular where id = :id");
  $urunsil->bindParam(':id', $_GET['numaram']);
  $urunsil-> execute();
  if($urunsil){
    echo '<meta http-equiv="refresh" content="2;URL=?sayfa=duyurular">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Ürün Başarı İle Silindi. 2 Saniye İçinde Yönlendiriliyorsunuz</strong>
    </div>';
  }else{
    echo '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Hata Oluştu !</strong>
    </div>';
  }  
} 
?>

<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
    <li class="breadcrumb-item"><a href="?sayfa=duyurular">Duyuru Düzenle</a></li>
    <li class="breadcrumb-item active"><?php echo $veriyigoster['baslik']; ?></li>
  </ol>
  <div class="row">
    <div class="col-xl-12 col-sm-6 mb-3">
      <form action="" method="post">
        <div class="message"></div>
        <div class="deploy">
          <div class="form-group">
            <label for="inputEmail3" class="">Duyuru Başlığı</label>
            <input type="text" name="baslik" class="form-control" id="baslik" value="<?php echo $veriyigoster['baslik']; ?>">
            <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $_GET['id']; ?>">
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="">Duyuru İçeriği</label>
            <input type="text" name="icerik" class="form-control" id="icerik" value="<?php echo $veriyigoster['icerik']; ?>">
          </div>
        </div>   
        <hr>
        <a href="?sayfa=duyurular" class="btn btn-danger pull-left">Geri Dön</a>
        <button type="submit" name="Gonder" class="btn btn-success float-right">Kaydet</button>
      </form>
    </div>
  </div>
</div>