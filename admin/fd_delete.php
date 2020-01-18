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

if ((isset($_GET['feed_id'])) && ($_GET['feed_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM owm_feedback WHERE feed_id=%s",
                       GetSQLValueString($_GET['feed_id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
}

$colname_fd_del = "1";
if (isset($_GET['feed_id'])) {
  $colname_fd_del = (get_magic_quotes_gpc()) ? $_GET['feed_id'] : addslashes($_GET['feed_id']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_fd_del = sprintf("SELECT * FROM owm_feedback WHERE feed_id = %s", $colname_fd_del);
$fd_del = mysql_query($query_fd_del, $koneksi) or die(mysql_error());
$row_fd_del = mysql_fetch_assoc($fd_del);
$totalRows_fd_del = mysql_num_rows($fd_del);
?>
<?php
mysql_free_result($fd_del);
?>
