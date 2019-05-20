<?php session_start(); ob_start(); ?>
<?php include 'baglantilar/database.php'; ?>
<?php
$sayilar[]="";
$i=0;
$kac_sayi_uretilecek=1;
while($i<$kac_sayi_uretilecek)
{
  $rastgele=rand(1,900); 
  if (in_array($rastgele,$sayilar)) 
    {continue;} 
  else 
    {$sayilar[]=$rastgele; 
      $i++;
    }
  }
  foreach ($sayilar as $sayilar_ekrana);

  if (isset($_POST["Gonder"])) {  
    $gonderenid = $sayilar_ekrana;
    $isim = $_POST['isim'];
    $baslik = $_POST['baslik'];
    $eposta = $_POST['eposta'];
    $kullanicicevap = $_POST['kullanicicevap'];
    $yoneticicevap = 'Yonetici Mesaji Bekleniyor !';
    $durum = '1';
    $sql = "INSERT INTO destektalepleri (alanid, isim, baslik, eposta, kullanicicevap, yoneticicevap, durum) VALUES (:alanid, :isim, :baslik, :eposta, :kullanicicevap, :yoneticicevap, :durum)";
    $gonder = $conn->prepare($sql);
    $gonder->bindParam(':isim', $isim);
    $gonder->bindParam(':alanid', $gonderenid);
    $gonder->bindParam(':baslik', $baslik);
    $gonder->bindParam(':eposta', $eposta);
    $gonder->bindParam(':kullanicicevap', $kullanicicevap);
    $gonder->bindParam(':yoneticicevap', $yoneticicevap);
    $gonder->bindParam(':durum', $durum);
    $gonder->execute();
    if($gonder){
      $mesaj = '<div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Destek talebi başarı ile oluşturuldu.</strong>
      </div>';
    }else{
      $mesaj = '<div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Talep başarısız !</strong>
      </div>';
    }
  }
  ?>
  <?php 
  $vericek = $conn -> prepare("SELECT * FROM ayarlar where id = 1");
  $vericek->bindParam(1, $_GET['id']);
  $vericek-> execute();
  $veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
  ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <form action="" method="post">
          <div class="message"></div>
          <?php if(!empty($mesaj)): ?>
            <p><?= $mesaj ?></p>
          <?php endif; ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="font-weight-bold">Adınız ve Soyadınız</label>
                <input type="text" name="isim" id="isim" class="form-control" value="Örnek: Mehmet Kaplan" autocapitalize="off">
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Eposta Adresiniz</label>
                <input type="text" name="eposta" id="eposta" class="form-control" value="Örnek: örnek@deneme.com" autocapitalize="off">
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Başlığınız</label>
                <input type="text" name="baslik" id="baslik" class="form-control" value="Örnek: Merhaba Destek Sağlarmısınız." autocapitalize="off">
              </div>
              <div class="form-group">
                <label class="font-weight-bold">Sorunuz</label>
                <input type="text" name="kullanicicevap" id="kullanicicevap" class="form-control" value="Örnek: Merhaba Nasıl Sipariş Vereceğim." autocapitalize="off">
              </div>
              <div class="form-group">
                <button type="submit" name="Gonder" class="btn btn-primary btn-round">
                  Hemen Destek Talebi Oluştur !
                </button>
              </div>
              <div class="col-md-6">
              </div>
            </div>
            <div class="col-md-6">
              <label class="font-weight-bold">İletişim Bilgileri</label>
              <div class="card">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><b style="width:150px;display: inline-block;">Telefon</b>: <?php echo $veriyigoster['site_telefon']; ?></li>
                  <li class="list-group-item"><b style="width:150px;display: inline-block;">Fax</b>: <?php echo $veriyigoster['site_fax']; ?></li>
                  <li class="list-group-item"><b style="width:150px;display: inline-block;">Çalışma Saatleri</b>: <?php echo $veriyigoster['site_calsaat']; ?></li>
                  <li class="list-group-item"><b style="width:150px;display: inline-block;">E-posta</b>: <?php echo $veriyigoster['site_eposta']; ?></li>
                  <li class="list-group-item"><b style="width:150px;display: inline-block;">Adres</b>: <?php echo $veriyigoster['site_adres']; ?></li>
                </ul>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
