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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO ta (id, nim, nama, judul, tahun) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['nim'], "text"),
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString($_POST['tahun'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  DisplayHeader ($fmt_add_ok,$OWM_add_ok);
}

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM ta";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<p><i>Tambah Tugas Akhir</i></p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="basic" align="left">
    <tr valign="baseline">
      <td class="ttl" nowrap align="right"><div align="left">Nim:</div></td>
      <td class="ttl"><input type="text" name="nim" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td class="ttl" nowrap align="right"><div align="left">Nama:</div></td>
      <td class="ttl"><input type="text" name="nama" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td class="ttl" nowrap align="right"><div align="left">Judul:</div></td>
      <td class="ttl"><textarea name="judul" cols="30" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td class="ttl" nowrap align="right">Tahun:</td>
      <td class="ttl"><input type="text" name="tahun" value="" size="10"></td>
    </tr>
    <tr valign="baseline">
      <td class="ttl" nowrap align="right">&nbsp;</td>
      <td class="ttl"><input name="Submit" type="submit" value="Simpan">
      <input name="reset" type="reset" id="reset" value="Reset">
	  <input name="kembali" type="button" id="kembali" value="Kembali" onClick="location='index.php?main=ta_tampil'"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>

<?php
mysql_free_result($Recordset1);
?>
