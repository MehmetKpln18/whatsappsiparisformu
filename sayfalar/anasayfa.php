<?php session_start(); ob_start(); ?>
<?php include 'admin/baglantilar/database.php'; ?>
<?php
$sayilar[]="";
$i=0;
$kac_sayi_uretilecek=1;
while($i<$kac_sayi_uretilecek)
{
  $rastgele=rand(1,999); 
  if (in_array($rastgele,$sayilar)) 
    {continue;} 
  else 
    {$sayilar[]=$rastgele; 
      $i++;
    }
  }
  foreach ($sayilar as $uretilen_sayi);

  if (isset($_POST["Gonder"])) {  
    $gonderenid = $uretilen_sayi;
    $urun = $_POST['urun'];
    $eposta = $_POST['eposta'];
    $telefon = $_POST['telefon'];
    $kullanicinot = $_POST['kullanicinot'];
    $yoneticicevap = 'Yeni';
    $durum = '1';
    $sql = "INSERT INTO siparistalepleri (alanid, urun, eposta, telefon, kullanicinot, yoneticicevap, durum) VALUES (:alanid, :urun, :eposta, :telefon, :kullanicinot, :yoneticicevap, :durum)";
    $gonder = $conn->prepare($sql);
    $gonder->bindParam(':alanid', $gonderenid);
    $gonder->bindParam(':urun', $urun);
    $gonder->bindParam(':eposta', $eposta);
    $gonder->bindParam(':telefon', $telefon);
    $gonder->bindParam(':kullanicinot', $kullanicinot);
    $gonder->bindParam(':yoneticicevap', $yoneticicevap);
    $gonder->bindParam(':durum', $durum);
    $gonder->execute();
    if($gonder){
      $mesaj = '<div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Sipariş talebi başarı ile oluşturuldu.</strong>
      </div>';
    }else{
      $mesaj = '<div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Talep başarısız !</strong>
      </div>';
    }
  }
  ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <form action="" name="Form1" method="post">
          <div class="message"></div>
          <?php if(!empty($mesaj)): ?>
            <p><?= $mesaj ?></p>
          <?php endif; ?>

          <?php
          $verial1 = $conn -> prepare("SELECT * FROM ayarlar");
          $verial1-> execute();
          while ($ayarlar = $verial1 -> fetch(PDO::FETCH_ASSOC)){
            if($ayarlar["site_gorunum"]=='1') {
              echo ''?>
              <div class="row">
                <div class="col-md-7">
                  <div class="testimonials">
                    <div class="row">
                      <div class="col-sm-12">
                        <div id="customers-testimonials" class="owl-carousel">
                          <?php
                          $verial1 = $conn -> prepare("SELECT * FROM urunler");
                          $verial1-> execute();
                          while ($urungoster = $verial1 -> fetch(PDO::FETCH_ASSOC)){
                            echo '
                            <div class="item">
                            <div class="shadow-effect">
                            <img src="admin/assets/resim/'.$urungoster['urunresim'].'" alt="'.$urungoster['urunbaslik'].'">
                            <div class="item-details">
                            <h5>'.$urungoster['urunbaslik'].'<span class="badge">'.$urungoster['urunfiyat'].' <i class="fas fa-lira-sign"></i></span></h5>
                            <span>'.$urungoster['urunicerik'].'</span>
                            </div>
                            </div>
                            </div>
                            ';
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <select class='form-control' name='urun' id='urun'>
                      <?php
                      try {
                        $sorgu = $conn->prepare("SELECT id,urunbaslik,urunfiyat,urunresim FROM urunler");
                        $sorgu->execute();
                        while ($cikti = $sorgu->fetch()) {
                          $html .= "<option class='form-control' value='" . $cikti['urunbaslik'] . "'>" . $cikti['urunbaslik'] . " - " . $cikti['urunfiyat'] . " TL</option>";
                        }
                        echo $html;
                      } catch (PDOException $e) {
                        die($e->getMessage());
                      }
                      $conn = null;
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" name="eposta" id="eposta" class="form-control" value="örnek@deneme.com">
                  </div>
                  <div class="form-group">
                    <input type="text" name="telefon" id="telefon" class="form-control" value="05554444444">
                  </div>
                  <div class="form-group">
                    <textarea name="kullanicinot" id="kullanicinot" class="form-control" placeholder="Kırmızı tercihim." style="width: 100%; height: 135px;"></textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="Gonder" class="btn btn-block btn-primary btn-round" onclick="OnButton1();">
                      Sipariş Ver
                    </button>
                  </div>
                </div>
              </div>
              <?php
            }
            if($ayarlar["site_gorunum"]=='2') {
              echo ''?>
              <h2 class="text-center">Sipariş Formu</h2>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <select class='form-control' name='urun' id='urun'>
                      <?php
                      try {
                        $sorgu = $conn->prepare("SELECT id,urunbaslik,urunfiyat FROM urunler");
                        $sorgu->execute();
                        while ($cikti = $sorgu->fetch()) {
                          $html .= "<option class='form-control' value='" . $cikti['urunbaslik'] . "'>" . $cikti['urunbaslik'] . " - <i class='fa fa-try'></i> " . $cikti['urunfiyat'] . "</option>";
                        }
                        echo $html;
                      } catch (PDOException $e) {
                        die($e->getMessage());
                      }
                      $conn = null;
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" name="eposta" id="eposta" class="form-control" value="örnek@deneme.com">
                  </div>
                  <div class="form-group">
                    <input type="text" name="telefon" id="telefon" class="form-control" value="05554444444">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea name="kullanicinot" id="kullanicinot" class="form-control" placeholder="Kırmızı tercihim." style="width: 100%; height: 150px;"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" name="Gonder" class="btn btn-primary btn-round" onclick="OnButton1();">
                      Sipariş Ver
                    </button>
                  </div>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </form>
      </div>
    </div>
  </div>

  <script language="javascript">
    function OnButton1()
    {
      document.Form1.action = "siparis.php"
      document.Form1.target = "iframe1";
      document.Form1.submit();
      return true;
    }
  </script>
