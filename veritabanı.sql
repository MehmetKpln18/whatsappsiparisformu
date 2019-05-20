-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 20 May 2019, 23:45:29
-- Sunucu sürümü: 10.0.38-MariaDB
-- PHP Sürümü: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `mehmetk6_siparisformu`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_title` text NOT NULL,
  `site_favicon` varchar(255) NOT NULL,
  `site_slogan` text NOT NULL,
  `site_description` text NOT NULL,
  `site_keywords` text NOT NULL,
  `site_copright` varchar(255) NOT NULL,
  `site_facebook` varchar(255) NOT NULL,
  `site_twitter` varchar(255) NOT NULL,
  `site_instagram` varchar(255) NOT NULL,
  `site_analytics` text NOT NULL,
  `site_telefon` varchar(255) NOT NULL,
  `site_fax` varchar(255) NOT NULL,
  `site_calsaat` text NOT NULL,
  `site_eposta` text NOT NULL,
  `site_adres` text NOT NULL,
  `site_gorunum` text NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_title`, `site_favicon`, `site_slogan`, `site_description`, `site_keywords`, `site_copright`, `site_facebook`, `site_twitter`, `site_instagram`, `site_analytics`, `site_telefon`, `site_fax`, `site_calsaat`, `site_eposta`, `site_adres`, `site_gorunum`, `updatedAt`) VALUES
(1, 'PHP | Whatsapp Sipariş Formu Scripti (Beta v.1) - Yönetim Panelli', 'favicon.png', 'Sipariş Formu (Beta v.1)', 'Sipariş Formu (Beta v.1)', 'sipariş formu, mehmet kaplan', 'Copyright © 2019 <a target=\"_blank\" title=\"Mehmet Kaplan\" href=\"https://www.mehmetkaplan.net/\">Mehmet Kaplan</a> tarafından kodlanmıştır.', 'https://www.facebook.com/mehmetkplnn', 'https://www.twitter.com/mehmetkpln18', 'Mehmet Kaplan', '', '0212 212 12 12', '0212 212 12 12', 'Pazartesi - Cumartesi 09:00 - 19:00', 'deneme@deneme.com', 'Adres Buraya gelecek.', '1', '2018-07-28 07:45:48');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `destektalepleri`
--

CREATE TABLE `destektalepleri` (
  `id` int(11) NOT NULL,
  `alanid` int(11) NOT NULL,
  `baslik` text NOT NULL,
  `isim` text NOT NULL,
  `eposta` text NOT NULL,
  `kullanicicevap` text NOT NULL,
  `yoneticicevap` text NOT NULL,
  `durum` text NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `destektalepleri`
--

INSERT INTO `destektalepleri` (`id`, `alanid`, `baslik`, `isim`, `eposta`, `kullanicicevap`, `yoneticicevap`, `durum`, `tarih`) VALUES
(27, 620, 'Merhaba Destek Sağlarmısınız.', 'Mehmet Kaplan', 'örnek@deneme.com', 'Merhaba Nasıl Sipariş Vereceğim.', 'Destek Sağlandı', '2', '2019-04-11 08:48:07'),
(28, 234, 'Merhaba Destek Sağlarmısınız.', 'Mehmet Kaplan', 'örnek@deneme.com', 'Merhaba Nasıl Sipariş Vereceğim.', 'Yonetici Mesaji Bekleniyor !', '1', '2019-04-12 06:17:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyurular`
--

CREATE TABLE `duyurular` (
  `id` int(11) NOT NULL,
  `baslik` text NOT NULL,
  `icerik` text NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yazar` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `duyurular`
--

INSERT INTO `duyurular` (`id`, `baslik`, `icerik`, `tarih`, `yazar`) VALUES
(7, 'Mehmet Kaplan', 'Sipariş Formu Duyuru Alanı', '2019-04-10 10:38:52', 'Mehmet');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparistalepleri`
--

CREATE TABLE `siparistalepleri` (
  `id` int(11) NOT NULL,
  `alanid` text NOT NULL,
  `urun` text NOT NULL,
  `eposta` text NOT NULL,
  `telefon` text NOT NULL,
  `kullanicinot` text NOT NULL,
  `yoneticicevap` text NOT NULL,
  `durum` text NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `siparistalepleri`
--

INSERT INTO `siparistalepleri` (`id`, `alanid`, `urun`, `eposta`, `telefon`, `kullanicinot`, `yoneticicevap`, `durum`, `tarih`) VALUES
(1, '256', '1.Ürün', 'örnek@deneme.com', '05554444444', 'Mavi', 'Yeni', '1', '2019-04-10 08:53:00'),
(2, '476', '2.Ürün', 'örnek@deneme.com', '05554444444', 'Kırmızı', 'Onaylı', '1', '2019-04-10 09:04:40'),
(3, '308', '3.Ürün', 'örnek@deneme.com', '05554444444', 'Mor', 'Hazır', '1', '2019-04-12 06:17:02'),
(4, '9', '4.Ürün', 'örnek@deneme.com', '05554444444', 'Turuncu', 'Kargo', '1', '2019-04-15 11:50:13'),
(5, '371', '5.Ürün', 'örnek@deneme.com', '05554444444', 'Sarı', 'Teslim', '1', '2019-04-15 11:51:57'),
(22, '423', '1.Ürün', 'örnek@deneme.com', '05554444444', 'Yeşil', 'İptal', '1', '2019-04-18 11:48:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `urunresim` varchar(255) NOT NULL,
  `urunbaslik` text NOT NULL,
  `urunicerik` text NOT NULL,
  `urunfiyat` int(11) NOT NULL,
  `urunstok` varchar(255) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ekleyen` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `urunresim`, `urunbaslik`, `urunicerik`, `urunfiyat`, `urunstok`, `tarih`, `ekleyen`) VALUES
(1, '1555422239.jpg', '1.Ürün', '1.Ürün İçeriği', 10, '10', '2019-04-05 17:39:56', 'Mehmet'),
(2, '1555913237.jpg', '2.Ürün', '2.Ürün İçeriği', 23, '10', '2019-04-10 09:04:05', 'Mehmet'),
(3, 'resimyok.jpg', '3.Ürün', '3.Ürün İçeriği', 30, '10', '2019-04-06 10:36:40', 'Mehmet'),
(4, 'resimyok.jpg', '4.Ürün', '4.Ürün İçeriği', 40, '10', '2019-04-06 10:56:47', 'Mehmet'),
(5, 'resimyok.jpg', '5.Ürün', '5.Ürün İçeriği', 50, '10', '2019-04-06 10:56:47', 'Mehmet');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

CREATE TABLE `yoneticiler` (
  `id` int(11) NOT NULL,
  `alanid` text NOT NULL,
  `kullaniciadi` text NOT NULL,
  `email` text,
  `password` text,
  `adiniz` text NOT NULL,
  `aciklama` text NOT NULL,
  `telefon` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`id`, `alanid`, `kullaniciadi`, `email`, `password`, `adiniz`, `aciklama`, `telefon`) VALUES
(1, '', 'demo', 'demo@demo.com', 'demo', 'demo', 'Demo', 'demo'),

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `destektalepleri`
--
ALTER TABLE `destektalepleri`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `duyurular`
--
ALTER TABLE `duyurular`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `siparistalepleri`
--
ALTER TABLE `siparistalepleri`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `yoneticiler`
--
ALTER TABLE `yoneticiler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `destektalepleri`
--
ALTER TABLE `destektalepleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Tablo için AUTO_INCREMENT değeri `duyurular`
--
ALTER TABLE `duyurular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `siparistalepleri`
--
ALTER TABLE `siparistalepleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
