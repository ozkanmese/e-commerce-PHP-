<?php
	if(isset($_SESSION["Kullanici"])){
		?>

		<div>
			<div style="table-layout: fixed;width: 300px;float: left;margin-right: 50px">
				<table align="left">
					<tr height="40">
						<td>
							<button class="hesabim_tablo_buton" onclick="window.location.href='index.php?SK=56'">Üye
								Bilgilerim
							</button>
						</td>
					</tr>
					<tr class="hesabim_tablo" height="40">
						<td>
							<button class="hesabim_tablo_buton" onclick="window.location.href='index.php?SK=64'">
								Siparişlerim
							</button>
						</td>
					</tr>
					<tr class="hesabim_tablo" height="40">
						<td>
							<button class="hesabim_tablo_buton" onclick="window.location.href='index.php?SK=65'">
								Adreslerim
							</button>
						</td>
					</tr>
					<tr class="hesabim_tablo" height="40">
						<td>
							<button class="hesabim_tablo_buton" onclick="window.location.href='index.php?SK=66'">
								Favoriler
							</button>
						</td>
					</tr>
					<tr class="hesabim_tablo" height="40">
						<td>
							<button class="hesabim_tablo_buton" onclick="window.location.href='index.php?SK=86'">Yorumlar
							</button>
						</td>
					</tr>
				</table>
			</div>
			<div style="table-layout: fixed;width: 500px;float:left;margin-left: 50px">
				
				<?php
					if(isset($_SESSION["Kullanici"])){
						
						$SayfalamaIcinSolVeSagButonSayisi = 2;
						$SayfaBasinaGosterilecekKayitSayisi = 10;
						$ToplamKayitSayisiSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM favoriler WHERE UyeId = ? ORDER BY id DESC");
						$ToplamKayitSayisiSorgusu->execute([$KullaniciID]);
						$ToplamKayitSayisiSorgusu = $ToplamKayitSayisiSorgusu->rowCount();
						$SayfalamayaBaslanacakKayitSayisi = ($Sayfalama * $SayfaBasinaGosterilecekKayitSayisi) - $SayfaBasinaGosterilecekKayitSayisi;
						$BulunanSayfaSayisi = ceil($ToplamKayitSayisiSorgusu / $SayfaBasinaGosterilecekKayitSayisi);
						?>
						<table width="600" align="center" border="0" cellpadding="0" cellspacing="0">

							<tr>
								<td width="600" valign="top">
									<table width="600" align="center" border="0" cellpadding="0" cellspacing="0">
										<tr height="40">
											<td colspan="4" style="color:#FF9900"><h3>Hesabım > Favoriler</h3></td>
										</tr>
										<tr height="30">
											<td colspan="4" valign="top"
											    style="border-bottom: 1px dashed #CCCCCC;">Favorilerinize Eklediğiniz Tüm Ürünleri Bu Alandan Görüntüleyebilirsiniz.
											</td>
										</tr>
										<tr height="50">
											<td width="75" style="background: #f8ffa7; color: black;" align="left">&nbsp;Resim</td>
											<td width="25" style="background: #f8ffa7; color: black;" align="left">Sil</td>
											<td width="865" style="background: #f8ffa7; color: black;" align="left">Adı</td>
											<td width="100" style="background: #f8ffa7; color: black;" align="left">Fiyatı</td>
										</tr>
										<?php
											$FavorilerSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM favoriler WHERE UyeId = ? ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
											$FavorilerSorgusu->execute([$KullaniciID]);
											$FavoriSayisi = $FavorilerSorgusu->rowCount();
											$FavoriKayitlari = $FavorilerSorgusu->fetchAll(PDO::FETCH_ASSOC);
											
											if($FavoriSayisi > 0){
												foreach($FavoriKayitlari as $FavoriSatirlar){
													$UrunlerSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
													$UrunlerSorgusu->execute([$FavoriSatirlar["UrunId"]]);
													$UrunKaydi = $UrunlerSorgusu->fetch(PDO::FETCH_ASSOC);
													
													$UrununAdi = $UrunKaydi["UrunAdi"];
													$UrunTuru = $UrunKaydi["UrunTuru"];
													$UrununResmi = $UrunKaydi["UrunResmiBir"];
													$UrununUrunFiyati = $UrunKaydi["UrunFiyati"];
													$UrununParaBirimi = $UrunKaydi["ParaBirimi"];
													
										if($UrunTuru == "Ders Kitabı"){
											$ResimKlasoru = "DersKitabi";
										}elseif($UrunTuru == "Okuma Kitabı"){
											$ResimKlasoru = "OkumaKitaplari";
										}elseif($UrunTuru == "Soru Bankası"){
											$ResimKlasoru = "SoruBankasi";
										}elseif($UrunTuru == "Dergi"){
											$ResimKlasoru = "Dergiler";
										}elseif($UrunTuru == "Üniversite Kitabı"){
											$ResimKlasoru = "UniversiteKitaplari";
										}
										
										
										?>
													<tr height="30">
														<td width="75" align="left" style="border-bottom: 1px dashed #CCCCCC;"><a
																href="index.php?SK=89&ID=<?php echo DonusumleriGeriDondur($UrunKaydi["id"]); ?>"><img
																	src="Resimler/Urunler/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrununResmi); ?>" border="0"
																	width="60" height="80"></a></td>
														<td width="50" align="left" style="border-bottom: 1px dashed #CCCCCC;"><a
																href="index.php?SK=87&ID=<?php echo DonusumleriGeriDondur($FavoriSatirlar["id"]); ?>"><img
																	src="Resimler/Sil20x20.png" border="0"></a></td>
														<td width="415" align="left" style="border-bottom: 1px dashed #CCCCCC;"><a
																href="index.php?SK=89&ID=<?php echo DonusumleriGeriDondur($UrunKaydi["id"]); ?>"
																style="color: #646464; text-decoration: none;"><?php echo DonusumleriGeriDondur($UrununAdi); ?></a>
														</td>
														<td width="100" align="left" style="border-bottom: 1px dashed #CCCCCC;"><a
																href="index.php?SK=89&ID=<?php echo DonusumleriGeriDondur($UrunKaydi["id"]); ?>"
																style="color: #646464; text-decoration: none;"><?php echo FiyatBicimlendir(DonusumleriGeriDondur($UrununUrunFiyati)); ?><?php echo DonusumleriGeriDondur($UrununParaBirimi); ?></a>
														</td>
													</tr>
													<?php
												}
												if($BulunanSayfaSayisi > 1){
													?>
													<tr height="50">
														<td colspan="4" align="center">
															<div class="SayfalamaAlaniKapsayicisi">
																<div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
																	Toplam <?php echo $BulunanSayfaSayisi; ?> sayfada, <?php echo $ToplamKayitSayisiSorgusu; ?> adet kayıt bulunmaktadır.
																</div>

																<div class="SayfalamaAlaniIciNumaraAlaniKapsayicisi">
																	<?php
																		if($Sayfalama > 1){
																			echo "<span class='SayfalamaPasif'><a href='index.php?SK=66&SYF=1'><<</a></span>";
																			$SayfalamaIcinSayfaDegeriniBirGeriAl = $Sayfalama - 1;
																			echo "<span class='SayfalamaPasif'><a href='index.php?SK=66&SYF=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
																		}
																		
																		for($SayfalamaIcinSayfaIndexDegeri = $Sayfalama - $SayfalamaIcinSolVeSagButonSayisi;$SayfalamaIcinSayfaIndexDegeri <= $Sayfalama + $SayfalamaIcinSolVeSagButonSayisi;$SayfalamaIcinSayfaIndexDegeri++){
																			if(($SayfalamaIcinSayfaIndexDegeri > 0) and ($SayfalamaIcinSayfaIndexDegeri <= $BulunanSayfaSayisi)){
																				if($Sayfalama == $SayfalamaIcinSayfaIndexDegeri){
																					echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
																				}else{
																					echo "<span class='SayfalamaPasif'><a href='index.php?SK=66&SYF=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
																				}
																			}
																		}
																		
																		if($Sayfalama != $BulunanSayfaSayisi){
																			$SayfalamaIcinSayfaDegeriniBirIleriAl = $Sayfalama + 1;
																			echo "<span class='SayfalamaPasif'><a href='index.php?SK=66&SYF=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
																			echo "<span class='SayfalamaPasif'><a href='index.php?SK=66&SYF=" . $BulunanSayfaSayisi . "'>>></a></span>";
																		}
																	?>
																</div>
															</div>
														</td>
													</tr>
													<?php
												}
											}else{
												?>
												<tr height="50">
													<td colspan="4" align="left">Sisteme Kayıtlı Favori Ürününüz Bulunmamaktadır.</td>
												</tr>
												<?php
											}
										?>
									</table>
								</td>
							</tr>
						</table>
						<?php
					}else{
						header("Location:index.php");
						exit();
					}
				?>


			</div>
		</div>
		
		
		<?php
	}else{
		header("Location:index.php");
	}
?>
