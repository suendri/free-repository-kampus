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
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_fd_rec = 5;
$pageNum_fd_rec = 0;
if (isset($_GET['pageNum_fd_rec'])) {
  $pageNum_fd_rec = $_GET['pageNum_fd_rec'];
}
$startRow_fd_rec = $pageNum_fd_rec * $maxRows_fd_rec;

mysql_select_db($database_koneksi, $koneksi);
$query_fd_rec = "SELECT feed_nama, feed_email, feed_pesan, tanggal FROM owm_feedback WHERE NotActive='N' ORDER BY tanggal DESC";
$query_limit_fd_rec = sprintf("%s LIMIT %d, %d", $query_fd_rec, $startRow_fd_rec, $maxRows_fd_rec);
$fd_rec = mysql_query($query_limit_fd_rec, $koneksi) or die(mysql_error());
$row_fd_rec = mysql_fetch_assoc($fd_rec);

if (isset($_GET['totalRows_fd_rec'])) {
  $totalRows_fd_rec = $_GET['totalRows_fd_rec'];
} else {
  $all_fd_rec = mysql_query($query_fd_rec);
  $totalRows_fd_rec = mysql_num_rows($all_fd_rec);
}
$totalPages_fd_rec = ceil($totalRows_fd_rec/$maxRows_fd_rec)-1;

$queryString_fd_rec = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_fd_rec") == false && 
        stristr($param, "totalRows_fd_rec") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_fd_rec = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_fd_rec = sprintf("&totalRows_fd_rec=%d%s", $totalRows_fd_rec, $queryString_fd_rec);
?>

<p><i>&nbsp;<a href="index.php?main=in_feed"><img src="template/image/feed.png" border="0">&nbsp;<?php echo $OWM_give_feed ?></a></i></p>
<hr>
<table width=100% cellpadding="2" cellspacing="2">
  <?php do { ?>
  <tr>
  <td class="owm_feed" height="50" style="overflow:hidden; width:50px; max-width:50px;">
  <span style="word-wrap: break-word;"><blockquote><?php echo $row_fd_rec['feed_pesan']; ?></blockquote><br></span></td>
  </tr>
  	<td class="owm_feed_">&nbsp;<?php echo $row_fd_rec['feed_nama']; ?>&nbsp;____<?php echo $row_fd_rec['tanggal']; ?></td>
  </tr>
  <?php } while ($row_fd_rec = mysql_fetch_assoc($fd_rec)); ?>
</table>

<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center">
      <?php if ($pageNum_fd_rec > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_fd_rec=%d%s", $currentPage, 0, $queryString_fd_rec); ?>"> &lt;&lt;&lt; First</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center">
      <?php if ($pageNum_fd_rec > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_fd_rec=%d%s", $currentPage, max(0, $pageNum_fd_rec - 1), $queryString_fd_rec); ?>">&lt;&lt; Previous</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_fd_rec < $totalPages_fd_rec) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_fd_rec=%d%s", $currentPage, min($totalPages_fd_rec, $pageNum_fd_rec + 1), $queryString_fd_rec); ?>">Next &gt;&gt;</a>
      <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_fd_rec < $totalPages_fd_rec) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_fd_rec=%d%s", $currentPage, $totalPages_fd_rec, $queryString_fd_rec); ?>">Last &gt;&gt;&gt; </a>
      <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<?php
mysql_free_result($fd_rec);
?>
