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
  $updateSQL = sprintf("UPDATE ta SET nim=%s, nama=%s, judul=%s, tahun=%s WHERE id=%s",
                       GetSQLValueString($_POST['nim'], "text"),
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString($_POST['tahun'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_Recordset1 = "1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = sprintf("SELECT * FROM ta WHERE id = %s", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<p><i>Edit Tugas Akhir</i></p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="basic" align="left">
    <tr valign="baseline">
      <td class="ttl" nowrap align="right">Id:</td>
      <td class="ttl"><?php echo $row_Recordset1['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td class="ttl" nowrap align="right">Nim:</td>
      <td class="ttl"><input type="text" name="nim" value="<?php echo $row_Recordset1['nim']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td class="ttl" nowrap align="right">Nama:</td>
      <td class="ttl"><input type="text" name="nama" value="<?php echo $row_Recordset1['nama']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td class="ttl" nowrap align="right">Judul:</td>
      <td class="ttl"><textarea name="judul" cols="32"><?php echo $row_Recordset1['judul']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td class="ttl" nowrap align="right">Tahun:</td>
      <td class="ttl"><input type="text" name="tahun" value="<?php echo $row_Recordset1['tahun']; ?>" size="10"></td>
    </tr>
    <tr valign="baseline">
      <td class="ttl" nowrap align="right">&nbsp;</td>
      <td class="ttl"><input name="Submit" type="submit" value="Simpan">
	  <input name="kembali" type="button" id="kembali" value="Kembali" onClick="location='index.php?main=ta_tampil'"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>">
</form>
<p>&nbsp;</p>

<?php
mysql_free_result($Recordset1);
?>
