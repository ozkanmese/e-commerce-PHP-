<?php
	
	require_once("Ayarlar/fonksiyonlar.php");
?>

<table align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left"><h2>&nbsp;BANKA HESAPLARIMIZ</h2></td>
	</tr>
	<tr height="50">
		<td align="left"
		    style="font-size: large">&nbsp;Ödemeleriniz İçin Çalışmakta Olduğumuz Tüm Banka Hesap Bilgileri Aşağıdadır.
		</td>
	</tr>

	<tr>
		<td>
			<table align="center" border="0" cellpadding="0" cellspacing="0">
				<tr><?php
						$BankalarSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM bankahesaplarimiz");
						$BankalarSorgusu->execute();
						$BankaSayisi = $BankalarSorgusu->rowCount();
						$BankaKayitlari = $BankalarSorgusu->fetchAll(PDO::FETCH_ASSOC);
						
						$DonguSayisi = 1;
						$SutunAdetSayisi = 3;
						
						foreach($BankaKayitlari as $Kayit){
							?>
							<td id="banka_table">
								<table align="center" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
									<tr height="40">
										<td colspan="4" align="center"><img
												src="Resimler/<?php echo DonusumleriGeriDondur($Kayit["BankaLogosu"]); ?>" border="0"></td>
									</tr>
									<tr height="25">
										<td width="5">&nbsp;</td>
										<td width="80"><b>Banka Adı</b></td>
										<td width="10"><b>:</b></td>
										<td width="250"><?php echo DonusumleriGeriDondur($Kayit["BankaAdi"]); ?></td>
									</tr>
									<tr height="25">
										<td width="5">&nbsp;</td>
										<td><b>Konum</b></td>
										<td><b>:</b></td>
										<td><?php echo DonusumleriGeriDondur($Kayit["KonumSehir"]); ?> / <?php echo DonusumleriGeriDondur($Kayit["KonumUlke"]); ?></td>
									</tr>
									<tr height="25">
										<td width="5">&nbsp;</td>
										<td><b>Şube</b></td>
										<td><b>:</b></td>
										<td><?php echo DonusumleriGeriDondur($Kayit["SubeAdi"]); ?> / <?php echo DonusumleriGeriDondur($Kayit["SubeKodu"]); ?></td>
									</tr>
									<tr height="25">
										<td width="5">&nbsp;</td>
										<td><b>Birim</b></td>
										<td><b>:</b></td>
										<td><?php echo DonusumleriGeriDondur($Kayit["ParaBirimi"]); ?></td>
									</tr>
									<tr height="25">
										<td width="5">&nbsp;</td>
										<td><b>Hesap Adı</b></td>
										<td><b>:</b></td>
										<td><?php echo DonusumleriGeriDondur($Kayit["HesapSahibi"]); ?></td>
									</tr>
									<tr height="25">
										<td width="5">&nbsp;</td>
										<td><b>Hesap No</b></td>
										<td><b>:</b></td>
										<td><?php echo DonusumleriGeriDondur($Kayit["HesapNumarasi"]); ?></td>
									</tr>
									<tr height="25">
										<td width="5">&nbsp;</td>
										<td><b>IBAN No</b></td>
										<td><b>:</b></td>
										<td><?php echo IbanBicimlendir(DonusumleriGeriDondur($Kayit["IbanNumarasi"])); ?></td>
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
					?>
				</tr>
			</table>
		</td>
	</tr>
</table>