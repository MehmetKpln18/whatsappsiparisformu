<?php session_start(); ob_start(); ?>
<?php include 'baglantilar/database.php'; ?>
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
<?php 
$vericek = $conn -> prepare("SELECT * FROM yoneticiler where id = 1");
$vericek->bindParam('1', $_SESSION['yonetici']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>
<?php 
$vericek = $conn -> prepare("SELECT * FROM yoneticiler where id = 1");
$vericek->bindParam('1', $_SESSION['yonetici']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>

<?php
$urun = $_POST["urun"];
$eposta = $_POST["eposta"];
$telefon = $_POST["telefon"];
$kullanicinot = $_POST["kullanicinot"];
$rand = rand(1,99999)
?>

<?php header("Location: https://api.whatsapp.com/send?phone=9" .$veriyigoster['telefon']. "&text=Merhaba sizden $urun hizmetinizi satın almak istiyorum. Emailim : $eposta - Telefonum :$telefon - Açıklamam: $kullanicinot - Banka Açıklamaya Yazılacak No: $rand"); ?>