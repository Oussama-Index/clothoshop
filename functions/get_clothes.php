<?php

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    require_once("../functions/db.php");
    $stmt = $conn->query("SELECT * FROM clothes");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}

?>