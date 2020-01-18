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
  $insertSQL = sprintf("INSERT INTO bantuan_en (pertanyaan, jawaban) VALUES (%s, %s)",
                       GetSQLValueString($_POST['pertanyaan'], "text"),
                       GetSQLValueString($_POST['jawaban'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_help_add1 = "SELECT * FROM bantuan_en";
$help_add1 = mysql_query($query_help_add1, $koneksi) or die(mysql_error());
$row_help_add1 = mysql_fetch_assoc($help_add1);
$totalRows_help_add1 = mysql_num_rows($help_add1);
?>

<p><i>Tambah Bantuan</i></p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table>
      <tr>
      <td class="ttl">Pertanyaan:</td>
      <td class="ttl"><input type="text" name="pertanyaan" value="" size="32"></td>
    </tr>
    <tr>
      <td class="ttl">Jawaban:</td>
      <td class="ttl"><textarea name="jawaban" cols="32" rows="8"></textarea></td>
    </tr>
    <tr>
      <td class="ttl">&nbsp;</td>
      <td class="ttl"><input type="submit" value="Simpan">
	  <input name="kembali" type="button" id="kembali" value="Kembali" onClick="location='index.php?main=help_tampil'"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<?php
mysql_free_result($help_add1);
?>
