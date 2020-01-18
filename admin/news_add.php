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
  $insertSQL = sprintf("INSERT INTO owm_news (judul, isi_pesan, tanggal) VALUES (%s, %s, now())",
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString($_POST['isi_pesan'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_rec_news2 = "SELECT * FROM owm_news";
$rec_news2 = mysql_query($query_rec_news2, $koneksi) or die(mysql_error());
$row_rec_news2 = mysql_fetch_assoc($rec_news2);
$totalRows_rec_news2 = mysql_num_rows($rec_news2);
?>
<p><i>Tambah Berita</i></p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table>
    <tr>
      <td class="ttl">Judul:</td>
      <td class="ttl"><input type="text" name="judul" value="" size="32"></td>
    </tr>
    <tr>
      <td class="ttl">Isi Berita</td>
      <td class="ttl"><textarea name="isi_pesan" cols="32" rows="8"></textarea></td>
    </tr>
    <tr>
      <td class="ttl">&nbsp;</td>
      <td class="ttl"><input type="submit" value="Simpan">
	  <input name="kembali" type="button" id="kembali" value="Kembali" onClick="location='index.php?main=news_tampil'"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<?php
mysql_free_result($rec_news2);
?>
