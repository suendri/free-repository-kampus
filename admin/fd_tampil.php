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
  $updateSQL = sprintf("UPDATE owm_feedback SET NotActive=%s WHERE feed_id=%s",
                       GetSQLValueString(isset($_POST['checkbox']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['feed_idd'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

if ((isset($_GET['feed_id'])) && ($_GET['feed_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM owm_feedback WHERE feed_id=%s",
                       GetSQLValueString($_GET['feed_id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_fd_rec = "SELECT * FROM owm_feedback";
$fd_rec = mysql_query($query_fd_rec, $koneksi) or die(mysql_error());
$row_fd_rec = mysql_fetch_assoc($fd_rec);
$totalRows_fd_rec = mysql_num_rows($fd_rec);
?>

<p><i>Master Feeback</i></p>
<table cellpadding="2" cellspacing="2">
  <tr>
    <td class="lst">No</td>
    <td class="lst">Nama</td>
    <td class="lst">Email</td>
    <td class="lst">Pesan</td>
    <td class="lst">NotActive</td>
    <td class="lst" colspan="2">Aksi</td>
  </tr>
  <?php do { ?>
  <tr>
    <td class="ttl"><?php echo $row_fd_rec['feed_id']; ?></td>
    <td class="ttl"><?php echo $row_fd_rec['feed_nama']; ?></td>
    <td class="ttl"><?php echo $row_fd_rec['feed_email']; ?></td>
    <td class="ttl" style="overflow:hidden; width:375px; max-width:375px;"><span style="word-wrap: break-word;"><?php echo $row_fd_rec['feed_pesan']; ?><br></span></td>
    <td class="ttl"><?php echo $row_fd_rec['NotActive']; ?></td>
    <td class="ttl"><form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
    <input name="feed_idd" type="hidden" value="<?php echo $row_fd_rec['feed_id']; ?>">
      <input <?php if (!(strcmp($row_fd_rec['NotActive'],"Y"))) {echo "checked";} ?> type="checkbox" name="checkbox" value="checkbox" onClick="this.form.submit()" title="Hilangkan Checklist untuk Setuju">
      <input type="hidden" name="MM_update" value="form1">
    </form></td>
    <td class="ttl"><a href="index.php?main=fd_tampil&feed_id=<?php echo $row_fd_rec['feed_id'];?>">Delete</a></td>
  </tr>
  <?php } while ($row_fd_rec = mysql_fetch_assoc($fd_rec)); ?>
</table><br>
<fieldset><legend><?php echo $OWM_attention ?></legend>
<?php echo $OWM_feed_check ?>

<?php
mysql_free_result($fd_rec);
?>
