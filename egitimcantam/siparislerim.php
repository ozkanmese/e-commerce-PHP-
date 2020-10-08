<?php
	if(isset($_SESSION["Kullanici"])){
		$SayfalamaIcinSolVeSagButonSayisi = 2;
		$SayfaBasinaGosterilecekKayitSayisi = 10;
		$ToplamKayitSayisiSorgusu = $VeritabaniBaglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler WHERE UyeId = ? ORDER BY SiparisNumarasi DESC");
		$ToplamKayitSayisiSorgusu->execute([$KullaniciID]);
		$ToplamKayitSayisiSorgusu = $ToplamKayitSayisiSorgusu->rowCount();
		$SayfalamayaBaslanacakKayitSayisi = ($Sayfalama * $SayfaBasinaGosterilecekKayitSayisi) - $SayfaBasinaGosterilecekKayitSayisi;
		$BulunanSayfaSayisi = ceil($ToplamKayitSayisiSorgusu / $SayfaBasinaGosterilecekKayitSayisi);
		?>
		<div>
			<div style="table-layout: fixed;width: 300px;float: left;margin-right: 150px">
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
							<button class="hesabim_tablo_buton" onclick="window.location.href='index.php?SK=86'">
								Yorumlar
							</button>
						</td>
					</tr>
				</table>
			</div>
			<div style="table-layout: fixed;width: 500px;float:left;margin-left: 50px">

				<table width="600" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="600" valign="top">
							<table width="600" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr height="40">
									<td style="color:#FF9900"><h3>Hesabım > Siparislerim</h3></td>
								</tr>
								<tr height="30">
									<td valign="top"
									    style="border-bottom: 1px dashed #CCCCCC;">Tüm Siparislerinizi buradan görüntüleyebilirsiniz.
									</td>
								</tr>
								<tr height="50">
									<td width="125" style="background: #f8ffa7; color: black;" align="left">&nbsp;Sipariş Numarası</td>
									<td width="75" style="background: #f8ffa7; color: black;" align="left">Resim</td>
									<td width="50" style="background: #f8ffa7; color: black;" align="left">Yorum</td>
									<td width="415" style="background: #f8ffa7; color: black;" align="left">Adı</td>
									<td width="100" style="background: #f8ffa7; color: black;" align="left">Fiyatı</td>
									<td width="50" style="background: #f8ffa7; color: black;" align="left">Adet</td>
									<td width="100" style="background: #f8ffa7; color: black;" align="left">Toplam Fiyat</td>
									<td width="150" style="background: #f8ffa7; color: black;" align="left">Kargo Durumu / Takip</td>
								</tr>
								<?php
									$SiparisNumaralariSorgusu = $VeritabaniBaglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler WHERE UyeId = ? ORDER BY SiparisNumarasi DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
									$SiparisNumaralariSorgusu->execute([$KullaniciID]);
									$SiparisNumaralariSayisi = $SiparisNumaralariSorgusu->rowCount();
									$SiparisNumaralariKayitlari = $SiparisNumaralariSorgusu->fetchAll(PDO::FETCH_ASSOC);
									
									if($SiparisNumaralariSayisi > 0){
										foreach($SiparisNumaralariKayitlari as $SiparisNumaralariSatirlar){
											$SiparisNo = DonusumleriGeriDondur($SiparisNumaralariSatirlar["SiparisNumarasi"]);
											
											$SiparisSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM siparisler WHERE UyeId = ? AND SiparisNumarasi = ? ORDER BY id ASC");
											$SiparisSorgusu->execute([$KullaniciID,$SiparisNo]);
											$SiparisSorgusuKayitlari = $SiparisSorgusu->fetchAll(PDO::FETCH_ASSOC);
											
											foreach($SiparisSorgusuKayitlari as $SiparisSatirlar){



                                            $UrunSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urunler  LIMIT 1");
                                            $UrunSorgusu->execute();
                                            $UrunSayisi = $UrunSorgusu->rowCount();
                                            $UrunSorgusuKaydi = $UrunSorgusu->fetch(PDO::FETCH_ASSOC);

                                            if($UrunSayisi > 0) {
                                                $UrunTuru = $UrunSorgusuKaydi["UrunTuru"];
                                                if ($UrunTuru == "Ders Kitabı") {
                                                    $ResimKlasoru = "DersKitabi";
                                                } elseif ($UrunTuru == "Okuma Kitabı") {
                                                    $ResimKlasoru = "OkumaKitaplari";
                                                } elseif ($UrunTuru == "Soru Bankası") {
                                                    $ResimKlasoru = "SoruBankasi";
                                                } elseif ($UrunTuru == "Dergi") {
                                                    $ResimKlasoru = "Dergiler";
                                                } elseif ($UrunTuru == "Üniversite Kitabı") {
                                                    $ResimKlasoru = "UniversiteKitaplari";
                                                }

                                            }

												$KargoDurumu = DonusumleriGeriDondur($SiparisSatirlar["KargoDurumu"]);
												if($KargoDurumu == 0){
													$KargoDurumuYazdir = "Beklemede";
												}else{
													$KargoDurumuYazdir = DonusumleriGeriDondur($SiparisSatirlar["KargoGonderiKodu"]);
												}


												?>

												<tr height="30">

													<td width="125"
													    align="left">&nbsp;#<?php echo DonusumleriGeriDondur($SiparisSatirlar["SiparisNumarasi"]); ?></td>
													<td width="75" align="left"><img
															src="Resimler/Urunler/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($SiparisSatirlar["UrunResmiBir"]); ?>"
															border="0" width="60" height="80"></td>
													<td width="50" align="left"><a
															href="index.php?SK=81&UrunID=<?php echo DonusumleriGeriDondur($SiparisSatirlar["UrunId"]); ?>"><img
																src="Resimler/DokumanKirmiziKalemli20x20.png" border="0"></a></td>
													<td width="415"
													    align="left"><?php echo DonusumleriGeriDondur($SiparisSatirlar["UrunAdi"]); ?></td>
													<td width="100"
													    align="left"><?php echo FiyatBicimlendir(DonusumleriGeriDondur($SiparisSatirlar["UrunFiyati"])); ?> TL
													</td>
													<td width="50"
													    align="left"><?php echo DonusumleriGeriDondur($SiparisSatirlar["UrunAdedi"]); ?></td>
													<td width="100"
													    align="left"><?php echo FiyatBicimlendir(DonusumleriGeriDondur($SiparisSatirlar["ToplamUrunFiyati"])); ?> TL
													</td>
													<td width="150" align="left"><?php echo $KargoDurumuYazdir; ?></td>

												</tr>
												<?php
											}
											?>
											<tr height="30">
												<td colspan="8">
													<hr/>
												</td>
											</tr>
											<?php
										}
										if($BulunanSayfaSayisi > 1){
											?>
											<tr height="50">
												<td colspan="8">
												<td colspan="8" align="center">
													<div class="SayfalamaAlaniKapsayicisi">
														<div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
															Toplam <?php echo $BulunanSayfaSayisi; ?> sayfada, <?php echo $ToplamKayitSayisiSorgusu; ?> adet kayıt bulunmaktadır.
														</div>

														<div class="SayfalamaAlaniIciNumaraAlaniKapsayicisi">
															<?php
																if($Sayfalama > 1){
																	echo "<span class='SayfalamaPasif'><a href='index.php?SK=64&SYF=1'><<</a></span>";
																	$SayfalamaIcinSayfaDegeriniBirGeriAl = $Sayfalama - 1;
																	echo "<span class='SayfalamaPasif'><a href='index.php?SK=64&SYF=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
																}
																
																for($SayfalamaIcinSayfaIndexDegeri = $Sayfalama - $SayfalamaIcinSolVeSagButonSayisi;$SayfalamaIcinSayfaIndexDegeri <= $Sayfalama + $SayfalamaIcinSolVeSagButonSayisi;$SayfalamaIcinSayfaIndexDegeri++){
																	if(($SayfalamaIcinSayfaIndexDegeri > 0) and ($SayfalamaIcinSayfaIndexDegeri <= $BulunanSayfaSayisi)){
																		if($Sayfalama == $SayfalamaIcinSayfaIndexDegeri){
																			echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
																		}else{
																			echo "<span class='SayfalamaPasif'><a href='index.php?SK=64&SYF=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
																		}
																	}
																}
																
																if($Sayfalama != $BulunanSayfaSayisi){
																	$SayfalamaIcinSayfaDegeriniBirIleriAl = $Sayfalama + 1;
																	echo "<span class='SayfalamaPasif'><a href='index.php?SK=64&SYF=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
																	echo "<span class='SayfalamaPasif'><a href='index.php?SK=64&SYF=" . $BulunanSayfaSayisi . "'>>></a></span>";
																}
															?>
														</div>
													</div>
												</td>
												</td>
											</tr>
											<?php
										}
									}else{
										?>
										<tr height="50">
											<td colspan="8" align="left">Sisteme Kayıtlı Siparişiniz Bulunmamaktadır.</td>
										</tr>
										<?php
									}
								?>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php
	}else{
		header("Location:index.php");
		exit();
	}

?>
