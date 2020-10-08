<?php
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
	
	$SayfalamaIcinSolVeSagButonSayisi = 2;
	$SayfaBasinaGosterilecekKayitSayisi = 10;
	$ToplamKayitSayisiSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE UrunTuru = 'Okuma Kitabı' AND Durumu = '1' $MenuKosulu $AramaKosulu ORDER BY id DESC");
	$ToplamKayitSayisiSorgusu->execute();
	$ToplamKayitSayisiSorgusu = $ToplamKayitSayisiSorgusu->rowCount();
	$SayfalamayaBaslanacakKayitSayisi = ($Sayfalama * $SayfaBasinaGosterilecekKayitSayisi) - $SayfaBasinaGosterilecekKayitSayisi;
	$BulunanSayfaSayisi = ceil($ToplamKayitSayisiSorgusu / $SayfaBasinaGosterilecekKayitSayisi);
	
	$AnaMenununTumUrunSayiSorgusu = $VeritabaniBaglantisi->prepare("SELECT SUM(UrunSayisi) AS MenununToplamUrunu FROM menuler WHERE UrunTuru = 'Okuma Kitabı'");
	$AnaMenununTumUrunSayiSorgusu->execute();
	$AnaMenununTumUrunSayiSorgusu = $AnaMenununTumUrunSayiSorgusu->fetch(PDO::FETCH_ASSOC);
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="250" align="left" valign="top">
			<table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="30" style="float: left">
								<td><a href="index.php?SK=2"
								       style="text-decoration: none; <?php if($GelenMenuId == ""){ ?>color: #FF9900;<? }else{ ?>color: #646464;<?php } ?> font-weight: bold;">&nbsp;Tüm Ürünler (<?php echo $AnaMenununTumUrunSayiSorgusu["MenununToplamUrunu"]; ?>)</a>
								</td>
							</tr>
							<?php
								$MenulerSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM menuler WHERE UrunTuru = 'Okuma Kitabı' ORDER BY MenuAdi ASC");
								$MenulerSorgusu->execute();
								$MenuKayitSayisi = $MenulerSorgusu->rowCount();
								$MenuKayitlari = $MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);
								
								foreach($MenuKayitlari as $Menu){
									?>
									<tr height="30">
										<td><a href="index.php?SK=2&MenuID=<?php echo $Menu["id"]; ?>"
										       style="text-align: left;float:left;text-decoration: none; <?php if($GelenMenuId == $Menu["id"]){ ?>color: #FF9900;<? }else{ ?>color: #646464;<?php } ?> font-weight: bold;">&nbsp;<?php echo DonusumleriGeriDondur($Menu["MenuAdi"]); ?> (<?php echo DonusumleriGeriDondur($Menu["UrunSayisi"]); ?>)</a>
										</td>
									</tr>
									<?php
								}
							?>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td width="795" align="left" valign="top">
			<table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<div class="AramaAlani">
							<form action="index.php?SK=2" method="post">

							</form>
						</div>
					</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
				</tr>

				<tr>
					<td>
						<table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr><?php
									$UrunlerSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE UrunTuru = 'Okuma Kiyabı' AND Durumu = '1' $MenuKosulu $AramaKosulu ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
									$UrunlerSorgusu->execute();
									$UrunSayisi = $UrunlerSorgusu->rowCount();
									$UrunKayitlari = $UrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);
									
									$DonguSayisi = 1;
									$SutunAdetSayisi = 4;
									
									foreach($UrunKayitlari as $Kayit){
										$UrununFiyati = DonusumleriGeriDondur($Kayit["UrunFiyati"]);
										$UrununParaBirimi = DonusumleriGeriDondur($Kayit["ParaBirimi"]);
										
										if($UrununParaBirimi == "USD"){
											$UrunFiyatiHesapla = $UrununFiyati * $DolarKuru;
										}elseif($UrununParaBirimi == "EUR"){
											$UrunFiyatiHesapla = $UrununFiyati * $EuroKuru;
										}else{
											$UrunFiyatiHesapla = $UrununFiyati;
										}
										
										$UrununToplamYorumSayisi = DonusumleriGeriDondur($Kayit["YorumSayisi"]);
										$UrununToplamYorumPuani = DonusumleriGeriDondur($Kayit["ToplamYorumPuani"]);
										
										if($UrununToplamYorumSayisi > 0){
											$PuanHesapla = number_format($UrununToplamYorumPuani / $UrununToplamYorumSayisi,2,".","");
										}else{
											$PuanHesapla = 0;
										}
										
										if($PuanHesapla == 0){
											$PuanResmi = "YildizCizgiliBos.png";
										}elseif(($PuanHesapla > 0) and ($PuanHesapla <= 1)){
											$PuanResmi = "YildizCizgiliBirDolu.png";
										}elseif(($PuanHesapla > 1) and ($PuanHesapla <= 2)){
											$PuanResmi = "YildizCizgiliIkiDolu.png";
										}elseif(($PuanHesapla > 2) and ($PuanHesapla <= 3)){
											$PuanResmi = "YildizCizgiliUcDolu.png";
										}elseif(($PuanHesapla > 3) and ($PuanHesapla <= 4)){
											$PuanResmi = "YildizCizgiliDortDolu.png";
										}elseif($PuanHesapla > 4){
											$PuanResmi = "YildizCizgiliBesDolu.png";
										}
										?>
										<td width="191" valign="top">
											<table width="191" align="left" border="0" cellpadding="0" cellspacing="0"
											       style="margin-bottom: 10px;"> <!-- border: 1px solid #CCCCCC; -->
												<tr height="40">
													<td align="center"><a
															href="index.php?SK=89&ID=<?php echo DonusumleriGeriDondur($Kayit["id"]); ?>"><img
																src="Resimler/Urunler/OkumaKitabi/<?php echo DonusumleriGeriDondur($Kayit["UrunResmiBir"]); ?>"
																border="0" width="120" height="180"></a></td>
												</tr>
												<tr height="25">
													<td width="191" align="center"><a
															href="index.php?SK=89&ID=<?php echo DonusumleriGeriDondur($Kayit["id"]); ?>"
															style="color: #537ecf; font-weight: bold; text-decoration: none;">Okuma Kitabı</a>
													</td>
												</tr>
												<tr height="25">
													<td width="191" align="center"><a
															href="index.php?SK=89&ID=<?php echo DonusumleriGeriDondur($Kayit["id"]); ?>"
															style="color: #646464; font-weight: bold; text-decoration: none;">
															<div
																style="width: 191px; max-width: 191px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo DonusumleriGeriDondur($Kayit["UrunAdi"]); ?></div>
														</a></td>
												</tr>
												<tr height="25">
													<td width="191" align="center"><a
															href="index.php?SK=89&ID=<?php echo DonusumleriGeriDondur($Kayit["id"]); ?>"><img
																src="Resimler/<?php echo $PuanResmi; ?>" border="0"></a></td>
												</tr>
												<tr height="25">
													<td width="191" align="center"><a
															href="index.php?SK=89&ID=<?php echo DonusumleriGeriDondur($Kayit["id"]); ?>"
															style="color:#439E4A !important; font-weight: bold; text-decoration: none;"><?php echo FiyatBicimlendir($UrunFiyatiHesapla); ?> TL</a>
													</td>
												</tr>
											</table>
										</td>
										<?php
										if($DonguSayisi < $SutunAdetSayisi){
											?>
											<td width="10">&nbsp;</td>
											<?php
										}
										?><?php
										$DonguSayisi++;
										
										if($DonguSayisi > $SutunAdetSayisi){
											echo "</tr><tr>";
											$DonguSayisi = 1;
										}
									}
								?></tr>
						</table>
					</td>
				</tr>
				
				<?php
					if($BulunanSayfaSayisi > 1){
						?>
						<tr>
							<td>&nbsp;</td>
						</tr>

						<tr height="50">
							<td align="center">
								<div class="SayfalamaAlaniKapsayicisi">
									<div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
										Toplam <?php echo $BulunanSayfaSayisi; ?> sayfada, <?php echo $ToplamKayitSayisiSorgusu; ?> adet kayıt bulunmaktadır.
									</div>

									<div class="SayfalamaAlaniIciNumaraAlaniKapsayicisi">
										<?php
											if($Sayfalama > 1){
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=2" . $SayfalamaKosulu . "&SYF=1'><<</a></span>";
												$SayfalamaIcinSayfaDegeriniBirGeriAl = $Sayfalama - 1;
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=2" . $SayfalamaKosulu . "&SYF=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
											}
											
											for($SayfalamaIcinSayfaIndexDegeri = $Sayfalama - $SayfalamaIcinSolVeSagButonSayisi;$SayfalamaIcinSayfaIndexDegeri <= $Sayfalama + $SayfalamaIcinSolVeSagButonSayisi;$SayfalamaIcinSayfaIndexDegeri++){
												if(($SayfalamaIcinSayfaIndexDegeri > 0) and ($SayfalamaIcinSayfaIndexDegeri <= $BulunanSayfaSayisi)){
													if($Sayfalama == $SayfalamaIcinSayfaIndexDegeri){
														echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
													}else{
														echo "<span class='SayfalamaPasif'><a href='index.php?SK=2" . $SayfalamaKosulu . "&SYF=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
													}
												}
											}
											
											if($Sayfalama != $BulunanSayfaSayisi){
												$SayfalamaIcinSayfaDegeriniBirIleriAl = $Sayfalama + 1;
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=2" . $SayfalamaKosulu . "&SYF=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
												echo "<span class='SayfalamaPasif'><a href='index.php?SK=2" . $SayfalamaKosulu . "&SYF=" . $BulunanSayfaSayisi . "'>>></a></span>";
											}
										?>
									</div>
								</div>
							</td>
						</tr>
						<?php
					}
				?>
			</table>
		</td>

	</tr>
</table>