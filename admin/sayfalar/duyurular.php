<?php session_start(); ob_start(); ?>
<?php include 'baglantilar/database.php'; ?>
<?php
if( isset($_SESSION['yonetici']) && !empty($_SESSION['yonetici']) ){
  $records = $conn->prepare('SELECT * FROM yoneticiler WHERE id = :id');
  $records->bindParam(':id', $_SESSION['yonetici']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);
  $user = NULL;
  if( count($results) > 0){ $user = $results; }
}
else { header("Location: giris.php"); die(); }
?>

<?php
if (isset($_GET['id'])) {
  $numaras = $_GET['id']; 
  $sil = $conn -> prepare("DELETE FROM duyurular where id = :id");
  $sil->bindParam(':id', $_GET['id']);
  $sil-> execute();
  if($sil){
    $mesaj = '<meta http-equiv="refresh" content="2;URL=?sayfa=duyurular">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Duyuru Başarı İle Silindi. 2 Saniye İçinde Yönlendiriliyorsunuz</strong>
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
    <li class="breadcrumb-item active">Duyurular</li>
  </ol>
  <div class="row">
    <div class="col-xl-12 col-sm-6 mb-3">
      <div class="message"></div>
      <?php if(!empty($mesaj)): ?>
        <p><?= $mesaj ?></p>
      <?php endif; ?>
      <div class="alert alert-info">
        <?php
        $sorgu = $conn->prepare("SELECT COUNT(*) FROM duyurular");
        $sorgu -> execute();
        $say = $sorgu->fetchColumn();
        echo 'Sistemde <b>'.$say.'</b> duyuru bulunmaktadır.';
        ?>
        <a class="btn-success btn-sm float-right mb-3" href="?sayfa=duyuruekle">Duyuru Ekle</a>
      </div>
      <?php
      $verial1 = $conn -> prepare("SELECT * FROM duyurular");
      $verial1-> execute();
      while ($duyurugoster = $verial1 -> fetch(PDO::FETCH_ASSOC)){
        echo '<div class="alert alert-warning"><i class="fas fa-fw fa-bullhorn"></i> '.$duyurugoster['baslik'].' - Duyuru : '.$duyurugoster['icerik'].'
        <div class="btn-group float-right">
        <a href="?sayfa=duyurugoruntule&id='.$duyurugoster['id'].'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
        <a href="?sayfa=duyurular&id='.$duyurugoster['id'].'" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
        </div></div>
        ';
      }
      ?>
    </div>
  </div>
</div>