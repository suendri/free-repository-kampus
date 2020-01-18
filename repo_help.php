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
$query_rec_help = "SELECT * FROM bantuan_en";
$rec_help = mysql_query($query_rec_help, $koneksi) or die(mysql_error());
$row_rec_help = mysql_fetch_assoc($rec_help);
$totalRows_rec_help = mysql_num_rows($rec_help);
?>
<p><img src="template/image/he.png" border="0">&nbsp;<i><?php echo $OWM_list_help ?></i></p>
<table class="table table-hover" border="0">
  <tr>
    <th>#</th>
    <th>Pertanyaan</th>
    <th>Jawaban</th>
  </tr>
  <?php do { ?>
  <tr>
    <td><?php echo $row_rec_help['id_bantuan']; ?></td>
    <td><?php echo $row_rec_help['pertanyaan']; ?></td>
    <td><?php echo $row_rec_help['jawaban']; ?></td>
  </tr>
  <?php } while ($row_rec_help = mysql_fetch_assoc($rec_help)); ?>
</table>

<?php
mysql_free_result($rec_help);
?>
