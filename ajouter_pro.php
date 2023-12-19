<?php
session_start();
if (!isset($_SESSION['email_in'])) {
    header('Location: index.php');
    exit(); 
}
include('conex.php');

   
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifier category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    
    .nani:hover,
    .nanda:hover,
    .nanimo:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease; 
    }
</style>
</head>
<body>
<div style="background-color:rgb(53, 163, 163);" class="d-flex justify-content-around  p-3 container ">
<div class="w-100 ">
    <nav style=" background-color:aqua;" class="navbar navbar-expand-lg navbar-light bg-light flex-column w-100 ">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarNavbar"
        aria-controls="sidebarNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="sidebarNavbar">
        <ul class="navbar-nav ">
           
            <li class="nav-item">
                <a class="nav-link nanimo" href="dashpord.php">manage users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nanimo" href="MANGECAT.php">manage categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nanimo" href="manage_products.php">manage products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn nanimo bg-primary text-light" href="index.php">log out</a>
            </li>
        </ul>
    </div>
</nav>


</div>
</div>
<div class="container justify-content-center p-5">
    <form class="form-section" method="post" enctype="multipart/form-data">
        <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">new name</label>
       <input type="text" id="name_category" class="form-control" name="name_pro" >

       </div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">prix</label>
       <input type="numner" id="name_category" class="form-control" name="prix" >

       </div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">l'offre</label>
       <input type="numner" id="name_category" class="form-control" name="offre" >

       </div>
       <div class="mb-3 w-50 mx-5">
  <label for="description" class="form-label ">new description</label>
  <textarea class="form-control" id="description" name="desc_pro" rows="3"></textarea>
</div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="img_category">new photo</label>
       <input type="file" id="img_category" class="form-control" name="file" >
       </div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">quantity mini</label>
       <input type="numner" id="name_category" class="form-control" name="quntt_min" >

       </div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">quantity de stok</label>
       <input type="numner" id="name_category" class="form-control" name="quntt_stk" >

       </div>

       <form method="post" style="margin-left:100px" class="  my-5 mb-5 mx-5">
       
        <select name="selectedCategory" id="categorySelect">
        <?php
        $category_list = $connection->query("SELECT * FROM Category");
        
        while ($productsCategory = $category_list->fetch_assoc()) {
            $categoryId = $productsCategory['category_id'];
            $categoryName = $productsCategory['category_name'];
            
            echo '<option value="' . $categoryId . '" style="color: red; font-size: 18px;">' . $categoryName . '</option>';
        }
        ?>
        </select>
        <button  type="submit" name="submit" class="btn bg-primary text-light mx-4 nani">modifier</button>
</form>
   
    </form>
    </div>
    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $categoryQuery = "SELECT * FROM products ";


    if (isset($_POST['name_pro'], $_POST['prix'],$_POST['offre'], $_POST['desc_pro'], $_FILES['file'],$_POST['quntt_min'], $_POST['quntt_stk'])) {
        $pro_nm = $_POST['name_pro'];
        $pro_prix= $_POST['prix'];
        $offre= $_POST['offre'];
        $pro_desc= $_POST['desc_pro'];
        $quntt_min= $_POST['quntt_min'];
        $quntt_stk=$_POST['quntt_stk'];
        
        if (isset($_POST['selectedCategory'])) {
            $selectedCategory = $_POST['selectedCategory'];

        }

       
            $photo = basename($_FILES['file']['name']);
            $targetPath = './images/' . $photo;
            $tempPath = $_FILES['file']['tmp_name'];

            if (move_uploaded_file($tempPath, $targetPath)) {
           
            $connection->query("INSERT INTO  products (etiquette, description_pro,prix_final, Offre_de_prix,quantite_min,quantite_stock, pro_image,categorie_id_fk,ise_deleted)
                 VALUES ('$pro_nm','$pro_desc','$pro_prix','$offre','$quntt_min',' $quntt_stk','$photo','$selectedCategory',0);
            
            ;");
            echo "uplo";
            header("Location: manage_products.php");
            exit();
        }else{
            echo "cnt uplo";
        }
    }
}
?>

</body>
</html>