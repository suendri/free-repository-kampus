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
  $updateSQL = sprintf("UPDATE jurnal SET NotActive=%s WHERE id_jurnal=%s",
                       GetSQLValueString(isset($_POST['na']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM jurnal";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<p><i>Master Jurnal</i></p>
<a href="index.php?main=jn_add">Tambah Baru</a>
<table cellpadding="2" cellspacing="2">
  <tr>
    <td class="lst">No</td>
    <td class="lst">Nama Penulis </td>
    <td class="lst">Judul Jurnal </td>
    <td class="lst">Nama File </td>
    <td class="lst">Type File </td>
    <td class="lst">Size(Byte)</td>
    <td class="lst">Path</td>
    <td class="lst" colspan="2">NA</td>
  </tr>
  <?php do { ?>
  <tr>
    <td class="ttl"><?php echo $row_Recordset1['id_jurnal']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['nama_penulis']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['title_jurnal']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['name']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['type']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['size']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['path']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['NotActive']; ?></td>
    <td class="ttl"><form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      <input name="id" type="hidden" id="id" value="<?php echo $row_Recordset1['id_jurnal']; ?>">
      <input <?php if (!(strcmp($row_Recordset1['NotActive'],"Y"))) {echo "checked";} ?> name="na" type="checkbox" id="na" value="na" onClick="this.form.submit()">
      <input type="hidden" name="MM_update" value="form1">
    </form></td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<?php
mysql_free_result($Recordset1);
?>
