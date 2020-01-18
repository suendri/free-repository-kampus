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
if ((isset($_GET['id_bantuan'])) && ($_GET['id_bantuan'] != "")) {
  $deleteSQL = sprintf("DELETE FROM bantuan_en WHERE id_bantuan=%s",
                       GetSQLValueString($_GET['id_bantuan'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
}
mysql_select_db($database_koneksi, $koneksi);
$query_rec_help = "SELECT * FROM bantuan_en";
$rec_help = mysql_query($query_rec_help, $koneksi) or die(mysql_error());
$row_rec_help = mysql_fetch_assoc($rec_help);
$totalRows_rec_help = mysql_num_rows($rec_help);
?>

<p><i>Master Bantuan</i></p>
<a href="index.php?main=help_add">Tambah Bantuan</a>
<table border="0">
  <tr>
    <td class="lst">No</td>
    <td class="lst">Pertanyaan</td>
    <td class="lst">Jawaban</td>
    <td class="lst">Hapus</td>
  </tr>
  <?php do { ?>
  <tr>
    <td class="ttl"><?php echo $row_rec_help['id_bantuan']; ?></td>
    <td class="ttl"><a href="index.php?main=help_edit&id_bantuan=<?php echo $row_rec_help['id_bantuan']; ?>"><?php echo $row_rec_help['pertanyaan']; ?></a></td>
    <td class="ttl"><?php echo $row_rec_help['jawaban']; ?></td>
    <td class="ttl"><div align="center"><a href="index.php?main=help_tampil&id_bantuan=<?php echo $row_rec_help['id_bantuan']; ?>"><img src="../template/image/remove.png" width="20" height="20" border="0" alt="Loading.."></a></div></td>
  </tr>
  <?php } while ($row_rec_help = mysql_fetch_assoc($rec_help)); ?>
</table>

<?php
mysql_free_result($rec_help);
?>
