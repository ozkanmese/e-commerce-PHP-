<?php
if(isset($_SESSION["Yonetici"])){
    ?>
    <form action="index.php?SKD=0&SKI=59" method="post">
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;MENÜLER</h3></td>
                <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=58" style="color: #FFFFFF; text-decoration: none;">Yeni Menü Ekle&nbsp;</a></td>
            </tr>
            <tr height="10">
                <td colspan="2" style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr height="40">
                            <td width="230">Menü İçin Ürün Türü</td>
                            <td width="20">:</td>



                            <td width="500"><select name="UrunTuru" class="SelectAlanlari">
                                    <option value="">Lütfen Seçiniz</option>
                                    <option value="Okuma Kitabı">Okuma Kitabı</option>
                                    <option value="Soru Bankası">Soru Bankası</option>
                                    <option value="Ders Kitabı">Ders Kitabı</option>
                                    <option value="Dergi">Dergi</option>
                                    <option value="Üniversite Kitabı">Üniversite Kitabı</option>
                                </select></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Menü Adı</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="MenuAdi" class="InputAlanlari"></td>
                        </tr>
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><input type="submit" value="Menü Kaydet" class="TuruncuButon"></td>
                        </tr>
                    </table></td>
            </tr>
        </table>
    </form>
    <?php
}else{
    header("Location:index.php?SKD=1");
    exit();
}
?>