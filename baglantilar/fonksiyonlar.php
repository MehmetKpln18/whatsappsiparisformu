<?php 
$ayarlarcek = $conn -> prepare("SELECT * FROM ayarlar where id = 1");
$ayarlarcek->bindParam(1, $_GET['id']);
$ayarlarcek-> execute();
$ayarlargoster = $ayarlarcek -> fetch(PDO::FETCH_ASSOC);
?>

<?php
trait URL {
  private $url = '';
  private $current_url = '';
  public $get = '';
  function __construct()
  {
    $this->url = $_SERVER['SERVER_NAME'];
    $this->current_url = $_SERVER['REQUEST_URI'];
    $clean_server = str_replace('', $this->url, $this->current_url);
    $clean_server = explode('/', $clean_server);
    $this->get = array('base_url' => "/".$clean_server[1]);
  }
}
class Home
{
  use URL;
}
$h = new Home();
?>

<?php
function SayfaGetir(){
  if(isset($_GET['sayfa'])){
    switch ($_GET['sayfa']) {
      case 'anasayfa': include('./sayfalar/anasayfa.php'); break;
      case 'destekolustur': include('./sayfalar/destekolustur.php'); break;
      case 'siparisolustur': include('./sayfalar/siparisolustur.php'); break;
      default: include('./sayfalar/404.php'); break;
    }
  }else{
    include('./sayfalar/anasayfa.php');
  }
}

function Duyuru()
{
  require('database.php'); 
  $duyurularsorgu = $conn->prepare("SELECT * FROM duyurular order by ID desc limit 1");
  $duyurularsorgu->execute();
  while ($duyurularcikti = $duyurularsorgu->fetch()) {
    $tarih = $duyurularcikti['tarih'];
    $dtarih = date("d F Y",strtotime($tarih));
    $ing_aylar = array("January","February","March","May","April","June","July","August","September","October","November","December");
    $tr_aylar = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
    $dztarih = str_replace($ing_aylar,$tr_aylar,$dtarih);
    echo '<div class="alert alert-warning"><i class="fas fa-fw fa-bullhorn"></i> Duyuru : ' . $duyurularcikti["icerik"] . ' <span class="float-right d-none d-sm-block">' . $dztarih . '</span></div>';
  }
}
?>

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