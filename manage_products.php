
<?php
include('conex.php');

session_start();
if (!isset($_SESSION['email_in'])) {
    header('Location: index.php');
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage products</title>
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
<body class="bg-light">

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
            <li class="nav-item ">
                <a class="nav-link  nanimo  text-dark" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right mb-1" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
</svg></a>
            </li>
        </ul>
    </div>
</nav>


</div>
</div>


<div id="categories"  class=" container " style="">
<div class="bg-light d-flex justify-content-end mb-0">
    
    <a href="ajouter_pro.php"  class="btn bg-primary p-1 my-2 mx-5 text-light nani">add product</a>
    
</div>
    <table class="table table-bordered  w-100 ">
        <thead class="bg-black text-light ">
            <tr class="table ">
                <th class="p-3 fs-6  border-black" scope="col">ID</th>
                <th class="p-3 fs-6  border-black" scope="col">product name</th>
                <th class="p-3 fs-6  border-black" scope="col">code barres</th>
                <th class="p-3 fs-6  border-black" scope="col">product desc</th>
                <th class="p-3 fs-6 border-black" scope="col">product imag</th>
                <th class="p-3 fs-6 border-black" scope="col">prix dachat</th>
                <th class="p-3 fs-6 border-black" scope="col">prix final</th>
                <th class="p-3 fs-6 border-black" scope="col">Offre de prix</th>
                <th class="p-3 fs-6 border-black" scope="col"> quantite min</th>
                <th class="p-3 fs-6 border-black" scope="col">quantite de stock</th>
                <th class="p-3 fs-6 border-black" scope="col">category</th>
                <th class="p-3 fs-6  border-black" scope="col">delete/modify</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $PRODUCTS = "SELECT * FROM products where ise_deleted=0";
            $result = $connection->query($PRODUCTS);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $pro_id = $row['reference'];
                    $pro_name = $row['etiquette'];
                    $code_bars = $row['code_barres'];
                    $pro_descrip = $row['description_pro'];
                    $pro_img = $row['pro_image'];
                    $prix_dachat = $row['prix_dachat'];
                    $prix_final = $row['prix_final'];
                    $ofre = $row['Offre_de_prix'];
                    $quantt_min = $row['quantite_min'];
                    $quantt_stok = $row['quantite_stock'];
                    $category = $row['categorie_id_fk'];

                    echo '<tr class="justify-content-center">';
                    echo '<td class="border-black p-3">'. $pro_id .'</td>';
                    echo '<td class="border-black p-3">' . $pro_name . '</td>';
                    echo '<td class="border-black p-3" >' . $code_bars . '</td>';
                    echo '<td class="border-black p-3" >' . $pro_descrip . '</td>';
                    echo '<td class="border-black p-3 "><img src="images/' . $pro_img . '" class="w-75 h-75 " alt="Product Image" ></td>';
                    echo '<td class="border-black p-3" >' . $prix_dachat . '</td>';
                    echo '<td class="border-black p-3" >' . $prix_final . '</td>';
                    echo '<td class="border-black p-3" >' . $ofre . '</td>';
                    echo '<td class="border-black p-3" >' . $quantt_min . '</td>';
                    echo '<td class="border-black p-3" >' . $quantt_stok . '</td>';
                    echo '<td class="border-black p-3" >' .  $category . '</td>';
                    echo '<td class="border-black p-2">
                          <form method="POST" class="product-action-form  d-flex justify-content-betwen ">
                               <input type="hidden" name="category_id" value="' . $pro_id . '">
                               <a   href="delet_pro.php?id='. $pro_id.'"  class="btn bg-warning text-light mx-1  w-50 nanda">archif</a>
                               <a  type="submit"  href="pro_modif.php?id='. $pro_id.'"  class="btn bg-primary text-light w-50 mx-1 nani">Modify</a>
                          </form>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No PRODUCTS found</td></tr>";
            }

           
            
            ?>
        </tbody>
    </table>
    
</div>
    
<h2 class="text-center bg-dark p-2 text-light container">l'archife</h2>
<div id="categories"  class=" container  " style="">
    <table class="table table-bordered   w-100">
        <thead class="bg-black text-light ">
            <tr class="table ">
            <th class="p-3 fs-6  border-black" scope="col">ID</th>
                <th class="p-3 fs-6  border-black" scope="col">product name</th>
                <th class="p-3 fs-6  border-black" scope="col">code barres</th>
                <th class="p-3 fs-6  border-black" scope="col">product desc</th>
                <th class="p-3 fs-6 border-black" scope="col">product imag</th>
                <th class="p-3 fs-6 border-black" scope="col">prix dachat</th>
                <th class="p-3 fs-6 border-black" scope="col">prix final</th>
                <th class="p-3 fs-6 border-black" scope="col">Offre de prix</th>
                <th class="p-3 fs-6 border-black" scope="col"> quantite min</th>
                <th class="p-3 fs-6 border-black" scope="col">quantite de stock</th>
                <th class="p-3 fs-6  border-black" scope="col">delete/modify</th>
            </tr>
        </thead>
        <tbody >
        <?php
            $PRODUCTS = "SELECT * FROM products where ise_deleted=1";
            $result = $connection->query($PRODUCTS);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $pro_id = $row['reference'];
                    $pro_name = $row['etiquette'];
                    $code_bars = $row['code_barres'];
                    $pro_descrip = $row['description_pro'];
                    $pro_img = $row['pro_image'];
                    $prix_dachat = $row['prix_dachat'];
                    $prix_final = $row['prix_final'];
                    $ofre = $row['Offre_de_prix'];
                    $quantt_min = $row['quantite_min'];
                    $quantt_stok = $row['quantite_stock'];

                    echo '<tr class="justify-content-center">';
                    echo '<td class="border-black p-3">'. $pro_id .'</td>';
                    echo '<td class="border-black p-3">' . $pro_name . '</td>';
                    echo '<td class="border-black p-3" >' . $code_bars . '</td>';
                    echo '<td class="border-black p-3" >' . $pro_descrip . '</td>';
                    echo '<td class="border-black p-3 "><img src="images/' . $pro_img . '" class="w-25 h-25 " alt="Product Image" ></td>';
                    echo '<td class="border-black p-3" >' . $prix_dachat . '</td>';
                    echo '<td class="border-black p-3" >' . $prix_final . '</td>';
                    echo '<td class="border-black p-3" >' . $ofre . '</td>';
                    echo '<td class="border-black p-3" >' . $quantt_min . '</td>';
                    echo '<td class="border-black p-3" >' . $quantt_stok . '</td>';
                    echo '<td class="border-black p-2">
                          <form method="POST" class="category-action-form mx-3 d-flex">
                               <input type="hidden" name="category_id" value="' . $pro_id . '">
                               <a   href="restor_pro.php?id='. $pro_id.'"  class="btn btn-success text-light nanimo mx-1">restore</a>
                               <a   href="delet_prod.php?id='. $pro_id.'"  class="btn bg-danger text-light nanimo mx-1">delet</a>

                          </form>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No PRODUCTS found</td></tr>";
            }

           
            
            ?>
        </tbody>
    </table>
</div>
</body>
</html>