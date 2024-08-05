<?php
require_once("../functions/db.php");
$state = $conn->query("SELECT * FROM clothes");
$clothes = $state->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include "head.php" ?>

<h1 class="main-title">
  MANAGE PRODUCTS
</h1>

<div class="con manage-products">
    <div class="head">
        <div>Title</div>
        <div>Price</div>
        <div>Categorie</div>
        <div>Store</div>
        <div>Edit</div>
    </div>
    
    <?php
        foreach($clothes as $cloth){
            ?>

            <div class="row">
                <div><?= $cloth['title'] ?></div>
                <div><?= $cloth['price']?></div>
                <div><?= $cloth['categorie']?></div>
                <div><?php
                $titleState = $conn->prepare("SELECT title FROM stores WHERE id = :id");
                $titleState->execute([":id" => $cloth['id_store']]);
                $store = $titleState->fetch();
                echo $store['title'];
                ?></div>
                <div>
                    <a href="modify_product.php?id=<?= $cloth['id']?>">Modify</a>
                    <a href="delete_product.php?id=<?= $cloth['id']?>">Delete</a>
                </div>
            </div>

            <?php
        }
    ?>
</div>

<?php include "foot.php" ?>