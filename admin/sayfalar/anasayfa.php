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

<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
  </ol>
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-life-ring"></i>
          </div>
          <div class="mr-5">
            <?php
            $sorgu = $conn->prepare("SELECT COUNT(*) FROM destektalepleri");
            $sorgu->execute();
            $say = $sorgu->fetchColumn();
            echo '<b>'.$say.'</b> adet destek talebi !';
            ?>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="?sayfa=destektalepleri">
          <span class="float-left">Detaylar</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-warning o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-shopping-cart"></i>
          </div>
          <div class="mr-5">
            <?php
            $sorgu = $conn->prepare("SELECT COUNT(*) FROM siparistalepleri");
            $sorgu->execute();
            $say = $sorgu->fetchColumn();
            echo '<b>'.$say.'</b> adet sipariş talebi !';
            ?>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="?sayfa=siparistalepleri">
          <span class="float-left">Detaylar</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-success o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-box-open"></i>
          </div>
          <div class="mr-5">
            <?php
            $sorgu = $conn->prepare("SELECT COUNT(*) FROM urunler");
            $sorgu->execute();
            $say = $sorgu->fetchColumn();
            echo '<b>'.$say.'</b> adet ürün mevcut';
            ?>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="?sayfa=urunler">
          <span class="float-left">Detaylar</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-danger o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-bullhorn"></i>
          </div>
          <div class="mr-5">
            <?php
            $sorgu = $conn->prepare("SELECT COUNT(*) FROM duyurular");
            $sorgu->execute();
            $say = $sorgu->fetchColumn();
            echo '<b>'.$say.'</b> adet duyuru eklendi';
            ?>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="?sayfa=duyurular">
          <span class="float-left">Detaylar</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-6 col-sm-6 mb-3">
      <div class="card mb-3">
        <div class="card-header"><i class="fas fa-fw fa-shopping-cart"></i> Siparişler</div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Durum</th>
                <th>Sipariş</th>
                <th>Telefon</th>
                <th class="text-right">#</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sorgu = $conn->prepare("SELECT * FROM siparistalepleri order by ID desc limit 5");
              $sorgu->execute();
              while ($siparis = $sorgu -> fetch(PDO::FETCH_ASSOC)){
                if($siparis["yoneticicevap"]=='Yeni') {
                  echo '<tr><td><span class="badge badge-success">'.$siparis['yoneticicevap'].'</span></td><td>' . $siparis["urun"] . '</td><td>' . $siparis["telefon"] . '</td><td class="text-right"><a href="?sayfa=siparisgoruntule&id='.$siparis['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
                if($siparis["yoneticicevap"]=='Onaylı') {
                  echo '<tr><td><span class="badge badge-warning">'.$siparis['yoneticicevap'].'</span></td><td>' . $siparis["urun"] . '</td><td>' . $siparis["telefon"] . '</td><td class="text-right"><a href="?sayfa=siparisgoruntule&id='.$siparis['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
                if($siparis["yoneticicevap"]=='Hazır') {
                  echo '<tr><td><span class="badge badge-primary">'.$siparis['yoneticicevap'].'</span></td><td>' . $siparis["urun"] . '</td><td>' . $siparis["telefon"] . '</td><td class="text-right"><a href="?sayfa=siparisgoruntule&id='.$siparis['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
                if($siparis["yoneticicevap"]=='Kargo') {
                  echo '<tr><td><span class="badge badge-danger">'.$siparis['yoneticicevap'].'</span></td><td>' . $siparis["urun"] . '</td><td>' . $siparis["telefon"] . '</td><td class="text-right"><a href="?sayfa=siparisgoruntule&id='.$siparis['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
                if($siparis["yoneticicevap"]=='Teslim') {
                  echo '<tr><td><span class="badge badge-dark">'.$siparis['yoneticicevap'].'</span></td><td>' . $siparis["urun"] . '</td><td>' . $siparis["telefon"] . '</td><td class="text-right"><a href="?sayfa=siparisgoruntule&id='.$siparis['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
                if($siparis["yoneticicevap"]=='İptal') {
                  echo '<tr><td><span class="badge badge-secondary">'.$siparis['yoneticicevap'].'</span></td><td>' . $siparis["urun"] . '</td><td>' . $siparis["telefon"] . '</td><td class="text-right"><a href="?sayfa=siparisgoruntule&id='.$siparis['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer small text-muted">İlk 5 Sipariş Listelenir.</div>
      </div>
    </div>
    <div class="col-xl-6 col-sm-6 mb-3">
      <div class="card mb-3">
        <div class="card-header"><i class="fas fa-fw fa-box-open"></i> Ürünler</div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Ürün</th>
                <th>Fiyat</th>
                <th>Stok</th>
                <th class="text-right">#</th>
              </tr>
            </thead>
            <tbody>
              <?php
              try {
                $sorgu = $conn->prepare("SELECT * FROM urunler order by ID desc limit 5");
                $sorgu->execute();
                while ($veri = $sorgu->fetch()) {
                  $goster .= '<tr>
                  <td>
                  <span data-toggle="tooltip" data-html="true" title="<img src=&quot;assets/resim/'.$veri['urunresim'].'&quot; width=&quot;150px&quot;>">' . $veri["urunbaslik"] . '</span>
                  </td>
                  <td>' . $veri["urunfiyat"] . 'TL </td><td>' . $veri["urunstok"] . ' Adet</td><td class="text-right"><a href="?sayfa=urungoruntule&id='.$veri['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
                echo $goster;
              } catch (PDOException $e) {
                die($e->getMessage());
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer small text-muted">Son 5 Ürün Listelenir.</div>
      </div>
    </div>
  </div>
</div>