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
							<button class="hesabim_tablo_buton" onclick="window.location.href='index.php?SK=86'">
								Yorumlar
							</button>
						</td>
					</tr>
				</table>
			</div>
			<div style="table-layout: fixed;width: 500px;float:left;margin-left: 50px">
				<table>
					<tr>
						<td width="650" valign="top">
							<table width="650" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr height="40">
									<td colspan="5" style="color:#FF9900"><h3>Hesabım > Adresler</h3></td>
								</tr>
								<tr height="30">
									<td colspan="5" valign="top"
									    style="border-bottom: 1px dashed #CCCCCC;">Tüm Adreslerini görüntüleyebilir veya güncelleyebilirsin.
									</td>
								</tr>
								<tr height="50">
									<td colspan="1" style="background: #f8ffa7; color: black; font-weight: bold;" align="left">&nbsp;Adresler
									</td>
									<td colspan="4" style="background: #f8ffa7; color: black; font-weight: bold;" align="right"><a
											href="index.php?SK=76" style="text-decoration: none; color: #000000;">+ Yeni Adres Ekle</a>&nbsp;
									</td>
								</tr>
								<?php
									$AdreslerSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM adresler WHERE UyeId = ?");
									$AdreslerSorgusu->execute([$KullaniciID]);
									$AdreslerSayisi = $AdreslerSorgusu->rowCount();
									$AdreslerKayitlari = $AdreslerSorgusu->fetchAll(PDO::FETCH_ASSOC);
									
									$BirinciRenk = "#FFFFFF";
									$IkinciRenk = "#F1F1F1";
									$RenkSayisi = 1;
									
									if($AdreslerSayisi > 0){
										foreach($AdreslerKayitlari as $Satirlar){
											if($RenkSayisi % 2){
												$ArkaplanRengi = $BirinciRenk;
											}else{
												$ArkaplanRengi = $IkinciRenk;
											}
											?>
											<tr height="50" bgcolor="<?php echo $ArkaplanRengi; ?>">
												<td
													align="left"><?php echo $Satirlar["AdiSoyadi"]; ?> - <?php echo $Satirlar["Adres"]; ?> <?php echo $Satirlar["Ilce"]; ?> / <?php echo $Satirlar["Sehir"]; ?> - <?php echo $Satirlar["TelefonNumarasi"]; ?></td>
												<td width="25"><img src="Resimler/Guncelleme20x20.png" border="0" style="margin-top: 5px;"></td>
												<td width="70"><a href="index.php?SK=68&ID=<?php echo $Satirlar["id"]; ?>"
												                  style="text-decoration: none; color: #646464;">Güncelle</a></td>
												<td width="25"><img src="Resimler/Sil20x20.png" border="0" style="margin-top: 5px;"></td>
												<td width="25"><a href="index.php?SK=73&ID=<?php echo $Satirlar["id"]; ?>"
												                  style="text-decoration: none; color: #646464;">Sil</a></td>
											</tr>
											<?php
											$RenkSayisi++;
										}
									}else{
										?>
										<tr height="50">
											<td colspan="5" align="left">Sisteme Kayıtlı Adresiniz Bulunmamaktadır.</td>
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
	}
?>
