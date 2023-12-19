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
    <title>manage categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>


<style>.nanimo:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease; 
        
    }</style>
<div style="background-color:rgb(53, 163, 163);" class="d-flex justify-content-around  p-3  container">
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
                <a class="nav-link btn nanimo bg-primary text-light " href="index.php">log out</a>
            </li>
        </ul>
    </div>
</nav>


</div>
</div>
<div class="bg-light d-flex justify-content-end mb-0 container">
    
<a href="ajout_cat.php"  class="btn bg-primary p-2 my-2 mx-5 text-light nanimo">add category</a>    
</div>
 
<div id="categories"  class=" container mb-5" style="">
    <table class="table  table-bordered w-100">
        <thead class="bg-black text-light ">
            <tr class="table ">
               
                <th class="p-3  border-black" scope="col">category_name</th>
                <th class="p-3  border-black" scope="col">category_desc</th>
                <th class="p-3 border-black" scope="col">category_imag</th>
                <th class="p-3  border-black" scope="col">delete/modify</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $categoryQuery = "SELECT * FROM category where ise_deleted=0";
            $result = $connection->query($categoryQuery);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $categoryName = $row['category_name'];
                    $categoryDiscrip = $row['category_desc'];
                    $categoryImg = $row['category_imag'];
                    $categoryid = $row['category_id'];
                    

                    echo '<tr class="justify-content-center">';
                    
                    echo '<td class="border-black p-3">' . $categoryName . '</td>';
                    echo '<td class="border-black p-3" >' . $categoryDiscrip . '</td>';
                    echo '<td class="border-black p-3 "><img src="images/' . $categoryImg . '" class="w-25 h-25 " alt="Product Image" ></td>';
                    echo '<td class="border-black p-2">
                          <form method="POST" class="category-action-form mx-3">
                               <input type="hidden" name="category_name" value="' . $categoryid . '">
                               <a   href="delet_cat.php?id='. $categoryid.'"  class="btn bg-danger text-light nanimo">delet</a>
                               <a  href="modif_cat.php?id='. $categoryid.'"  class="btn bg-primary text-light nanimo">Modify</a>
                          </form>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No categories found</td></tr>";
            }

           
            
            ?>
        </tbody>
    </table>
</div>
    
  <h2 class="text-center bg-dark p-2 text-light container">l'archife</h2>
<div id="categories"  class=" container  " style="">
    <table class="table table-bordered container">
        <thead class="bg-black text-light ">
            <tr class="table ">
                <th class="p-3  border-black" scope="col">ID</th>
                <th class="p-3  border-black" scope="col">category_name</th>
                <th class="p-3 border-black" scope="col">category_imag</th>
                <th class="p-3  border-black" scope="col">delete/modify</th>
            </tr>
        </thead>
        <tbody >
            <?php
            $categoryQuery = "SELECT * FROM category where ise_deleted=1";
            $result = $connection->query($categoryQuery);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $categoryName = $row['category_name'];
                    $categoryDiscrip = $row['category_desc'];
                    $categoryImg = $row['category_imag'];
                    $categoryid =$row['category_id'];

                    echo '<tr class="justify-content-center">';
                   
                    echo '<td class="border-black p-3">' . $categoryName . '</td>';
                    echo '<td class="border-black p-3" >' . $categoryDiscrip . '</td>';
                    echo '<td class="border-black p-3 "><img src="./images/' . $categoryImg . '" class="w-25 h-25 " alt="Product Image" ></td>';
                    echo '<td class="border-black p-2">
                          <form method="POST" class="category-action-form mx-3">
                               <input type="hidden" name="category_name" value="' . $categoryid . '">
                               <a   href="restorecat.php?id='. $categoryid.'"  class="btn bg-warning text-light nanimo">restore</a>
                               <a   href="delet.php?id='. $categoryid.'"  class="btn bg-danger text-light nanimo">delet</a>
                          </form>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No categories found</td></tr>";
            }

           
            
            ?>
        </tbody>
    </table>
</div>
</body>
</html>