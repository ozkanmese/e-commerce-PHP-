<?php
	if(isset($_SESSION["Kullanici"])){
		?>

		<div>
			<div style="table-layout: fixed;width: 300px;float: left;margin-right: 150px">
				<table align="left">
					<tr height="40">
						<td>
							<button class="hesabim_tablo_buton" onclick="window.location.href='index.php?SK=56'">Üyelik
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
						<td width="500">
							<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr height="40">
									<td style="color:#FF9900;border-bottom: 1px solid #afafaf"><h3>Hesabim > Uyelik Bilgieri</h3></td>
								</tr>
								<tr height="30">
									<td align="top" align="left"><b
											style="font-size: 15px">Isim Soyisim&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b><?php echo $IsimSoyisim; ?>
									</td>
								</tr>
								<tr height="30">
									<td align="top" align="left"><b
											style="font-size: 15px">E-Mail Adresi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b><?php echo $EmailAdresi; ?>
									</td>
								</tr>
								<tr height="30">
									<td align="top" align="left"><b style="font-size: 15px">Telefon
											Numarasi&nbsp;:&nbsp;</b><?php echo $TelefonNumarasi; ?></td>
								</tr>
								<tr height="30">
									<td align="top" align="left"><b
											style="font-size: 15px">Kayit Tarihi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b><?php echo TarihBul($KayitTarihi); ?>
									</td>
								</tr>
								<tr>
									<td>
										<button class="TuruncuButon" onclick="window.location.href='index.php?SK=57'">
											Bilgilerimi Guncelle
										</button>
									</td>
									</td>
								</tr>
							</table>
					</tr>
				</table>
			</div>
		</div>
		
		
		<?php
	}else{
		header("Location:index.php");
	}
?>
