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
  $updateSQL = sprintf("UPDATE bantuan_en SET pertanyaan=%s, jawaban=%s WHERE id_bantuan=%s",
                       GetSQLValueString($_POST['pertanyaan'], "text"),
                       GetSQLValueString($_POST['jawaban'], "text"),
                       GetSQLValueString($_POST['id_bantuan'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_help_edit = "1";
if (isset($_GET['id_bantuan'])) {
  $colname_rec_help_edit = (get_magic_quotes_gpc()) ? $_GET['id_bantuan'] : addslashes($_GET['id_bantuan']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_rec_help_edit = sprintf("SELECT * FROM bantuan_en WHERE id_bantuan = %s", $colname_rec_help_edit);
$rec_help_edit = mysql_query($query_rec_help_edit, $koneksi) or die(mysql_error());
$row_rec_help_edit = mysql_fetch_assoc($rec_help_edit);
$totalRows_rec_help_edit = mysql_num_rows($rec_help_edit);
?>

<p><i>Edit Pertanyaan</i></p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table>
    <tr>
      <td class="ttl">Pertanyaan:</td>
      <td class="ttl"><input type="text" name="pertanyaan" value="<?php echo $row_rec_help_edit['pertanyaan']; ?>" size="32"></td>
    </tr>
    <tr>
      <td class="ttl">Jawaban:</td>
      <td class="ttl"><textarea name="jawaban" cols="32" rows="8"><?php echo $row_rec_help_edit['jawaban']; ?></textarea></td>
    </tr>
    <tr>
      <td class="ttl">&nbsp;</td>
      <td class="ttl"><input type="submit" value="Perbaharui">
	  <input name="kembali" type="button" id="kembali" value="Kembali" onClick="location='index.php?main=help_tampil'"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_bantuan" value="<?php echo $row_rec_help_edit['id_bantuan']; ?>">
</form>

<?php
mysql_free_result($rec_help_edit);
?>
