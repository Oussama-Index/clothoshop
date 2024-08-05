<?php

require_once("../functions/db.php");
$state = $conn->query("SELECT * FROM stores");
$stores = $state->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include "head.php" ?>

<h1 class="main-title">
  MANAGE STORES
</h1>

<div class="con manage-stores">
    <div class="head">
        <div>Title</div>
        <div>Products Number</div>
        <div>Edit</div>
    </div>
    
    <?php
        foreach($stores as $store){
            ?>

            <div class="row">
                <div><?= $store['title'] ?></div>
                <div><?php
                    $counState = $conn->prepare("SELECT * FROM clothes WHERE id_store = :id");
                    $counState->execute([":id" => $store['id']]);
                    $data = $counState->fetchAll(PDO::FETCH_ASSOC);
                    echo count($data);
                ?></div>
                <div>
                    <a href="modify_store.php?id=<?= $store['id']?>">Modify</a>
                </div>
            </div>

            <?php
        }
    ?>
</div>

<?php include "foot.php" ?>