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

$maxRows_jurnal_rec = 10;
$pageNum_jurnal_rec = 0;
if (isset($_GET['pageNum_jurnal_rec'])) {
  $pageNum_jurnal_rec = $_GET['pageNum_jurnal_rec'];
}
$startRow_jurnal_rec = $pageNum_jurnal_rec * $maxRows_jurnal_rec;

$colname_jurnal_rec = "1";
if (isset($_GET['katakunci'])) {
  $colname_jurnal_rec = (get_magic_quotes_gpc()) ? $_GET['katakunci'] : addslashes($_GET['katakunci']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_jurnal_rec = sprintf("SELECT id_jurnal, nama_penulis, title_jurnal, `path` FROM jurnal WHERE title_jurnal LIKE '%%%s%%' AND NotActive='N'", $colname_jurnal_rec);
$query_limit_jurnal_rec = sprintf("%s LIMIT %d, %d", $query_jurnal_rec, $startRow_jurnal_rec, $maxRows_jurnal_rec);
$jurnal_rec = mysql_query($query_limit_jurnal_rec, $koneksi) or die(mysql_error());
$row_jurnal_rec = mysql_fetch_assoc($jurnal_rec);

if (isset($_GET['totalRows_jurnal_rec'])) {
  $totalRows_jurnal_rec = $_GET['totalRows_jurnal_rec'];
} else {
  $all_jurnal_rec = mysql_query($query_jurnal_rec);
  $totalRows_jurnal_rec = mysql_num_rows($all_jurnal_rec);
}
$totalPages_jurnal_rec = ceil($totalRows_jurnal_rec/$maxRows_jurnal_rec)-1;

$queryString_jurnal_rec = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_jurnal_rec") == false && 
        stristr($param, "totalRows_jurnal_rec") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_jurnal_rec = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_jurnal_rec = sprintf("&totalRows_jurnal_rec=%d%s", $totalRows_jurnal_rec, $queryString_jurnal_rec);
?>
<form class="well" name="form1" id="form1" method="get" action="">
<input type=hidden name='main' value='repo_jurnal'>
<?php echo $OWM_cari_jn ?> :
  <input name="katakunci" type="text" id="katakunci"  placeholder="Cari Jurnal"/> 
  <input class="btn btn-primary" name="cari" type="submit" id="cari" value="Cari" />
</form>

<?php if ($totalRows_jurnal_rec > 0) { // Show if recordset not empty ?>
<table class="table table-bordered" cellpadding="2" cellspacing="2">
  <tr>
    <th>#</th>
    <th>Nama Penulis </th>
    <th>Judul</th>
    <th>Download</th>
  </tr>
  <?php do { ?>
  <tr>
    <td><?php echo $row_jurnal_rec['id_jurnal']; ?></td>
    <td><?php echo $row_jurnal_rec['nama_penulis']; ?></td>
    <td><?php echo $row_jurnal_rec['title_jurnal']; ?></td>
    <td><a href="././repositorie/<?php echo $row_jurnal_rec['path']; ?>">File</a></td>
  </tr>
    <?php } while ($row_jurnal_rec = mysql_fetch_assoc($jurnal_rec)); ?>
</table>

<table border="0" width="100%" align="center">
<tr><td class="basic" colspan="4">Total : <?php echo $totalRows_jurnal_rec ?></td></tr>
  <tr>
    <td width="23%" align="center">
      <?php if ($pageNum_jurnal_rec > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_jurnal_rec=%d%s", $currentPage, 0, $queryString_jurnal_rec); ?>">First</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center">
      <?php if ($pageNum_jurnal_rec > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_jurnal_rec=%d%s", $currentPage, max(0, $pageNum_jurnal_rec - 1), $queryString_jurnal_rec); ?>">Previous</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_jurnal_rec < $totalPages_jurnal_rec) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_jurnal_rec=%d%s", $currentPage, min($totalPages_jurnal_rec, $pageNum_jurnal_rec + 1), $queryString_jurnal_rec); ?>">Next</a>
      <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_jurnal_rec < $totalPages_jurnal_rec) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_jurnal_rec=%d%s", $currentPage, $totalPages_jurnal_rec, $queryString_jurnal_rec); ?>">Last</a>
      <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_jurnal_rec == 0) { // Show if recordset empty ?>
Data tidak ditemukan
<?php } // Show if recordset empty ?>

<?php
mysql_free_result($jurnal_rec);
?>
