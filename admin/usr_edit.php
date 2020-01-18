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
// tambahkan ekripsi password dan pengacak
$username = $_POST['username'];
$password = $_POST['password']; 

$pengacak  = "NDJS3289JSKS190JISJI";
$password = md5($pengacak . md5($password) . $pengacak);
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE adminen SET password=%s, NotActive=%s WHERE username=%s",
                       GetSQLValueString($password, "text"),
                       GetSQLValueString(isset($_POST['checkbox']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($username, "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_Recordset1 = "1";
if (isset($_GET['username'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['username'] : addslashes($_GET['username']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = sprintf("SELECT * FROM adminen WHERE username = '%s'", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

?>

<p><i>Edit User</i></p>

<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table cellpadding="2" cellspacing="2">
    <tr>
      <td class="ttl">Username</td>
      <td class="ttl"><input name="username" type="text" id="username" value="<?php echo $row_Recordset1['username']; ?>"></td>
    </tr>
    <tr>
      <td class="ttl">Password</td>
      <td class="ttl"><input name="password" type="password" id="password" value="<?php echo $row_Recordset1['password']; ?>" size="40"></td>
    </tr>
    <tr>
      <td class="ttl">NotActive</td>
      <td class="ttl"><input <?php if (!(strcmp($row_Recordset1['NotActive'],"Y"))) {echo "checked";} ?> type="checkbox" name="checkbox" value="checkbox"></td>
    </tr>
    <tr>
      <td class="ttl">&nbsp;</td>
      <td class="ttl"><input type="submit" name="Submit" value="Update">
      <input name="reset" type="reset" id="reset" value="Reset"><input name="kembali" type="button" id="kembali" value="Kembali" onClick="location='index.php?main=usr_tampil'"></td>
    </tr>
  </table>
    <input type="hidden" name="MM_update" value="form1">
</form>

<?php
mysql_free_result($Recordset1);
?>
