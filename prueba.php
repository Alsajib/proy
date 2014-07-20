<?php

require_once 'curl_access.php';

$auth = new autorizacion("salud");

$jason_decode = $auth->Get_Respuesta_JasonDecode(true); 

print_r($jason_decode);

?>