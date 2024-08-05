<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    if (!empty($_GET['id'])){
        $id = $_GET['id'];
        require_once("../functions/db.php");
        $stmt = $conn->prepare("DELETE FROM clothes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        header('location: home.php');
    }
}


?>