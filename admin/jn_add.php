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
// ** Upload Script
$uploadDir = '../jurnal/'; // Direktoy penyimpanan file
require "lib/file.common.php";
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
// ** upload script 
	$fileName = $_FILES['file_jurnal']['name'];
	$tmpName = $_FILES['file_jurnal']['tmp_name'];
	$fileSize = $_FILES['file_jurnal']['size'];
	$fileType = $_FILES['file_jurnal']['type'];

	// periksa extensi file
   $ext = substr($fileName, strpos($fileName,'.'), strlen($fileName)-1); 
    // File path
   $filePath = $uploadDir .$randName . '.' . $ext;
	
   // Cek type file yang diperboleh
   if(!in_array($ext,$allowed_filetypes))
      die('Type File tidak diperbolehkan');
   // File terlalu besar
   else if(filesize($_FILES['file_jurnal']['tmp_name']) > $max_filesize)
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
  $insertSQL = sprintf("INSERT INTO jurnal (id_jurnal, nama_penulis, title_jurnal, NotActive, name, size, type, path) VALUES (%s, %s, %s, %s, '$fileName', '$fileSize', '$fileType', '$filePath')",
                       GetSQLValueString($_POST['id_jurnal'], "int"),
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString(isset($_POST['checkbox']) ? "true" : "", "defined","'Y'","'N'"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_rec_jurnal = "SELECT * FROM jurnal";
$rec_jurnal = mysql_query($query_rec_jurnal, $koneksi) or die(mysql_error());
$row_rec_jurnal = mysql_fetch_assoc($rec_jurnal);
$totalRows_rec_jurnal = mysql_num_rows($rec_jurnal);
?>

<p><i>Master Jurnal</i></p>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1">
  <input name="id_jurnal" type="hidden" id="id_jurnal">
  <table cellpadding="2" cellspacing="2">
    <tr>
      <td class="ttl">Nama Penulis </td>
      <td class="ttl"><input name="nama" type="text" id="nama" size="40" maxlength="50"></td>
    </tr>
    <tr>
      <td class="ttl">Judul jurnal </td>
      <td class="ttl"><textarea name="judul" cols="40" id="judul"></textarea></td>
    </tr>
    <tr>
      <td class="ttl">File</td>
      <td class="ttl"><input name="file_jurnal" type="file" id="file_jurnal" size="40"></td>
    </tr>
    <tr>
      <td class="ttl">NotActive</td>
      <td class="ttl"><input type="checkbox" name="checkbox" value="checkbox"></td>
    </tr>
    <tr>
      <td class="ttl">&nbsp;</td>
      <td class="ttl"><input type="submit" name="Submit" value="Simpan">
      <input name="reset" type="reset" id="reset" value="Reset">
	  <input name="kembali" type="button" id="kembali" value="Kembali" onClick="location='index.php?main=jn_tampil'"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<fieldset><legend><?php echo $OWM_jn_file ?></legend>
<?php echo $OWM_isi_file ?>

<?php
mysql_free_result($rec_jurnal);
?>
