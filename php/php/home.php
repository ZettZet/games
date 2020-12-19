<?php
    require_once 'local.php';

    try {
        $pdo = new PDO($dsn, $user, $pass);
    }
    catch (PDOException $e) {
        die("Error!: " . $e->getMessage());
    }
    
?>