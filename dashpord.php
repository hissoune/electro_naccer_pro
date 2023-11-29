<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

    .navbar {
        flex-direction: column; 
        height: 100vh; 
    }

    .navbar-toggler {
        margin-bottom: 10px; 
    }

    

    .navbar-nav .nav-link:hover {
        background-color:blue;
        padding: 10px; 
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

?>
<section class="d-flex  " >
    <div class="w-25 h-100">
    <nav style="height:600px; background-color:aqua;" class="navbar navbar-expand-lg navbar-light bg-light flex-column w-100 ">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarNavbar"
        aria-controls="sidebarNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="sidebarNavbar">
        <ul class="navbar-nav flex-column">
            <li class="nav-item ">
                <a class="nav-link" href="home_admin.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manageuser.php">manage users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="MANGECAT.php">manage categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_products.php">manage products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn" href="index.php">log out</a>
            </li>
        </ul>
    </div>
</nav>


</div>
<?php

$sql = "SELECT * FROM User where is_admin = 1";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $adminName = $row['user_nam'];}}
      echo'  <div " class="container-flud w-100 bg-primary  h-50 d-flex justify-content-center ">';
       echo'<h4 class="p-3 my-3 text-light">welcom '.$adminName.'</h4>';
      
    echo' </div>';
?>


</section>

</body>
</html>