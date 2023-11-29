<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
 
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
    <?php  
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "Electro_naccer_pro";
    
    $connection = new mysqli($hostname, $username, $password, $database);
    
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $result = $connection->query("SELECT * FROM products where ise_deleted = 0");
    $category_list =  $connection->query("SELECT * FROM category");
    ?>
       <a href="dashpord.php" class="btn bg-primary nani">dashboard</a>         
   <div class="d-flex bg-light">
    <form method="post" style="margin-left:30px" class="my-5 d-flex">
        <?php
        while ($productsCategory = $category_list->fetch_assoc()) {
            $categoryName = $productsCategory['category_name'];
           
            echo '<div>';
            echo '<input type="checkbox" value="' . $categoryName . '" name="filter[]" class="label mx-3" id="' . $categoryName . '">';
            echo '<label for="' . $categoryName . '">' . $categoryName . '</label>';
            echo '</div>';
        }
        ?>
        <input type="checkbox" value="quantity" name="quantt" class="label mx-3" id="quantt">
        <label for="quantt">filtre par quantity</label>
        <button type="submit" name="choose" class="btn bg-primary border-light mx-2 nani">Select</button>
    </form>

  
</div>
<?php
function display_products($result)
{
    echo '<div class="container-fluid row mx-auto my-4">';
    
    while ($product = $result->fetch_assoc()) {
       
        $imagePath = $product['pro_image'];
        $label = $product['etiquette'];
        $discription_pro = $product['description_pro'];
        $offre = $product['Offre_de_prix'];
        $prixfinal = $product['prix_final'];

        echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-3">';
        echo '<div class="card p-3 h-100 nani">';
        echo '<img src="/electro_naccer/images/' . $imagePath . '" class="card-img-top h-75" alt="Product Image">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $label . '</h5>';
        echo '<p class="card-text">' . $discription_pro . '</p>';
        echo '<p class="card-text">' . $offre . ' DH</p>';
        echo '<p class="card-text">' . $prixfinal . ' DH</p>';
      
        echo '</div></div></div>';
    }
    
    echo '</div>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['choose'])) {
    if (!empty($_POST['filter'])) {
        $selectedCategories = $_POST['filter'];

     
        $sanitizedCategories = array_map(function ($category) use ($connection) {
            return "'" . $connection->real_escape_string($category) . "'";
        }, $selectedCategories);

        $catChecked = implode(',', $sanitizedCategories);

       
        $sql = "SELECT products.*, category.category_name FROM products 
                JOIN category ON products.categorie_id_fk = category_name
                WHERE category.category_name IN ($catChecked)";
        $result = $connection->query($sql);

        
        display_products($result);
    } 
    else if(!empty($_POST['quantt'])){
        $sql = "SELECT * from Products where quantite_stock < quantite_min;";
        $result = $connection->query($sql);
        display_products($result);
    }
    
    else {
       
        $sql = "SELECT products.*, category.category_name FROM products 
                JOIN category ON products.categorie_id_fk = category.category_name";
        $result = $connection->query($sql);

       
        display_products($result);
    }
    
} else {
  
    $sql = "SELECT products.*, category.category_name FROM products 
            JOIN category ON products.categorie_id_fk = category.category_name";
    $result = $connection->query($sql);

   
    display_products($result);
}
   ?>
</body
</html>