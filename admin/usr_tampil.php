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
$query_Recordset1 = "SELECT * FROM adminen";
$Recordset1 = mysql_query($query_Recordset1, $koneksi) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<p><i>Master User</i></p>
<a href="index.php?main=usr_add">Tambah Baru</a>

<table cellpadding="2" cellspacing="2">
  <tr>
    <td class="lst">Username</td>
    <td class="lst">Password</td>
    <td class="lst">NotActive</td>
    <td class="lst">Aksi</td>
  </tr>
  <?php do { ?>
  <tr>
    <td class="ttl"><?php echo $row_Recordset1['username']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['password']; ?></td>
    <td class="ttl"><?php echo $row_Recordset1['NotActive']; ?></td>
    <td class="ttl"><a href="index.php?main=usr_edit&username=<?php echo $row_Recordset1['username']; ?>">Edit</a></td>
  </tr>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table><br>
<fieldset><legend><?php echo $OWM_attention ?></legend>
<?php echo $OWM_usr_isi ?>
</fieldset>

<?php
mysql_free_result($Recordset1);
?>
