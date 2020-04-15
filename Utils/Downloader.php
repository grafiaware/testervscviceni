<?php
/**
 * Description of DOREL
 *
 * @author pes2704
 */
class Downloader {
    public static function download($souborProDownload) { 
        if (file_exists($souborProDownload)) {
            header('Content-Description: File Transfer');
            //header("Content-type: application/force-download"); 
            //header('Content-Type','text/html; charset=windows-1250');
            //header('Content-type: application/pdf');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($souborProDownload).'"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($souborProDownload));
            ob_clean();
            flush();
            readfile($souborProDownload);
            exit;
        }
    }
}
