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
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE riset SET NotActive=%s WHERE id_riset=%s",
                       GetSQLValueString(isset($_POST['na']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM riset";
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

<p><i>Master Penelitian</i></p>
<a href="index.php?main=rst_add">Tambah Baru</a>
<table cellpadding="2" cellspacing="2">
  <tr>
    <td class="lst"><div align="center">No</div></td>
    <td class="lst"><div align="center">Nama</div></td>
    <td class="lst"><div align="center">Judul Penelitian </div></td>
    <td class="lst"><div align="center">Nama File</div></td>
    <td class="lst"><div align="center">Type</div></td>
    <td class="lst"><div align="center">Size(Byte)</div></td>
    <td class="lst"><div align="center">Path</div></td>
    <td colspan="2" class="lst"><div align="center">NA</div></td>
  </tr>
  <?php do { ?>
  <tr>
    <td class="ttl"><?php echo $row_Recordset1['id_riset']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['nama_peneliti']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['title_riset']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['name']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['type']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['size']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['path']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['NotActive']; ?></td>
    <td class="ttl"><form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      <input name="id" type="hidden" id="id" value="<?php echo $row_Recordset1['id_riset']; ?>">
      <input name="na" type="checkbox" id="na" value="Y" onClick="this.form.submit()" title="Checklist untuk Non Aktif" <?php if (!(strcmp($row_Recordset1['NotActive'],"Y"))) {echo "checked";} ?>>
      <input type="hidden" name="MM_update" value="form1">
    </form></td>
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
      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><< Previous</a>
      <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next >></a>
      <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center">
      <?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last >>></a>
      <?php } // Show if not last page ?>
    </td>
  </tr>
</table>

<?php
mysql_free_result($Recordset1);
?>
