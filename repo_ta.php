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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "1";
if (isset($_GET['katakunci'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['katakunci'] : addslashes($_GET['katakunci']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = sprintf("SELECT * FROM ta WHERE judul LIKE '%%%s%%'", $colname_Recordset1);
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>

<form class="well" name="form1" id="form1" method="get" action="index.php">
<input type=hidden name='main' value='repo_ta'>
<?php echo $OWM_cari_ta ?> : 
    <input name="katakunci" type="text" id="katakunci" placeholder="Cari Tugas Akhir" />
    <input class="btn btn-primary" name="cari" type="submit" value="Cari" />
</form>

<?php if ($totalRows_Recordset1 > 0) { // Show if recordset not empty ?>
<table class="table table-bordered" cellpadding="2" cellspacing="2">
  <tr>
    <th>#</th>
    <th>Nim</th>
    <th>Nama</th>
    <th>Judul</th>
    <th>Tahun</th>
  </tr>
  <?php do { ?>
  <tr class="bg">
    <td><?php echo $row_Recordset1['id']; ?></td>
    <td><?php echo $row_Recordset1['nim']; ?></td>
    <td><?php echo $row_Recordset1['nama']; ?></td>
    <td><?php echo $row_Recordset1['judul']; ?></td>
    <td><?php echo $row_Recordset1['tahun']; ?></td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<?php } // Show if recordset not empty ?>
<table class="basic" border="0" width="100%" align="center">
<tr><td class="basic" colspan="4">Total : <?php echo $totalRows_Recordset1 ?></td></tr>
  <tr>
    <td width="25%" align="center">
      <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"> <<< Pertama</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="25%" align="center">
      <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"> << Sebelumnya</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="25%" align="center">
      <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Selanjutnya >> </a>
      <?php } // Show if not last page ?>
    </td>
    <td width="25%" align="center">
      <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Terakhir >>> </a>
      <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<?php if ($totalRows_Recordset1 == 0) { // Show if recordset empty ?>
<p>Data tidak ditemukan ! </p>
<?php } // Show if recordset empty ?>

<?php
mysql_free_result($Recordset1);
?>
