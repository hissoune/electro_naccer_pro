
<?php
session_start();
if (!isset($_SESSION['email_in'])) {
    header('Location: index.php');
    exit(); 
}

include('conex.php');



if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $delete_cat = "DELETE FROM products  WHERE reference = $id";

    if ($connection->query($delete_cat) === TRUE) {
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error deleting category: " . $connection->error;
    }
}











?>