<?php
	session_start();
	ob_start();
	require_once("Ayarlar/ayar.php");
	require_once("Ayarlar/fonksiyonlar.php");
	require_once("Ayarlar/sitesayfalari.php");
	if(isset($_REQUEST["SK"])){
		$SayfaKoduDegeri = SayiliIcerikleriFiltrele($_REQUEST["SK"]);
	}else{
		$SayfaKoduDegeri = 0;
	}
	if(isset($_REQUEST["SYF"])){
		$Sayfalama = SayiliIcerikleriFiltrele($_REQUEST["SYF"]);
	}else{
		$Sayfalama = 1;
	}
	if(isset($_REQUEST["MenuID"])){
		$GelenMenuId = SayiliIcerikleriFiltrele(Guvenlik($_REQUEST["MenuID"]));
		$MenuKosulu = " AND MenuId = '" . $GelenMenuId . "' ";
		$SayfalamaKosulu = "&MenuID=" . $GelenMenuId;
	}else{
		$GelenMenuId = "";
		$MenuKosulu = "";
		$SayfalamaKosulu = "";
	}
	
	if(isset($_REQUEST["AramaIcerigi"])){
		$GelenAramaIcerigi = Guvenlik($_REQUEST["AramaIcerigi"]);
		$AramaKosulu = " AND UrunAdi LIKE '%" . $GelenAramaIcerigi . "%' ";
		$SayfalamaKosulu .= "&AramaIcerigi=" . $GelenAramaIcerigi;
	}else{
		$AramaKosulu = "";
		$SayfalamaKosulu .= "";
	}
?>
<!DOCTYPE html>
<html lang="tr-TR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0">
	<meta http-equiv="Content-Language" content="tr">
	<meta name="robots" content="index,follow">
	<meta name="googlebot" content="index,follow">
	<meta name="revisit-after" content="30 Days">

	<title><?php echo DonusumleriGeriDondur($SiteAdi) ?></title>
	<meta name="description" content="<?php echo DonusumleriGeriDondur($SiteDescription) ?>">
	<meta name="keywords" content="<?php echo DonusumleriGeriDondur($SiteKeywords) ?>">
	<link type="image/png" rel="icon" href="Resimler/Favicon.png">
	<script type="text/javascript" src="Frameworks/jQuery/jquery-3.4.1.min.js" language="javascript"></script>
	<link type="text/css" rel="stylesheet" href="Ayarlar/stil.css">
	<script type="text/javascript" src="Ayarlar/fonksiyonlar.js" language="javascript"></script>

</head>
<body>
<div class="container">

	<div>
		<header class="header"><img src="Resimler/kargo.png" height="60" border="0"></header>
	</div>

	<div>
		<div style="table-layout: fixed;float:left;padding: 10px">
			<a href="index.php?SK=0"><img src="Resimler/<?php echo DonusumleriGeriDondur($SiteLogosu) ?>"
			                              style="width: 100px;height: 100px;float: left"></a>
		</div>
		<div style="table-layout: fixed;float:left;padding-top: 30px">
			<div class="Arama-motoru">
			
					<input class="Arama-motoruinput" type="text"><input class="Arama-motorubuton" type="submit">
			
			</div>
		</div>
		<div style="table-layout: fixed;float:right;padding: 10px">
			<table class="uyepanel">
				<tr>
					<?php
						if(isset($_SESSION["Kullanici"])){
							?>
							<td><a href="index.php?SK=56" class="uyepanel_Yazi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="uye_sepet_stil"
							                                                                                       src="Resimler/KullaniciBeyaz16x16.png"><br>Hesabım&nbsp;</a>
							</td>
							<td><a href="index.php?SK=55" class="uyepanel_Yazi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="uye_sepet_stil"
							                                                                                       src="Resimler/CikisBeyaz16x16.png"><br>Çıkış Yap&nbsp;</a>
							</td>
							<td><a href="index.php?SK=107" class="uyepanel_Yazi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
										id="uye_sepet_stil" src="Resimler/SepetBeyaz16x16.png"><br>Alışveriş Sepeti</a>
							</td>
							<?php
						}else{
							?>
							<td><a href="index.php?SK=37" class="uyepanel_Yazi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
										id="uye_sepet_stil" src="Resimler/KullaniciBeyaz16x16.png"><br>Üye Girişi&nbsp;</a>
							</td>
							<td><a href="index.php?SK=28" class="uyepanel_Yazi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
										id="uye_sepet_stil" src="Resimler/KullaniciEkleBeyaz16x16.png"><br>Yeni Üye&nbsp;</a>
							</td>
							<td><a href="index.php?SK=0" class="uyepanel_Yazi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
										id="uye_sepet_stil" src="Resimler/SepetBeyaz16x16.png"><br>Alışveriş Sepeti</a>
							</td>
							<?php
						}
					?>

				</tr>
			</table>
		</div>
	</div>
	<!--BANNER KATEGORILERIN OLDUGU YER -->
	<div class="banner">
		<table class="kategoriler">
			<tr>
				<td>
					<button id="button" onclick="window.location.href='index.php?SK=1'">Ders Kitabı</button>
				</td>
				<td>
					<button id="button" onclick="window.location.href='index.php?SK=2'">Okuma Kitabı</button>
				</td>
				<td>
					<button id="button" onclick="window.location.href='index.php?SK=3'">Soru Bankası</button>
				</td>
				<td>
					<button id="button" onclick="window.location.href='index.php?SK=4'">Dergi</button>
				</td>
				<td>
					<button id="button" onclick="window.location.href='index.php?SK=96'">Üniversite Kitapları</button>
				</td>
			</tr>
		</table>
	</div>
	<!-- ICERIKLERIN GELECEGI YER VE SAYFA YONLENDIRMESI YAPTIGIMIZ KISIM -->
	<div class="content">

		<div style="table-layout: fixed">
			<?php
				if(!$SayfaKoduDegeri || $SayfaKoduDegeri == "" || $SayfaKoduDegeri == 0){
					include($Sayfa[0]);
				}else{
					include($Sayfa[$SayfaKoduDegeri]);
				}
			?>
		</div>
	</div>
	<!-- EN EN ASAGIDAKI FOOTER KISMI -->
	<div class="sayfa_en_alt_footer">
		<div class="footer_1">
			<table id="footer_table">
				<tr>
					<td class="bilgiler">Site Adı gelecek</td>
					<td class="bilgiler">Sözleşmeler</td>
					<td class="bilgiler">Kategoriler</td>
					<td class="bilgiler">Sosyal Medya</td>
				</tr>
				<tr>
					<td><a href="index.php?SK=27" class="footer_1_yazi">Yardım/SSS</a></td>
					<td><a href="index.php?SK=7" class="footer_1_yazi">Üyelik Sözleşmesi</a></td>
					<td><a href="index.php?SK=1" class="footer_1_yazi">Ders Kitabı</a></td>
					<td><a class="sosyalmedya_yazi" href="<?php echo DonusumleriGeriDondur($SosyalLinkFacebook) ?>"
					       target="_blank"><img class="sosyalmedya" src="Resimler/Facebook16x16.png">Facebook</a></td>
				</tr>
				<tr>
					<td><a href="index.php?SK=22" class="footer_1_yazi">İletişim</a></td>
					<td><a href="index.php?SK=8" class="footer_1_yazi">Kullanım Koşulları</a></td>
					<td><a href="index.php?SK=2" class="footer_1_yazi">Okuma Kitabı</a></td>
					<td><a class="sosyalmedya_yazi" href="<?php echo DonusumleriGeriDondur($SosyalLinkInstagram) ?>"
					       target="_blank"><img class="sosyalmedya" src="Resimler/Instagram16x16.png">Instagram</a></td>
				</tr>
				<tr>
					<td><a href="index.php?SK=6" class="footer_1_yazi">Hakkımızda</a></td>
					<td><a href="index.php?SK=9" class="footer_1_yazi">Gizlilik Sözleşmesi</a></td>
					<td><a href="index.php?SK=3" class="footer_1_yazi">Soru Bankası</a></td>
					<td><a class="sosyalmedya_yazi" href="<?php echo DonusumleriGeriDondur($SosyalLinkTwitter) ?>"
					       target="_blank"><img class="sosyalmedya" src="Resimler/Twitter16x16.png">Twitter</a></td>
				</tr>
				<tr>
					<td class="footer_1_yazi">İşlem Rehberi</td>
					<td><a href="index.php?SK=10" class="footer_1_yazi">Mesafeli Satış Sözleşmesi</a></td>
					<td><a href="index.php?SK=4" class="footer_1_yazi">Dergi</a></td>
					<td><a class="sosyalmedya_yazi" href="<?php echo DonusumleriGeriDondur($SosyalLinkLinkedin) ?>"
					       target="_blank"><img class="sosyalmedya" src="Resimler/LinkedIn16x16.png">LinkedIn</a></td>
				</tr>
				<tr>
					<td><a href="index.php?SK=20" class="footer_1_yazi">Kargo Nerede?</a></td>
					<td><a href="index.php?SK=11" class="footer_1_yazi">Teslimat</a></td>
					<td><a href="index.php?SK=96" class="footer_1_yazi">Üniversite Kitapları</a></td>
					<td><a class="sosyalmedya_yazi" href="<?php echo DonusumleriGeriDondur($SosyalLinkPinterest) ?>"
					       target="_blank"><img class="sosyalmedya" src="Resimler/Pinterest16x16.png">Pinterest</a></td>
				</tr>
				<tr>
					<td><a href="index.php?SK=14" class="footer_1_yazi">Banka Hesapları</a></td>
					<td><a href="index.php?SK=12" class="footer_1_yazi">İptal, İade ve Değişim</a></td>
					<td></td>
					<td></td>
				</tr>
				<tr height="30">
					<td><a href="index.php?SK=15" class="footer_1_yazi">Havale Bildirim Formu</a></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<!--SAYFANIN DIBI SERTIFIKA KREDI KARTI FALAN FILAN -->
<div class="sertifikalar">
	<!-- ssl ve kartlar -->
	<p><?php echo $SiteCopyrightMetni ?></p><br>
	<img src="Resimler/RapidSSL32x12.png">
	<img src="Resimler/MasterCard21x12.png">
	<img src="Resimler/VisaCard37x12.png">
</div>
</body>
</html>
<?php
	$VeritabaniBaglantisi = null;
	ob_end_flush();

?>

