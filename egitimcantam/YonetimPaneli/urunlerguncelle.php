<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID			=	Guvenlik($_GET["ID"]);
	}else{
		$GelenID			=	"";
	}
	
	$UrunlerSorgusu	=	$VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
	$UrunlerSorgusu->execute([$GelenID]);
	$UrunSayisi		=	$UrunlerSorgusu->rowCount();
	$UrunBilgisi	=	$UrunlerSorgusu->fetch(PDO::FETCH_ASSOC);
	
	if($UrunSayisi>0){
?>
<form action="index.php?SKD=0&SKI=100&ID=<?php echo DonusumleriGeriDondur($GelenID); ?>" method="post" enctype="multipart/form-data">
	<table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr height="70">
			<td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;ÜRÜNLER</h3></td>
			<td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=95" style="color: #FFFFFF; text-decoration: none;">Yeni Ürün Ekle&nbsp;</a></td>
		</tr>
		<tr height="10">
			<td colspan="2" style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td width="230">Ürün Menüsü</td>
					<td width="20">:</td>
					<td width="500"><select name="UrunMenusu" class="SelectAlanlari">
						<?php
						$MenulerSorgusu			=	$VeritabaniBaglantisi->prepare("SELECT * FROM menuler WHERE UrunTuru = ? ORDER BY UrunTuru ASC, MenuAdi ASC");
						$MenulerSorgusu->execute([DonusumleriGeriDondur($UrunBilgisi["UrunTuru"])]);
						$MenuSayisi			=	$MenulerSorgusu->rowCount();
						$MenuKayitlari		=	$MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);
	
						foreach($MenuKayitlari as $MenuKaydi){
						?>
							<option value="<?php echo DonusumleriGeriDondur($MenuKaydi["id"]); ?>" <?php if(DonusumleriGeriDondur($UrunBilgisi["MenuId"]) == DonusumleriGeriDondur($MenuKaydi["id"])){ ?>selected="selected"<?php } ?>>(<?php echo  DonusumleriGeriDondur($MenuKaydi["UrunTuru"]); ?>) <?php echo  DonusumleriGeriDondur($MenuKaydi["MenuAdi"]); ?></option>
						<?php
						}
						?>
					</select></td>
				</tr>
				<tr height="40">
					<td width="230">Ürün Adı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="UrunAdi" class="InputAlanlari" value="<?php echo  DonusumleriGeriDondur($UrunBilgisi["UrunAdi"]); ?>"></td>
				</tr>
				<tr height="40">
					<td width="230">Ürün Fiyatı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="UrunFiyati" class="InputAlanlari" value="<?php echo  DonusumleriGeriDondur($UrunBilgisi["UrunFiyati"]); ?>"></td>
				</tr>
				<tr height="40">
					<td width="230">Para Birimi</td>
					<td width="20">:</td>
					<td width="500"><select name="ParaBirimi" class="SelectAlanlari">
						<option value="TRY" <?php if(DonusumleriGeriDondur($UrunBilgisi["ParaBirimi"]) == "TRY"){ ?>selected="selected"<?php } ?>>Türk Lirası</option>
						<option value="USD" <?php if(DonusumleriGeriDondur($UrunBilgisi["ParaBirimi"]) == "USD"){ ?>selected="selected"<?php } ?>>Amerikan Doları</option>
						<option value="EUR" <?php if(DonusumleriGeriDondur($UrunBilgisi["ParaBirimi"]) == "EUR"){ ?>selected="selected"<?php } ?>>Euro</option>
					</select></td>
				</tr>
				<tr height="40">
					<td width="230">KDV Oranı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="KdvOrani" class="InputAlanlari" value="<?php echo  DonusumleriGeriDondur($UrunBilgisi["KdvOrani"]); ?>"></td>
				</tr>
				<tr height="40">
					<td width="230">Kargo Ücreti</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="KargoUcreti" class="InputAlanlari" value="<?php echo  DonusumleriGeriDondur($UrunBilgisi["KargoUcreti"]); ?>"></td>
				</tr>
				<tr>
					<td width="230" valign="top">Ürün Açıklaması</td>
					<td width="20" valign="top">:</td>
					<td width="500"><textarea name="UrunAciklamasi" class="TextAreaAlanlari"><?php echo  DonusumleriGeriDondur($UrunBilgisi["UrunAciklamasi"]); ?></textarea></td>
				</tr>
				<tr height="40">
					<td>Ürün Resmi 1</td>
					<td>:</td>
					<td><input type="file" name="Resim1"></td>
				</tr>
				<tr height="40">
					<td>Ürün Resmi 2</td>
					<td>:</td>
					<td><input type="file" name="Resim2"></td>
				</tr>
				<tr height="40">
					<td>Ürün Resmi 3</td>
					<td>:</td>
					<td><input type="file" name="Resim3"></td>
				</tr>
				<tr height="40">
					<td>Ürün Resmi 4</td>
					<td>:</td>
					<td><input type="file" name="Resim4"></td>
				</tr>

				
				
				<?php
				$VaryantlarSorgusu	=	$VeritabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE UrunId = ?");
				$VaryantlarSorgusu->execute([$GelenID]);
				$VaryantSayisi		=	$VaryantlarSorgusu->rowCount();
				$VaryantBilgisi		=	$VaryantlarSorgusu->fetchAll(PDO::FETCH_ASSOC);
				
				$VaryantIsimDizisi	=	array();
				$VaryantStokDizisi	=	array();
				
				foreach($VaryantBilgisi as $Varyant){
					$VaryantIsimDizisi[]	=	$Varyant["VaryantAdi"];
					$VaryantStokDizisi[]	=	$Varyant["StokAdedi"];
				}
					  


				?>
				<tr height="40">
					<td colspan="3" align="left"><table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="230">1. Varyant Adı</td>
							<td width="20">:</td>
							<td width="200"><input type="text" name="VaryantAdi1" class="InputAlanlari" value="<?php echo DonusumleriGeriDondur($VaryantIsimDizisi[0]); ?>"></td>
							<td width="20">&nbsp;</td>
							<td width="178">1. Varyant Stok Adedi</td>
							<td width="20">:</td>
							<td width="60"><input type="text" name="StokAdedi1" class="InputAlanlari" value="<?php echo DonusumleriGeriDondur($VaryantStokDizisi[0]); ?>"></td>
						</tr>
					</table></td>
				</tr>


				</tr>
				<tr height="40">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><input type="submit" value="Ürün Kaydet" class="TuruncuButon"></td>
				</tr>
			</table></td>
		</tr>
	</table>
</form>
<?php
	}else{
		header("Location:index.php?SKD=0&SKI=102");
		exit();
	}
}else{
	header("Location:index.php?SKD=1");
	exit();
}
?>