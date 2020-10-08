<?php
	if(isset($_GET["ID"])){
		$GelenID = SayiliIcerikleriFiltrele(Guvenlik($_GET["ID"]));
		
		$UrunHitiGuncellemeSorgusu = $VeritabaniBaglantisi->prepare("UPDATE urunler SET GoruntulenmeSayisi=GoruntulenmeSayisi+1 WHERE id = ? AND Durumu = ? LIMIT 1");
		$UrunHitiGuncellemeSorgusu->execute([$GelenID,1]);
		
		$UrunSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? AND Durumu = ? LIMIT 1");
		$UrunSorgusu->execute([$GelenID,1]);
		$UrunSayisi = $UrunSorgusu->rowCount();
		$UrunSorgusuKaydi = $UrunSorgusu->fetch(PDO::FETCH_ASSOC);
		
		if($UrunSayisi > 0){
			$UrunTuru = $UrunSorgusuKaydi["UrunTuru"];
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
			
			$UrununFiyati = DonusumleriGeriDondur($UrunSorgusuKaydi["UrunFiyati"]);
			$UrununParaBirimi = DonusumleriGeriDondur($UrunSorgusuKaydi["ParaBirimi"]);
			
			if($UrununParaBirimi == "USD"){
				$UrunFiyatiHesapla = $UrununFiyati * $DolarKuru;
			}elseif($UrununParaBirimi == "EUR"){
				$UrunFiyatiHesapla = $UrununFiyati * $EuroKuru;
			}else{
				$UrunFiyatiHesapla = $UrununFiyati;
			}
			?>
			<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="350" valign="top">
						<table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="border: 1px solid #CCCCCC;" align="center"><img id="BuyukResim"
								                                                           src="Resimler/Urunler/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiBir"]); ?>"
								                                                           width="330" height="440" border="0"></td>
							</tr>
							<tr height="5">
								<td style="font-size: 5px;">&nbsp;</td>
							</tr>
							<tr>
								<td>
									<table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="78" style="border: 1px solid #CCCCCC;"><img
													src="Resimler/Urunler/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiBir"]); ?>"
													width="78" height="104" border="0"
													onClick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>', '<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiBir"]); ?>');">
											</td>
											<td width="10">&nbsp;</td>
											<?php if(DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiIki"]) != ""){ ?>
												<td width="78" style="border: 1px solid #CCCCCC;"><img
													src="Resimler/Urunler/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiIki"]); ?>"
													width="78" height="104" border="0"
													onClick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>', '<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiIki"]); ?>');">
												</td><?php }else{ ?>
												<td width="78">&nbsp;</td><?php } ?>
											<td width="10">&nbsp;</td>
											<?php if(DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiUc"]) != ""){ ?>
												<td width="78" style="border: 1px solid #CCCCCC;"><img
													src="Resimler/Urunler/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiUc"]); ?>"
													width="78" height="104" border="0"
													onClick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>', '<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiUc"]); ?>');">
												</td><?php }else{ ?>
												<td width="78">&nbsp;</td><?php } ?>
											<td width="10">&nbsp;</td>
											<?php if(DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiDort"] != "")){ ?>
												<td width="78" style="border: 1px solid #CCCCCC;"><img
													src="Resimler/Urunler/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiDort"]); ?>"
													width="78" height="104" border="0"
													onClick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>', '<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunResmiDort"]); ?>');">
												</td><?php }else{ ?>
												<td width="78">&nbsp;</td><?php } ?>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>

					<td width="10" valign="top">&nbsp;</td>

					<td width="705" valign="top">
						<table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="50" bgcolor="#F1F1F1">
								<td
									style="color:#0088cc;text-align: left; font-size: 18px; font-weight: bold;">&nbsp;<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunAdi"]); ?></td>
							</tr>
							<tr>
								<td>
									<form action="index.php?SK=104&ID=<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["id"]); ?>"
									      method="post">
										<table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
											<tr height="45">
												<td width="150"><?php if(isset($_SESSION["Kullanici"])){ ?>
														<a style="color:#f0766b;text-decoration: none"
														   href="index.php?SK=100&ID=<?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["id"]); ?>">
															<p style="float: left;padding-bottom: 3px">&nbsp;Favorilere Ekle</p></a>
													<?php }else{ ?><?php } ?></td>
												<td width="10">&nbsp;</td>
												<td style="float: right;margin-right: 110px" width="345"><input type="submit" value="SEPETE EKLE" class="SepeteEkleButonu"></td>
											</tr>
											<tr height="45">
												<td colspan="5">
													<table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
														<tr height="45">
															<td width="500" align="left"><select hidden name="Varyant" class="SelectAlanlari">
																	<?php
																		
																		$VaryantSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE UrunId = ? AND StokAdedi > ? ORDER BY VaryantAdi ASC");
																		$VaryantSorgusu->execute([DonusumleriGeriDondur($UrunSorgusuKaydi["id"]),0]);
																		$VaryantSayisi = $VaryantSorgusu->rowCount();
																		$VaryantKayitlari = $VaryantSorgusu->fetchAll(PDO::FETCH_ASSOC);
																		$Varyant = 1;
																		$VaryantSecimi = 1;
																		foreach($VaryantKayitlari as $VaryantSecimi){
																			?>
																			<option
																				value="<?php echo $VaryantSecimi["VaryantAdi"]; ?>"><?php echo DonusumleriGeriDondur($VaryantSecimi["VaryantAdi"]); ?></option>
																			<?php
																		}
																	?>
																</select></td>
															<td width="205"
															    style="font-size: 25px; color:#439E4A !important; font-weight: bold"><?php echo FiyatBicimlendir($UrunFiyatiHesapla); ?> TL
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</form>
								</td>
							</tr>
							<tr>
								<td>
									<hr/>
								</td>
							</tr>
							<tr>
								<td>
									<table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
										<tr height="30">
											<td><img src="Resimler/SaatEsnetikGri20x20.png" border="0" style="margin-top: 5px;"></td>
											<td>Siparişiniz <?php echo UcGunIleriTarihBul(); ?> tarihine kadar kargoya verilecektir.</td>
										</tr>
										<tr height="30">
											<td><img src="Resimler/SaatHizCizgiliLacivert20x20.png" border="0" style="margin-top: 5px;"></td>
											<td>İlgili ürün süper hızlı gönderi kapsamındadır. Aynı gün teslimat yapılabilir.</td>
										</tr>
										<tr height="30">
											<td><img src="Resimler/KrediKarti20x20.png" border="0" style="margin-top: 5px;"></td>
											<td>Tüm bankaların kredi kartları ile peşin veya taksitli ödeme seçeneği.</td>
										</tr>
										<tr height="30">
											<td><img src="Resimler/Banka20x20.png" border="0" style="margin-top: 5px;"></td>
											<td>Tüm bankalardan havale veya EFT ile ödeme seçeneği.</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<hr/>
								</td>
							</tr>
							<tr height="30">
								<td style="background: #FF9900; color: white;">&nbsp;Ürün Açıklaması</td>
							</tr>
							<tr>
								<td><?php echo DonusumleriGeriDondur($UrunSorgusuKaydi["UrunAciklamasi"]); ?></td>
							</tr>
							<tr>
								<td>
									<hr/>
								</td>
							</tr>
							<tr height="30">
								<td style="background: #FF9900; color: white;">&nbsp;Ürün Yorumları</td>
							</tr>
							<tr>
								<td>
									<div style="width: 705px; max-width: 705px; height: 300px; max-height: 300px; overflow-y: scroll;">
										<table width="685" align="left" border="0" cellpadding="0" cellspacing="0">
											<?php
												$YorumlarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM yorumlar WHERE UrunId = ? ORDER BY YorumTarihi DESC");
												$YorumlarSorgusu->execute([DonusumleriGeriDondur($UrunSorgusuKaydi["id"])]);
												$YorumSayisi = $YorumlarSorgusu->rowCount();
												$YorumKayitlari = $YorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);
												
												if($YorumSayisi > 0){
													foreach($YorumKayitlari as $YorumSatirlari){
														$YorumPuani = DonusumleriGeriDondur($YorumSatirlari["Puan"]);
														
														if($YorumPuani == 1){
															$YorumPuanResmi = "YildizBirDolu.png";
														}elseif($YorumPuani == 2){
															$YorumPuanResmi = "YildizIkiDolu.png";
														}elseif($YorumPuani == 3){
															$YorumPuanResmi = "YildizUcDolu.png";
														}elseif($YorumPuani == 4){
															$YorumPuanResmi = "YildizDortDolu.png";
														}elseif($YorumPuani == 5){
															$YorumPuanResmi = "YildizBesDolu.png";
														}
														
														$YorumIcinUyeSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE id = ? LIMIT 1");
														$YorumIcinUyeSorgusu->execute([DonusumleriGeriDondur($YorumSatirlari["UyeId"])]);
														$YorumIcinUyeKaydi = $YorumIcinUyeSorgusu->fetch(PDO::FETCH_ASSOC);
														?>
														<tr height="30">
															<td width="64"><img src="Resimler/<?php echo $YorumPuanResmi; ?>" border="0"></td>
															<td width="10">&nbsp;</td>
															<td
																width="451"><?php echo DonusumleriGeriDondur($YorumIcinUyeKaydi["IsimSoyisim"]); ?></td>
															<td width="10">&nbsp;</td>
															<td width="150"
															    align="right"><?php echo TarihBul(DonusumleriGeriDondur($YorumSatirlari["YorumTarihi"])); ?></td>
														</tr>
														<tr>
															<td colspan="5"
															    style="border-bottom: 1px dashed #CCCCCC;"><?php echo DonusumleriGeriDondur($YorumSatirlari["YorumMetni"]); ?></td>
														</tr>
														<?php
													}
												}else{
													?>
													<tr height="30">
														<td>Ürün İçin Henüz Yorum Eklenmemiş.</td>
													</tr>
													<?php
												}
											?>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<?php
		}else{
			header("Location:index.php");
			exit();
		}
	}else{
		header("Location:index.php");
		exit();
	}
?>