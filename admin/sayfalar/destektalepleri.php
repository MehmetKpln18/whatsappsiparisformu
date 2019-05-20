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
if (isset($_GET['id'])) {
  $numaras = $_GET['id']; 
  $sil = $conn -> prepare("DELETE FROM destektalepleri where id = :id");
  $sil->bindParam(':id', $_GET['id']);
  $sil-> execute();
  if($sil){
    echo '<meta http-equiv="refresh" content="2;URL=?sayfa=destektalepleri">
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
    <li class="breadcrumb-item active">Destek Talepleri</li>
  </ol>
  <div class="row">
    <div class="col-xl-12 col-sm-6 mb-3">
      <div class="table-responsive">
        <table class="table table-bordered">
          <tbody>
            <?php
            $verial1 = $conn -> prepare("SELECT * FROM destektalepleri");
            $verial1-> execute();
            while ($destektalepleri = $verial1 -> fetch(PDO::FETCH_ASSOC)){
              echo ' 
              <tr>
              <td>Başlık: '.$destektalepleri['baslik'].' - Gönderen İsim: '.$destektalepleri['isim'].'</td>
              <td>'.$destektalepleri['tarih'].' </td>
              <td><span style="float: right;"><a href="?sayfa=destekgoruntule&id='.$destektalepleri['id'].'" class="btn-success btn-sm">Hemen Yönet</a>&nbsp; <a href="?sayfa=destektalepleri&id='.$destektalepleri['id'].'" class="btn-success btn-sm">Hemen Sil</a></td>
              </tr>
              ';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>