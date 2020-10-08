<?php
	if(isset($_SESSION["Kullanici"])){
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
							<button class="hesabim_tablo_buton" onclick="window.location.href='index.php?SK=67'">Kayıtlı
								Kartlerım
							</button>
						</td>
					</tr>
				</table>
			</div>
			<div style="table-layout: fixed;width: 500px;float:left;margin-left: 50px">
				
				<?php
					if(isset($_SESSION["Kullanici"])){
						if(isset($_GET["ID"])){
							$GelenID = Guvenlik($_GET["ID"]);
						}else{
							$GelenID = "";
						}
						
						if($GelenID != ""){
							$AdresSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM adresler WHERE id = ? AND UyeId = ? LIMIT 1");
							$AdresSorgusu->execute([$GelenID,$KullaniciID]);
							$AdresSayisi = $AdresSorgusu->rowCount();
							$KayitBilgisi = $AdresSorgusu->fetch(PDO::FETCH_ASSOC);
							
							if($AdresSayisi > 0){
								?>
								<table width="400" align="center" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="500" valign="top">
											<form action="index.php?SK=69&ID=<?php echo $GelenID; ?>" method="post">
												<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
													<tr height="40">
														<td style="color:#FF9900"><h3>Hesabım > Adresler</h3></td>
													</tr>
													<tr height="30">
														<td valign="top"
														    style="border-bottom: 1px dashed #CCCCCC;">Tüm Adreslerini görüntüleyebilir veya güncelleyebilirsin.
														</td>
													</tr>
													<tr height="30">
														<td valign="bottom" align="left">İsim Soyisim (*)</td>
													</tr>
													<tr height="30">
														<td valign="top" align="left"><input type="text" name="IsimSoyisim" class="InputAlanlari"
														                                     value="<?php echo $KayitBilgisi["AdiSoyadi"]; ?>"></td>
													</tr>
													<tr height="30">
														<td valign="bottom" align="left">Adres (*)</td>
													</tr>
													<tr height="30">
														<td valign="top" align="left"><input type="text" name="Adres" class="InputAlanlari"
														                                     value="<?php echo $KayitBilgisi["Adres"]; ?>"></td>
													</tr>
													<tr height="30">
														<td valign="bottom" align="left">İlçe (*)</td>
													</tr>
													<tr height="30">
														<td valign="top" align="left"><input type="text" name="Ilce" class="InputAlanlari"
														                                     value="<?php echo $KayitBilgisi["Ilce"]; ?>"></td>
													</tr>
													<tr height="30">
														<td valign="bottom" align="left">Şehir (*)</td>
													</tr>
													<tr height="30">
														<td valign="top" align="left"><input type="text" name="Sehir" class="InputAlanlari"
														                                     value="<?php echo $KayitBilgisi["Sehir"]; ?>"></td>
													</tr>
													<tr height="30">
														<td valign="bottom" align="left">Telefon Numarası (*)</td>
													</tr>
													<tr height="30">
														<td valign="top" align="left"><input type="text" name="TelefonNumarasi" maxlength="11"
														                                     class="InputAlanlari"
														                                     value="<?php echo $KayitBilgisi["TelefonNumarasi"]; ?>">
														</td>
													</tr>
													<tr height="40">
														<td colspan="2" align="center"><input type="submit" value="Adresi Güncelle"
														                                      class="TuruncuButon"></td>
													</tr>
												</table>
											</form>
										</td>
									</tr>
								</table>
								
								
								<?php
							}else{
								header("Location:index.php?SK=71");
								exit();
							}
						}else{
							header("Location:index.php?SK=71");
							exit();
						}
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
