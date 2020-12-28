<?php
if(!empty($_GET)){
    include "../Utils.php";
    $db = Utils::getPDO();
    $stm = $db->prepare("select * from category where id=?");
    $stm->execute([$_GET['id']]);
    echo json_encode($stm->fetchAll()[0]);
}