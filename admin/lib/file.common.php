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
mysql_select_db($database_koneksi, $koneksi);
$query_status_file = "SELECT status_type_file, status_max_file FROM status WHERE status_id=1";
$status_file = mysql_query($query_status_file, $koneksi) or die(mysql_error());
$row_status_file = mysql_fetch_assoc($status_file);
$totalRows_status_file = mysql_num_rows($status_file);

$file_en = $row_status_file['status_type_file'];
$allowed_filetypes = explode(",",$file_en); // Type file yang diperbolehkan
$max_filesize = $row_status_file['status_max_file']; // Ukuran file yang diperbolehkan
$randName = md5(rand() * time()); // Random nama file

mysql_free_result($status_file);

?>
