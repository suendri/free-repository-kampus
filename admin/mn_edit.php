<?php
/*
Hak cipta (C) 2011 suendri, phpbego, owner openwebmurah.com
- Puskom AMIK Royal Kisaran, Sumatera Utara.
- RCC, Royal Copyleft Community.

Program ini adalah perangkat lunak bebas; Anda dapat menyebarluaskannya
dan/atau memodifikasinya di bawah ketentuan-ketentuan dari
GNU General Public License seperti yang diterbitkan oleh
Free Software Foundation; baik versi 2 dari Lisensi tersebut, atau (dengan
pilihan Anda) versi lain yang lebih tinggi.

Program ini didistribusikan dengan harapan bahwa program ini akan berguna,
tetapi TANPA GARANSI; tanpa garansi yang termasuk dari DAGANGAN atau
KECOCOKAN UNTUK TUJUAN TERTENTU sekalipun. Lihat
GNU General Public License untuk rincian lebih lanjut.

Anda seharusnya menerima sebuah salinan GNU General Public License beserta
program ini; jika tidak, tulis ke Free Software Foundation, Inc.,
59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE menu_utama SET utama_link=%s, NotActive=%s WHERE utama_title=%s",
                       GetSQLValueString($_POST['textfield2'], "text"),
                       GetSQLValueString(isset($_POST['checkbox']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['textfield'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_Recordset1 = "1";
if (isset($_GET['utama_title'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['utama_title'] : addslashes($_GET['utama_title']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = sprintf("SELECT * FROM menu_utama WHERE utama_title = '%s'", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<p><i>Edit Menu Utama</i></p>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table cellpadding="1" cellspacing="2">
    <tr>
      <td class="ttl">Nama Menu </td>
      <td class="ttl"><input name="textfield" type="text" value="<?php echo $row_Recordset1['utama_title']; ?>"></td>
    </tr>
    <tr>
      <td class="ttl">Alamat</td>
      <td class="ttl"><input name="textfield2" type="text" value="<?php echo $row_Recordset1['utama_link']; ?>" size="50"></td>
    </tr>
    <tr>
      <td class="ttl">NotActive </td>
      <td class="ttl"><input <?php if (!(strcmp($row_Recordset1['NotActive'],"Y"))) {echo "checked";} ?> type="checkbox" name="checkbox" value="checkbox"></td>
    </tr>
    <tr>
      <td class="ttl">&nbsp;</td>
      <td class="ttl"><input type="submit" name="Submit" value="Simpan">
      <input name="reset" type="reset" id="reset" value="Reset">
	  <input name="kembali" type="button" id="kembali" value="Kembali" onClick="location='index.php?main=mn_tampil'"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
</form>

<?php
mysql_free_result($Recordset1);
?>
