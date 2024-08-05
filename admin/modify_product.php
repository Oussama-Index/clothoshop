<?php 

require_once("../functions/db.php");
$state = $conn->query("SELECT * FROM stores");
$state->execute();
$stores = $state->fetchAll(PDO::FETCH_ASSOC);

$product_data = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    if (!empty($_GET['id'])){
        $id_store = $_GET['id'];
        require_once("../functions/db.php");
        $stmt = $conn->prepare("SELECT * FROM clothes WHERE id = :id");
        $stmt->execute([':id' => $id_store]);
        $product_data = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  if (
    !empty($_POST['title']) &&
    !empty($_POST['price']) &&
    !empty($_POST['store']) &&
    !empty($_POST['categorie']) && 
    !empty($_POST['id'])
    )
  {

    $title = $_POST['title'];
    $price = $_POST['price'];
    $store = $_POST['store'];
    $categorie = $_POST['categorie'];
    $id = $_POST['id'];
    require_once("../functions/db.php");
    $sql = "UPDATE clothes SET title = :title, price = :price, id_store=:store, categorie=:categorie WHERE id=:id";

    $state = $conn->prepare($sql);
    $state->execute([
    ":title" => $title,
    ":price" => $price,
    ":store" => $store,
    ":categorie" => $categorie,
    ":id" => $id
    ]);
    header("location: home.php");
    echo "the produnct modified successfully";
  }
  else{
    echo "fill the form informations";
  }
}
?>

<?php include "head.php" ?>

<h1 class="main-title">
  ADD PRODUCT
</h1>

<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?= $product_data['title']?>">
  </div>

  <div class="form-group">
    <label for="price">Price</label>
    <input type="number" step="1" class="form-control" id="price" name="price" value="<?= $product_data['price']?>">
  </div>

  <div class="form-group">
    <label for="store">Store</label>
    <select class="form-control" id="store" name="store">
        <option value="<?= $product_data['id_store'] ?>">
            <?php
                foreach($stores as $store){
                    if ($store['id'] == $product_data['id_store']){
                        echo $store['title'];
                    }
                }
            ?>
        </option>
        <?php
        foreach($stores as $store){
          ?>
          <option value="<?= $store['id'] ?>"><?= $store['title'] ?></option>
          <?php
        }
        ?>
    </select>
  </div>
  
  <div class="form-group">
      <label for="gendre">Categorie: </label>

      <input type="radio" <?php echo $product_data['categorie'] == 'men' ? "checked" : "" ?> class="" id="gendre" name="categorie" value="men"> <label>men</label>
      <input type="radio" <?php echo $product_data['categorie'] == 'women' ? "checked" : "" ?> class="" id="gendre" name="categorie" value="women"> <label>women</label>
      <input type="radio" <?php echo $product_data['categorie'] == 'kids' ? "checked" : "" ?> class="" id="gendre" name="categorie" value="kids"> <label>kids</label>
  </div>
  <input type="hidden" name="id" value="<?= $product_data['id'] ?>">
  <input type="submit" class="btn-primary btn" name="submit" id="send" value="Add Product">
</form>

<?php include "foot.php" ?>