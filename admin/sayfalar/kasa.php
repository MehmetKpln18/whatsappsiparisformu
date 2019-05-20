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
    <li class="breadcrumb-item active">Kasa</li>
  </ol>
  <div class="row">
    <div class="col-xl-12 col-sm-12 mb-3">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <th>Ürün</th>
            <th>Birim Fiyat</th>
            <th>Adet</th>
            <th>Toplam</th>
          </thead>
          <tbody>
            <?php
            $verial1 = $conn -> prepare("SELECT * FROM urunler");
            $verial1 -> execute();
            while ($urungoster = $verial1 -> fetch(PDO::FETCH_ASSOC)){
              $sayi1  = $urungoster['urunfiyat'];
              $sayi2  = $urungoster['urunstok'];
              $carp  = $sayi1 * $sayi2;
              echo '
              <tr>
              <td><strong>'.$urungoster['urunbaslik'].'</strong></td>
              <td class="bg-secondary text-white">'.$urungoster['urunfiyat'].' TL</td> 
              <td class="bg-secondary text-white">'.$urungoster['urunstok'].'</td>
              <td class="bg-secondary text-white">'.$carp.'</td>
              </tr>
              ';
            }
            ?>
          </tbody>
          <tfoot>
            <?php 
            $query = $conn -> query("SELECT SUM(urunfiyat*urunstok) FROM urunler")->fetch(); 
            $row = $query; 
            echo '<tr><th class="text-right">STOKTAKİ ÜRÜNLERİN TOPLAM FİYATLARI</th><th colspan="3">'.$row['SUM(urunfiyat*urunstok)'].' TL</th></tr>';
            ?>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>