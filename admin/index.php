<?php require_once('../Connections/koneksi.php'); ?>
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
	require "../repo_cookie.php"; 
	require "lib/func.common.php";
	require "../disp.func.php";
	 //OWM error handler************************************
    require('../repo.ErrorHandler.php');

	define('FATAL', E_USER_ERROR);
	define('ERROR', E_USER_WARNING);
	define('WARNING', E_USER_NOTICE);

	$errorHandler = new ErrorHandler(1);
  // error handler sampai sini********************************
  require "../repo.log.php";
	
	?>
<?php
session_start();
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
mysql_select_db($database_koneksi, $koneksi);
$query_admstatus = "SELECT * FROM status WHERE status_id=1";
$admstatus = mysql_query($query_admstatus, $koneksi) or die(mysql_error());
$row_admstatus = mysql_fetch_assoc($admstatus);
$totalRows_admstatus = mysql_num_rows($admstatus);
?>
<?php
require "../template/style/main.css"; 
require "../common.php"; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administrator | Repository | <?php echo $row_admstatus['status_nama']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="../template/image/favicon.ico" type="image/x-icon" />
<link rel="icon" href="../template/image/favicon.ico" type="image/x-icon" />
</head>

<body>
<table width="900" align="center" class="basic">
 <tr>
    <td><?php include "menu_head.php"; ?></td>
  </tr>
  <tr>
    <td class="box"><?php include "menu_top.php"; ?></td>
  </tr>
  <tr>
    <td valign="top"><?php include $repo; ?></td>
  </tr>
  <tr>
    <td class="kaki"><?php include "menu_kaki.php"; ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($admstatus);
?>
