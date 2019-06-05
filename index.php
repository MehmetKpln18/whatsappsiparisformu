<?php session_start(); ob_start(); ?>
<?php include 'admin/baglantilar/database.php'; ?>
<?php include 'baglantilar/fonksiyonlar.php'; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $ayarlargoster['site_title']; ?></title>
	<link rel="shortcut icon" type="image/png" href="admin/assets/resim/favicon/<?php echo $ayarlargoster['site_favicon']; ?>"/>
	<meta name="description" content="<?php echo $ayarlargoster['site_description']; ?>">
	<meta name="keywords" content="<?php echo $ayarlargoster['site_keywords']; ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
	<link rel="stylesheet" href="admin/assets/css/sb-admin.css">
	<link rel="stylesheet" href="admin/assets/css/main.css">
	<link rel="stylesheet" href="admin/assets/vendor/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="admin/assets/css/custom.css">
	<?php echo $ayarlargoster['site_analytics']; ?>
</head>
<body id="page-top" class="theme-purple">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
		<a href="?sayfa=anasayfa" class="navbar-brand" title="Site Slogan"><?php echo $ayarlargoster['site_slogan']; ?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="active"><a href="?sayfa=anasayfa" class="nav-link" title="Ana Sayfa"><i class="fa fa-home"></i> Anasayfa</a></li>
				<li><a href="?sayfa=destekolustur" class="nav-link" title="Destek Talebi"><i class="fas fa-life-ring"></i> Destek Talebi</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 pt-3">
				<?php Duyuru(); ?>
			</div>
			<?php SayfaGetir(); ?>
			<footer class="sticky-footer2">
				<div class="container my-auto">
					<div class="copyright my-auto">
						<div class="row">
							<div class="col-lg-6 col-sm-12 pt-3">
								<span><?php echo $ayarlargoster['site_copright']; ?></span>
							</div>
							<div class="col-lg-6 col-sm-12 text-right">
								<div class="sosyal">
									<a href="<?php echo $ayarlargoster['site_facebook']; ?>" title="Facebook'tan Takip Et"><span>Facebook</span></a>
									<a href="<?php echo $ayarlargoster['site_twitter']; ?>" title="Twitter'dan Takip Et"><span>Twitter</span></a>
									<a href="<?php echo $ayarlargoster['site_instagram']; ?>" title="İnstagram'dan Takip Et"><span>İnstagram</span></a>
									<a href="<?=$h->get['base_url']?>/admin" title="Admin Paneli"><span>Admin</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>
		<a href="#page-top" class="scroll-to-top rounded" title="Yukarı Çık">
			<i class="fas fa-angle-up"></i>
		</a>
		<script src="admin/assets/js/sb-admin.min.js"></script>
		<script src="admin/assets/vendor/jquery/jquery.min.js"></script>
		<script src="admin/assets/vendor/owl-carousel/owl.carousel.min.js"></script>
		<script src="admin/assets/js/custom.js"></script>
	</body>
	</html>
