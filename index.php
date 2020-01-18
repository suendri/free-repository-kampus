<?php require_once('Connections/koneksi.php'); ?>
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
 require "repo_cookie.php"; 
 require "common.php"; 
 require "disp.func.php";
 //OWM error handler************************************
  require('repo.ErrorHandler.php');

	define('FATAL', E_USER_ERROR);
	define('ERROR', E_USER_WARNING);
	define('WARNING', E_USER_NOTICE);

	$errorHandler = new ErrorHandler(1);
  // error handler sampai sini********************************
  require "repo.log.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="template/image/favicon.ico" type="image/x-icon" />
<link rel="icon" href="template/image/favicon.ico" type="image/x-icon" />
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="bootstrap/css/bootswatch.css" rel="stylesheet">
<link href="bootstrap/css/font-awesome.min.css" rel="stylesheet">
<title>Repository | <?php echo $row_recstatus['status_nama']; ?></title>
</head>

<body class="preview" id="top" data-spy="scroll" data-target=".subnav" data-offset="80">
<!-- Navbar ================================================== -->
 <div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
     <div class="container">
       <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a>
       <a class="brand" href="index.php">Repository</a>
       <div class="nav-collapse collapse" id="main-menu">
        <ul class="nav" id="main-menu-left">
          <li><a href="index.php">&nbsp;<?php echo $OWM_home ?></a></li>
          <li><a href="index.php?main=repo_kontak"><?php echo $OWM_contact ?></a></li>
          <li><a href="index.php?main=repo_help"><?php echo $OWM_help ?></a></li>
		  <li><a href="index.php?main=repo_feedback"><?php echo $OWM_feed ?></a></li>
		  <li><a href="index.php?main=repo_donasi">Donasi</a></li>
		  <li><a href="admin">Login</a></li>
        </ul>
       </div>
     </div>
   </div>
 </div>
 
<div class="container">
<!-- Masthead ================================================== -->
<header class="subhead" id="overview">
  <div class="row">
    <div class="span6">
      <h1>Repository</h1>
      <p class="lead">Open Repository Campus</p>
    </div>
  </div>
  <div class="subnav">
    <ul class="nav nav-pills">
      <?php include "menu_kiri.php";  ?>
    </ul>
  </div>
</header>

<table width="900" class="basic" align="center">
  <tr>
    <td class="kiri" valign="top"><p>&nbsp;</p><?php include $repo;  ?></td>
  </tr>
    <tr>
    <td class="bhs" align="right" colspan="2">Indonesia | English | Privasi | Bantuan</td>
    </tr>
  <tr>
    <td class="kaki" colspan="2"><?php include "menu_kaki.php";  ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($recstatus);
?>
