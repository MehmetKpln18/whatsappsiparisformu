<?php session_start(); ob_start(); ?>
<?php include 'baglantilar/database.php'; ?>
<?php include 'baglantilar/fonksiyonlar.php'; ?>
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
function SayfaGetir(){
  if(isset($_GET['sayfa'])){
    switch ($_GET['sayfa']) {
      case 'anasayfa': include('sayfalar/anasayfa.php'); break;
      case 'siparistalepleri': include('sayfalar/siparistalepleri.php'); break;
      case 'siparisgoruntule': include('sayfalar/siparisgoruntule.php'); break;
      case 'yenisiparis': include('sayfalar/siparisyeni.php'); break;
      case 'onaylisiparis': include('sayfalar/siparisonayli.php'); break;
      case 'hazirsiparis': include('sayfalar/siparishazir.php'); break;
      case 'kargosiparis': include('sayfalar/sipariskargo.php'); break;
      case 'teslimsiparis': include('sayfalar/siparisteslim.php'); break;
      case 'iptalsiparis': include('sayfalar/siparisiptal.php'); break;
      case 'hesabim': include('sayfalar/hesabim.php'); break;
      case 'kasa': include('sayfalar/kasa.php'); break;
      case 'duyurular': include('sayfalar/duyurular.php'); break;
      case 'duyuruekle': include('sayfalar/duyuruekle.php'); break;
      case 'duyurugoruntule': include('sayfalar/duyuruduzenle.php'); break;
      case 'urunler': include('sayfalar/urunler.php'); break;
      case 'urunekle': include('sayfalar/urunekle.php'); break;
      case 'urungoruntule': include('sayfalar/urunduzenle.php'); break;
      case 'destektalepleri': include('sayfalar/destektalepleri.php'); break;
      case 'destekgoruntule': include('sayfalar/destekgoruntule.php'); break;
      case 'ayarlar': include('sayfalar/siteayarlari.php'); break;
      default: include('sayfalar/404.php'); break;
    }
  }else{
    include('sayfalar/anasayfa.php');
  }
}
?>
<?php 
$vericek = $conn -> prepare("SELECT * FROM ayarlar where id = 1");
$vericek->bindParam(1, $_GET['id']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $veriyigoster['site_title']; ?> | Yönetim Paneli</title>
  <link rel="shortcut icon" type="image/png" href="assets/resim/favicon/<?php echo $veriyigoster['site_favicon']; ?>"/>
  <meta name="description" content="<?php echo $veriyigoster['site_description']; ?>">
  <meta name="keywords" content="<?php echo $veriyigoster['site_keywords']; ?>">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="assets/css/sb-admin.css" rel="stylesheet">
  <link href="assets/css/color-skins.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body id="page-top" class="sidebar-toggled">
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top ">
    <a class="navbar-brand mr-1" href="?sayfa=anasayfa">Yönetim Paneli</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <div class="input-group-append">
        </div>
      </div>
    </form>
    <ul class="navbar-nav ml-auto ml-md-0 float-right">

      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="Siparistalepleri" data-toggle="dropdown">
          <i class="fas fa-bell fa-shopping-cart"></i>
            <?php
            $sor = $conn -> prepare("SELECT COUNT(*) FROM siparistalepleri WHERE yoneticicevap='yeni'");
            $sor -> execute();
            $say = $sor -> fetchColumn();
            if ($say == 0) {
            } else {
              echo '<span class="badge badge-success">'.$say.'</span>';
            }
            ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Siparistalepleri">
          <span class="dropdown-header">Yeni Siparişler</span>
          <div class="dropdown-divider"></div>
          <div class="dropdown-item">
            <div class="list-group">
              <?php
              $sorgu = $conn->prepare("SELECT * FROM siparistalepleri WHERE yoneticicevap='yeni'");
              $sorgu->execute();
              while ($siparis = $sorgu -> fetch(PDO::FETCH_ASSOC)){
                if($siparis["yoneticicevap"]=='Yeni') {
                  echo '<a href="?sayfa=siparisgoruntule&id='.$siparis['id'].'" class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1 badge badge-success">'.$siparis['yoneticicevap'].'</h5>
                  <small>' . $siparis["tarih"] . '</small>
                  </div>
                  <p class="mb-1">' . $siparis["urun"] . ' - ' . $siparis["telefon"] . '</p>
                  <small>' . $siparis["kullanicinot"] . '</small>
                  </a>';
                }
              }
              ?>
            </div>
          </div>
          <div class="dropdown-divider"></div>
        </div>
      </li>

      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="Destektalepleri" data-toggle="dropdown">
          <i class="fas fa-bell fa-fw"></i>
            <?php
            $sor = $conn -> prepare("SELECT COUNT(*) FROM destektalepleri WHERE durum=1");
            $sor -> execute();
            $say = $sor -> fetchColumn();
            if ($say == 0) {
            } else {
              echo '<span class="badge badge-danger">'.$say.'</span>';
            }
            ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Destektalepleri">
          <span class="dropdown-header">Yeni Destek Talepleri</span>
          <div class="dropdown-divider"></div>
          <div class="dropdown-item">
            <div class="list-group">
              <?php
              $cek = $conn->prepare("SELECT * FROM destektalepleri WHERE durum=1");
              $cek->execute();
              while ($destek = $cek -> fetch(PDO::FETCH_ASSOC)){
                if($destek["durum"]==1) {
                  echo '<a href="?sayfa=destekgoruntule&id='.$destek['id'].'" class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">'.$destek['baslik'].'</h5>
                  <small>' . $destek["tarih"] . '</small>
                  </div>
                  <p class="mb-1">' . $destek["isim"] . ' - ' . $destek["eposta"] . '</p>
                  <small>' . $destek["kullanicicevap"] . '</small>
                  </a>';
                }
              }
              ?>
            </div>
          </div>
          <div class="dropdown-divider"></div>
        </div>
      </li>

      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="../index.php">
          <i class="fas fa-eye fa-fw"></i>
        </a>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="?sayfa=hesabim">Hesabım</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cikisModal">Çıkış Yap</a>
        </div>
      </li>
    </ul>
  </nav>
  <div id="wrapper">
    <ul class="sidebar navbar-nav toggled">
      <li class="nav-item active">
        <a class="nav-link" href="?sayfa=anasayfa">
          <i class="fas fa-fw fa-home"></i>
          <span>Ana Sayfa</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Siparişler</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="?sayfa=siparistalepleri">Tüm Siparişler</a>
          <a class="dropdown-item" href="?sayfa=yenisiparis">Yeni Siparişler</a>
          <a class="dropdown-item" href="?sayfa=onaylisiparis">Onaylı Siparişler</a>
          <a class="dropdown-item" href="?sayfa=hazirsiparis">Hazır Siparişler</a>
          <a class="dropdown-item" href="?sayfa=kargosiparis">Kargolanmış Siparişler</a>
          <a class="dropdown-item" href="?sayfa=teslimsiparis">Teslim Edilen Siparişler</a>
          <a class="dropdown-item" href="?sayfa=iptalsiparis">İptal Edilen Siparişler</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-box-open"></i>
          <span>Ürünler</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="?sayfa=urunler">Ürün Listesi</a>
          <a class="dropdown-item" href="?sayfa=urunekle">Ürün Ekle</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-bullhorn"></i>
          <span>Duyurular</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="?sayfa=duyurular">Duyuru Listesi</a>
          <a class="dropdown-item" href="?sayfa=duyuruekle">Duyuru Ekle</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?sayfa=kasa">
          <i class="fas fa-fw fa-wallet"></i>
          <span>Kasa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?sayfa=destektalepleri">
          <i class="fas fa-fw fa-life-ring"></i>
          <span>Destek Talepleri</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?sayfa=hesabim">
          <i class="fas fa-fw fa-user"></i>
          <span>Yönetici</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?sayfa=ayarlar">
          <i class="fas fa-fw fa-cog"></i>
          <span>Site Ayarları</span>
        </a>
      </li>
    </ul>
    <div id="content-wrapper">
      <?php SayfaGetir(); ?>
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span><?php echo $veriyigoster['site_copright']; ?></span>
          </div>
          <div class="copyright text-center my-auto d-none">
            <span>Copyright © 2019 <a target="_blank" title="Mehmet Kaplan" href="https://www.mehmetkaplan.net/">Mehmet Kaplan</a> tarafından kodlanmıştır.</span>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <div class="modal fade" id="cikisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Çıkış Yap ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Mevcut oturumunuzu sonlandırmaya hazırsanız, aşağıdaki "Oturumu Kapat" ı seçin.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">İptal Et</button>
          <a class="btn btn-primary" href="cikis.php">Oturumu Kapat</a>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="assets/js/sb-admin.min.js"></script>
  <script src="assets/js/custom.js"></script>
  <script>
    $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });

      $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
        log = label;

        if( input.length ) {
          input.val(log);
        } else {
          if( log ) alert(log);
        }

      });
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
            $('#img-upload').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#imgInp").change(function(){
        readURL(this);
      });   
    });
  </script>
</body>
</html>
