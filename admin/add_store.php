
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (!empty($_POST['title']) && !empty($_POST['phone'])){
        $title = $_POST['title'];
        $phone = $_POST['phone'];
        require_once("../functions/db.php");
        $state = $conn->prepare("INSERT INTO stores (title, phone) VALUES (:title, :phone)");
        $state->execute([":title" => $title, ":phone" => $phone]);
        header("location: manage_stores.php");
    }
    else {
        echo "Fill the form information please";
    }
}


?>

<?php include "head.php" ?>

<h1 class="main-title">
  ADD STORE
</h1>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
        <label for="title">Phone Number</label>
        <input type="tel" id="phone" name="phone" value=""
        pattern="\d{10}" required>
        <div style="margin-top: 20px">Format: 0612345678 or similar</div>
    </div>
    <input type="submit" class="btn btn-primary" value="Add Store">
</form>

<?php include "foot.php" ?>