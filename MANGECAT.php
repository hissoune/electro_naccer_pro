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
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "Electro_naccer_pro";

$connection = new mysqli($hostname, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
<div style="background-color:rgb(53, 163, 163);" class="d-flex justify-content-around  p-3  ">
<a href="dashpord.php" class="btn bg-primary text-light">back</a>
    <h4 class="text-light">manage your categories</h4>
</div>
<div>
    
    <a href="ajout_cat.php"  class="btn bg-primary p-3 my-2 mx-5 text-light">add category</a>
    
</div>

<div id="categories"  class=" w-100 mb-5" style="">
    <table class="table  w-100">
        <thead class="bg-black text-light ">
            <tr class="table ">
                <th class="p-3  border-black" scope="col">ID</th>
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
                    $categoryId = $row['category_id'];

                    echo '<tr class="justify-content-center">';
                    echo '<td class="border-black p-3">' . $categoryId . '</td>';
                    echo '<td class="border-black p-3">' . $categoryName . '</td>';
                    echo '<td class="border-black p-3" >' . $categoryDiscrip . '</td>';
                    echo '<td class="border-black p-3 "><img src="' . $categoryImg . '" class="w-25 h-25 " alt="Product Image" ></td>';
                    echo '<td class="border-black p-2">
                          <form method="POST" class="category-action-form mx-3">
                               <input type="hidden" name="category_id" value="' . $categoryId . '">
                               <a   href="delet_cat.php?id='. $categoryId.'"  class="btn bg-danger text-light">delet</a>
                               <a  type="submit"  href="modif_cat.php?id='. $categoryId.'"  class="btn bg-primary text-light">Modify</a>
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
    
  <h2 class="text-center bg-black p-5 text-light">l'archife</h2>
<div id="categories"  class=" w-100  " style="">
    <table class="table  w-100">
        <thead class="bg-black text-light ">
            <tr class="table ">
                <th class="p-3  border-black" scope="col">ID</th>
                <th class="p-3  border-black" scope="col">category_name</th>
                <th class="p-3  border-black" scope="col">category_desc</th>
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
                    $categoryId = $row['category_id'];

                    echo '<tr class="justify-content-center">';
                    echo '<td class="border-black p-3">' . $categoryId . '</td>';
                    echo '<td class="border-black p-3">' . $categoryName . '</td>';
                    echo '<td class="border-black p-3" >' . $categoryDiscrip . '</td>';
                    echo '<td class="border-black p-3 "><img src="' . $categoryImg . '" class="w-25 h-25 " alt="Product Image" ></td>';
                    echo '<td class="border-black p-2">
                          <form method="POST" class="category-action-form mx-3">
                               <input type="hidden" name="category_id" value="' . $categoryId . '">
                               <a   href="restorecat.php?id='. $categoryId.'"  class="btn bg-warning text-light">restore</a>
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