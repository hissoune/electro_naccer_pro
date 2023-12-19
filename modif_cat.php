<?php
session_start();
if (!isset($_SESSION['email_in'])) {
    header('Location: index.php');
    exit(); 
}

$hostname = "localhost";
$username = "root";
$password = "";
$database = "Electro_naccer_pro";

$connection = new mysqli($hostname, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$id = $_GET["id"];
$categoryQuery = "SELECT * FROM category WHERE category_id=$id";
$result = $connection->query($categoryQuery);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categoryName = $row['category_name'];
        $categoryDiscrip = $row['category_desc'];
        $categoryImg = $row['category_imag'];}}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

    if (isset($_POST['name_cat'], $_POST['desc_cat'], $_FILES['file'])) {
        $cat_name = $_POST['name_cat'];
        $cat_desc = $_POST['desc_cat'];
        $photo = basename($_FILES['file']['name']);
        $targetPath = './images/' . $photo;
        $tempPath = $_FILES['file']['tmp_name'];

        if (move_uploaded_file($tempPath, $targetPath)) {
            $category_id = $_GET['id'];
            $connection->query("UPDATE category SET category_name='$cat_name', category_desc='$cat_desc', category_imag='$photo' WHERE category_id=$category_id");

            header("Location: MANGECAT.php");
            exit();
        }
    }
}
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
    <link rel="stylesheet" href="style.css">
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
<div class="container justify-content-center p-5" >
    <form class="form-section " method="post" enctype="multipart/form-data">
        <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">new name</label>
       <input type="text" id="name_category" class="form-control" name="name_cat" value="<?php echo $categoryName ;?>" >

       </div>
       <div class="mb-3 w-50 mx-5">
  <label for="description" class="form-label ">new description</label>
  <textarea class="form-control" id="description" name="desc_cat" rows="3" ><?php echo $categoryDiscrip; ?></textarea>
</div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="img_category">curent photo</label>
       <img src="images/<?php echo $categoryImg; ?>" alt="Category Image" width="100">
       <input type="file" id="img_category" class="form-control" name="file">
       </div>
       <button  type="submit" name="submit" class="btn bg-primary text-light mx-5">modifier votre category</button>
    </form>
    </div>
   

</body>
</html>