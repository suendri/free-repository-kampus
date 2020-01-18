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
$agent = $_SERVER['HTTP_USER_AGENT'];
$uri = $_SERVER['REQUEST_URI'];
$ip = $_SERVER['REMOTE_ADDR'];
$ref = $_SERVER['HTTP_REFERER'];
$ipasli = $_SERVER['HTTP_X_FORWARDED_FOR'];
$via = $_SERVER['HTTP_VIA'];
$dtime = date('r');
$entry_line =
"
//--------------------------- //
Waktu: $dtime
IP asli: $ip
Browser: $agent
URL: $uri
Referrer: $ref
Proxy: $ipasli
Koneksi: $via
//--------------------------- //
";
$fp = fopen("LOG.txt", "a");
fputs($fp, $entry_line);
fclose($fp);
?>
