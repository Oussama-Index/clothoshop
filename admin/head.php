<?php
session_start();

    if (!isset($_SESSION['user']))
    {
        header('location:../index.php');
        exit;
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <ul class="nav nav-pills">

        <li class="nav-item">
            <a class="nav-link" href="../index.php">Shop</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_product.php">Add Product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_store.php">Add Store</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="home.php">Manage Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="manage_stores.php">Manage Stores</a>
        </li>
    </ul>