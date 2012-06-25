<?php
//$enlace = $path_a_tu_doc."/".$id;
$id = $_GET['id'];
$enlace = $id;
header ("Content-Disposition: attachment; filename=".$id." ");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
?> 