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
function validity(){
require ("antspam/securimage.php");
  $img = new Securimage();
  $valid = $img->check($_POST['code']);

  if($valid == true) {
    return true;
  } else {
    return false;
  }
}
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($_POST["kirim"]) && validity() ) {
  $insertSQL = sprintf("INSERT INTO owm_feedback (feed_id, feed_nama, feed_email, feed_pesan, tanggal) VALUES (%s, %s, %s, %s, now())",
                       GetSQLValueString($_POST['feed_id'], "int"),
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['pesan'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  DisplayHeader ($fmt_warning_fail,$OWM_feed_thanks);
}
else if (isset($_POST["kirim"])) {
DisplayHeader ($fmt_warning_ok,$OWM_feed_code_fail);
}

mysql_select_db($database_koneksi, $koneksi);
$query_fd_rec = "SELECT * FROM owm_feedback";
$fd_rec = mysql_query($query_fd_rec, $koneksi) or die(mysql_error());
$row_fd_rec = mysql_fetch_assoc($fd_rec);
$totalRows_fd_rec = mysql_num_rows($fd_rec);
?>

<p><i>&nbsp;Isi Feedback</i></p>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
<input name="feed_id" type="hidden" value="feed_id">
  <table cellpadding="2" cellspacing="2">
    <tr>
      <td class="ttl">Nama</td>
      <td class="ttl"><input name="nama" type="text" id="nama" size="30"></td>
    </tr>
    <tr>
      <td class="ttl">Email</td>
      <td class="ttl"><input name="email" type="text" id="email" size="30"></td>
    </tr>
    <tr>
      <td class="ttl">Pesan</td>
      <td class="ttl"><textarea name="pesan" cols="50" rows="10" id="pesan"></textarea></td>
    </tr>
	<tr>
   <td class="ttl">validation code</td>
   <td class="ttl"><img src="antspam/securimage_show.php"></td>
   </tr>
   <tr>
   <td class="ttl">Masukkan Validation Code</td>
   <td class="ttl"><input maxlength="5" size="5" name="code" type="text"></td>
</tr>
    <tr>
      <td class="ttl">&nbsp;</td>
      <td class="ttl"><input name="kirim" type="submit" id="kirim" value="Kirim">
      <input name="rest" type="reset" id="rest" value="Reset"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<?php
mysql_free_result($fd_rec);
?>
