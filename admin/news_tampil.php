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

if ((isset($_GET['id_news'])) && ($_GET['id_news'] != "")) {
  $deleteSQL = sprintf("DELETE FROM owm_news WHERE id_news=%s",
                       GetSQLValueString($_GET['id_news'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE owm_news SET NotActive=%s WHERE id_news=%s",
                       GetSQLValueString(isset($_POST['checkbox']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['id_news'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_rec_news = "SELECT * FROM owm_news";
$rec_news = mysql_query($query_rec_news, $koneksi) or die(mysql_error());
$row_rec_news = mysql_fetch_assoc($rec_news);
$totalRows_rec_news = mysql_num_rows($rec_news);
?>


<p><i>Master News</i></p>
<a href="index.php?main=news_add">Tambah Baru</a>
<table border="0">
  <tr>
    <td class="lst">No</td>
    <td class="lst">Judul</td>
    <td class="lst">Isi Berita</td>
    <td class="lst">Tanggal</td>
    <td class="lst">NA</td>
    <td colspan="2" class="lst">Aksi</td>
  </tr>
  <?php do { ?>
  <tr>
    <td class="ttl"><?php echo $row_rec_news['id_news']; ?></td>
    <td class="ttl"><?php echo $row_rec_news['judul']; ?></td>
    <td class="ttl"><?php echo $row_rec_news['isi_pesan']; ?></td>
    <td class="ttl"><?php echo $row_rec_news['tanggal']; ?></td>
    <td class="ttl"><?php echo $row_rec_news['NotActive']; ?></td>
    <td class="ttl"><form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
    <input name="id_news" type="hidden" value="<?php echo $row_rec_news['id_news']; ?>">
      <input <?php if (!(strcmp($row_rec_news['NotActive'],"Y"))) {echo "checked";} ?> type="checkbox" name="checkbox" value="checkbox" onClick="this.form.submit()" title="Cheklist untuk NonActive">
      <input type="hidden" name="MM_update" value="form1">
    </form></td>
    <td class="ttl"><a href="index.php?main=news_tampil&id_news=<?php echo $row_rec_news['id_news']; ?>"><img src="../template/image/remove.png" border="0"></a></td>
  </tr>
  <?php } while ($row_rec_news = mysql_fetch_assoc($rec_news)); ?>
</table>
<?php
mysql_free_result($rec_news);
?>