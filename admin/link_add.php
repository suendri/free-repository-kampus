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
  $insertSQL = sprintf("INSERT INTO tautan (tautan_title, tautan_link, NotActive) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString(isset($_POST['checkbox']) ? "true" : "", "defined","'Y'","'N'"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM tautan";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<p><i>Tambah Link</i></p>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table >
    <tr>
      <td class="ttl">Nama Link </td>
      <td class="ttl"><input name="nama" type="text" id="nama"></td>
    </tr>
    <tr>
      <td class="ttl">Alamat</td>
      <td class="ttl"><input name="alamat" type="text" id="alamat"></td>
    </tr>
    <tr>
      <td class="ttl">NotActive</td>
      <td class="ttl"><input type="checkbox" name="checkbox" value="checkbox"></td>
    </tr>
    <tr>
      <td class="ttl">&nbsp;</td>
      <td class="ttl"><input type="submit" name="Submit" value="Simpan">
      <input name="reset" type="reset" id="reset" value="Reset">
	  <input name="kembali" type="button" id="kembali" value="Kembali" onClick="location='index.php?main=link_tampil'"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<fieldset><legend><?php echo $OWM_attention ?></legend>
<?php echo $OWM_link_isi_add ?>

<?php
mysql_free_result($Recordset1);
?>
