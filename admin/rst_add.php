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
// Thanks to :
// http://www.zymic.com/tutorials/php/creating-a-file-upload-form-with-php/
// http://www.php-mysql-tutorial.com/wikis/php-tutorial/uploading-files-to-the-server-using-php.aspx
// *************** http://openwebmurah.com ****************************************************************

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
// ** Upload Script
$uploadDir = '../riset/'; // Direktoy penyimpanan file
require "lib/file.common.php";
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
// ** upload script 
	$fileName = $_FILES['file_riset']['name'];
	$tmpName = $_FILES['file_riset']['tmp_name'];
	$fileSize = $_FILES['file_riset']['size'];
	$fileType = $_FILES['file_riset']['type'];

	// periksa extensi file
   $ext = substr($fileName, strpos($fileName,'.'), strlen($fileName)-1); 
    // File path
   $filePath = $uploadDir .$randName . '.' . $ext;
	
   // Cek type file yang diperboleh
   if(!in_array($ext,$allowed_filetypes))
      die('Type File tidak diperbolehkan');
   // File terlalu besar
   else if(filesize($_FILES['file_riset']['tmp_name']) > $max_filesize)
      die('File yang anda masukkan terlalu besar.');
   // Izin Direktory belum ada, silakan CHMOD ke 777
   else if(!is_writable($uploadDir))
      die('Izin Direktory belum ada, silakan CHMOD ke 777.');
	  
   else $result = move_uploaded_file($tmpName, $filePath);
	if (!$result) {
	echo "Error uploading file";
	exit;
		}
	if(!get_magic_quotes_gpc())
	{
	$fileName = addslashes($fileName);
	$filePath = addslashes($filePath);
	} 
  	
  $insertSQL = sprintf("INSERT INTO riset (id_riset, nama_peneliti, title_riset, NotActive, name, size, type, path) VALUES (%s, %s, %s, %s, '$fileName', '$fileSize', '$fileType', '$filePath')",
                       GetSQLValueString($_POST['id_riset'], "int"),
					   GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString(isset($_POST['checkbox']) ? "true" : "", "defined","'Y'","'N'"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_Recordset1 = "SELECT * FROM riset";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<p><i>Tambah Penelitian</i></p>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1">
<input name="id_riset" type="hidden" id="id_riset">
  <table cellpadding="2" cellspacing="2">
    <tr>
      <td class="ttl">Nama Peneliti </td>
      <td class="ttl"><input name="nama" type="text" id="nama" size="40" maxlength="50"></td>
    </tr>
    <tr>
      <td class="ttl">Judul Penelitian </td>
      <td class="ttl"><textarea name="judul" cols="40" id="judul"></textarea></td>
    </tr>
    <tr>
      <td class="ttl">File</td>
      <td class="ttl"><input name="file_riset" type="file" id="file_riset" size="40"></td>
    </tr>
    <tr>
      <td class="ttl">NotActive</td>
      <td class="ttl"><input type="checkbox" name="checkbox" value="checkbox"></td>
    </tr>
    <tr>
      <td class="ttl">&nbsp;</td>
      <td class="ttl"><input type="submit" name="Submit" value="Simpan">
      <input name="reset" type="reset" id="reset" value="Reset">
	  <input name="kembali" type="button" id="kembali" value="Kembali" onClick="location='index.php?main=rst_tampil'"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<fieldset><legend><?php echo $OWM_rst_file ?></legend>
<?php echo $OWM_isi_file ?>
</fieldset>

<?php
mysql_free_result($Recordset1);
?>
