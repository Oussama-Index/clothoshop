<?php 

require_once("../functions/db.php");
$state = $conn->query("SELECT * FROM stores");
$state->execute();
$data = $state->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  if (
    !empty($_POST['title']) &&
    !empty($_POST['price']) &&
    !empty($_POST['store']) &&
    !empty($_POST['categorie']) &&
    isset($_FILES['myImage']) && $_FILES['myImage']['error'] == UPLOAD_ERR_OK
    )
  {

    $title = $_POST['title'];
    $price = $_POST['price'];
    $store = $_POST['store'];
    $categorie = $_POST['categorie'];

    include "upload.php";

    if ($uploadOk){
      require_once("../functions/db.php");
      $sql = "INSERT INTO clothes (title, price, id_store, categorie, img) VALUES (:title, :price, :store, :categorie, :img)";
  
      $state = $conn->prepare($sql);
      $state->execute([
        ":title" => $title,
        ":price" => $price,
        ":store" => $store,
        ":categorie" => $categorie,
        ":img" => $target_file
      ]);
  
      echo "the produnct added successfully";

    }
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
    <input type="text" class="form-control" id="title" name="title">
  </div>

  <div class="form-group">
    <label for="price">Price</label>
    <input type="number" step="1" class="form-control" id="price" name="price">
  </div>

  <div class="form-group">
    <label for="store">Store</label>
    <select class="form-control" id="store" name="store">
        <option value="">Select a Store</option>
        <?php
        foreach($data as $store){
          ?>
          <option value="<?= $store['id'] ?>"><?= $store['title'] ?></option>
          <?php
        }
        ?>
    </select>
  </div>
  
  <div class="form-group">
      <label for="gendre">Categorie: </label>

      <input type="radio" class="" id="gendre" name="categorie" value="men"> <label>men</label>
      <input type="radio" class="" id="gendre" name="categorie" value="women"> <label>women</label>
      <input type="radio" class="" id="gendre" name="categorie" value="kids"> <label>kids</label>
  </div>

  <div class="form-group">
    <label for="myImage">Image</label>
    <input type="file" name="myImage">
  </div>

  <input type="submit" class="btn-primary btn" name="submit" id="send" value="Add Product">
</form>

<?php include "foot.php" ?>