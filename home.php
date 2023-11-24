<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css"></head>
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

    $category_list =  $connection->query("SELECT * FROM category");

    echo '<div class="container-fluid row mx-auto my-5">';
    while ($productsCategory = $category_list->fetch_assoc()){
        $categoryName = $productsCategory['category_name'];
        $categorydiscrip =  $productsCategory['category_desc'];
        $categoryimg =  $productsCategory['category_imag'];
        $categoryId =  $productsCategory['category_id'];
       
        echo '<div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">';
        echo '<div class="card p-3 h-100">';
        echo '<img src="' .  $categoryimg . '" class="card-img-top h-75" alt="Product Image">';
        echo '<div class="card-body">';
        echo '<a href="#"><h5 class="card-title">' . $categoryName . '</h5> </a>';
        echo '<p class="card-text">' . $categorydiscrip . '</p>';
        
      
        echo '</div></div></div>';
    }
    echo '</div>';
?>    
</body>
</html>