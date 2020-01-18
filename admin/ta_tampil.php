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

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM ta";
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

<p><i>Home &gt;&gt; Master Tugas Akhir</i></p>
<a href="index.php?main=ta_add">Tambah Baru</a>
<table border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="lst"><div align="center">id</div></td>
    <td class="lst"><div align="center">nim</div></td>
    <td class="lst"><div align="center">nama</div></td>
    <td class="lst"><div align="center">judul</div></td>
    <td class="lst"><div align="center">tahun</div></td>
    <td class="lst" colspan="2"><div align="center">Aksi</div></td>
  </tr>
  <?php do { ?>
  <tr>
    <td class="ttl"><?php echo $row_Recordset1['id']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['nim']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['nama']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['judul']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['tahun']; ?></td>
    <td class="ttl"><a href="index.php?main=ta_edit&id=<?php echo $row_Recordset1['id']; ?>">Edit</a></td>
    <td class="ttl"><a href="index.php?main=ta_delete&id=<?php echo $row_Recordset1['id']; ?>">Delete</a></td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

<table class="basic" border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center">
      <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"><<< First</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center">
      <?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"> << Previous</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next >> </a>
      <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last >>> </a>
      <?php } // Show if not last page ?>
    </td>
  </tr>
</table>

<?php
mysql_free_result($Recordset1);
?>
