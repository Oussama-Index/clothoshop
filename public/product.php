<?php

$myCloth = '';
$myStore = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    if (!empty($_GET['id'])){
        $id_cloth = $_GET['id'];
        require_once("../functions/db.php");
        $cloth_stmt = $conn->prepare("SELECT * FROM clothes WHERE id=:id");
        $cloth_stmt->execute([':id' => $id_cloth]);
        $myCloth = $cloth_stmt->fetch(PDO::FETCH_ASSOC);
        
        $store_stmt = $conn->prepare("SELECT * FROM stores WHERE id=:id");
        $store_stmt->execute([':id' => $myCloth['id_store']]);
        $myStore = $store_stmt->fetch(PDO::FETCH_ASSOC);



    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClothoShop</title>

    <link rel="stylesheet" href="style.min.css" />

    <meta name="description" content="Are you looking for best quality and modern moroccan clothes, you are in the right place,
    with ClothoShop you can get it now with best prices, just one click on the piece of clothes you
    want and we will get you in touch with the seller.">
    <meta name="keywords" content="clothoshop, modern clothes, moroccan clothes, clothshop, shopcloth, clothes, clothes shop, clothes store, moroccan clothes store, moroccan clothes store">
    <title>Product</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="con product">
        <h1 class="title"> <?= $myCloth['title'] ?> </h1>
        <div class="imgCon">
            <img src="<?= $myCloth['img'] ?>" alt="">
        </div>
        <p class="price">Price: <span><?= $myCloth['price'] ?></span> DH </p>
        <p class="categrorie">Categorie: <span><?= $myCloth['categorie'] ?></span>  </p>
        <p class="store">Shop: <span><?= $myStore['title'] ?></span>  </p>
        <p class="phone"> Shop Phone: +212 <a id='link'><span><?= $myStore['phone'] ?></span></a>  </p>
    </div>
    <script>
        let mylink = document.getElementById('link');
        var phoneNumber = '212<?= $myStore['phone'] ?>';
        var msg = encodeURIComponent(`est-ce que ce produit est disponible ? (id_produit: ${<?= $myCloth['id'] ?>}), 
        le lien: https://clothoshop.lovestoblog.com/public/product.php?id=<?= $myCloth['id'] ?>`);
        mylink.onclick = () => {
            window.location.href = "https://wa.me/" + phoneNumber + "?text=" + msg;
        }
    </script>
</body>
</html>