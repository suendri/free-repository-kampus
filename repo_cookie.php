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
// file : repo_cookie.php
// hati-hati merobah file ini, cookie terletak pada file ini
// created phpbego, pertengahan juni 2011, capek bangat..
// visit http://openwebmurah.com
// script ini terinspirasi dari http://sisfokampus.com
  function WriteCookie ($variabel, $value) {
    $nextyear = mktime (0,0,0,date("m"),date("d"),date("Y")+1);
    setcookie($variabel,$value,$nextyear);
  }
// Cek jika ada perintah perubahan bahasa
  if (!isset($_REQUEST ['setlang'])) $SetLang=0;
  else $SetLang = $_REQUEST ['setlang'];

  // jika tidak ada perintah perubahan bahasa:
  if ($SetLang==0) {
    // Jika cookie belum diset, gunakan bahasa default: Indonesia
    if (empty ($_COOKIE ['uselang'])) {
      $Language = 'indonesia';
      WriteCookie ('uselang', $Language);
    }
    else {
      // refresh cookie untuk pemakaian 1 tahun lagi.
      $Language = $_COOKIE ['uselang'];
      WriteCookie ('uselang', $Language);
    }
  }
  else if ($SetLang==1) {
    $UseLang = $_POST ['uselang'];
    $Language = $UseLang;
    WriteCookie ('uselang', $Language);
  }
  // Jangan lupa file bahasa di-include
  include "lang/$Language.php";
  
?>
