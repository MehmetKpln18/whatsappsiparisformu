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
$vericek = $conn -> prepare("SELECT * FROM siparistalepleri where id = :id");
$vericek->bindParam(':id', $_GET['id']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>
<?php
if (isset($_GET['id'])) {
  $numaras = $_GET['id']; 
  $sil = $conn -> prepare("DELETE FROM siparistalepleri where id = :id");
  $sil->bindParam(':id', $_GET['id']);
  $sil-> execute();
  if($sil){
    echo '<meta http-equiv="refresh" content="2;URL=?sayfa=siparistalepleri">
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
    <li class="breadcrumb-item"><a href="?sayfa=siparistalepleri">Siparişler</a></li>
    <li class="breadcrumb-item active">Yeni Siparişler</li>
  </ol>
  <div class="row">
    <div class="col-xl-12 col-sm-6 mb-3">
      <div class="table-responsive">
        <table class="table table-bordered">
          <tbody>
            <?php
            $verial1 = $conn -> prepare("SELECT * FROM siparistalepleri");
            $verial1-> execute();
            while ($siparistalepleri = $verial1 -> fetch(PDO::FETCH_ASSOC)){
              if($siparistalepleri["yoneticicevap"]=='Yeni') {
                echo ' 
                <tr><td><span class="badge badge-success">'.$siparistalepleri['yoneticicevap'].'</span></td>
                <td>Ürün: '.$siparistalepleri['urun'].' - Eposta: '.$siparistalepleri['eposta'].' - '.$siparistalepleri['telefon'].'</td>
                <td>'.$siparistalepleri['tarih'].' </td>
                <td><span style="float: right;"><a href="?sayfa=siparisgoruntule&id='.$siparistalepleri['id'].'" class="btn-success btn-sm">Hemen Yönet</a>&nbsp; <a href="?sayfa=siparistalepleri&id='.$siparistalepleri['id'].'" class="btn-success btn-sm">Hemen Sil</a></td>
                </tr>
                ';
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>