<?php

include 'file_upload.php';

$filemanager = new FileManager();
$today = date("Y-m-d-H-i-s"); 
$file_name = today . '.dat';
$filemanager->savefile($file_name);
?>
<a href="http://localhost/web/FileUpload/index.html">戻る</a>
