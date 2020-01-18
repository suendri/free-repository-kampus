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
  $updateSQL = sprintf("UPDATE status SET status_nama=%s, status_moto=%s, status_kontak=%s, status_kaki=%s, status_type_file=%s, status_max_file=%s WHERE status_id=%s",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['moto'], "text"),
                       GetSQLValueString($_POST['kontak'], "text"),
                       GetSQLValueString($_POST['footer'], "text"),
					   GetSQLValueString($_POST['type_file'], "text"),
					   GetSQLValueString($_POST['maxfile'], "int"),
                       GetSQLValueString(1, "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM status WHERE status_id = 1";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<p><i>Master Status</i></p>
<form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
  <table border="0">
    <tr>
      <td class="ttl">Nama Kampus </td>
      <td class="ttl"><textarea name="nama" cols="60" id="nama"><?php echo $row_Recordset1['status_nama']; ?></textarea></td>
    </tr>
    <tr>
      <td class="ttl">Moto Repository Kampus </td>
      <td class="ttl"><textarea name="moto" cols="60" id="moto"><?php echo $row_Recordset1['status_moto']; ?></textarea></td>
    </tr>
    <tr>
      <td class="ttl">Kontak</td>
      <td class="ttl"><textarea name="kontak" cols="60" rows="8" id="kontak"><?php echo $row_Recordset1['status_kontak']; ?></textarea></td>
    </tr>
    <tr>
      <td class="ttl">Footer</td>
      <td class="ttl"><textarea name="footer" cols="60" rows="8" id="footer"><?php echo $row_Recordset1['status_kaki']; ?></textarea></td>
    </tr>
    <tr>
      <td class="ttl">Type File </td>
      <td class="ttl"><input name="type_file" type="text" id="type_file" value="<?php echo $row_Recordset1['status_type_file']; ?>" size="60"></td>
    </tr>
    <tr>
      <td class="ttl">Max File</td>
      <td class="ttl"><input name="maxfile" type="text" id="maxfile" value="<?php echo $row_Recordset1['status_max_file']; ?>"></td>
    </tr>
    <tr>
      <td class="ttl">&nbsp;</td>
      <td class="ttl"><input type="submit" name="Submit" value="Update"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
</form><br>
<fieldset><legend><?php echo $OWM_attention ?></legend>
<?php echo $OWM_status_isi ?>
</fieldset>

<?php
mysql_free_result($Recordset1);
?>
