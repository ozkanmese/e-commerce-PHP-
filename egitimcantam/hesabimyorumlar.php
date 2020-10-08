<?php
	if(isset($_SESSION["Kullanici"])){
		
		$SayfalamaIcinSolVeSagButonSayisi = 2;
		$SayfaBasinaGosterilecekKayitSayisi = 10;
		$ToplamKayitSayisiSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM yorumlar WHERE UyeId = ? ORDER BY YorumTarihi DESC");
		$ToplamKayitSayisiSorgusu->execute([$KullaniciID]);
		$ToplamKayitSayisiSorgusu = $ToplamKayitSayisiSorgusu->rowCount();
		$SayfalamayaBaslanacakKayitSayisi = ($Sayfalama * $SayfaBasinaGosterilecekKayitSayisi) - $SayfaBasinaGosterilecekKayitSayisi;
		$BulunanSayfaSayisi = ceil($ToplamKayitSayisiSorgusu / $SayfaBasinaGosterilecekKayitSayisi);
		?>
		<div width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
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
				<td width="650" valign="top">
					<table width="650" align="center" border="0" cellpadding="0" cellspacing="0">
						<tr height="40">
							<td colspan="2" style="color:#FF9900"><h3>Hesabım > Yorumlar</h3></td>
						</tr>
						<tr height="30">
							<td colspan="2" valign="top"
							    style="border-bottom: 1px dashed #CCCCCC;">Tüm Yorumlarınız Bu Alandan Görüntüleyebilirsiniz.
							</td>
						</tr>
						<tr height="50">
							<td width="125" style="background: #f8ffa7; color: black;" align="left">&nbsp;Puan</td>
							<td width="75" style="background: #f8ffa7; color: black;" align="left">Yorum&nbsp;</td>
						</tr>
						<?php
							$YorumlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM yorumlar WHERE UyeId = ? ORDER BY YorumTarihi DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
							$YorumlarSorgusu->execute([$KullaniciID]);
							$YorumlarSayisi = $YorumlarSorgusu->rowCount();
							$YorumlarKayitlari = $YorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);
							
							if($YorumlarSayisi > 0){
								foreach($YorumlarKayitlari as $Satirlar){
									$VerilenPuan = $Satirlar["Puan"];
									if($VerilenPuan == 1){
										$ResimDosyasi = "YildizBirDolu.png";
									}elseif($VerilenPuan == 2){
										$ResimDosyasi = "YildizIkiDolu.png";
									}elseif($VerilenPuan == 3){
										$ResimDosyasi = "YildizUcDolu.png";
									}elseif($VerilenPuan == 4){
										$ResimDosyasi = "YildizDortDolu.png";
									}elseif($VerilenPuan == 5){
										$ResimDosyasi = "YildizBesDolu.png";
									}
									?>
									<tr>
										<td width="85" align="left" style="border-bottom: 1px dashed #CCCCCC; padding: 15px 0px;"
										    valign="top"><img src="Resimler/<?php echo $ResimDosyasi; ?>"></td>
										<td width="980" align="left" style="border-bottom: 1px dashed #CCCCCC; padding: 15px 0px;"
										    valign="top"><?php echo DonusumleriGeriDondur($Satirlar["YorumMetni"]); ?></td>
									</tr>
									<?php
								}
								if($BulunanSayfaSayisi > 1){
									?>
									<tr height="50">
										<td colspan="2" align="center">
											<div class="SayfalamaAlaniKapsayicisi">
												<div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
													Toplam <?php echo $BulunanSayfaSayisi; ?> sayfada, <?php echo $ToplamKayitSayisiSorgusu; ?> adet kayıt bulunmaktadır.
												</div>

												<div class="SayfalamaAlaniIciNumaraAlaniKapsayicisi">
													<?php
														if($Sayfalama > 1){
															echo "<span class='SayfalamaPasif'><a href='index.php?SK=86&SYF=1'><<</a></span>";
															$SayfalamaIcinSayfaDegeriniBirGeriAl = $Sayfalama - 1;
															echo "<span class='SayfalamaPasif'><a href='index.php?SK=86&SYF=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
														}
														
														for($SayfalamaIcinSayfaIndexDegeri = $Sayfalama - $SayfalamaIcinSolVeSagButonSayisi;$SayfalamaIcinSayfaIndexDegeri <= $Sayfalama + $SayfalamaIcinSolVeSagButonSayisi;$SayfalamaIcinSayfaIndexDegeri++){
															if(($SayfalamaIcinSayfaIndexDegeri > 0) and ($SayfalamaIcinSayfaIndexDegeri <= $BulunanSayfaSayisi)){
																if($Sayfalama == $SayfalamaIcinSayfaIndexDegeri){
																	echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
																}else{
																	echo "<span class='SayfalamaPasif'><a href='index.php?SK=86&SYF=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
																}
															}
														}
														
														if($Sayfalama != $BulunanSayfaSayisi){
															$SayfalamaIcinSayfaDegeriniBirIleriAl = $Sayfalama + 1;
															echo "<span class='SayfalamaPasif'><a href='index.php?SK=86&SYF=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
															echo "<span class='SayfalamaPasif'><a href='index.php?SK=86&SYF=" . $BulunanSayfaSayisi . "'>>></a></span>";
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
									<td colspan="2" align="left">Sisteme Kayıtlı Yorum Bulunmamaktadır.</td>
								</tr>
								<?php
							}
						?>
					</table>
				</td>
			</div>
		</div>
		<?php
	}else{
		header("Location:index.php");
		exit();
	}
?>