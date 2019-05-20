<?php
$cekilecek_text="https://www.mehmetkaplan.net/lisans.txt";
if (!function_exists("file")) { die("<strong><a href='http://www.php.net/file'>file</a></strong> fonksiyonu sunucuda yüklü olmalıdır<br /> fonction <strong><a href='http://www.php.net/file'>file</a></strong> must be installed on the server"); } 
function soullisanskontrol() {
  if (substr($_SERVER['HTTP_HOST'], 0, 4) == "www.") {
  $domainadi = substr($_SERVER['HTTP_HOST'], 4);
  } else {
  $domainadi = $_SERVER['HTTP_HOST'];
  }
return $domainadi;
}
$alanadi=soullisanskontrol();
$lisanstext=file($cekilecek_text,FILE_IGNORE_NEW_LINES);
$lisans=array(); 
foreach($lisanstext as $sayi => $cekveri) {
$lisans[$sayi]=rtrim($cekveri,"\r\n");
}
if (!in_array($alanadi,$lisans)) { 
header("location:https://mehmetkaplan.net/lisanssiz.html"); exit; 
}
?>