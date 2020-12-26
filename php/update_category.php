<?php
$str = file_get_contents('php://input');
header('Content-Type: application/json');
include "Utils.php";
$db = Utils::getPDO();
try {
    $query = $db->query($str);
    echo json_encode($query != false);
}
catch (Exception){
    echo json_encode(false);
}