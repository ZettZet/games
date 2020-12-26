<?php
$str = file_get_contents('php://input');
header('Content-Type: application/json');
include "Utils.php";
$db = Utils::getPDO();
try {
    $query = $db->query($str);
    if ($query!==false)
        echo json_encode($db->lastInsertId('category'));
    else
        echo json_encode(false);
}
catch (Exception){
    echo json_encode(false);
}