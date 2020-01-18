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
// Replace main.php untuk link yang dipanggil.
//
$repo = $_GET['main'];
if (empty($repo)) $repo="main";
$repo="$repo.php";

//
// Panggil database untuk status.
//
mysql_select_db($database_koneksi, $koneksi);
$query_recstatus = "SELECT * FROM status WHERE status_id=1";
$recstatus = mysql_query($query_recstatus, $koneksi) or die(mysql_error());
$row_recstatus = mysql_fetch_assoc($recstatus);
$totalRows_recstatus = mysql_num_rows($recstatus);

//
// Fungsi untuk tampil peringatan !
// file yang bersangkutan. disp.func.php, indonesia.php
//
function DisplayHeader ($fmt, $title, $write=1) {
    if ($write==1)
	  echo str_replace('=TITLE=', $title, $fmt);
	return str_replace('=TITLE=', $title, $fmt);
}

?>
