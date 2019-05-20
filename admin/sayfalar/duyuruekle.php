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
  $baslik = $_POST['baslik'];
  $icerik = $_POST['icerik'];
  $yazar = $veriyigoster['adiniz'];
  $sql = "INSERT INTO duyurular (baslik, icerik, yazar) VALUES (:baslik, :icerik, :yazar)";
  $gonder = $conn->prepare($sql);
  $gonder->bindParam(':baslik', $baslik);
  $gonder->bindParam(':icerik', $icerik);
  $gonder->bindParam(':yazar', $yazar);
  $gonder->execute();
  if($gonder){
    echo '<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Duyuru Eklendi !</strong>
    </div>';
  }else{
    echo '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Başarısız !</strong>
    </div>';
  }
}
?>
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
    <li class="breadcrumb-item active">Duyuru Ekle</li>
  </ol>
  <div class="row">
    <div class="col-xl-12 col-sm-6 mb-3">
      <form action="" method="post">
        <div class="message"></div>
        <div class="deploy">
          <div class="form-group">
            <label for="inputEmail3" class="">Başlık</label>
            <input type="text" name="baslik" class="form-control" id="baslik" value="Başlık Giriniz">
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="">İçerik</label>
            <input type="text" name="icerik" class="form-control" id="icerik" value="İçerik Giriniz">
          </div>
        </div>   
        <hr>
        <a href="?sayfa=duyurular" class="btn btn-danger pull-left">Geri Dön</a>
        <button type="submit" name="Gonder" class="btn btn-success float-right">Oluştur</button>
      </form>
    </div>
  </div>
</div>