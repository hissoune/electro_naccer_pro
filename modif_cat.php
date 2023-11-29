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
    <form class="form-section" method="post" enctype="multipart/form-data">
        <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">new name</label>
       <input type="text" id="name_category" class="form-control" name="name_cat" >

       </div>
       <div class="mb-3 w-50 mx-5">
  <label for="description" class="form-label ">new description</label>
  <textarea class="form-control" id="description" name="desc_cat" rows="3"></textarea>
</div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="img_category">new photo</label>
       <input type="file" id="img_category" class="form-control" name="file" >
       </div>
       <button  type="submit" name="submit" class="btn bg-primary text-light mx-4">modifier votre category</button>
    </form>
    <?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "Electro_naccer_pro";

$connection = new mysqli($hostname, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET["id"];
    $categoryQuery = "SELECT * FROM category WHERE category_id=$id";

    if (isset($_POST['name_cat'], $_POST['desc_cat'], $_FILES['file'])) {
        $cat_name = $_POST['name_cat'];
        $cat_desc = $_POST['desc_cat'];
        $img_cart = 'images/' . $_FILES['file']['name'];

        if (move_uploaded_file($_FILES['file']['tmp_name'], $img_cart)) {
            $category_id = $_GET['id'];
            $connection->query("UPDATE category SET category_name='$cat_name', category_desc='$cat_desc', category_imag='$img_cart' WHERE category_id=$category_id");

            header("Location: MANGECAT.php");
            exit();
        }
    }
}
?>

</body>
</html>