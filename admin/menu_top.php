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
//initialize the session
session_start();

// ** Logout the current user. **

if (isset($_REQUEST['logout'])) {
  session_unregister('MM_Username');
  session_unregister('MM_UserGroup');
}	


?>

<script language="JavaScript">
<!--
function mmLoadMenus() {
  if (window.mm_menu_0612103222_0) return;
                    window.mm_menu_0612103222_0 = new Menu("root",134,20,"",12,"#000000","#990000","#FFFFFF","#FF9933","left","middle",4,2,1000,-5,7,true,true,true,0,true,true);
  mm_menu_0612103222_0.addMenuItem("Master&nbsp;Status","location='index.php?main=menu_status'");
  mm_menu_0612103222_0.addMenuItem("Master&nbsp;FeedBack","location='index.php?main=fd_tampil'");
  mm_menu_0612103222_0.addMenuItem("Master&nbsp;Menu","location='index.php?main=mn_tampil'");
  mm_menu_0612103222_0.addMenuItem("Master&nbsp;Link","location='index.php?main=link_tampil'");
  mm_menu_0612103222_0.addMenuItem("Master&nbsp;Bantuan","location='index.php?main=help_tampil'");
  mm_menu_0612103222_0.addMenuItem("Master&nbsp;Berita","location='index.php?main=news_tampil'");
   mm_menu_0612103222_0.hideOnMouseOut=true;
   mm_menu_0612103222_0.bgColor='#555555';
   mm_menu_0612103222_0.menuBorder=1;
   mm_menu_0612103222_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0612103222_0.menuBorderBgColor='#999999';

mm_menu_0612103222_0.writeMenus();
} // mmLoadMenus()
//-->
</script>
<script language="JavaScript" src="mm_menu.js"></script>

<script language="JavaScript1.2">mmLoadMenus();</script>
<a href="index.php"><?php echo $OWM_home ?></a> | <a href="index.php?main=ta_tampil"><?php echo $OWM_Thesis ?></a> | <a href="index.php?main=rst_tampil"><?php echo $OWM_Research ?></a> | <a href="index.php?main=jn_tampil"><?php echo $OWM_Jurnal ?></a> | <a href="#" name="link2" id="link1" onMouseOver="MM_showMenu(window.mm_menu_0612103222_0,0,19,null,'link2')" onMouseOut="MM_startTimeout();">Master Master</a> | <a href="index.php?main=usr_tampil">Master User</a> |<a href="../index.php"> <?php echo $OWM_view ?></a> | <a href="index.php?logout=1">Logout</a>

