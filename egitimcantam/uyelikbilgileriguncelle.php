<?php
	if(isset($_SESSION["Kullanici"])){
		?>

		<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="500" valign="top">
					<form action="index.php?SK=58" method="post">
						<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="40">
								<td style="color:#FF9900"><h3>Hesabim > Uyelik Bilgieri</h3></td>
							</tr>
							<tr height="30">
								<td align="top" style="border-bottom: 1px dashed #CCCCCC;">Hesap bilgilerim.</td>
							</tr>
							<tr height="30">
								<td class="hesabim_yazilar" align="bottom" align="left">Isim Soyisim</td>
							</tr>
							<tr height="30">
								<td align="top" align="left"><input type="text" name="IsimSoyisim" class="InputAlanlari"
								                                    value="<?php echo $IsimSoyisim ?>"></td>
							</tr>
							<tr height="30">
								<td class="hesabim_yazilar" align="bottom" align="left">E-Mail Adresi</td>
							</tr>
							<tr height="30">
								<td align="top" align="left"><input type="mail" name="EmailAdresi" class="InputAlanlari"
								                                    value="<?php echo $EmailAdresi ?>"></td>
							</tr>
							<tr height="30">
								<td class="hesabim_yazilar" align="bottom" align="left">Şifre</td>
							</tr>
							<tr height="30">
								<td align="top" align="left"><input type="password" name="Sifre" class="InputAlanlari"
								                                    value="EskiSifre"></td>
							</tr>
							<tr height="30">
								<td class="hesabim_yazilar" align="bottom" align="left">Şifre Tekrar</td>
							</tr>
							<tr height="30">
								<td colspan="2" valign="top" align="left"><input type="password" name="SifreTekrar"
								                                                 class="InputAlanlari" value="EskiSifre"></td>
							</tr>
							<tr height="30">
								<td class="hesabim_yazilar" align="bottom" align="left">Telefon Numarasi</td>
							</tr>
							<tr height="30">
								<td align="top" align="left"><input type="text" name="TelefonNumarasi" maxlength="11"
								                                    class="InputAlanlari" value="<?php echo $TelefonNumarasi ?>"></td>
							</tr>
							<tr>
								<td><input type="submit" value="Bilgilerimi Guncelle" class="TuruncuButon"></td>
								</td>
							</tr>
						</table>
					</form>
		</table>
		
		
		<?php
	}else{
		header("Location:index.php");
	}
?>
