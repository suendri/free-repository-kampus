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

class ErrorHandler
{
    private $debug = 0;

    public function __construct($debug = 0)
    {
        $this->debug = $debug;
        set_error_handler(array($this, 'handleError'));
    }

    public function handleError($errorType, $errorString, $errorFile, $errorLine)
    {	
        switch ($errorType)
        {
            case FATAL:
	            switch ($this->debug)
	            {
					case 0:
	                    echo 'Sadly an error has occured!';
	                    exit;
	                case 1:
	                    echo "<pre><b>FATAL</b> [T: $errorType] [L: $errorLine] [F: $errorFile]<br/>$errorString<br /></pre>";
	                    exit;
	            }
            case ERROR:
	            echo "<pre><b>ERROR</b> [T: $errorType] [L: $errorLine] [F: $errorFile]<br/>$errorString<br /></pre>";
	            break;
            case WARNING:
	            echo "<pre><b>WARNING</b> [T: $errorType] [L: $errorLine] [F: $errorFile]<br/>$errorString<br /></pre>";
	            break;
        }
    }
} 

?>
