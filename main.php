<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rec_news = 5;
$pageNum_rec_news = 0;
if (isset($_GET['pageNum_rec_news'])) {
  $pageNum_rec_news = $_GET['pageNum_rec_news'];
}
$startRow_rec_news = $pageNum_rec_news * $maxRows_rec_news;

mysql_select_db($database_koneksi, $koneksi);
$query_rec_news = "SELECT * FROM owm_news WHERE NotActive='N'";
$query_limit_rec_news = sprintf("%s LIMIT %d, %d", $query_rec_news, $startRow_rec_news, $maxRows_rec_news);
$rec_news = mysql_query($query_limit_rec_news, $koneksi) or die(mysql_error());
$row_rec_news = mysql_fetch_assoc($rec_news);

if (isset($_GET['totalRows_rec_news'])) {
  $totalRows_rec_news = $_GET['totalRows_rec_news'];
} else {
  $all_rec_news = mysql_query($query_rec_news);
  $totalRows_rec_news = mysql_num_rows($all_rec_news);
}
$totalPages_rec_news = ceil($totalRows_rec_news/$maxRows_rec_news)-1;

$queryString_rec_news = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rec_news") == false && 
        stristr($param, "totalRows_rec_news") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rec_news = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rec_news = sprintf("&totalRows_rec_news=%d%s", $totalRows_rec_news, $queryString_rec_news);

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
?>
<h4>Selamat Datang di Repository <?php echo $row_recstatus['status_nama']; ?></h4>
<br>
<p align="right"><b><i><?php echo $OWM_new_news ?></i></b></p>
<hr>
<table border="0" width="100%">
  <?php do { ?>
  <tr>
    <td><span class="owm_news_head"><?php echo $row_rec_news['judul']; ?></span><br>
    <i><?php echo $row_rec_news['tanggal']; ?></i></td>
  </tr><tr>
    <td class="owm_feed" colspan="2"><blockquote><?php echo $row_rec_news['isi_pesan']; ?></blockquote></td>
  </tr>
  <?php } while ($row_rec_news = mysql_fetch_assoc($rec_news)); ?>
</table>

<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center">
      <?php if ($pageNum_rec_news > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_rec_news=%d%s", $currentPage, 0, $queryString_rec_news); ?>">First</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center">
      <?php if ($pageNum_rec_news > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_rec_news=%d%s", $currentPage, max(0, $pageNum_rec_news - 1), $queryString_rec_news); ?>">Previous</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_rec_news < $totalPages_rec_news) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_rec_news=%d%s", $currentPage, min($totalPages_rec_news, $pageNum_rec_news + 1), $queryString_rec_news); ?>">Next</a>
      <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_rec_news < $totalPages_rec_news) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_rec_news=%d%s", $currentPage, $totalPages_rec_news, $queryString_rec_news); ?>">Last</a>
      <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<?php
mysql_free_result($rec_news);
?>
