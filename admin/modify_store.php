
<?php
$data = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    if (!empty($_GET['id'])){
        $id_store = $_GET['id'];
        require_once("../functions/db.php");
        $stmt = $conn->prepare("SELECT * FROM stores WHERE id = :id");
        $stmt->execute([':id' => $id_store]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// MODIFY DATA
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (!empty($_POST['title']) && !empty($_POST['phone']) && !empty($_POST['id'])){
        $title = $_POST['title'];
        $phone = $_POST['phone'];
        $id = $_POST['id'];
        require_once("../functions/db.php");
        $state = $conn->prepare("UPDATE stores SET title = :title, phone = :phone WHERE id = :id");
        $state->execute([
            ":title" => $title,
            ":phone" => $phone,
            ":id" => $id
        ]);
        header("location: manage_stores.php");
    }
    else {
        echo "Fill the form information please";
    }
}


?>

<?php include "head.php" ?>

<h1 class="main-title">
    MODIFY STORE
</h1>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $data['title'] ?>">
    </div>
    <div class="form-group">
        <label for="title">Phone Number</label>
        <input type="tel" id="phone" name="phone" value="<?= $data['phone'] ?>"
        pattern="\d{10}" required>
        <div style="margin-top: 20px">Format: 0612345678 or similar</div>
    </div>
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <input type="submit" class="btn btn-primary" value="Modify Store">
    <a class="btn red" href="delete_store.php?id=<?= $data['id'] ?>" >Delete</a>
</form>


<?php include "foot.php" ?>