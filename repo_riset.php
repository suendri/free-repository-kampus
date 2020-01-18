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

$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

$colname_Recordset2 = "1";
if (isset($_GET['katakunci'])) {
  $colname_Recordset2 = (get_magic_quotes_gpc()) ? $_GET['katakunci'] : addslashes($_GET['katakunci']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_Recordset2 = sprintf("SELECT id_riset, nama_peneliti, title_riset, `path` FROM riset WHERE title_riset LIKE '%%%s%%' AND NotActive='N'", $colname_Recordset2);
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $koneksi) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

$queryString_Recordset2 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset2") == false && 
        stristr($param, "totalRows_Recordset2") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset2 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset2 = sprintf("&totalRows_Recordset2=%d%s", $totalRows_Recordset2, $queryString_Recordset2);
?>
<form class="well" name="form1" id="form1" method="get" action="">
<input type=hidden name='main' value='repo_riset'>
  <?php echo $OWM_cari_rs ?> : 
  <input name="katakunci" type="text" id="katakunci" placeholder="Cari Riset" />
  <input class="btn btn-primary" name="cari" type="submit" id="cari" value="Cari" />
</form>

<?php if ($totalRows_Recordset2 > 0) { // Show if recordset not empty ?>
<table class="table table-bordered" cellpadding="2" cellspacing="2">
  <tr>
    <th>#</th>
    <th>Nama Peneliti </th>
    <th>Judul Penelitian </th>
    <th>Abstrak</th>
  </tr>
  <?php do { ?>
  <tr>
    <td><?php echo $row_Recordset2['id_riset']; ?></td>
    <td><?php echo $row_Recordset2['nama_peneliti']; ?></td>
    <td><?php echo $row_Recordset2['title_riset']; ?></td>
    <td><a href="././repositorie/<?php echo $row_Recordset2['path']; ?>" title="Klik untuk Download Abstrak">File</a></td>
  </tr>
  <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
</table>

<table border="0" width="100%" align="center">
<tr><td class="basic" colspan="4">Total : <?php echo $totalRows_Recordset2 ?></td></tr>
  <tr>
    <td width="23%" align="center">
      <?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, 0, $queryString_Recordset2); ?>">First</a>
      <?php } // Show if not first page ?>    </td>
    <td width="31%" align="center">
      <?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, max(0, $pageNum_Recordset2 - 1), $queryString_Recordset2); ?>">Previous</a>
      <?php } // Show if not first page ?>    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, min($totalPages_Recordset2, $pageNum_Recordset2 + 1), $queryString_Recordset2); ?>">Next</a>
      <?php } // Show if not last page ?>    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, $totalPages_Recordset2, $queryString_Recordset2); ?>">Last</a>
      <?php } // Show if not last page ?>    </td>
  </tr>
</table>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_Recordset2 == 0) { // Show if recordset empty ?>
Data tidak ditemukan
<?php } // Show if recordset empty ?>

<?php
mysql_free_result($Recordset2);
?>
